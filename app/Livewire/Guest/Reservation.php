<?php

namespace App\Livewire\Guest;

use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions;
use Livewire\Attributes\Validate;
use Carbon\Carbon;

#[Layout('layouts.guest')] 
class Reservation extends Component
{
    use Interactions;
    public function mount()
    {
        if(!Auth::guard('pengguna')->check()){
            return $this->redirectRoute('login', navigate: true);
        }
                
    }

    #[Validate('required', message: 'Tempat kegiatan wajib diisi.')]
    public $tempat_kegiatan = '';

    #[Validate('required', message: 'Nama penanggung jawab wajib diisi.')]
    public $nama_penanggung_jawab = '';

    #[Validate('required', message: 'Tujuan kegiatan wajib diisi.')]
    public $tujuan = '';

    #[Validate('required', message: 'Jumlah peserta wajib diisi.')]
    public $jumlah_peserta = '';

    #[Validate('required', message: 'No whatsapp wajib diisi.')]
    public $no_wa = '';

    
    public $tanggal = '';

    public function rules()
    {
        // Hitung batas maksimal (hari ini + 2 bulan) dengan format Y-m-d
        $maxDate = Carbon::now()->addMonths(2)->format('Y-m-d');

        return [
            'tanggal' => [
                'required',             // Tidak boleh kosong
                'date',                 // Harus berupa format tanggal yang valid
                'after_or_equal:today', // Tidak boleh di masa lalu (opsional, tergantung kebutuhan)
                'before_or_equal:' . $maxDate, // INI LOGIKA UTAMANYA: Maksimal 2 bulan ke depan
            ],
        ];
    }

    // 2. Kustomisasi pesan error agar menggunakan Bahasa Indonesia
    public function messages()
    {
        return [
            'tanggal.required' => 'Tanggal pelaksanaan wajib dipilih.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'tanggal.after_or_equal' => 'Tanggal pelaksanaan tidak boleh kurang dari hari ini.',
            'tanggal.before_or_equal' => 'Tanggal pelaksanaan tidak diizinkan lebih dari 2 bulan ke depan.',
        ];
    }

    public $waktu; // Menangkap sesi yang dipilih user

    // Daftar sesi yang tersedia di sistem Anda
    public $daftarSesi = [
        ['value' => '09:00-12:00', 'judul' => 'Sesi Pagi', 'jam' => '09.00 - 12.00 WIB'],
        ['value' => '13:00-15:00', 'judul' => 'Sesi Siang', 'jam' => '13.00 - 15.00 WIB'],
        ['value' => '15:00-17:00', 'judul' => 'Sesi Sore', 'jam' => '15.00 - 17.00 WIB'],
    ];

    // public function bookedTimes()
    // {
    //     // Jika tanggal belum dipilih, anggap belum ada yang dipesan (atau bisa di-return semua array agar disabled)
    //     if (!$this->tanggal) {
    //         return [];
    //     }

    //     // Ambil data pemesanan, tapi kita hanya butuh kolom 'waktu' saja dan jadikan Array
    //     // Contoh output: ['09-12', '15-17']
    //     return Pemesanan::where('tanggal', $this->tanggal)
    //         ->pluck('waktu')
    //         ->toArray();
    // }

    // 3. (Opsional) Validasi Real-time setiap kali tanggal di-set dari Flatpickr
    public function updatedTanggal()
    {
        // Akan langsung mengecek rule dan memunculkan error jika batas dilanggar
        $this->validateOnly('tanggal'); 

        $this->waktu = null;
    }

    public function generateKodeBooking()
    {
        // 1. Prefix dan Format Tanggal
        $prefix = 'RPT-PL-';
        $dateCode = Carbon::now()->format('my'); // Hasil: 0926 (Bulan 09, Tahun 26)
        $baseFormat = $prefix . $dateCode;       // Hasil: RPT-PL-0926

        // 2. Cari data transaksi TERAKHIR di bulan ini
        $lastRecord = Pemesanan::where('id_reservasi', 'LIKE', $baseFormat . '%')
                        ->latest('id')
                        ->first();

        if (!$lastRecord) {
            // Jika belum ada pesanan di bulan ini, set default ke A001
            $nextHuruf = 'A';
            $nextAngka = '001';
        } else {
            // Jika sudah ada, misal kode terakhir: RPT-PL-0926A005
            $lastKode = $lastRecord->kode_booking;
            
            // Buang baseFormat untuk menyisakan akhirannya saja (Hasil: A005)
            $lastSuffix = str_replace($baseFormat, '', $lastKode);
            
            // Pisahkan Huruf dan Angka menggunakan Regex
            // [A-Z]+ mengambil semua huruf kapital
            // \d+ mengambil semua angka
            preg_match('/([A-Z]+)(\d+)/', $lastSuffix, $matches);
            
            $huruf = $matches[1] ?? 'A';       // Menangkap 'A'
            $angka = (int) ($matches[2] ?? 0); // Menangkap '5' (di-convert ke integer)
            
            // Naikkan angka 1 tingkat
            $angka++;

            // Logika Limit: Jika angka melewati 999, reset ke 1 dan huruf dinaikkan (A -> B)
            if ($angka > 999) {
                $angka = 1;
                $huruf++; // A otomatis menjadi B
            }

            $nextHuruf = $huruf;
            
            // Format ulang angka menjadi minimal 3 digit (5 menjadi 005)
            $nextAngka = str_pad($angka, 3, '0', STR_PAD_LEFT);
        }

        // 3. Gabungkan semua komponen
        // Hasil akhir: RPT-PL-0926A001
        return $baseFormat . $nextHuruf . $nextAngka;
    }



    // 4. Fungsi saat tombol Submit ditekan
    public function reservation()
    {
        // Jalankan validasi akhir sebelum masuk ke database
        $this->validate();
        // dd($this->generateKodeBooking());
        // dd(Auth::guard('pengguna')->user()->id);
        $pemesanan = Pemesanan::create([
            'id_reservasi' => $this->generateKodeBooking(),
            'tempat_kegiatan' => $this->tempat_kegiatan,
            'nama_penanggung_jawab' => $this->nama_penanggung_jawab,
            'tujuan' => $this->tujuan,
            'jumlah_peserta' => $this->jumlah_peserta,
            'no_wa' => $this->no_wa,
            'tanggal' => $this->tanggal,
            'waktu' => $this->waktu,
            'pengguna_id' => Auth::guard('pengguna')->user()->id,
            'status' => 'pending'
        ]);
        
        // return $this->redirectRoute('reservation.result', navigate: true);
        return $this->redirectRoute(
            'reservation.result', 
            ['id' => $pemesanan->id], // Parameter rute dikirim dalam bentuk array
            navigate: true
        );
    }


    public function render()
    {
        $bookedTimes = [];
        if ($this->tanggal) {

            $bookedTimes = Pemesanan::where('tanggal', $this->tanggal)
                ->where('status',  'Menunggu Konfirmasi')
                ->orWhere('status', 'Booking')
                ->pluck('waktu')
                ->toArray();
            // dd($bookedTimes);
        }
        return view('livewire.guest.reservation', [
            'bookedTimes' => $bookedTimes
        ]);
    }
}
