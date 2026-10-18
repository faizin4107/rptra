<?php

namespace App\Livewire\General\Absensi;

use App\Models\Absensi;
use App\Models\AbsensiDpjp;
use App\Models\Jadwal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use TallStackUi\Traits\Interactions;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] 
class Index extends Component
{
// $lat = config('services.location.latitude');
// $lng = config('services.location.longitude');
// $radius = config('services.location.radius');
// $sekarang = now();

// // 2. Buat objek jam mulai dan jam selesai untuk hari ini
// $jamMulai = Carbon::createFromTimeString('08:00:00');
// $jamSelesai = Carbon::createFromTimeString('17:00:00');

// // 3. Lakukan validasi rentang waktu
// if ($sekarang->lessThan($jamMulai)) {
//     return redirect()->back()->with('error', 'Proses gagal. Belum memasuki jam kerja (08:00).');
// }

// if ($sekarang->greaterThan($jamSelesai)) {
//     return redirect()->back()->with('error', 'Proses gagal. Sudah melewati jam kerja (17:00).');
// }

// // 4. Jika lolos validasi di atas, proses dilanjutkan di bawah sini
// return "Proses berhasil dilanjutkan!";
    use Interactions;
    public ?float $latitude = null;
    public ?float $longitude = null;
    public ?string $address = null;
    public ?string $tipeAktivitas = null;
    public string $statusMessage = '';
    public bool $isError = false; // Untuk membedakan warna pesan sukses/gagal
    public $statusAbsen = []; 

    public function updateLocation(float $lat, float $lng, string $tipe, int $id): void
    {
        // cari jadwal residen berdasarkan jadwal_id = id, nanti dapatin id, dpjp_id
        // 
        // dd($id);
        $role = '';
        if (Auth::guard('residen')->check()) {
            $role = 'residen';
            $userId = Auth::guard('residen')->user()->id;
        }else if(Auth::guard('dpjp')->check()){
            $role = 'dpjp';
            $userId = Auth::guard('dpjp')->user()->id;
        }
        if($role === 'residen'){
            $jadwal_residen = \App\Models\JadwalResiden::where('jadwal_id', $id)->where('residen_id', $userId)->first();
            // dd($jadwal_residen);
            $jadwal_residen_id = $jadwal_residen->id;
            $dpjp_id = $jadwal_residen->dpjp_id;
        }
        // $residen_id = Auth::guard('residen')->user()->id;
        
        $this->statusMessage = '';
        $sekarang = now();
        $jadwal = \App\Models\Jadwal::where('id', $id)->first();
        // dd($jadwal);
        // 2. Buat objek jam mulai dan jam selesai untuk hari ini
        $jamMulai = Carbon::createFromTimeString($jadwal->start_time);
        // $jamSelesai = Carbon::createFromTimeString($jadwal->end_time);

        // 3. Lakukan validasi rentang waktu
        // dd($tipe);
        if($tipe === 'masuk'){
            if ($sekarang->lessThan($jamMulai)) {
                $this->statusMessage = "❌ Gagal: Belum memasuki jam kerja (" . $jadwal->start_time . ")-(" . $jadwal->end_time . ")";
                return;
            }
        }
        

        // if ($sekarang->greaterThan($jamSelesai)) {
        //     $this->statusMessage = "❌ Gagal: Sudah melewati jam kerja (" . $jadwal->end_time . ")";
        //     return;
        // }

        $this->latitude = $lat;
        $this->longitude = $lng;
        $this->tipeAktivitas = $tipe;
        
        // 1. Dapatkan Alamat Fisik dari Koordinat (Reverse Geocoding)
        $this->address = $this->dapatkanAlamat($lat, $lng);
        
        // 2. Data Target (Ganti dengan data dari database)
        $targetLat = config('app.location.latitude');;
        // dd($this->address);
        $targetLng = config('app.location.longitude');;
        $radius = config('app.location.radius');
        
        // 3. Hitung Jarak
        $jarak = $this->hitungJarakMeter($lat, $lng, $targetLat, $targetLng);
        // dd($jarak);
        // 4. Validasi Radius 20 Meter
        if ($jarak > $radius) {
            $this->isError = true;
            $jarakBulat = round($jarak);
            $this->statusMessage = "❌ Gagal: Jarak {$jarakBulat}m (Maks 20m). Anda berada di: " . ($this->alamat ?? 'Lokasi tidak diketahui');
            return; 
        }

        // 5. Sukses
        $this->isError = false;
        $this->statusMessage = "✅ Berhasil: Jarak valid (" . round($jarak, 1) . "m).";
        // TODO: Simpan ke Database, sekarang Anda bisa menyimpan $this->alamat ke kolom `alamat`
        // auth()->user()->absensi()->create([
        //     'latitude' => $lat,
        //     'longitude' => $lng,
        //     'alamat' => $this->alamat,
        //     ...
        // ]);
        $dpjp = \App\Models\User::where('id', $jadwal->user_id)->first();
        // dd($dpjp->id_identitas);
        if($role === 'residen'){
            Absensi::create([
                'jadwal_residen_id' => $jadwal_residen_id,
                'residen_id' => Auth::guard('residen')->user()->id,
                'dpjp_id' => $dpjp_id,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'address' => $this->address,
                'type_absen' => $tipe,
            ]);
        }else if($role === 'dpjp'){
            AbsensiDpjp::create([
                'jadwal_id' => $id,
                'dpjp_id' => $userId,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'address' => $this->address,
                'type_absen' => $tipe,
            ]);
        }
        
        $this->toast()->success('Berhasil!', 'Absensi ' . $tipe . ' berhasil')->send();

    }

    private function dapatkanAlamat($lat, $lng): ?string
    {
        try {
            // OpenStreetMap mewajibkan kita mengirim 'User-Agent' agar tidak diblokir
            $response = Http::timeout(5)->withHeaders([
                'User-Agent' => 'AplikasiPresensiRS/1.0' // Ubah sesuai nama aplikasi Anda
            ])->get("https://nominatim.openstreetmap.org/reverse", [
                'format' => 'jsonv2',
                'lat' => $lat,
                'lon' => $lng,
            ]);

            if ($response->successful()) {
                // Mengambil nilai 'display_name' dari JSON balasan
                return $response->json('display_name');
            }
        } catch (\Exception $e) {
            // Jika API mati atau timeout, abaikan agar aplikasi tidak crash
            return "Gagal mendapatkan detail alamat.";
        }

        return "Alamat tidak ditemukan.";
    }

    /**
     * Rumus Haversine
     */
    private function hitungJarakMeter($lat1, $lon1, $lat2, $lon2): float
    {
        $earthRadius = 6371000;
        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);
        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lonDelta / 2) * sin($lonDelta / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }

    public function store()
    {
        // $isExist = DB::table('jadwal') // Ganti dengan nama tabel Anda
        //     ->where('user_id', $userId)
        //     ->where('hari', $hari)
        //     ->where(function ($query) use ($jamMulai, $jamSelesai) {
        //         $query->where('jam_mulai', '<', $jamSelesai)
        //             ->where('jam_selesai', '>', $jamMulai);
        //     })
        //     ->exists(); // Menghasilkan true jika ada data yang bentrok

        // // Jika bentrok, kembalikan error ke user
        // if ($isExist) {
        //     return redirect()->back()
        //         ->withErrors(['jam_mulai' => 'Jadwal bentrok dengan kegiatan user lain pada hari dan jam tersebut.'])
        //         ->withInput();
        // }
    }
    public function render()
    {
        $headers = [
            ['index' => 'day', 'label' => 'Hari'],
            ['index' => 'start_time', 'label' => 'Jam Masuk'],
            ['index' => 'end_time',     'label' => 'Jam Selesai'],
            ['index' => 'action',   'label' => 'Aksi'], // Kolom kustom untuk tombol
        ];
        // dd(Auth::user()->id);
        // $day = date('l');
        // dd($day);
        // $data = \App\Models\Jadwal
        //     ::where('day', $day)->get();
        // // dd($jadwals);
        // $jadwals = [];
        // if(count($data) > 0){
        //     foreach($data as $row){
        //         $jadwals[] = \App\Models\JadwalResiden::where('jadwal_id', $row->id)->where('user_id', Auth::user()->id)->latest()->paginate(10);
        //     }
        // }
        // $day = now()->format('l');
        $day = Carbon::now()->translatedFormat('l');
        // dd($day);
        $role = '';
        if (Auth::guard('residen')->check()) {
            $role = 'residen';
            $userId = Auth::guard('residen')->user()->id;
        }else if(Auth::guard('dpjp')->check()){
            $role = 'dpjp';
            $userId = Auth::guard('dpjp')->user()->id;
        }
        // $jadwals = Jadwal::with(['residen', 'jadwalResiden.residen'])
        //         ->where('day', $day)
        //         ->where('residen_id', $userId)
        //     ->latest()->paginate(10);
        if($role === 'residen'){
            $jadwals = \App\Models\Jadwal::with(['residen', 'jadwalResiden.residen'])
                ->where('day', $day) // Filter hari di tabel jadwal
                ->whereHas('jadwalResiden', function($query) use ($userId) {
                    // Filter residen_id di tabel jadwal_residen
                    $query->where('residen_id', $userId);
                })
                ->latest()
                ->paginate(10);
            // dd($jadwals);
            // ID Residen yang sedang login
            // Mengambil nama hari (Monday, Tuesday, dsb)

            // $jadwals = Jadwal::where('day', $day)
            // ->whereHas('jadwalResiden', function($q) use ($userId) {
            //     $q->where('user_id', $userId);
            // })
            // ->latest()->paginate(10);
            // dd($jadwals);

            // $this->statusAbsen = Absensi::with(['jadwalResiden'])
            //     ->where('residen_id', $userId)
            //     // ->where('day', $day)
            //     ->get()
            //     ->mapWithKeys(function ($item) {
            //         // Kita bersihkan format jam agar sama (08:00:00 -> 08:00)
            //         $startTime = \Carbon\Carbon::parse($item->start_time)->format('H:i');
            //         $endTime = \Carbon\Carbon::parse($item->end_time)->format('H:i');
            //         $key = $item->day . '_' . $startTime . '_' . $endTime . '_' . $item->type_absen;
            //         return [$key => true];
            //     });
             // Menghasilkan "Senin", "Selasa", dsb.

            // $this->statusAbsen = \App\Models\Absensi::where('residen_id', $userId)
            //     ->whereHas('jadwalResiden.jadwal', function($q) use ($hariIni) {
            //         $q->where('day', $hariIni);
            //     })
            //     ->get();
            // $this->statusAbsen = \App\Models\Absensi::where('residen_id', $userId)
            //     ->whereHas('jadwalResiden.jadwal', function($query) use ($hariIni) {
            //         // Gunakan 'day' sesuai dengan protected $fillable di model Jadwal
            //         $query->where('day', $hariIni); 
            //     })
            //     ->with(['jadwalResiden.jadwal'])
            //     ->get();
            $this->statusAbsen = \App\Models\Absensi::where('residen_id', $userId)
                ->whereHas('jadwalResiden.jadwal', function($query) use ($day) {
                    $query->where('day', $day); 
                })
                ->with(['jadwalResiden.jadwal']) // Pastikan relasi ini di-load
                ->get()
                ->mapWithKeys(function ($item) {
                    // Karena data waktu ada di tabel Jadwal, kita akses lewat relasi
                    // Absensi -> JadwalResiden -> Jadwal
                    $jadwal = $item->jadwalResiden->jadwal;

                    // Bersihkan format jam dari tabel Jadwal
                    $startTime = \Carbon\Carbon::parse($jadwal->start_time)->format('H:i');
                    $endTime = \Carbon\Carbon::parse($jadwal->end_time)->format('H:i');

                    // Buat key menggunakan data dari Jadwal dan tipe absen dari Absensi
                    $key = $jadwal->day . '_' . $startTime . '_' . $endTime . '_' . $item->type_absen;

                    return [$key => true];
                });
            
            // dd($this->statusAbsen);
            $headers_absensi = [
                ['index' => 'address', 'label' => 'Alamat'],
                ['index' => 'type_absen', 'label' => 'Jenis Absen'],
                ['index' => 'start_time', 'label' => 'Jam Masuk'],
                ['index' => 'end_time',     'label' => 'Jam Selesai'],
                ['index' => 'status',     'label' => 'Status'],
            ];
            $q_riwayat = \App\Models\Absensi::where('residen_id', $userId)
                ->whereHas('jadwalResiden.jadwal', function($query) use ($day) {
                    // Gunakan 'day' sesuai dengan protected $fillable di model Jadwal
                    $query->where('day', $day); 
                })
                ->with(['jadwalResiden.jadwal'])
                ->oldest()->paginate(10);
            // dd($jadwals);
            // $q_riwayat = Absensi::where('residen_id', $userId)->where('day', $day)->oldest()->paginate(10);
            return view('livewire.general.absensi.index', compact('jadwals', 'headers', 'day', 'q_riwayat', 'headers_absensi'));
        }else if($role === 'dpjp'){
            $jadwals = \App\Models\Jadwal::with(['dpjp'])
                ->where('day', $day) // Filter hari di tabel jadwal
                ->where('dpjp_id', $userId) // Filter hari di tabel jadwal
                ->latest()
                ->paginate(10);
            
            // $hariIni = Carbon::now()->translatedFormat('l'); // Menghasilkan "Senin", "Selasa", dsb.

            // $this->statusAbsen = \App\Models\Absensi::where('residen_id', $userId)
            //     ->whereHas('jadwalResiden.jadwal', function($q) use ($hariIni) {
            //         $q->where('day', $hariIni);
            //     })
            //     ->get();
            // $this->statusAbsen = \App\Models\Absensi::where('residen_id', $userId)
            //     ->whereHas('jadwalResiden.jadwal', function($query) use ($hariIni) {
            //         // Gunakan 'day' sesuai dengan protected $fillable di model Jadwal
            //         $query->where('day', $hariIni); 
            //     })
            //     ->with(['jadwalResiden.jadwal'])
            //     ->get();
            // $this->statusAbsen = \App\Models\AbsensiDpjp::where('dpjp_id', $userId)
            //     ->whereHas('jadwal', function($query) use ($hariIni) {
            //         $query->where('day', $hariIni); 
            //     })
            //     ->with(['absensi_dpjp']) // Pastikan relasi ini di-load
            //     ->get()
            //     ->mapWithKeys(function ($item) {
            //         // Karena data waktu ada di tabel Jadwal, kita akses lewat relasi
            //         // Absensi -> JadwalResiden -> Jadwal
            //         $jadwal = $item->jadwalResiden->jadwal;

            //         // Bersihkan format jam dari tabel Jadwal
            //         $startTime = \Carbon\Carbon::parse($jadwal->start_time)->format('H:i');
            //         $endTime = \Carbon\Carbon::parse($jadwal->end_time)->format('H:i');

            //         // Buat key menggunakan data dari Jadwal dan tipe absen dari Absensi
            //         $key = $jadwal->day . '_' . $startTime . '_' . $endTime . '_' . $item->type_absen;

            //         return [$key => true];
            //     });
            $this->statusAbsen = \App\Models\AbsensiDpjp::where('dpjp_id', $userId)
                ->whereHas('jadwal', function($query) use ($day) {
                    // 'hari' adalah kolom di tabel jadwal
                    $query->where('day', $day); 
                })
                ->with(['jadwal']) // Eager load relasi jadwal
                ->get()
                ->mapWithKeys(function ($item) {
                    $jadwal = $item->jadwal;

                    // Bersihkan format jam (asumsi kolom start_time dan end_time ada di tabel jadwal)
                    $startTime = \Carbon\Carbon::parse($jadwal->start_time)->format('H:i');
                    $endTime = \Carbon\Carbon::parse($jadwal->end_time)->format('H:i');

                    // Membuat Key unik: [Hari]_[JamMulai]_[JamSelesai]_[TipeAbsen]
                    // Contoh: Senin_08:00_10:00_masuk
                    $key = $jadwal->day . '_' . $startTime . '_' . $endTime . '_' . $item->type_absen;
                    // dd($key);
                    return [$key => true];
                });
            
            // dd($this->statusAbsen);
            $headers_absensi = [
                ['index' => 'address', 'label' => 'Alamat'],
                ['index' => 'type_absen', 'label' => 'Jenis Absen'],
                ['index' => 'start_time', 'label' => 'Jam Masuk'],
                ['index' => 'end_time',     'label' => 'Jam Selesai'],
                ['index' => 'status',     'label' => 'Status'],
            ];
            $q_riwayat = \App\Models\AbsensiDpjp::where('dpjp_id', $userId)
                ->whereHas('jadwal', function($query) use ($day) {
                    // Gunakan 'day' sesuai dengan protected $fillable di model Jadwal
                    $query->where('day', $day); 
                })
                ->with(['jadwal'])
                ->oldest()->paginate(10);
            // dd($q_riwayat);
            // $q_riwayat = Absensi::where('residen_id', $userId)->where('day', $day)->oldest()->paginate(10);
            return view('livewire.general.absensi.index', compact('jadwals', 'headers', 'day', 'q_riwayat', 'headers_absensi'));
        }
        
        
    }
}
