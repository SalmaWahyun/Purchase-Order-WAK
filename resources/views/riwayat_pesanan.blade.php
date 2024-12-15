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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Riwayat Pesanan</h4>
                  <div class="card mb-3">
                    <div class="card-body">
                      <form action="{{ route('riwayat.index') }}" method="GET" class="row align-items-end">
                        <div class="col-md-4">
                          <label class="form-label">Tanggal Mulai</label>
                          <input type="date" name="start_date" class="form-control" 
                                 value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Tanggal Akhir</label>
                          <input type="date" name="end_date" class="form-control" 
                                 value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-4">
                          <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-filter"></i> Filter
                          </button>
                          <a href="{{ route('riwayat.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-refresh"></i> Reset
                          </a>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>
                            ID Pesanan
                            <a href="{{ route('riwayat.index', ['sort' => 'id_pesanan', 'order' => 'asc']) }}" class="text-dark">↑</a>
                            <a href="{{ route('riwayat.index', ['sort' => 'id_pesanan', 'order' => 'desc']) }}" class="text-dark">↓</a>
                          </th>
                          <th>
                            Tanggal Pesan
                            <a href="{{ route('riwayat.index', ['sort' => 'tanggal_pesan', 'order' => 'asc']) }}" class="text-dark">↑</a>
                            <a href="{{ route('riwayat.index', ['sort' => 'tanggal_pesan', 'order' => 'desc']) }}" class="text-dark">↓</a>
                          </th>
                          <th>
                            Tanggal Kirim
                            <a href="{{ route('riwayat.index', ['sort' => 'tanggal_kirim', 'order' => 'asc']) }}" class="text-dark">↑</a>
                            <a href="{{ route('riwayat.index', ['sort' => 'tanggal_kirim', 'order' => 'desc']) }}" class="text-dark">↓</a>
                          </th>
                          <th>
                            Konsumen
                          </th>
                          <th>
                            Supplier
                          </th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($riwayat_pesanan as $riwayat)
                        <tr>
                          <td>{{ $riwayat->id_pesanan }}</td>
                          <td>{{ date('Y-m-d', strtotime($riwayat->tanggal_pesan)) }}</td>
                          <td>{{ date('Y-m-d', strtotime($riwayat->tanggal_kirim)) }}</td>
                          <td>{{ $riwayat->nama_konsumen }}</td>
                          <td>{{ $riwayat->nama_suplier }}</td>
                          <td>
                            <label class="badge badge-success">Selesai</label>
                          </td>
                          <td>
                            <div class="btn-group" role="group">
                              <a href="{{ route('riwayat.detail', $riwayat->id_pesanan) }}" 
                                 class="btn btn-info btn-sm" title="Detail">
                                <i class="mdi mdi-eye"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex justify-content-center mt-4">
                    {{ $riwayat_pesanan->appends(request()->query())->links() }}
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
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
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
</body>

</html>
