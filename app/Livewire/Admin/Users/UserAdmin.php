<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions; // Impor SweetAlert
use App\Livewire\Forms\Admin\Users\UserForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;

// use App\Livewire\Forms\Admin\Users\UserForm; 

#[Layout('layouts.app')]
class UserAdmin extends Component
{
    use WithPagination, Interactions;

    public $search = '';
    public bool $modalEdit = false;
    //  public UserForm $form;
    public ?UserForm $form = null;

    public function boot()
    {
        if (!isset($this->form)) {
            $this->form = new UserForm($this, 'form');
        }
    }

    public function mount($role = null)
    {
        
        // Kirim sinyal menu aktif ke sidebar
        $this->dispatch('updatePage', page: 'manage_users');

        // Cek jika ada kiriman flash message dari form tambah data
        if (session()->has('admin_created')) {
            $this->dialog()->success('Berhasil!', session('admin_created'))->send();
        }
    }

    

    public function openEditModal($id)
    {
        $this->resetErrorBag();
        // Cari data user di database berdasarkan ID yang diklik
        // 
        $user = \App\Models\User::find($id);

        if ($user) {
            $this->form->setUserAdmin($user);
            
            // 2. Buka modal dengan aman
            $this->modalEdit = true;
        } else {
            $this->toast()->error('Gagal!', 'Data pengguna tidak ditemukan.')->send();
        }
    }

    

    // Reset halaman pagination ke nomor 1 jika pengguna mengetik di kolom pencarian
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Memicu Pop-up Konfirmasi Hapus (SweetAlert)
     */
    public function confirmDelete($id)
    {
        $this->dialog()
            ->question('Apakah Anda Yakin?', 'Data ini akan dihapus secara permanen.')
            ->confirm('Ya, Hapus!', 'delete', [
                'id' => $id,
                'color' => 'red' // Paksa menggunakan warna red agar lebih jelas
            ])
            ->cancel('Batal', 'cancelAction')
            ->send();
    }

    /**
     * Eksekusi Hapus Data Resmi
     */
    public function delete($id)
    {
        $data = \App\Models\User::where('id', $id)->first(); 

        if ($data) {
           if ($data->id === Auth::user()->id) {
                $this->dialog()->error('Aksi Ditolak!', 'Anda tidak bisa menghapus akun Anda sendiri yang sedang aktif.')->send();
                return;
            }
            

            $data->delete();
            $this->toast()->success('Berhasil!', 'Data berhasil dihapus.')->send();
            // $this->dialog()->success('Berhasil!', 'Data pengguna telah sukses dihapus.')->send();
        }
    }

    public function store()
    {
        try {
            
            // Jalankan validasi manual yang ada di dalam Form Object
            $this->form->validateCreate('admin');

            // Jika lolos validasi, baris di bawah ini akan dieksekusi
            User::create([
                'name' => $this->form->add_admin_name,
                'email'    => $this->form->add_admin_email,
                'password' => \Illuminate\Support\Facades\Hash::make($this->form->add_admin_password),
                'role'     => 'admin',
            ]);
            
            $this->form->reset();
            $this->dispatch('refresh-tabel');
            $this->toast()->success('Berhasil!', 'Data berhasil ditambahkan.')->send();
            // $this->dialog()->success('Berhasil!', 'Data berhasil ditambahkan.')->send();

        } catch (ValidationException $e) {
            
            // Ambil kumpulan pesan error dari exception
            $errors = $e->validator->errors()->all();

            // Looping dan tembakkan masing-masing error sebagai Toast dari TallStackUi
            foreach ($errors as $error) {
                $this->toast()->error('Validasi Gagal!', $error)->send();
            }
             // Teruskan kembali error bag internal agar form input ikut berwarna merah
            throw $e;
        }
        
    }

    public function update()
    {
        if (!$this->form->user) {
            $this->toast()->error('Gagal!', 'Sesi data pengguna tidak valid.')->send();
            return;
        }
        $userId = $this->form->user->id;
        if (!$userId) return;
        $this->validate([
            'form.edit_admin_name' => 'required|min:3',
            'form.edit_admin_email'    => 'required|email|unique:users,email,' . $userId,
        ], [
            'form.edit_admin_name.required' => 'Nama wajib diisi.',
            'form.edit_admin_email.unique'      => 'Email sudah terdaftar.',
        ]);
        if (!empty($this->form->edit_admin_password)) {
            $this->validate([
                'form.edit_admin_password' => 'required|min:8|max:255',
            ], [
                'form.edit_admin_password.min' => 'Kata sandi minimal harus 8 karakter.',
                'form.edit_admin_password.required' => 'Kata sandi wajib diisi.',
            ]);

            \App\Models\User::where('id', $userId)->update([
                'name' => $this->form->edit_admin_name,
                'email' => $this->form->edit_admin_email,
                'role' => 'admin',
                'password' => Hash::make($this->form->edit_admin_password),
            ]);
            
        }else{
            \App\Models\User::where('id', $userId)->update([
                'name' => $this->form->edit_admin_name,
                'email' => $this->form->edit_admin_email,
                'role' => 'admin',
            ]);
        }
        $this->modalEdit = false;
        $this->form->reset();
        $this->dispatch('refresh-tabel');
        $this->toast()->success('Berhasil!', 'Data berhasil diperbarui.')->send();
    }

    public function cancelAction()
    {
        // $this->modalCreate = false;
        $this->modalEdit = false;
        
        // Pastikan terinisialisasi sebelum di-reset
        if (isset($this->form)) {
            $this->form->reset();
        }
    }

    #[On('refresh-tabel')]
    public function refreshTable()
    {
        // Cukup biarkan kosong. 
        // Saat fungsi ini dipanggil oleh event, Livewire otomatis menjalankan ulang render()
    }

    public function render()
    {
        $headers = [
            ['index' => 'name', 'label' => 'Nama'],
            ['index' => 'email', 'label' => 'Email'],
            ['index' => 'action',   'label' => 'Aksi'], // Kolom kustom untuk tombol
        ];
       
        $users = \App\Models\User::where(function($query) {
                $query->where(function($q) {
                    // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
                    $keyword = strtolower($this->search);

                    // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
                    $q->whereRaw('LOWER(name) LIKE ?', ['%' . $keyword . '%']);
                });
            })
            ->latest()
            ->paginate(10);
       
        $title = 'Manajemen User Admin';
        return view('livewire.admin.users.user-admin', compact('users', 'headers', 'title'));
    }
}
