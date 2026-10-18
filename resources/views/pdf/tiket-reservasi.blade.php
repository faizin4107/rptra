<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket Reservasi - {{ $pemesanan->id_reservasi }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; line-height: 1.5; }
        .ticket-container { border: 2px dashed #ccc; padding: 20px; border-radius: 10px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #10b981; }
        .row { width: 100%; margin-bottom: 15px; }
        .col { width: 48%; display: inline-block; vertical-align: top; }
        .label { font-size: 11px; color: #777; text-transform: uppercase; margin-bottom: 3px; font-weight: bold; }
        .value { font-size: 14px; font-weight: bold; margin: 0; }
        .status-badge { 
            background: #fffbeb; color: #b45309; border: 1px solid #fde68a; 
            padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: bold; display: inline-block; 
        }
        .footer { margin-top: 30px; padding: 15px; background-color: #f0f9ff; border: 1px solid #bae6fd; font-size: 12px; }
    </style>
</head>
<body>

    <div class="ticket-container">
        <div class="header">
            <h1>Bukti Reservasi RPTRA</h1>
            <p>Simpan dokumen ini sebagai bukti pendaftaran.</p>
        </div>

        <div class="row">
            <div class="col">
                <div class="label">ID Reservasi</div>
                <div class="value">{{ $pemesanan->id_reservasi }}</div>
            </div>
            <div class="col" style="text-align: right;">
                <div class="status-badge">
                    Status: {{ strtoupper($pemesanan->status) }}
                </div>
            </div>
        </div>

        <hr style="border: 0; border-top: 1px dashed #eee; margin: 15px 0;">

        <div class="row">
            <div class="col">
                <div class="label">Lokasi RPTRA</div>
                <div class="value">{{ $pemesanan->tempat_kegiatan }}</div>
            </div>
            <div class="col">
                <div class="label">Tanggal & Sesi</div>
                <div class="value">{{ \Carbon\Carbon::parse($pemesanan->tanggal)->locale('id')->translatedFormat('d F Y') }}</div>
                <div style="color: #10b981; font-size: 12px; font-weight: bold;">{{ $pemesanan->waktu }}</div>
            </div>
        </div>

        <div class="row" style="margin-top: 15px;">
            <div class="col">
                <div class="label">Penanggung Jawab</div>
                <div class="value">{{ $pemesanan->nama_penanggung_jawab }}</div>
                <div style="font-size: 12px; color: #555;">{{ $pemesanan->no_wa }}</div>
            </div>
            <div class="col">
                <div class="label">Detail Kegiatan</div>
                <div class="value">{{ $pemesanan->tujuan }}</div>
                <div style="font-size: 12px; color: #555;">Peserta: {{ $pemesanan->jumlah_peserta }} Orang</div>
            </div>
        </div>

        <div class="footer">
            <strong>Langkah Selanjutnya:</strong><br>
            Admin (Koordinator RPTRA) akan meninjau jadwal Anda. Konfirmasi persetujuan akan dikirimkan melalui WhatsApp ke nomor Penanggung Jawab maksimal 1x24 Jam.
        </div>
    </div>

</body>
</html>