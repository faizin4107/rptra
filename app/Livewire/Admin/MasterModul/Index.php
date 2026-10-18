<?php

namespace App\Livewire\Admin\MasterModul;

use Livewire\Component;
use App\Livewire\Forms\Admin\MasterMadul\MasterModulForm;
use App\Models\MasterModul;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use TallStackUi\Traits\Interactions;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Index extends Component
{
    use WithPagination, Interactions; // Gunakan fitur pagination & sweetalert
    public $search = '';

    public bool $modalEdit = false;
    public ?MasterModulForm $form = null;

    public function boot()
    {
        if (!isset($this->form)) {
            $this->form = new MasterModulForm($this, 'form');
        }
    }

    public function openEditModal($id)
    {
        // $users = \App\Models\User::where('role', 'dpjp')->get();
        $this->resetErrorBag();
        // Cari data user di database berdasarkan ID yang diklik
        $user = \App\Models\MasterModul::find($id);

        if ($user) {
            $this->form->setData($user);
            
            // 2. Buka modal dengan aman
            $this->modalEdit = true;
        } else {
            $this->toast()->error('Gagal!', 'Data pengguna tidak ditemukan.')->send();
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

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
        $data = \App\Models\MasterModul::where('id', $id)->first(); 


        if ($data) {
            $data->delete();
            $this->toast()->success('Berhasil!', 'Data berhasil dihapus.')->send();
            // $this->dialog()->success('Berhasil!', 'Data pengguna telah sukses dihapus.')->send();
        }
    }

    #[On('refresh-tabel')]
    public function refreshTable()
    {
        // Cukup biarkan kosong. 
        // Saat fungsi ini dipanggil oleh event, Livewire otomatis menjalankan ulang render()
    }

    public function store()
    {
        try {
            $this->form->validateCreate();

            // Jika lolos validasi, baris di bawah ini akan dieksekusi
            // dd($this->form->add_asa1);
            MasterModul::create([
                'kode_modul' => $this->form->add_kode_modul,
                'nama_modul' => $this->form->add_nama_modul,
                'semester'    => $this->form->add_semester,
                'sks' => $this->form->add_sks,
                'kuota_tindakan' => 0,
                'asa1' => $this->form->add_asa1 ?? false,
                'asa2' => $this->form->add_asa2 ?? false,
                'asa3' => $this->form->add_asa3 ?? false,
                'asa4' => $this->form->add_asa4 ?? false,
                'asa5' => $this->form->add_asa5 ?? false,
                'asa6' => $this->form->add_asa6 ?? false,
                'asa7' => $this->form->add_asa7 ?? false,
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
        if (!$this->form->master_modul) {
            $this->toast()->error('Gagal!', 'Sesi data pengguna tidak valid.')->send();
            return;
        }
        $id = $this->form->master_modul->id;
        //  $user = \App\Models\User::find($this->userIdToEdit);

        if (!$id) return;
        // dd($this->form->endtime);
        // Jalankan validasi (abaikan keunikan email/username untuk ID user ini sendiri)
        $this->validate([
            'form.edit_kode_modul'     => 'required|min:4|unique:master_modul,kode_modul,' . $id,
            'form.edit_nama_modul'        => 'required|string',
            'form.edit_semester'   => 'required',
            'form.edit_sks' => 'required',
        ], [
            'form.edit_kode_modul.required' => 'Kode wajib diisi.',
            'form.edit_kode_modul.unique' => 'Kode sudah diisi di data yang lain.',
            'form.edit_nama_modul.required'   => 'Nama modul wajib diisi.',
            'form.edit_semester.required'      => 'Semester wajib diisi.',
            'form.edit_sks.required'   => 'SKS wajib diisi.',
        ]);
        
        \App\Models\MasterModul::where('id', $id)->update([
            'kode_modul' => $this->form->edit_kode_modul,
            'nama_modul' => $this->form->edit_nama_modul,
            'semester' => $this->form->edit_semester,
            'sks' => $this->form->edit_sks,
            'asa1' => $this->form->edit_asa1,
            'asa2' => $this->form->edit_asa2,
            'asa3' => $this->form->edit_asa3,
            'asa4' => $this->form->edit_asa4,
            'asa5' => $this->form->edit_asa5,
            'asa6' => $this->form->edit_asa6,
            'asa7' => $this->form->edit_asa7,
        ]);
        
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
   
    public function render()
    {
        $headers = [
            ['index' => 'modul', 'label' => 'Kode / Modul'],
            ['index' => 'semester_sks', 'label' => 'Semester / SKS'],
            ['index' => 'kompetensi',     'label' => 'Kompetensi'],
            ['index' => 'action',   'label' => 'Aksi'], // Kolom kustom untuk tombol
        ];
        $total_modul = \App\Models\MasterModul::count();
        // dd($total_moduls);
        $master_modul = \App\Models\MasterModul
            ::where(function($query) {
                $query->where(function($q) {
                    // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
                    $keyword = strtolower($this->search);

                    // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
                    $q->whereRaw('LOWER(kode_modul) LIKE ?', ['%' . $keyword . '%'])
                    ->orWhereRaw('LOWER(nama_modul) LIKE ?', ['%' . $keyword . '%']);
                });
            })
            ->latest()
            ->paginate(10);
        return view('livewire.admin.master-modul.index', compact('master_modul', 'headers', 'total_modul'));
    }
}
