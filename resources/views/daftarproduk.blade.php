<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
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
                <button type="button" class="btn btn-inverse-primary btn-fw mb-5 align-items-center" data-bs-toggle="modal" data-bs-target="#tambahproduk">
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
                            <td>{{ $produk->nama_produk }}</td>
                            <td>{{ $produk->deskripsi }}</td>
                            <td>{{ 'Rp '.number_format($produk->harga_produk,0,',','.') }} </td>
                            <td>{{ $produk->satuan }}</td>
                            <td>
                            <a href="{{ route('EditProduk', $produk->id_produk) }}" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editProduk{{ $produk->id_produk }}">
                                <i class="mdi mdi-pencil-box"></i>
                            </a>
                            </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
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
  <div class="modal fade" id="tambahproduk" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Tambah Produk</h5>
        </div>
        <form action="{{ route('TambahProduk') }}" method="POST">
          @csrf <!-- Tambahkan CSRF token untuk keamanan -->
          <div class="modal-body">
            <div class="mb-3">
              <label for="namaProduk" class="form-label">Nama Produk</label>
              <input type="text" class="form-control form-control-sm" id="namaProduk" name="nama_produk" required>
            </div>
            <div class="mb-3">
              <label for="deskripsiProduk" class="form-label">Deskripsi</label>
              <textarea class="form-control form-control-sm" id="deskripsiProduk" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="hargaProduk" class="form-label">Harga</label>
              <input type="text" class="form-control form-control-sm" id="hargaProduk" name="harga_produk" required style="-moz-appearance: textfield; -webkit-appearance: none; appearance: none;">
            </div>
            <div class="mb-3">
              <label for="satuanProduk" class="form-label">Satuan</label>
              <select class="form-control form-control-sm" id="satuanProduk" name="satuan" required>
                <option value="">Pilih Satuan</option>
                <option value="Ons">Ons</option>
                <option value="Kg">Kg</option>
                <option value="Ton">Ton</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal tambah produk -->
  

  <!-- modal edit produk -->
  <div class="modal fade" id="editProduk{{ $produk->id_produk }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $produk->id_produk }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProductModalLabel{{ $produk->id_produk }}">Edit Produk</h5>
        </div>
        <form action="{{ route('UpdateProduk', $produk->id_produk) }}" method="POST">
          @csrf
          @method('PUT') <!-- Menandakan bahwa ini adalah update -->
          <div class="modal-body">
            <div class="mb-3">
              <label for="namaProduk" class="form-label">Nama Produk</label>
              <input type="text" class="form-control form-control-sm" id="namaProduk" name="nama_produk" value="{{ $produk->nama_produk }}" required>
            </div>
            <div class="mb-3">
              <label for="deskripsiProduk" class="form-label">Deskripsi</label>
              <textarea class="form-control form-control-sm" id="deskripsiProduk" name="deskripsi" rows="3" required>{{ $produk->deskripsi }}</textarea>
            </div>
            <div class="mb-3">
              <label for="hargaProduk" class="form-label">Harga</label>
              <input type="text" class="form-control form-control-sm" id="hargaProduk" name="harga_produk" value="{{ $produk->harga_produk }}" required>
            </div>
            <div class="mb-3">
              <label for="satuanProduk" class="form-label">Satuan</label>
              <select class="form-control form-control-sm" id="satuanProduk" name="satuan" required>
                <option value="Kg" {{ $produk->satuan == 'Kg' ? 'selected' : '' }}>Kg</option>
                <option value="Ons" {{ $produk->satuan == 'Ons' ? 'selected' : '' }}>Ons</option>
                <option value="Ton" {{ $produk->satuan == 'Ton' ? 'selected' : '' }}>Ton</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal edit produk -->
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
</body>

</html>