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
                <button type="button" class="btn btn-inverse-primary btn-fw mb-5 align-items-center" data-bs-toggle="modal" data-bs-target="#tambahkonsumen">
                <i class="mdi mdi-plus" style="vertical-align: middle; margin-right: 8px;"></i>Tambah Konsumen
                </button>
            </div>
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar Konsumen</h4>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Konsumen</th>
                          <th>Alamat</th>
                          <th>No HP</th>
                          <th>Email</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($ms_konsumen as $konsumen)
                        <tr>
                            <td>{{ $konsumen->nama_konsumen }}</td>
                            <td>{{ $konsumen->alamat }}</td>
                            <td>{{ $konsumen->no_hp }} </td>
                            <td>{{ $konsumen->email }}</td>
                            <td>
                            <a >
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
  <!-- modal tambah konsumen -->
  <div class="modal fade" id="tambahkonsumen" tabindex="-1" aria-labelledby="addKonsumenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addKonsumenModalLabel">Tambah Konsumen</h5>
        </div>
        <form action="{{ route('TambahKonsumen') }}" method="POST">
          @csrf <!-- Tambahkan CSRF token untuk keamanan -->
          <div class="modal-body">
            <div class="mb-3">
              <label for="namaKonsumen" class="form-label">Nama Konsumen</label>
              <input type="text" class="form-control form-control-sm" id="namaKonsumen" name="nama_konsumen" required>
            </div>
            <div class="mb-3">
              <label for="alamatkonsumen" class="form-label">Alamat</label>
              <textarea class="form-control form-control-sm" id="alamatkonsumen" name="alamat" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="nohp" class="form-label">No HP</label>
              <input type="text" class="form-control form-control-sm" id="nohp" name="no_hp" required style="-moz-appearance: textfield; -webkit-appearance: none; appearance: none;">
            </div>
            <div class="mb-3">
              <label for="e-mail" class="form-label">Email</label>
              <input type="text" class="form-control form-control-sm" id="e-mail" name="email" required style="-moz-appearance: textfield; -webkit-appearance: none; appearance: none;">
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
  <div class="modal fade" id="editKonsumen{{ $konsumen->id_konsumen }}" tabindex="-1" aria-labelledby="editKonsumenModalLabel{{ $konsumen->id_konsumen }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editKonsumenModalLabel{{ $konsumen->id_konsumen }}">Edit Produk</h5>
        </div>
        <form action="{{ route('UpdateProduk', $konsumen->id_konsumen) }}" method="POST">
          @csrf
          @method('PUT') <!-- Menandakan bahwa ini adalah update -->
          <div class="modal-body">
            <div class="mb-3">
              <label for="namaKonsumen" class="form-label">Nama Konsumen</label>
              <input type="text" class="form-control form-control-sm" id="namaKonsumen" name="nama_konsumen" value="{{ $konsumen->nama_konsumen }}" required>
            </div>
            <div class="mb-3">
              <label for="alamatkonsumen" class="form-label">Alamat</label>
              <textarea class="form-control form-control-sm" id="alamatkonsumen" name="alamat" rows="3" required>{{ $konsumen->alamat }}</textarea>
            </div>
            <div class="mb-3">
              <label for="nohp" class="form-label">No HP</label>
              <input type="text" class="form-control form-control-sm" id="nohp" name="no_hp" value="{{ $konsumen->no_hp }}" required>
            </div>
            <div class="mb-3">
              <label for="e-mail" class="form-label">Email</label>
              <input type="text" class="form-control form-control-sm" id="e-mail" name="email" value="{{ $konsumen->email }}" required>
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