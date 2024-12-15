<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tambah Pesanan - Purchase Order</title>
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="../../images/favicon.png" />
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
                                    <h4 class="card-title">Form Tambah Pesanan</h4>
                                    <p class="card-description">
                                        Silakan isi detail pesanan dengan lengkap
                                    </p>
                                    <form action="{{ route('store.pesanan') }}" method="POST" class="form-sample">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card shadow-sm">
                                                    <div class="card-header bg-primary text-white">
                                                        <h5 class="mb-0">Informasi Pesanan</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>
                                                                        <i class="mdi mdi-calendar"></i> Tanggal Pesan
                                                                    </label>
                                                                    <input type="datetime-local" class="form-control" name="tanggal_pesan" required>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>
                                                                        <i class="mdi mdi-truck-delivery"></i> Tanggal Kirim
                                                                    </label>
                                                                    <input type="datetime-local" class="form-control" name="tanggal_kirim" required>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>
                                                                        <i class="mdi mdi-flag"></i> Status
                                                                    </label>
                                                                    <select name="status" class="form-control" required>
                                                                        <option value="pesanan">Pesanan</option>
                                                                        <option value="dikirim">Dikirim</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>
                                                                        <i class="mdi mdi-account"></i> Konsumen
                                                                    </label>
                                                                    <select name="ms_konsumen_id_konsumen" class="form-control" required>
                                                                        <option value="">Pilih Konsumen</option>
                                                                        @foreach($konsumen as $k)
                                                                            <option value="{{ $k->id_konsumen }}">{{ $k->nama_konsumen }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>
                                                                        <i class="mdi mdi-account-multiple"></i> Supplier
                                                                    </label>
                                                                    <select name="ms_suplier_id_suplier" class="form-control" required>
                                                                        <option value="">Pilih Supplier</option>
                                                                        @foreach($suplier as $s)
                                                                            <option value="{{ $s->id_suplier }}">{{ $s->nama_suplier }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>
                                                                        <i class="mdi mdi-account"></i> Admin
                                                                    </label>
                                                                    <input type="text" class="form-control" value="{{ session('admin_name') }}" readonly>
                                                                    <input type="hidden" name="ms_user_id_user" value="{{ session('admin_id') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="card shadow-sm">
                                                    <div class="card-header bg-success text-white">
                                                        <h5 class="mb-0">Ringkasan Pesanan</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="summary-info">
                                                            <div class="row mb-3">
                                                                <div class="col-6">
                                                                    <label class="text-muted">Total Item:</label>
                                                                    <h4 id="total-items">0 Items</h4>
                                                                </div>
                                                                <div class="col-6">
                                                                    <label class="text-muted">Total Harga:</label>
                                                                    <h4 id="total-summary">Rp 0</h4>
                                                                </div>
                                                            </div>
                                                            <div class="alert alert-info">
                                                                <i class="mdi mdi-information"></i>
                                                                Silakan tambahkan produk pada tabel di bawah
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="card shadow-sm mt-3">
                                                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">Detail Produk</h5>
                                                    <button type="button" class="btn btn-light btn-sm" id="tambah-produk">
                                                        <i class="mdi mdi-plus"></i> Tambah Item
                                                    </button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover" id="produk-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Produk</th>
                                                                    <th>Harga</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Subtotal</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="produk-rows">
                                                                <tr class="produk-row">
                                                                    <td>
                                                                        <select name="produk[0][ms_produk_id_produk]" class="form-control produk-select" required>
                                                                            <option value="">Pilih Produk</option>
                                                                            @foreach($produk as $p)
                                                                                <option value="{{ $p->id_produk }}" data-harga="{{ $p->harga_produk }}">
                                                                                    {{ $p->nama_produk }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control harga-display" readonly>
                                                                        <input type="hidden" name="produk[0][harga]" class="harga-input">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="produk[0][jumlah]" class="form-control jumlah-input" min="1" value="1" required>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control subtotal-row" readonly>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-danger btn-sm hapus-row" style="display: none;">
                                                                            <i class="mdi mdi-delete"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="3" class="text-right"><strong>Total Keseluruhan:</strong></td>
                                                                    <td>
                                                                        <input type="text" id="total-keseluruhan" class="form-control" readonly>
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 text-center">
                                        <a href="{{ route('marketlist') }}" class="btn btn-light btn-lg mr-2">
                                            <i class="mdi mdi-arrow-left"></i> Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="mdi mdi-content-save"></i> Simpan Pesanan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @include('partial._footer')
            </div>
        </div>
    </div>

    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/settings.js"></script>
    <script src="../../js/todolist.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let rowCount = 0;
            const produkTable = document.getElementById('produk-rows');
            const tambahProdukBtn = document.getElementById('tambah-produk');
            
            // Format number to currency
            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(angka);
            }

            // Fungsi untuk mengecek duplikasi produk
            function isDuplicate(selectedProdukId, currentSelect) {
                let duplicate = false;
                document.querySelectorAll('.produk-select').forEach(select => {
                    // Abaikan elemen select yang sedang dicek
                    if (select !== currentSelect && select.value === selectedProdukId && selectedProdukId !== '') {
                        duplicate = true;
                    }
                });
                return duplicate;
            }

            // Hitung subtotal per baris
            function hitungSubtotal(row) {
                const harga = parseInt(row.querySelector('.harga-input').value) || 0;
                const jumlah = parseInt(row.querySelector('.jumlah-input').value) || 0;
                const subtotal = harga * jumlah;
                row.querySelector('.subtotal-row').value = formatRupiah(subtotal);
                hitungTotalKeseluruhan();
            }

            // Hitung total keseluruhan
            function hitungTotalKeseluruhan() {
                let total = 0;
                document.querySelectorAll('.produk-row').forEach(row => {
                    const harga = parseInt(row.querySelector('.harga-input').value) || 0;
                    const jumlah = parseInt(row.querySelector('.jumlah-input').value) || 0;
                    total += harga * jumlah;
                });
                document.getElementById('total-keseluruhan').value = formatRupiah(total);
                updateSummary();
            }

            // Setup event listeners untuk select produk
            function setupProdukSelect(row) {
                const produkSelect = row.querySelector('.produk-select');
                const hargaInput = row.querySelector('.harga-input');
                const hargaDisplay = row.querySelector('.harga-display');
                
                produkSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const selectedProdukId = this.value;

                    // Cek duplikasi saat pemilihan produk
                    if (isDuplicate(selectedProdukId, this)) {
                        alert('Produk ini sudah dipilih sebelumnya!');
                        this.value = ''; // Reset pilihan
                        hargaInput.value = '';
                        hargaDisplay.value = '';
                        hitungSubtotal(row);
                        return;
                    }

                    const harga = selectedOption.dataset.harga;
                    hargaInput.value = harga;
                    hargaDisplay.value = formatRupiah(harga);
                    hitungSubtotal(row);
                });
            }

            // Setup event listeners untuk baris pertama
            setupProdukSelect(document.querySelector('.produk-row'));
            document.querySelectorAll('.jumlah-input').forEach(input => {
                input.addEventListener('input', function() {
                    hitungSubtotal(this.closest('.produk-row'));
                });
            });

            // Tambah baris baru
            tambahProdukBtn.addEventListener('click', function() {
                rowCount++;
                const newRow = document.createElement('tr');
                newRow.className = 'produk-row';
                newRow.innerHTML = `
                    <td>
                        <select name="produk[${rowCount}][ms_produk_id_produk]" class="form-control produk-select" required>
                            <option value="">Pilih Produk</option>
                            @foreach($produk as $p)
                                <option value="{{ $p->id_produk }}" data-harga="{{ $p->harga_produk }}">
                                    {{ $p->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control harga-display" readonly>
                        <input type="hidden" name="produk[${rowCount}][harga]" class="harga-input">
                    </td>
                    <td>
                        <input type="number" name="produk[${rowCount}][jumlah]" class="form-control jumlah-input" min="1" value="1" required>
                    </td>
                    <td>
                        <input type="text" class="form-control subtotal-row" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm hapus-row">
                            <i class="mdi mdi-delete"></i>
                        </button>
                    </td>
                `;

                produkTable.appendChild(newRow);

                // Tampilkan semua tombol hapus
                document.querySelectorAll('.hapus-row').forEach(btn => {
                    btn.style.display = 'block';
                });

                // Setup event listeners untuk baris baru
                setupProdukSelect(newRow);
                newRow.querySelector('.jumlah-input').addEventListener('input', function() {
                    hitungSubtotal(newRow);
                });

                // Event listener untuk tombol hapus
                newRow.querySelector('.hapus-row').addEventListener('click', function() {
                    newRow.remove();
                    hitungTotalKeseluruhan();
                    
                    // Sembunyikan tombol hapus jika hanya ada satu baris
                    if (document.querySelectorAll('.produk-row').length === 1) {
                        document.querySelector('.hapus-row').style.display = 'none';
                    }
                });
            });

            function updateSummary() {
                const totalItems = document.querySelectorAll('.produk-row').length;
                document.getElementById('total-items').textContent = `${totalItems} Items`;
                
                const totalKeseluruhan = document.getElementById('total-keseluruhan').value;
                document.getElementById('total-summary').textContent = totalKeseluruhan;
            }
        });
    </script>
</body>
</html>
