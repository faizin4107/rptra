<?php

namespace App\Livewire\Admin\AuditLogs;

use App\Models\AuditLogs;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Index extends Component
{
    use WithPagination, Interactions; // Gunakan fitur pagination & sweetalert
    // public $search = '';
    public $show_search = false;
    public $date = '';
    public $user = '';

    public function mount()
    {
        // Kirim sinyal menu aktif ke sidebar
        // $this->dispatch('updatePage', page: 'manage_users');

        // Cek jika ada kiriman flash message dari form tambah data
        if (session()->has('user_created')) {
            $this->dialog()->success('Berhasil!', session('user_created'))->send();
        }
    }

    public function search()
    {
        // $this->resetPage();
        // dd($this->user);
        $this->show_search = true;

    }

    public function resetSearch()
    {
        $this->show_search = false;
        $this->date = '';
        $this->user = '';
    }

    public function confirmDelete($id)
    {
        // $this->dialog()
        //     ->question('Apakah Anda Yakin?', 'Data ini akan dihapus secara permanen.')
        //     ->confirm('Ya, Hapus!', 'delete', $id)
            
        //     // Jika tombol batal diklik, panggil fungsi 'cancelAction' di class PHP
        //     ->cancel('Batal', 'cancelAction') 
        //     ->send();

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
        // $data = AuditLogs::find($id);
        $data = \App\Models\AuditLogs::where('id', $id)->first(); 

        if ($data) {
            $data->delete();
            $this->toast()->success('Berhasil!', 'Data berhasil dihapus.')->send();
            // $this->dialog()->success('Berhasil!', 'Data pengguna telah sukses dihapus.')->send();
        }
    }

    public function cancelAction()
    {
        
    }

    public function render()
    {
        $total_logs = \App\Models\AuditLogs::count();
        $headers = [
            ['index' => 'user', 'label' => 'Nama'],
            ['index' => 'activity', 'label' => 'Aktivitas'],
            ['index' => 'ip_address',     'label' => 'IP Address'],
            ['index' => 'action',   'label' => 'Aksi'], // Kolom kustom untuk tombol
        ];
        // Mengambil data user berdasarkan pencarian fullname atau username
        // $users = \App\Models\User::with('users')
        //     ->where(function($query) {
        //         $query->where('fullname', 'ilike', '%' . $this->search . '%')
        //             ->orWhere('username', 'ilike', '%' . $this->search . '%');
        //     })
        //     ->latest()
        //     ->paginate(10);
        if($this->show_search){
            
            // if(!empty($this->date)){
            //     $logs = \App\Models\AuditLogs::with('user')
            //         ->whereHas('user', function($query) {
            //             $query->where(function($q) {
            //                 $q->where('fullname', 'ilike', '%' . $this->search . '%')
            //                 ->orWhere('role', 'ilike', '%' . $this->search . '%');
            //             });
            //         })
            //         ->whereDate('created_at', $this->date)
            //         ->latest()
            //         ->paginate(10);
            // }else{
            //     $logs = \App\Models\AuditLogs::with('user')
            //     ->whereHas('user', function($query) {
            //         $query->where(function($q) {
            //             $q->where('fullname', 'ilike', '%' . $this->search . '%')
            //             ->orWhere('role', 'ilike', '%' . $this->search . '%');
            //         });
            //     })
            //     ->latest()
            //     ->paginate(10);
            // }
            // $logs = \App\Models\AuditLogs::with('user')
            //     ->whereHas('user', function($query) {
            //         $query->where(function($q) {
            //             $q->where('fullname', 'ilike', '%' . $this->user . '%')
            //             ->orWhere('role', 'ilike', '%' . $this->user . '%');
            //         });
            //     })
            //     // Jika $this->date tidak kosong, jalankan query di dalam closure ini
            //     ->when(!empty($this->date), function($query) {
            //         $query->whereDate('created_at', $this->date);
            //     })
            //     ->latest()
            //     ->paginate(10);
            
            // $logs = \App\Models\AuditLogs::with('user')
            //     ->whereHas('user', function($query) {
            //         $query->where(function($q) {
            //             // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
            //             $keyword = strtolower($this->user);

            //             // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
            //             $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $keyword . '%'])
            //             ->orWhereRaw('LOWER(role) LIKE ?', ['%' . $keyword . '%']);
            //         });
            //     })
            //     ->with('residen')
            //     ->whereHas('residen', function($query) {
            //         $query->where(function($q) {
            //             // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
            //             $keyword = strtolower($this->user);

            //             // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
            //             $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $keyword . '%'])
            //             ->orWhereRaw('LOWER(role) LIKE ?', ['%' . $keyword . '%']);
            //         });
            //     })
            //     ->with('dpjp')
            //     ->whereHas('dpjp', function($query) {
            //         $query->where(function($q) {
            //             // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
            //             $keyword = strtolower($this->user);

            //             // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
            //             $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $keyword . '%'])
            //             ->orWhereRaw('LOWER(role) LIKE ?', ['%' . $keyword . '%']);
            //         });
            //     })
            //     ->when(!empty($this->date), function($query) {
            //         $query->whereDate('created_at', $this->date);
            //     })
            //     ->latest()
            //     ->paginate(10);
            // $logs = \App\Models\AuditLogs::with('user')
            //     ->whereHas('user', function($query) {
            //         // Filter spesifik untuk role admin dan residen
            //         $query->whereIn(DB::raw('LOWER(role)'), ['admin', 'residen', 'dpjp']);
                    
            //         // Tetap pertahankan pencarian nama jika diperlukan
            //         if (!empty($this->user)) {
            //             $keyword = strtolower($this->user);
            //             $query->whereRaw('LOWER(fullname) LIKE ?', ['%' . $keyword . '%']);
            //         }
            //     })
            //     ->when(!empty($this->date), function($query) {
            //         $query->whereDate('created_at', $this->date);
            //     })
            //     ->latest()
            //     ->first(); // Mengambil 1 hasil saja (sebagai objek tunggal)
            // $keyword = strtolower($this->user);

            // $logs = \App\Models\AuditLogs::with('user')
            //     ->whereHasMorph('user', [\App\Models\User::class, \App\Models\Residen::class], function($query, $type) use ($keyword) {
            //         // $type akan berisi model yang sedang diperiksa (User atau Residen)
                    
            //         $query->where(function($q) use ($keyword) {
            //             $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $keyword . '%'])
            //             ->orWhereRaw('LOWER(role) LIKE ?', ['%' . $keyword . '%']);
            //         });
            //     })
            //     ->when(!empty($this->date), function($query) {
            //         $query->whereDate('created_at', $this->date);
            //     })
            //     ->latest()
            //     ->paginate(10);
                
                // ATAU gunakan ->paginate(1) jika tetap ingin bentuk pagination

            $keyword = strtolower($this->user);

            // Buat satu fungsi pencarian agar tidak menulis ulang 3 kali
            $searchFilter = function($query) use ($keyword) {
                $query->where(function($q) use ($keyword) {
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $keyword . '%'])
                    ->orWhereRaw('LOWER(role) LIKE ?', ['%' . $keyword . '%']);
                });
            };

            $logs = \App\Models\AuditLogs::with(['user', 'residen', 'dpjp']) // Load semua relasi
                ->where(function($mainQuery) use ($searchFilter) {
                    // Cari di relasi user ATAU residen ATAU dpjp
                    $mainQuery->whereHas('user', $searchFilter)
                            ->orWhereHas('residen', $searchFilter)
                            ->orWhereHas('dpjp', $searchFilter);
                })
                ->when(!empty($this->date), function($query) {
                    $query->whereDate('created_at', $this->date);
                })
                ->latest()
                ->paginate(10);
        }else{
            
            $logs = \App\Models\AuditLogs::with('user')->with('residen')->with('dpjp')
            ->latest()
            ->paginate(10);
        }
        // dd($logs);

        return view('livewire.admin.audit-logs.index', compact('logs', 'headers', 'total_logs'));
    }
}
