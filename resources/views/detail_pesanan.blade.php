<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Pesanan - Purchase Order</title>
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="../../images/favicon.png" />
    <style>
        @media print {
            @page {
                size: A4;
                margin: 0;
            }
            
            body * {
                visibility: hidden;
            }
            
            #invoicePrintArea, #invoicePrintArea *,
            #suratJalanPrintArea, #suratJalanPrintArea * {
                visibility: visible;
            }
            
            #invoicePrintArea,
            #suratJalanPrintArea {
                position: absolute;
                transform: translateX(-25%);
                top: 0;
                width: 210mm; /* Lebar A4 */
                padding: 20mm; /* Margin dalam */
                box-sizing: border-box;
            }

            .invoice-container,
            .surat-jalan-container {
                width: 100%;
                max-width: none;
                margin: 0;
                padding: 0;
                border: none;
            }

            .invoice-header,
            .surat-jalan-header {
                margin-bottom: 25mm;
            }

            .invoice-table,
            .surat-jalan-table {
                width: 100%;
                margin: 10mm 0;
            }

            .invoice-table th,
            .invoice-table td,
            .surat-jalan-table th,
            .surat-jalan-table td {
                padding: 2mm;
            }

            .invoice-signature,
            .surat-jalan-signature {
                margin-top: 30mm;
            }

            .no-print {
                display: none !important;
            }
        }

        /* Styling untuk preview di layar */
        .invoice-container,
        .surat-jalan-container {
            width: 210mm;
            margin: 0 auto;
            padding: 20mm;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .invoice-header,
        .surat-jalan-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-info,
        .surat-jalan-info {
            margin-bottom: 20px;
        }

        .invoice-info-box,
        .info-box {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            background-color: #f8f9fa;
        }

        .invoice-table,
        .surat-jalan-table {
            margin: 20px 0;
        }

        .invoice-notes,
        .notes {
            margin-top: 30px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        .invoice-signature,
        .surat-jalan-signature {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('partial._navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partial._settings-panel')
            @include('partial._sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Detail Pesanan Section -->
                                    <div id="detailPesananSection">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h4 class="card-title">Detail Pesanan #{{ $pesanan->id_pesanan }}</h4>
                                            <div>
                                                <button onclick="showPreviewInvoice()" class="btn btn-primary me-2">
                                                    <i class="mdi mdi-eye"></i> Preview Invoice
                                                </button>
                                                <button onclick="showPreviewSuratJalan()" class="btn btn-info me-2">
                                                    <i class="mdi mdi-file-document"></i> Preview Surat Jalan
                                                </button>
                                                <a href="{{ route('marketlist') }}" class="btn btn-secondary" id="btnKembali">
                                                    <i class="mdi mdi-arrow-left"></i> Kembali
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Konten Detail Pesanan yang sudah ada -->
                                        <div class="row">
                                            <!-- Kolom Kiri - Informasi Pesanan -->
                                            <div class="col-md-4">
                                                <div class="card shadow-sm h-100">
                                                    <div class="card-header bg-primary text-white">
                                                        <h5 class="mb-0">Informasi Pesanan</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-3">
                                                            <label class="text-muted">
                                                                <i class="mdi mdi-calendar"></i> Tanggal Pesan
                                                            </label>
                                                            <p class="form-control">{{ date('d/m/Y H:i', strtotime($pesanan->tanggal_pesan)) }}</p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="text-muted">
                                                                <i class="mdi mdi-truck-delivery"></i> Tanggal Kirim
                                                            </label>
                                                            <p class="form-control">{{ date('d/m/Y H:i', strtotime($pesanan->tanggal_kirim)) }}</p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="text-muted">
                                                                <i class="mdi mdi-flag"></i> Status
                                                            </label>
                                                            <p class="form-control">{{ ucfirst($pesanan->status) }}</p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="text-muted">
                                                                <i class="mdi mdi-account"></i> Konsumen
                                                            </label>
                                                            <p class="form-control">{{ $pesanan->konsumen->nama_konsumen }}</p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="text-muted">
                                                                <i class="mdi mdi-account-multiple"></i> Supplier
                                                            </label>
                                                            <p class="form-control">{{ $pesanan->suplier->nama_suplier }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Kolom Kanan - Detail Transaksi -->
                                            <div class="col-md-8">
                                                <div class="card shadow-sm h-100">
                                                    <div class="card-header bg-info text-white">
                                                        <h5 class="mb-0">Detail Transaksi</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID Transaksi</th>
                                                                        <th>Nama Produk</th>
                                                                        <th>Jumlah</th>
                                                                        <th>Harga Satuan</th>
                                                                        <th>Subtotal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                    $total = 0;
                                                                    $no = 1;
                                                                    @endphp
                                                                    @foreach($transaksiPesanan as $transaksi)
                                                                    <tr>
                                                                        <td>{{ $no++ }}</td>
                                                                        <td>{{ $transaksi->produk->nama_produk }}</td>
                                                                        <td>{{ $transaksi->jumlah }}</td>
                                                                        <td>Rp {{ number_format($transaksi->harga, 0, ',', '.') }}</td>
                                                                        <td>Rp {{ number_format($transaksi->sub_total, 0, ',', '.') }}</td>
                                                                    </tr>
                                                                    @php $total += $transaksi->sub_total; @endphp
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr class="table-info">
                                                                        <td colspan="4" class="text-end">
                                                                            <strong>Total:</strong>
                                                                        </td>
                                                                        <td>
                                                                            <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Preview Invoice Section -->
                                    <div id="previewInvoiceSection" style="display: none;">
                                        <div class="container">
                                            <div class="d-flex justify-content-between mb-4">
                                                <button onclick="hidePreviewInvoice()" class="btn btn-secondary no-print">
                                                    <i class="mdi mdi-arrow-left"></i> Kembali
                                                </button>
                                                <button onclick="printInvoice()" class="btn btn-primary no-print">
                                                    <i class="mdi mdi-printer"></i> Cetak Invoice
                                                </button>
                                            </div>

                                            <div id="invoicePrintArea" class="invoice-container">
                                                <div class="invoice-header">
                                                    <h2>CV. WAK PUTRA JAYA</h2>
                                                    <p>Jl. Bengkel 9 Jaya No. 575 Ds. Gempolkerep Kec. Gedeg Kab. Mojokerto</p>
                                                    <h3 class="mt-4">INVOICE</h3>
                                                    <p>No. Invoice: WAK/{{ date('y', strtotime($pesanan->tanggal_pesan)) }}{{ date('m', strtotime($pesanan->tanggal_pesan)) }}{{ str_pad($pesanan->id_pesanan, 2, '0', STR_PAD_LEFT) }}</p>
                                                </div>

                                                <div class="row invoice-info">
                                                    <div class="col-sm-4 invoice-info-box">
                                                        <h5>Dari:</h5>
                                                        <p>CV. WAK PUTRA JAYA</p>
                                                        <p>{{ $pesanan->suplier->nama_suplier }}</p>
                                                    </div>
                                                    <div class="col-sm-4 invoice-info-box">
                                                        <h5>Kepada:</h5>
                                                        <p>{{ $pesanan->konsumen->nama_konsumen }}</p>
                                                    </div>
                                                    <div class="col-sm-4 invoice-info-box">
                                                        <h5>Info Pesanan:</h5>
                                                        <p>Tanggal Pesan: {{ date('d/m/Y', strtotime($pesanan->tanggal_pesan)) }}</p>
                                                        <p>Tanggal Kirim: {{ date('d/m/Y', strtotime($pesanan->tanggal_kirim)) }}</p>
                                                    </div>
                                                </div>

                                                <div class="invoice-table">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Produk</th>
                                                                <th>Jumlah</th>
                                                                <th>Harga Satuan</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $total = 0; @endphp
                                                            @foreach($transaksiPesanan as $index => $transaksi)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $transaksi->produk->nama_produk }}</td>
                                                                <td>{{ $transaksi->jumlah }}</td>
                                                                <td>Rp {{ number_format($transaksi->harga, 0, ',', '.') }}</td>
                                                                <td>Rp {{ number_format($transaksi->sub_total, 0, ',', '.') }}</td>
                                                            </tr>
                                                            @php $total += $transaksi->sub_total; @endphp
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                                                <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <div class="invoice-notes">
                                                    <p><strong>Catatan:</strong></p>
                                                    <br><br><br>
                                                    <br><br><br>
                                                    <br><br><br>
                                                </div>

                                                <div class="row invoice-signature">
                                                    <div class="col-md-6 text-center">
                                                        <p>Disiapkan oleh:</p>
                                                        <br><br><br>
                                                        <p>_______________________</p>
                                                        <p><strong>CV. WAK PUTRA JAYA</strong></p>
                                                    </div>
                                                    <div class="col-md-6 text-center">
                                                        <p>Diterima oleh:</p>
                                                        <br><br><br>
                                                        <p>_______________________</p>
                                                        <p><strong>{{ $pesanan->konsumen->nama_konsumen }}</strong></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Preview Surat Jalan Section -->
                                    <div id="previewSuratJalanSection" style="display: none;">
                                        <div class="container">
                                            <div class="d-flex justify-content-between mb-4">
                                                <button onclick="hidePreviewSuratJalan()" class="btn btn-secondary no-print">
                                                    <i class="mdi mdi-arrow-left"></i> Kembali
                                                </button>
                                                <button onclick="printSuratJalan()" class="btn btn-primary no-print">
                                                    <i class="mdi mdi-printer"></i> Cetak Surat Jalan
                                                </button>
                                            </div>

                                            <div id="suratJalanPrintArea" class="surat-jalan-container">
                                                <div class="text-center mb-4">
                                                    <h2>CV. WAK PUTRA JAYA</h2>
                                                    <p>Jl. Bengkel 9 Jaya No. 575 Ds. Gempolkerep Kec. Gedeg Kab. Mojokerto</p>
                                                    <h3 class="mt-4">SURAT JALAN</h3>
                                                    <p>No. Surat Jalan: SJ/{{ date('y', strtotime($pesanan->tanggal_pesan)) }}{{ date('m', strtotime($pesanan->tanggal_pesan)) }}{{ str_pad($pesanan->id_pesanan, 2, '0', STR_PAD_LEFT) }}</p>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <div class="info-box">
                                                            <h5>Informasi Pengiriman:</h5>
                                                            <p>Tanggal: {{ date('d/m/Y', strtotime($pesanan->tanggal_kirim)) }}</p>
                                                            <p>No. Pesanan: {{ $pesanan->id_pesanan }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="info-box">
                                                            <h5>Tujuan Pengiriman:</h5>
                                                            <p>{{ $pesanan->konsumen->nama_konsumen }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama Produk</th>
                                                                <th class="text-center">Jumlah</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($transaksiPesanan as $index => $transaksi)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $transaksi->produk->nama_produk }}</td>
                                                                <td class="text-center">{{ $transaksi->jumlah }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="notes mb-4">
                                                    <p><strong>Catatan:</strong></p>
                                                    <br><br><br>
                                                    <br><br><br>
                                                    <br><br><br>
                                                </div>

                                                <div class="row mt-5">
                                                    <div class="col-md-6 text-center">
                                                        <p><strong>Pengirim</strong></p>
                                                        <br><br><br>
                                                        <p>_______________________</p>
                                                        <p><strong>CV. WAK PUTRA JAYA</strong></p>
                                                    </div>
                                                    <div class="col-md-6 text-center">
                                                        <p><strong>Penerima</strong></p>
                                                        <br><br><br>
                                                        <p>_______________________</p>
                                                        <p><strong>{{ $pesanan->konsumen->nama_konsumen }}</strong></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showPreviewInvoice() {
            document.getElementById('detailPesananSection').style.display = 'none';
            document.getElementById('previewInvoiceSection').style.display = 'block';
            document.getElementById('previewSuratJalanSection').style.display = 'none';
            document.getElementById('btnKembali').style.display = 'none';
        }

        function showPreviewSuratJalan() {
            document.getElementById('detailPesananSection').style.display = 'none';
            document.getElementById('previewInvoiceSection').style.display = 'none';
            document.getElementById('previewSuratJalanSection').style.display = 'block';
            document.getElementById('btnKembali').style.display = 'none';
        }

        function hidePreviewInvoice() {
            document.getElementById('detailPesananSection').style.display = 'block';
            document.getElementById('previewInvoiceSection').style.display = 'none';
            document.getElementById('previewSuratJalanSection').style.display = 'none';
            document.getElementById('btnKembali').style.display = 'inline-block';
        }

        function hidePreviewSuratJalan() {
            document.getElementById('detailPesananSection').style.display = 'block';
            document.getElementById('previewInvoiceSection').style.display = 'none';
            document.getElementById('previewSuratJalanSection').style.display = 'none';
            document.getElementById('btnKembali').style.display = 'inline-block';
        }

        function printInvoice() {
            window.print();
        }

        function printSuratJalan() {
            window.print();
        }
    </script>

    <!-- Scripts -->
    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/settings.js"></script>
    <script src="../../js/todolist.js"></script>
</body>

</html>