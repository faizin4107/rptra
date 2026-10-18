<?php

namespace App\Livewire\Admin\MasterKrs;

use App\Livewire\Forms\Admin\MasterKrs\MasterKrsForm;
use App\Models\MasterKrs;
use Illuminate\Validation\ValidationException;
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

    public bool $modalEdit = false;
    public ?MasterKrsForm $form = null;

    public function boot()
    {
        if (!isset($this->form)) {
            $this->form = new MasterKrsForm($this, 'form');
        }
    }

    public function openEditModal($id)
    {
        // $users = \App\Models\User::where('role', 'dpjp')->get();
        $this->resetErrorBag();
        // Cari data user di database berdasarkan ID yang diklik
        $user = \App\Models\MasterKrs::find($id);

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
        $data = \App\Models\MasterKrs::where('id', $id)->first(); 


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
            MasterKrs::create([
                'kode_mk' => $this->form->add_kode_mk,
                'nama_mk' => $this->form->add_nama_mk,
                'semester'    => $this->form->add_semester,
                'sks' => $this->form->add_sks,
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
        if (!$this->form->master_krs) {
            $this->toast()->error('Gagal!', 'Sesi data pengguna tidak valid.')->send();
            return;
        }
        $masterKrsId = $this->form->master_krs->id;
        //  $user = \App\Models\User::find($this->userIdToEdit);

        if (!$masterKrsId) return;
        // dd($this->form->endtime);
        // Jalankan validasi (abaikan keunikan email/username untuk ID user ini sendiri)
        $this->validate([
            'form.edit_kode_mk'     => 'required|min:4|unique:master_krs,kode_mk,' . $masterKrsId,
            'form.edit_nama_mk'        => 'required|string',
            'form.edit_semester'   => 'required',
            'form.edit_sks' => 'required',
        ], [
            'form.edit_kode_mk.required' => 'Kode wajib diisi.',
            'form.edit_kode_mk.unique' => 'Kode sudah diisi di data yang lain.',
            'form.edit_nama_mk.required'   => 'Mata kuliah wajib diisi.',
            'form.edit_semester.required'      => 'Semester wajib diisi.',
            'form.edit_sks.required'   => 'SKS wajib diisi.',
        ]);
        
        \App\Models\MasterKrs::where('id', $masterKrsId)->update([
            'kode_mk' => $this->form->edit_kode_mk,
            'nama_mk' => $this->form->edit_nama_mk,
            'semester' => $this->form->edit_semester,
            'sks' => $this->form->edit_sks,
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
            ['index' => 'kode_mk', 'label' => 'Kode'],
            ['index' => 'nama_mk', 'label' => 'Mata Kuliah'],
            ['index' => 'semester',     'label' => 'Semester'],
            ['index' => 'sks',     'label' => 'SKS'],
            ['index' => 'action',   'label' => 'Aksi'], // Kolom kustom untuk tombol
        ];
        $master_krs = \App\Models\MasterKrs
            ::where(function($query) {
                $query->where(function($q) {
                    // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
                    $keyword = strtolower($this->search);

                    // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
                    $q->whereRaw('LOWER(kode_mk) LIKE ?', ['%' . $keyword . '%'])
                    ->orWhereRaw('LOWER(nama_mk) LIKE ?', ['%' . $keyword . '%']);
                });
            })
            ->latest()
            ->paginate(10);
        return view('livewire.admin.master-krs.index', compact('master_krs', 'headers'));
    }
}
