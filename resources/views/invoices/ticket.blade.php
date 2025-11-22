<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>E-Ticket BahariGo</title>
    <style>
        /* Reset dan Base Styles */
        body { 
            font-family: 'Arial', sans-serif; 
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.4;
        }
        
        /* Header Styles */
        .header {
            background-color: #2563eb;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        
        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            text-align: right;
        }
        
        /* Booking Info */
        .booking-info {
            margin-bottom: 25px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 6px;
            border-left: 4px solid #2563eb;
        }
        
        .booking-id {
            font-size: 18px;
            font-weight: bold;
            color: #2563eb;
            margin: 0;
        }
        
        .status-lunas {
            background-color: #10b981;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            display: inline-block;
            margin-top: 5px;
        }
        
        /* Details Section */
        .details-section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .details-table td {
            padding: 8px 0;
            vertical-align: top;
        }
        
        .details-table .label {
            font-weight: bold;
            width: 35%;
            color: #64748b;
        }
        
        /* Price Table */
        .price-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            border: 1px solid #e2e8f0;
        }
        
        .price-table th {
            background-color: #f1f5f9;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .price-table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .price-table .description {
            color: #64748b;
        }
        
        .price-table .total-price {
            font-size: 20px;
            font-weight: bold;
            color: #2563eb;
        }
        
        /* Footer */
        .footer {
            margin-top: 40px;
            padding: 15px;
            background-color: #f8fafc;
            border-radius: 6px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 2px solid #e2e8f0;
        }
        
        .warning-text {
            color: #dc2626;
            font-weight: bold;
            margin: 5px 0;
        }
        
        /* Utility Classes */
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .mb-10 {
            margin-bottom: 10px;
        }
        
        .mb-20 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <table class="header-table">
            <tr>
                <td width="50%">
                    <div class="logo">🚗 BahariGo</div>
                </td>
                <td width="50%" class="text-right">
                    <div class="invoice-title">E-TICKET / INVOICE</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- Booking Information -->
    <div class="booking-info">
        <table width="100%">
            <tr>
                <td width="70%">
                    <p class="booking-id">#TRV-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</p>
                    <p style="margin: 5px 0 0 0; color: #64748b;">Booking Reference</p>
                </td>
                <td width="30%" class="text-right">
                    <span class="status-lunas">LUNAS</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Passenger & Travel Details -->
    <table class="details-table">
        <tr>
            <!-- Passenger Details -->
            <td width="50%" style="padding-right: 20px;">
                <div class="details-section">
                    <div class="section-title">DATA PENUMPANG</div>
                    <table width="100%">
                        <tr>
                            <td class="label">Nama Lengkap</td>
                            <td>: {{ $booking->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="label">Email</td>
                            <td>: {{ $booking->user->email }}</td>
                        </tr>
                        <tr>
                            <td class="label">No. Telepon</td>
                            <td>: {{ $booking->user->phone ?? '- Belum diisi -' }}</td>
                        </tr>
                        <tr>
                            <td class="label">Tanggal Booking</td>
                            <td>: {{ $booking->created_at->format('d F Y') }}</td>
                        </tr>
                    </table>
                </div>
            </td>
            
            <!-- Travel Details -->
            <td width="50%" style="padding-left: 20px;">
                <div class="details-section">
                    <div class="section-title">DATA PERJALANAN</div>
                    <table width="100%">
                        <tr>
                            <td class="label">Tujuan</td>
                            <td>: {{ $booking->travelSchedule->destination }}</td>
                        </tr>
                        <tr>
                            <td class="label">Tanggal</td>
                            <td>: {{ \Carbon\Carbon::parse($booking->travelSchedule->departure_at)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td class="label">Jam</td>
                            <td>: {{ \Carbon\Carbon::parse($booking->travelSchedule->departure_at)->format('H:i') }} WIB</td>
                        </tr>
                        <tr>
                            <td class="label">Armada</td>
                            <td>: Travel Express</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <!-- Price Table -->
    <div class="section-title">RINCIAN BIAYA</div>
    <table class="price-table">
        <thead>
            <tr>
                <th width="80%">Deskripsi</th>
                <th width="20%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="description">
                    Tiket Perjalanan {{ $booking->travelSchedule->destination }}<br>
                    <small>Termasuk asuransi perjalanan dan fasilitas standar</small>
                </td>
                <td>Rp {{ number_format($booking->travelSchedule->price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="description">
                    Biaya Layanan & Administrasi
                </td>
                <td>Rp 0</td>
            </tr>
            <tr style="background-color: #f8fafc;">
                <td class="text-right" style="font-weight: bold;">Total Pembayaran:</td>
                <td class="total-price">Rp {{ number_format($booking->travelSchedule->price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Important Notes -->
    <table width="100%" style="margin-top: 30px;">
        <tr>
            <td style="padding: 15px; background-color: #fef2f2; border-radius: 6px; border-left: 4px solid #dc2626;">
                <p style="margin: 0; color: #dc2626; font-weight: bold;">📌 Catatan Penting:</p>
                <p style="margin: 5px 0 0 0; color: #7f1d1d; font-size: 13px;">
                    • Hadir di lokasi keberangkatan 30 menit sebelum jadwal<br>
                    • Bawa dokumen identitas asli (KTP/SIM)<br>
                    • E-ticket ini berlaku sebagai bukti pembayaran yang sah
                </p>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p style="margin: 0 0 10px 0;">
            <strong>BahariGo</strong> - Your Trusted Travel Partner
        </p>
        <p style="margin: 0 0 5px 0;">
            Jl. Perjalanan No. 123, Kota Travel • contact@baharigo.com • +62 21 1234 5678
        </p>
        <p class="warning-text">
            ⚠️ SIMPAN TIKET INI. TUNJUKKAN PADA PETUGAS SAAT KEBERANGKATAN.
        </p>
        <p style="margin: 5px 0 0 0; font-size: 11px;">
            Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}
        </p>
    </div>
</body>
</html>