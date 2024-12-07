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
  <link rel="stylesheet" href="../../vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
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
          <div class="row">
            
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tambah Pesanan</h4>
                  <form class="form-sample">
                    <p class="card-description">
                      Tambahkan Pesanan Baru
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Admin</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"value="{{ session('admin_name') }}" required readonly />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Status</label>
                          <div class="col-sm-9">
                            <select class="form-control" id="status">
                                <option>pesanan</option>
                                <option>dikirim</option>
                                <option>selesai</option>
                              </select>
                          </div>
                        </div>
                      </div>                 
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Konsumen</label>
                          <div class="col-sm-9">
                            <select class="form-control" id="konsumen"name="ms_konsumen_id_konsumen" required>
                                <option value="">-- Pilih Konsumen --</option>

                                <!-- Looping data konsumen -->
                                @foreach ($konsumen as $item)
                                <option value="{{ $item->id_konsumen }}">{{ $item->nama_konsumen }}</option>
                                @endforeach

                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Suplier</label>
                          <div class="col-sm-9">
                          <select class="form-control" id="suplier"name="ms_suplier_id_suplier" required>
                            <option value="">-- Pilih Suplier --</option>

                            <!-- Looping data konsumen -->
                            @foreach ($suplier as $item)
                            <option value="{{ $item->id_suplier }}">{{ $item->nama_suplier }}</option>
                            @endforeach

                        </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tanggal Pesan</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tanggal Kirim</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-inverse-primary btn-fw mb-5 align-items-center" data-bs-toggle="modal" data-bs-target="#tambahproduk">
                        <i class="mdi mdi-plus" style="vertical-align: middle; margin-right: 8px;"></i>Tambah Pesanan
                    </button>
                    <h4 class="card-title">Daftar Produk</h4>
                    <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Konsumen</th>
                          <th>Total Harga</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($ms_pesanan as $pesanan)
                        <tr>
                        <td>{{ $pesanan->tanggal_pesan }}</td>
                        <td>{{ $pesanan->konsumen->nama_konsumen ?? 'Tidak ada' }}</td>
                        <td>{{ $pesanan->suplier->nama_suplier ?? 'Tidak ada' }}</td>
                        <td>
                            @if ($pesanan->status == 'pesanan')
                                <label class="badge badge-warning">Pesanan</label>
                            @elseif ($pesanan->status == 'dikirim')
                                <label class="badge badge-info">Dikirim</label>
                            @elseif ($pesanan->status == 'selesai')
                                <label class="badge badge-success">Selesai</label>
                            @else
                                <label class="badge badge-secondary">Tidak Diketahui</label>
                            @endif
                        </td>

                        <td>
                            <a class="btn btn-link">
                                <i class="mdi mdi-pencil-box"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                      </tbody>
                    </table>
                  </div>
                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                    <button class="btn btn-danger">Batal</button>
                     
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        @include('partial._footer')
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../js/file-upload.js"></script>
  <script src="../../js/typeahead.js"></script>
  <script src="../../js/select2.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
