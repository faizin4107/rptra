<?php

namespace App\Livewire\Admin\VerificationUsers;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Index extends Component
{
    use WithPagination, Interactions; // Gunakan fitur pagination & sweetalert
    public $search = '';
    public $roleFilter = null; 
   

    public function mount($role = null)
    {
        $validRoles = ['dpjp', 'residen'];

        if ($role && in_array($role, $validRoles)) {
            $this->roleFilter = $role;
        } else {
            // Jika URL sembarangan (misal: admin/users/hacker), kembalikan ke default (null)
            $this->roleFilter = null; 
        }
        // Kirim sinyal menu aktif ke sidebar
        // $this->dispatch('updatePage', page: 'manage_users');

        // Cek jika ada kiriman flash message dari form tambah data
        if (session()->has('user_created')) {
            $this->dialog()->success('Berhasil!', session('user_created'))->send();
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
    public function confirmApprove($id)
    {
        $this->dialog()
            ->question('Apakah Anda ingin menyutujui?', 'Status pengguna akan aktif.')
            ->confirm('Ya!', 'approve', [
                'id' => $id,
                'color' => 'red' // Paksa menggunakan warna red agar lebih jelas
            ])
            ->cancel('Batal')
            ->send();
    }

    public function approve($id)
    {
        // $user = \App\Models\User::find($id);
        if($this->roleFilter === 'residen'){
            $user = \App\Models\Residen::where('id', $id)->first(); 
        }else if($this->roleFilter === 'dpjp'){
            $user = \App\Models\Dpjp::where('id', $id)->first(); 
        }
        

        if ($user) {
            $user->update(['status' => 'Aktif']);
            
            // Kirim notifikasi sukses Toast dari TallStackUi
            $this->dispatch('refresh-tabel');
            $this->toast()->success('Berhasil Dikonfirmasi!', "Akun {$user->fullname} sekarang sudah aktif dan dapat login ke sistem.") ->send();
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
            ['index' => 'fullname', 'label' => 'Nama'],
            ['index' => 'email', 'label' => 'Email'],
            ['index' => 'role',     'label' => 'Role'],
            ['index' => 'action',   'label' => 'Aksi'], // Kolom kustom untuk tombol
        ];
        // Mengambil data user berdasarkan pencarian fullname atau username
        // $users = \App\Models\User::where('status', '=', 'Pending')
        //     ->where(function($query) {
        //         $query->where('fullname', 'ilike', '%' . $this->search . '%')
        //             ->orWhere('username', 'ilike', '%' . $this->search . '%');
        //     })
        //     ->latest()
        //     ->paginate(10);
        
        if($this->roleFilter === 'residen'){
            $users = \App\Models\Residen::where('status', '=', 'Pending')
                ->where(function($query) {
                    $query->where(function($q) {
                        // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
                        $keyword = strtolower($this->search);

                        // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
                        $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $keyword . '%'])
                        ->orWhereRaw('LOWER(username) LIKE ?', ['%' . $keyword . '%']);
                    });
                })
                ->latest()
                ->paginate(10);
        }else if($this->roleFilter === 'dpjp'){
            $users = \App\Models\Dpjp::where('status', '=', 'Pending')
                ->where(function($query) {
                    $query->where(function($q) {
                        // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
                        $keyword = strtolower($this->search);

                        // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
                        $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $keyword . '%'])
                        ->orWhereRaw('LOWER(username) LIKE ?', ['%' . $keyword . '%']);
                    });
                })
                ->latest()
                ->paginate(10);
        }
        // dd($users);
        $title = 'Verifikasi User ' . ($this->roleFilter ? ucfirst($this->roleFilter) : '');
        return view('livewire.admin.verification-users.index', compact('users', 'headers', 'title'));
    }
}
