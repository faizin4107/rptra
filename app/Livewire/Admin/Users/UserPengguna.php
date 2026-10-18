<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pengguna;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions; // Impor SweetAlert
use App\Livewire\Forms\Admin\Users\UserForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;

// use App\Livewire\Forms\Admin\Users\UserForm; 

#[Layout('layouts.app')]
class UserPengguna extends Component
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
        $data = \App\Models\Pengguna::where('id', $id)->first(); 

        if ($data) {

            $data->delete();
            $this->toast()->success('Berhasil!', 'Data berhasil dihapus.')->send();
            // $this->dialog()->success('Berhasil!', 'Data pengguna telah sukses dihapus.')->send();
        }
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
            ['index' => 'nama_lengkap', 'label' => 'Nama'],
            ['index' => 'email', 'label' => 'Email'],
            ['index' => 'nik', 'label' => 'NIK'],
            ['index' => 'telp', 'label' => 'Telepon'],
            ['index' => 'instansi', 'label' => 'Instansi'],
            ['index' => 'action',   'label' => 'Aksi'], // Kolom kustom untuk tombol
        ];
       
        $users = \App\Models\Pengguna::where(function($query) {
                $query->where(function($q) {
                    // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
                    $keyword = strtolower($this->search);

                    // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
                    $q->whereRaw('LOWER(nama_lengkap) LIKE ?', ['%' . $keyword . '%']);
                });
            })
            ->when(!empty($this->roleFilter), function($query) {
                $query->where('role', $this->roleFilter);
            })
            ->latest()
            ->paginate(10);

       
        $title = 'Manajemen User Pengguna';
        return view('livewire.admin.users.user-pengguna', compact('users', 'headers', 'title'));
    }
}
