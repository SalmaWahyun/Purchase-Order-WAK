<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Pesanan - Purchase Order</title>
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="../../images/favicon.png" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
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
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="card-title">Edit Pesanan #{{ $pesanan->id_pesanan }}</h4>
                                        <a href="{{ route('marketlist') }}" class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left"></i> Kembali
                                        </a>
                                    </div>

                                    <form action="{{ route('pesanan.update', $pesanan->id_pesanan) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <!-- Informasi Pesanan -->
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><i class="mdi mdi-calendar"></i> Tanggal Pesan</label>
                                                    <input type="datetime-local" class="form-control" name="tanggal_pesan" 
                                                        value="{{ date('Y-m-d\TH:i', strtotime($pesanan->tanggal_pesan)) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label><i class="mdi mdi-truck-delivery"></i> Tanggal Kirim</label>
                                                    <input type="datetime-local" class="form-control" name="tanggal_kirim"
                                                        value="{{ date('Y-m-d\TH:i', strtotime($pesanan->tanggal_kirim)) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label><i class="mdi mdi-flag"></i> Status</label>
                                                    <select class="form-control" name="status">
                                                        <option value="pesanan" {{ $pesanan->status == 'pesanan' ? 'selected' : '' }}>Pesanan</option>
                                                        <option value="dikirim" {{ $pesanan->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label><i class="mdi mdi-account"></i> Konsumen</label>
                                                    <select class="form-control" name="ms_konsumen_id_konsumen">
                                                        @foreach($konsumens as $konsumen)
                                                            <option value="{{ $konsumen->id_konsumen }}" 
                                                                {{ $pesanan->ms_konsumen_id_konsumen == $konsumen->id_konsumen ? 'selected' : '' }}>
                                                                {{ $konsumen->nama_konsumen }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label><i class="mdi mdi-account-multiple"></i> Supplier</label>
                                                    <select class="form-control" name="ms_suplier_id_suplier">
                                                        @foreach($supliers as $suplier)
                                                            <option value="{{ $suplier->id_suplier }}"
                                                                {{ $pesanan->ms_suplier_id_suplier == $suplier->id_suplier ? 'selected' : '' }}>
                                                                {{ $suplier->nama_suplier }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tabel Detail Transaksi -->
                                        <div class="table-responsive mt-4">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th colspan="6" class="text-right">
                                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambahProduk">
                                                                <i class="mdi mdi-plus"></i> Tambah Produk
                                                            </button>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th>ID Transaksi</th>
                                                        <th>Nama Produk</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga Satuan</th>
                                                        <th>Subtotal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $total = 0; @endphp
                                                    @foreach($pesanan->transaksiPesanan as $index => $transaksi)
                                                    <tr>
                                                        <td>
                                                            {{ $transaksi->id_tr_pesanan }}
                                                            <input type="hidden" name="transaksi[{{ $index }}][id_tr_pesanan]" 
                                                                value="{{ $transaksi->id_tr_pesanan }}">
                                                        </td>
                                                        <td>{{ $transaksi->produk->nama_produk }}</td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm jumlah"
                                                                name="transaksi[{{ $index }}][jumlah]" 
                                                                value="{{ $transaksi->jumlah }}" min="1">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm harga"
                                                                name="transaksi[{{ $index }}][harga]" 
                                                                value="{{ $transaksi->harga }}" min="0">
                                                        </td>
                                                        <td class="subtotal">
                                                            Rp {{ number_format($transaksi->sub_total, 0, ',', '.') }}
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm" 
                                                                onclick="konfirmasiHapus('{{ $transaksi->id_tr_pesanan }}')">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @php $total += $transaksi->sub_total; @endphp
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr class="table-info">
                                                        <td colspan="4" class="text-end">
                                                            <strong>Total:</strong>
                                                        </td>
                                                        <td id="total" colspan="2">
                                                            <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="mdi mdi-content-save"></i> Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="modalKonfirmasiHapus" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus produk ini dari pesanan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="formHapus" action="" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Produk Terakhir -->
    <div class="modal fade" id="modalKonfirmasiHapusTerakhir" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="mdi mdi-alert"></i> Peringatan Penghapusan
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="mdi mdi-alert-circle text-danger" style="font-size: 48px;"></i>
                    </div>
                    <p class="text-center font-weight-bold">
                        Ini adalah produk terakhir dalam pesanan ini!
                    </p>
                    <p class="text-center">
                        Jika Anda menghapus produk ini, seluruh data pesanan juga akan dihapus.
                        Apakah Anda yakin ingin melanjutkan?
                    </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="mdi mdi-close"></i> Batal
                    </button>
                    <form id="formHapusPesanan" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="mdi mdi-delete"></i> Ya, Hapus Semua
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="modalTambahProduk" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk ke Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('transaksi.store', $pesanan->id_pesanan) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Pilih Produk</label>
                            <select class="form-control produk-select" name="ms_produk_id_produk" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach($produks as $p)
                                    <option value="{{ $p->id_produk }}" data-harga="{{ $p->harga_produk }}">
                                        {{ $p->nama_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga Satuan</label>
                            <input type="text" class="form-control harga-display" readonly>
                            <input type="hidden" name="harga" class="harga-input">
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" class="form-control jumlah-input" name="jumlah" min="1" required>
                        </div>
                        <div class="form-group">
                            <label>Subtotal</label>
                            <input type="text" class="form-control subtotal-display" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="mdi mdi-plus"></i> Tambah Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function konfirmasiHapus(id) {
            const formHapus = document.getElementById('formHapus');
            formHapus.action = '/transaksi-pesanan/' + id;
            $('#modalKonfirmasiHapus').modal('show');
        }

        // Perhitungan otomatis
        $(document).ready(function() {
            const hitungSubtotal = (row) => {
                const jumlah = parseInt($(row).find('.jumlah').val()) || 0;
                const harga = parseInt($(row).find('.harga').val()) || 0;
                const subtotal = jumlah * harga;
                $(row).find('.subtotal').text(`Rp ${subtotal.toLocaleString('id-ID')}`);
                return subtotal;
            };

            const hitungTotal = () => {
                let total = 0;
                $('tbody tr').each(function() {
                    total += hitungSubtotal(this);
                });
                $('#total strong').text(`Rp ${total.toLocaleString('id-ID')}`);
            };

            $('.jumlah, .harga').on('input', hitungTotal);
        });

        @if(session('showDeleteConfirm'))
            $(document).ready(function() {
                const formHapus = document.getElementById('formHapusPesanan');
                formHapus.action = '/transaksi-pesanan/{{ session("deleteId") }}/delete-with-pesanan';
                $('#modalKonfirmasiHapusTerakhir').modal('show');
            });
        @endif

        $(document).ready(function() {
            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(angka);
            }

            function hitungSubtotal() {
                const harga = parseInt($('.harga-input').val()) || 0;
                const jumlah = parseInt($('.jumlah-input').val()) || 0;
                const subtotal = harga * jumlah;
                $('.subtotal-display').val(formatRupiah(subtotal));
            }

            // Cek duplikasi produk
            function isProdukExists(produkId) {
                let exists = false;
                $('tbody tr').each(function() {
                    const existingProdukId = $(this).find('input[name^="transaksi"][name$="[id_produk]"]').val();
                    if (existingProdukId === produkId) {
                        exists = true;
                        return false; // break loop
                    }
                });
                return exists;
            }

            $('.produk-select').change(function() {
                const selectedOption = $(this).find('option:selected');
                const produkId = selectedOption.val();

                // Cek apakah produk sudah ada di tabel
                if (isProdukExists(produkId)) {
                    alert('Produk ini sudah ada dalam pesanan!');
                    $(this).val(''); // Reset pilihan
                    $('.harga-display').val('');
                    $('.harga-input').val('');
                    $('.subtotal-display').val('');
                    return;
                }

                const harga = selectedOption.data('harga');
                $('.harga-input').val(harga);
                $('.harga-display').val(formatRupiah(harga));
                hitungSubtotal();
            });

            $('.jumlah-input').on('input', hitungSubtotal);

            // Reset form saat modal ditutup
            $('#modalTambahProduk').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $('.subtotal-display').val('');
                $('.harga-display').val('');
            });

            $('#formTambahProduk').on('submit', function(e) {
                e.preventDefault();
                
                const produkId = $('.produk-select').val();
                const produkNama = $('.produk-select option:selected').text();
                const jumlahBaru = parseInt($('.jumlah-input').val());
                const hargaBaru = parseInt($('.harga-input').val());
                let produkExists = false;
                
                // Cek apakah produk sudah ada di tabel
                $('tbody tr').each(function() {
                    const namaProduk = $(this).find('td:eq(1)').text().trim();
                    
                    if (namaProduk === produkNama.trim()) {
                        produkExists = true;
                        // Ambil nilai jumlah yang sudah ada
                        const jumlahLama = parseInt($(this).find('.jumlah').val());
                        const jumlahTotal = jumlahLama + jumlahBaru;
                        
                        // Update jumlah
                        $(this).find('.jumlah').val(jumlahTotal);
                        
                        // Update subtotal
                        const subtotal = jumlahTotal * hargaBaru;
                        $(this).find('.subtotal').text(`Rp ${subtotal.toLocaleString('id-ID')}`);
                        
                        // Trigger event untuk update total
                        $(this).find('.jumlah').trigger('input');
                        
                        // Tampilkan pesan
                        alert(`Produk ${produkNama} sudah ada. Jumlah akan ditambahkan ke baris yang ada.`);
                        return false; // break loop
                    }
                });
                
                // Jika produk belum ada, submit form seperti biasa
                if (!produkExists) {
                    this.submit();
                } else {
                    // Tutup modal jika produk digabungkan
                    $('#modalTambahProduk').modal('hide');
                }
            });
        });
    </script>
</body>
</html>
