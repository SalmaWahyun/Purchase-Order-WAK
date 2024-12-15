<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    @include('partial._navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      @include('partial._settings-panel')
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
      @include('partial._sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="column">

            <div class="template-demo">
                <button type="button" class="btn btn-inverse-primary btn-fw m-3 align-items-center" data-bs-toggle="modal" data-bs-target="#tambahproduk">
                <i class="mdi mdi-plus" style="vertical-align: middle; margin-right: 8px;"></i>Tambah Produk
                </button>
            </div>
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar Produk</h4>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>
                            ID Produk
                            <a href="{{ route('daftarproduk', ['sort' => 'id_produk', 'order' => 'asc']) }}" class="text-dark">↑</a>
                            <a href="{{ route('daftarproduk', ['sort' => 'id_produk', 'order' => 'desc']) }}" class="text-dark">↓</a>
                          </th>
                          <th>Produk</th>
                          <th>Deskripsi</th>
                          <th>Harga</th>
                          <th>Satuan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($ms_produk as $produk)
                        <tr>
                            <td>{{ $produk->id_produk }}</td>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>{{ $produk->deskripsi }}</td>
                            <td>{{ 'Rp '.number_format($produk->harga_produk,0,',','.') }}</td>
                            <td>{{ $produk->satuan }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                            data-bs-target="#editProduk{{ $produk->id_produk }}" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" 
                                            onclick="konfirmasiHapus('{{ $produk->id_produk }}')" title="Hapus">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit untuk setiap produk -->
                        <div class="modal fade" id="editProduk{{ $produk->id_produk }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('UpdateProduk', $produk->id_produk) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control" name="nama_produk" 
                                                       value="{{ $produk->nama_produk }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi" rows="3" 
                                                          required>{{ $produk->deskripsi }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Harga</label>
                                                <input type="number" class="form-control" name="harga_produk" 
                                                       value="{{ $produk->harga_produk }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Satuan</label>
                                                <select class="form-control" name="satuan" required>
                                                    <option value="Kg" {{ $produk->satuan == 'Kg' ? 'selected' : '' }}>Kg</option>
                                                    <option value="Ons" {{ $produk->satuan == 'Ons' ? 'selected' : '' }}>Ons</option>
                                                    <option value="Ton" {{ $produk->satuan == 'Ton' ? 'selected' : '' }}>Ton</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                      @endforeach
                      </tbody>
                    </table>
                  </div>

                  <!-- Pagination -->
                  <div class="d-flex justify-content-center mt-4">
                      {{ $ms_produk->appends(request()->query())->links() }}
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        @include('partial._footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- modal tambah produk -->
  <div class="modal fade" id="tambahproduk" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form id="formTambahProduk" action="{{ route('TambahProduk') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama Produk</label>
              <input type="text" class="form-control form-control-sm required-field" 
                     name="nama_produk" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Deskripsi</label>
              <textarea class="form-control form-control-sm required-field" 
                        name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Harga</label>
              <input type="number" class="form-control form-control-sm required-field" 
                     name="harga_produk" required min="0" 
                     onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
            </div>
            <div class="mb-3">
              <label class="form-label">Satuan</label>
              <select class="form-control form-control-sm required-field" 
                      name="satuan" required>
                <option value="">Pilih Satuan</option>
                <option value="Ons">Ons</option>
                <option value="Kg">Kg</option>
                <option value="Ton">Ton</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" id="btnSimpan" disabled>Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal tambah produk -->
  

  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  <!-- Modal Konfirmasi Hapus -->
  <div class="modal fade" id="modalKonfirmasiHapus" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="mdi mdi-alert"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus produk ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close"></i> Batal
                </button>
                <form id="formHapus" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="mdi mdi-delete"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
  </div>

  <!-- Script untuk konfirmasi hapus -->
  <script>
    function konfirmasiHapus(id) {
        const form = document.getElementById('formHapus');
        form.action = `/daftarproduk/${id}`;
        $('#modalKonfirmasiHapus').modal('show');
    }
  </script>

  <!-- Script untuk mengecek field dan enable/disable tombol -->
  <script>
  // Cek apakah semua field required sudah diisi
  function checkRequiredFields() {
      let allFilled = true;
      document.querySelectorAll('.required-field').forEach(field => {
          if (!field.value) {
              allFilled = false;
          }
      });
      
      // Enable/disable tombol simpan
      document.getElementById('btnSimpan').disabled = !allFilled;
  }

  // Event listener untuk setiap perubahan pada form
  document.querySelectorAll('.required-field').forEach(field => {
      field.addEventListener('input', checkRequiredFields);
      field.addEventListener('change', checkRequiredFields);
  });
  </script>

  <!-- Modal Error Pesanan Dikirim -->
  <div class="modal fade" id="modalErrorDikirim" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="mdi mdi-alert"></i> Tidak Dapat Menghapus Produk
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Produk ini masih digunakan dalam pesanan yang sudah dikirim. Tidak dapat menghapus produk.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
  </div>

  <!-- Modal Warning Pesanan Aktif -->
  <div class="modal fade" id="modalWarningAktif" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">
                    <i class="mdi mdi-alert"></i> Peringatan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Produk ini masih digunakan dalam pesanan yang aktif. Silakan edit atau hapus produk dari pesanan terlebih dahulu.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="" id="linkKePesanan" class="btn btn-primary">
                    Lihat Pesanan
                </a>
            </div>
        </div>
    </div>
  </div>

  <!-- Script untuk menampilkan modal -->
  <script>
    $(document).ready(function() {
        @if(session('error'))
            $('#modalErrorDikirim').modal('show');
        @endif

        @if(session('warning'))
            $('#modalWarningAktif').modal('show');
            @if(session('pesananId'))
                $('#linkKePesanan').attr('href', '/pesanan/' + '{{ session("pesananId") }}'+'/detail');
            @endif
        @endif
    });
  </script>
</body>

</html>