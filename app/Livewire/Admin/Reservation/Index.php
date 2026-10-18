<?php

namespace App\Livewire\Admin\Reservation;

use App\Models\Pemesanan;
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
    public $status = null; 
   

    public function mount($status = null)
    {
        $this->status = $status;
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
            ->question('Apakah Anda ingin menyutujui?', 'Data akan di perbaharui.')
            ->confirm('Ya!', 'approve', [
                'id' => $id,
                'color' => 'red' // Paksa menggunakan warna red agar lebih jelas
            ])
            ->cancel('Batal')
            ->send();
    }

    public function approve($id)
    {
        $data = Pemesanan::where('id', $id)->first(); 

        if ($data) {
            $data->update(['status' => 'booking']);
            
            // Kirim notifikasi sukses Toast dari TallStackUi
            $this->dispatch('refresh-tabel');
            $this->toast()->success('Berhasil!', "Data berhasil diperbaharui") ->send();
        }
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
        $data = Pemesanan::where('id', $id)->first();
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

    public function render()
    {
        if($this->status == 'booking'){
            $headers = [
                ['index' => 'tempat_kegiatan', 'label' => 'Tempat'],
                ['index' => 'nama_penanggung_jawab', 'label' => 'Nama Penanggung Jawab'],
                ['index' => 'tujuan', 'label' => 'Tujuan Kegiatan'],
                ['index' => 'jumlah_peserta',     'label' => 'Jumlah Peserta'],
                ['index' => 'no_wa',     'label' => 'No Whatsapp'],
                ['index' => 'tanggal',     'label' => 'Tanggal'],
                ['index' => 'waktu',     'label' => 'Waktu'],
            ];
        }else{
            $headers = [
                ['index' => 'tempat_kegiatan', 'label' => 'Tempat'],
                ['index' => 'nama_penanggung_jawab', 'label' => 'Nama Penanggung Jawab'],
                ['index' => 'tujuan', 'label' => 'Tujuan Kegiatan'],
                ['index' => 'jumlah_peserta',     'label' => 'Jumlah Peserta'],
                ['index' => 'no_wa',     'label' => 'No Whatsapp'],
                ['index' => 'tanggal',     'label' => 'Tanggal'],
                ['index' => 'waktu',     'label' => 'Waktu'],
                ['index' => 'action',   'label' => 'Aksi'], // Kolom kustom untuk tombol
            ];
        }
        
        
        $reservations = Pemesanan::where('status', '=', $this->status)
            ->where(function($query) {
                $query->where(function($q) {
                    // Ubah teks pencarian dari user menjadi huruf kecil terlebih dahulu
                    $keyword = strtolower($this->search);

                    // Menggunakan whereRaw agar sesuai dengan indeks LOWER yang baru dibuat
                    $q->whereRaw('LOWER(tempat_kegiatan) LIKE ?', ['%' . $keyword . '%']);
                });
            })
            ->latest()
            ->paginate(10);
        // dd($users);
        $title = 'Reservation ' . ($this->status ? ucfirst($this->status) : '');
        return view('livewire.admin.reservation.index', compact('reservations', 'headers', 'title'));
    }
}
