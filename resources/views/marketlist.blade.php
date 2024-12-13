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
                <button type="button" class="btn btn-inverse-primary btn-fw mb-5 align-items-center" data-bs-toggle="modal" data-bs-target="#tambahpesanan">
                <i class="mdi mdi-plus" style="vertical-align: middle; margin-right: 8px;"></i>Tambah Pesanan
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
  <!-- Modal Tambah Pesanan -->
  <div class="modal fade" id="tambahpesanan" tabindex="-1" aria-labelledby="tambahPesananModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahPesananModalLabel">Tambah Pesanan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('TambahPesanan') }}" method="POST">
          @csrf <!-- Tambahkan CSRF token untuk keamanan -->
          <div class="modal-body">
            <div class="mb-3">
              <label for="adminName" class="form-label">Admin</label>
              <input type="text" class="form-control form-control-sm" id="adminName" name="ms_user_id_user" value="{{ session('admin_name') }}" readonly />
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-control form-control-sm" id="status" name="status" required>
                <option value="pesanan">Pesanan</option>
                <option value="dikirim">Dikirim</option>
                <option value="selesai">Selesai</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="id_konsumen" class="form-label">Konsumen</label>
              <select class="form-control form-control-sm" id="id_konsumen" name="ms_konsumen_id_konsumen" required>
                <option value="">-- Pilih Konsumen --</option>
                @foreach ($konsumen as $item)
                <option value="{{ $item->id_konsumen }}">{{ $item->nama_konsumen }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="id_suplier" class="form-label">Suplier</label>
              <select class="form-control form-control-sm" id="id_suplier" name="ms_suplier_id_suplier" required>
                <option value="">-- Pilih Suplier --</option>
                @foreach ($suplier as $item)
                <option value="{{ $item->id_suplier }}">{{ $item->nama_suplier }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="tanggalpesan" class="form-label">Tanggal Pesan</label>
              <input type="date" class="form-control form-control-sm" id="tanggalpesan" name="tanggal_pesan" required />
            </div>
            <div class="mb-3">
              <label for="tanggalkirim" class="form-label">Tanggal Kirim</label>
              <input type="date" class="form-control form-control-sm" id="tanggalkirim" name="tanggal_kirim" required />
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
  <!-- End Modal Tambah Pesanan -->


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
