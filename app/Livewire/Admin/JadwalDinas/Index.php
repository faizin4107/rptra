<?php

namespace App\Livewire\Admin\JadwalDinas;

use App\Livewire\Forms\Admin\Jadwal\JadwalForm;
use App\Models\Jadwal;
use App\Models\JadwalResiden;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Index extends Component
{
    use WithPagination, Interactions;
    public $search = '';
    public bool $modalEdit = false;
    public bool $modalCreate = false;
    public ?JadwalForm $form = null;

    public $searchResiden = ''; // Properti untuk pencarian
    public $selected_users = [];
    public $saved_user_ids = [];
    public $dpjp_id = '';
    // public $selected_jadwal_id;

    public function boot()
    {
        if (!isset($this->form)) {
            $this->form = new JadwalForm($this, 'form');
        }
    }

    public function getResidensProperty()
    {
        return \App\Models\Residen::query()
            // ->where('role', 'residen') // Pastikan hanya role residen
            ->when($this->searchResiden, function($query) {
                $query->where(function($q) {
                    $keyword = strtolower($this->searchResiden);
                    $q->whereRaw('LOWER(fullname) LIKE ?', ['%' . $keyword . '%'])
                      ->orWhereRaw('LOWER(role) LIKE ?', ['%' . $keyword . '%']);
                });
            })
            ->orderBy('fullname', 'asc')
            ->get();
    }

    public function mount($role = null)
    {
        // Kirim sinyal menu aktif ke sidebar
        // $this->dispatch('updatePage', page: 'manage_users');

        // Cek jika ada kiriman flash message dari form tambah data
        // if (session()->has('user_created')) {
        //     $this->dialog()->success('Berhasil!', session('user_created'))->send();
        // }
    }

    public function openEditModal($id)
    {
        // $users = \App\Models\User::where('role', 'dpjp')->get();
        $this->resetErrorBag();
        // Cari data user di database berdasarkan ID yang diklik
        $user = \App\Models\Jadwal::find($id);

        if ($user) {
            $this->form->setData($user);
            
            // 2. Buka modal dengan aman
            $this->modalEdit = true;
        } else {
            $this->toast()->error('Gagal!', 'Data pengguna tidak ditemukan.')->send();
        }
    }

    public function openCreateModal($id)
    {
        $this->resetErrorBag();
        $this->modalCreate = true;
        $this->form->id = $id;
        $dpjp = \App\Models\Jadwal::where('id', $id)->first();
        $this->dpjp_id = $dpjp->dpjp_id;
        $this->saved_user_ids = \App\Models\JadwalResiden::where('jadwal_id', $id)
        ->pluck('residen_id') // Hanya ambil kolom user_id
        ->toArray();       // Ubah jadi array biasa [1, 2, 5]
        // dd($this->saved_user_ids);
        
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
        $data = \App\Models\Jadwal::where('id', $id)->first(); 


        if ($data) {
            $data->delete();
            $this->toast()->success('Berhasil!', 'Data berhasil dihapus.')->send();
            // $this->dialog()->success('Berhasil!', 'Data pengguna telah sukses dihapus.')->send();
        }
    }

    public function store()
    {
        try {
            
            // Jalankan validasi manual yang ada di dalam Form Object
            $this->form->validateCreate();

            // $day = date('l');
            // $start_time = $this->form->add_start_time;
            // $end_time = $this->form->add_end_time;
            // $time_now = now();
            // dd($this->form->add_day);

            $start_time = Carbon::createFromTimeString($this->form->add_start_time);
            $end_time = Carbon::createFromTimeString($this->form->add_end_time);

            // if (strtotime($start_time) >= strtotime($end_time)) {
            //     // Kembalikan error: Waktu mulai tidak boleh melebihi waktu selesai
            // }

            // if ($start_time->greaterThan($end_time)) {
            //     $this->dialog()->error('Gagal membuat jadwal!', 'Jam mulai tidak boleh lebih dari jam selesai.')->send();
            //     return;
            // }
            // $users = \App\Models\Jadwal::where('user_id', $this->form->add_user_id)->where('day', $day)->get();
            // if(count($users) > 0){
            //     foreach($users as $row){
            //         if($row->)
            //     }
            // }
            // $isExist = DB::table('jadwal') // Ganti dengan nama tabel Anda
            //     ->where('user_id', $this->form->add_user_id)
            //     ->where('day', $day)
            //     ->where(function ($query) use ($start_time, $end_time) {
            //         $query->where('start_time', '<', $end_time)
            //             ->where('end_time', '>', $start_time);
            //     })
            //     ->exists(); // Menghasilkan true jika ada data yang bentrok
            // $isExist = DB::table('jadwal')
            // ->where('user_id', $this->form->add_user_id)
            // ->where('day', $day)
            // ->where(function ($query) use ($start_time, $end_time) {
            //     $query->where(function ($q) use ($start_time, $end_time) {
            //         // Logika Overlap:
            //         // Jadwal bentrok jika:
            //         // (Waktu mulai baru ada di antara jadwal lama)
            //         // ATAU (Waktu selesai baru ada di antara jadwal lama)
            //         // ATAU (Jadwal baru menutupi seluruh jadwal lama)
            //         $q->where('start_time', '<', $end_time)
            //         ->where('end_time', '>', $start_time);
            //     });
            // })
            // // 2. Jika ini proses UPDATE, pastikan abaikan ID data yang sedang diedit
            // // ->where('id', '!=', $current_id) 
            // ->exists();
            // $isExist = DB::table('jadwal')
            // ->where('user_id', $this->form->add_user_id)
            // ->where('day', $this->form->add_day)
            // ->where(function ($query) use ($start_time, $end_time) {
            //     $query->whereTime('start_time', '<', $end_time)
            //         ->whereTime('end_time', '>', $start_time);
            // })
            // ->exists();
            $isExist = DB::table('jadwal')
                ->where('dpjp_id', $this->form->add_dpjp_id)
                ->where('day', $this->form->add_day)
                ->where(function ($query) use ($start_time, $end_time) {
                    $query->where(function ($q) use ($start_time, $end_time) {
                        // Cek jika jam mulai baru berada di dalam range yang sudah ada
                        $q->whereTime('start_time', '<=', $start_time)
                        ->whereTime('end_time', '>', $start_time);
                    })
                    ->orWhere(function ($q) use ($start_time, $end_time) {
                        // Cek jika jam selesai baru berada di dalam range yang sudah ada
                        $q->whereTime('start_time', '<', $end_time)
                        ->whereTime('end_time', '>=', $end_time);
                    })
                    ->orWhere(function ($q) use ($start_time, $end_time) {
                        // Cek jika jadwal baru justru "membungkus" jadwal yang sudah ada
                        $q->whereTime('start_time', '>=', $start_time)
                        ->whereTime('end_time', '<=', $end_time);
                    });
                })
                ->exists();
            // dd($isExist);
            // Jika bentrok, kembalikan error ke user
            if ($isExist) {
                $this->dialog()->error('Gagal membuat jadwal!', 'Jadwal yang anda masukkan sudah terdaftar dengan user, hari dan jam tersebut.')->send();
                return;
            }



            // dd($this->form->add_dpjp_id);

            // Jika lolos validasi, baris di bawah ini akan dieksekusi
            Jadwal::create([
                'dpjp_id' => $this->form->add_dpjp_id,
                'day' => $this->form->add_day,
                'start_time'    => $this->form->add_start_time,
                'end_time' => $this->form->add_end_time,
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
        if (!$this->form->jadwal) {
            $this->toast()->error('Gagal!', 'Sesi data pengguna tidak valid.')->send();
            return;
        }
        $userId = $this->form->jadwal->id;
        //  $user = \App\Models\User::find($this->userIdToEdit);

        if (!$userId) return;
        // dd($this->form->endtime);
        // Jalankan validasi (abaikan keunikan email/username untuk ID user ini sendiri)
        $this->validate([
            'form.edit_dpjp_id'     => 'required|integer',
            'form.edit_day'        => 'required|string',
            'form.starttime'   => 'required',
            'form.endtime' => 'required|after:form.starttime',
        ], [
            'form.edit_dpjp_id.required' => 'Nama lengkap wajib diisi.',
            'form.edit_day.required'   => 'Hari wajib diisi.',
            'form.starttime.required'      => 'Jam mulai wajib diisi.',
            'form.endtime.required'   => 'Jam selesai wajib diisi.',
            'form.endtime.after'     => 'Jam mulai tidak boleh lebih dari jam selesai.',
        ]);
        // $day = date('l');
        // $start_time = $this->form->edit_start_time;
        // $end_time = $this->form->edit_end_time;
        // dd($this->form->edit_start_time);
        // $start_time = \Carbon\Carbon::createFromFormat('h:i A', $this->form->edit_start_time)->format('H:i:s');
        // $end_time = \Carbon\Carbon::createFromFormat('h:i A', $this->form->edit_start_time)->format('H:i:s');
        $start_time = Carbon::createFromTimeString($this->form->starttime)->format('H:i:s');
        $end_time = Carbon::createFromTimeString($this->form->endtime)->format('H:i:s');
        // if ($start_time->greaterThan($end_time)) {
        //     $this->dialog()->error('Gagal membuat jadwal!', 'Jam mulai tidak boleh lebih dari jam selesai.')->send();
        //     return;
        // }
        $isExist = DB::table('jadwal')
            ->where('dpjp_id', $this->form->edit_dpjp_id)
            ->where('day', $this->form->edit_day)
            // --- TAMBAHKAN BARIS INI ---
            ->where('id', '!=', $userId) 
            // ---------------------------
            ->where(function ($query) use ($start_time, $end_time) {
                $query->where(function ($q) use ($start_time, $end_time) {
                    // Cek jika jam mulai baru berada di dalam range yang sudah ada
                    $q->whereTime('start_time', '<=', $start_time)
                    ->whereTime('end_time', '>', $start_time);
                })
                ->orWhere(function ($q) use ($start_time, $end_time) {
                    // Cek jika jam selesai baru berada di dalam range yang sudah ada
                    $q->whereTime('start_time', '<', $end_time)
                    ->whereTime('end_time', '>=', $end_time);
                })
                ->orWhere(function ($q) use ($start_time, $end_time) {
                    // Cek jika jadwal baru justru "membungkus" jadwal yang sudah ada
                    $q->whereTime('start_time', '>=', $start_time)
                    ->whereTime('end_time', '<=', $end_time);
                });
            })
            ->exists();

        // $isExist = DB::table('jadwal')
        //     ->where('user_id', $this->form->add_user_id)
        //     ->where('day', $this->form->add_day)
        //     ->where(function ($query) use ($start_time, $end_time) {
        //         $query->whereTime('start_time', '<', $end_time)
        //             ->whereTime('end_time', '>', $start_time);
        //     })
        //     ->exists();

        // 3. Jika bentrok, kirim pesan error
        if ($isExist) {
            $this->modalEdit = false;
            // $this->dialog()->error('Gagal membuat jadwal!', 'Jadwal yang anda masukkan sudah terdaftar dengan user, hari dan jam tersebut.')->send();
            $this->dialog()->error('Gagal ubah data!', 'Data yang anda masukkan sudah ada')->send();
            return;
        }
        // dd($start_time);
        \App\Models\Jadwal::where('id', $userId)->update([
            'dpjp_id' => $this->form->edit_dpjp_id,
            'day' => $this->form->edit_day,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);
        
        $this->modalEdit = false;
        $this->form->reset();
        $this->dispatch('refresh-tabel');
        $this->toast()->success('Berhasil!', 'Data berhasil diperbarui.')->send();
    }

    public function store_residen()
    {
        // dd($this->form->users);
        $this->validate([
            'form.users'     => 'required',
        ], [
            'form.users.required' => 'Nama wajib dipilih.',
        ]);
        foreach($this->form->users as $row){
            JadwalResiden::create([
                'jadwal_id' => $this->form->id,
                'residen_id' => $row,
                'dpjp_id' => $this->dpjp_id,
            ]);
        }
        $this->modalCreate = false;
        $this->form->reset();
        $this->dispatch('refresh-tabel');
        $this->toast()->success('Berhasil!', 'Data berhasil ditambahkan.')->send();
    }

    public function cancelAction()
    {
        $this->modalCreate = false;
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
        $dpjp = \App\Models\Dpjp::get();
        $users_residen = $this->getResidensProperty();
        $headers = [
            ['index' => 'user', 'label' => 'Nama'],
            ['index' => 'day', 'label' => 'Hari'],
            ['index' => 'time',     'label' => 'Waktu'],
            ['index' => 'action',   'label' => 'Aksi'], // Kolom kustom untuk tombol
        ];
        // $jadwals = \App\Models\Jadwal::with('user')
        //     ->latest()
        //     ->paginate(10);

       $keyword = strtolower($this->search);

        // 1. Buat Kamus Terjemahan Hari
        $dayMapping = [
            'senin'  => 'monday',
            'selasa' => 'tuesday',
            'rabu'   => 'wednesday',
            'kamis'  => 'thursday',
            'jumat'  => 'friday',
            'sabtu'  => 'saturday',
            'minggu' => 'sunday',
            'ahad'   => 'sunday', // Tambahan variasi
        ];

        // 2. Cek apakah keyword ada di kamus, jika ada ambil bahasa Inggrisnya
        // Jika tidak ada (misal user cari nama orang), tetap gunakan keyword asli
      
        
        $translatedDay = $dayMapping[$keyword] ?? $keyword;
        $jadwals = \App\Models\Jadwal::with('dpjp')
            ->where(function($mainQuery) use ($keyword, $translatedDay) {
                $mainQuery->whereHas('dpjp', function($query) use ($keyword) {
                    // Tetap cari nama orang dengan keyword asli (Indonesia/Apapun)
                    $query->whereRaw('LOWER(fullname) LIKE ?', ['%' . $keyword . '%']);
                })
                // Cari di kolom day menggunakan keyword yang sudah diterjemahkan
                // Kita gunakan LIKE agar user ketik "Sen" tetap bisa ketemu "Monday"
                ->orWhereRaw('LOWER(day) LIKE ?', ['%' . $translatedDay . '%'])
                
                // Opsional: Tetap cari di kolom day dengan keyword asli 
                // (Jaga-jaga jika user ketik "Monday" langsung)
                ->orWhereRaw('LOWER(day) LIKE ?', ['%' . $keyword . '%']);
            })
            ->latest()
            ->paginate(10);
        // dd($jadwals);
        return view('livewire.admin.jadwal-dinas.index', compact('dpjp', 'jadwals', 'headers', 'users_residen'));
    }
}
