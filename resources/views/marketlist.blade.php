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

            <div class="template-demo m-3">
              <a href="{{ route('create.pesanan') }}" class="btn btn-inverse-primary btn-fw align-items-center">
                <i class="mdi mdi-plus" style="vertical-align: middle; margin-right: 8px;"></i>Tambah Pesanan
              </a>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Daftar Pemesanan</h4>
                  <div class="card mb-3">
                    <div class="card-body">
                      <form action="{{ route('marketlist') }}" method="GET" class="row align-items-end">
                        <div class="col-md-3">
                          <label class="form-label">Status</label>
                          <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="pesanan" {{ request('status') == 'pesanan' ? 'selected' : '' }}>Pesanan</option>
                            <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <label class="form-label">Tanggal Mulai</label>
                          <input type="date" name="start_date" class="form-control" 
                                 value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-3">
                          <label class="form-label">Tanggal Akhir</label>
                          <input type="date" name="end_date" class="form-control" 
                                 value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-3">
                          <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-filter"></i> Filter
                          </button>
                          <a href="{{ route('marketlist') }}" class="btn btn-secondary">
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
                            <a href="{{ route('marketlist', ['sort' => 'id_pesanan', 'order' => 'asc']) }}" class="text-dark">↑</a>
                            <a href="{{ route('marketlist', ['sort' => 'id_pesanan', 'order' => 'desc']) }}" class="text-dark">↓</a>
                          </th>
                          <th>
                            Tanggal
                            <a href="{{ route('marketlist', ['sort' => 'tanggal_pesan', 'order' => 'asc']) }}" class="text-dark">↑</a>
                            <a href="{{ route('marketlist', ['sort' => 'tanggal_pesan', 'order' => 'desc']) }}" class="text-dark">↓</a>
                          </th>
                          <th>
                            Konsumen
                            <a href="{{ route('marketlist', ['sort' => 'nama_konsumen', 'order' => 'asc']) }}" class="text-dark">↑</a>
                            <a href="{{ route('marketlist', ['sort' => 'nama_konsumen', 'order' => 'desc']) }}" class="text-dark">↓</a>
                          </th>
                          <th>
                            Supplier
                            <a href="{{ route('marketlist', ['sort' => 'nama_suplier', 'order' => 'asc']) }}" class="text-dark">↑</a>
                            <a href="{{ route('marketlist', ['sort' => 'nama_suplier', 'order' => 'desc']) }}" class="text-dark">↓</a>
                          </th>
                          <th>
                            Status
                            <a href="{{ route('marketlist', ['sort' => 'status', 'order' => 'asc']) }}" class="text-dark">↑</a>
                            <a href="{{ route('marketlist', ['sort' => 'status', 'order' => 'desc']) }}" class="text-dark">↓</a>
                          </th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($ms_pesanan as $pesanan)
                        <tr>
                          <td>{{ $pesanan->id_pesanan }}</td>
                          <td>{{ date('Y-m-d', strtotime($pesanan->tanggal_pesan)) }}</td>
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
                            <div class="btn-group" role="group">
                              <a href="{{ route('pesanan.detail', $pesanan->id_pesanan) }}" class="btn btn-info btn-sm" title="Detail">
                                <i class="mdi mdi-eye"></i>
                              </a>
                              @if($pesanan->status == 'pesanan')
                                <a href="{{ route('pesanan.edit', $pesanan->id_pesanan) }}" class="btn btn-warning btn-sm" title="Edit">
                                  <i class="mdi mdi-pencil"></i>
                                </a>
                              @elseif($pesanan->status == 'dikirim')
                                <button type="button" class="btn btn-success btn-sm" title="Selesaikan Pesanan" 
                                        onclick="konfirmasiSelesai('{{ $pesanan->id_pesanan }}')">
                                  <i class="mdi mdi-check"></i>
                                </button>
                              @endif
                              <button type="button" class="btn btn-danger btn-sm" title="Hapus" 
                                      onclick="konfirmasiHapusPesanan('{{ $pesanan->id_pesanan }}')">
                                <i class="mdi mdi-delete"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="d-flex justify-content-center mt-4">
                    {{ $ms_pesanan->appends(request()->query())->links() }}
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
  <!-- Modal Konfirmasi Hapus Pesanan -->
  <div class="modal fade" id="modalKonfirmasiHapusPesanan" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">
            <i class="mdi mdi-alert"></i> Konfirmasi Hapus
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus pesanan ini?</p>
          <p class="mb-0">Semua data transaksi terkait pesanan ini juga akan dihapus.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="mdi mdi-close"></i> Batal
          </button>
          <form id="formHapusPesanan" method="POST" style="display: inline;">
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
  <!-- Tambahkan Modal Konfirmasi Selesai -->
  <div class="modal fade" id="modalKonfirmasiSelesai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="mdi mdi-check"></i> Konfirmasi Selesai
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menyelesaikan pesanan ini?</p>
                <p class="mb-0">Status pesanan akan diubah menjadi 'Selesai'.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-dismiss="modal">
                    <i class="mdi mdi-close"></i> Batal
                </button>
                <form id="formSelesai" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">
                        <i class="mdi mdi-check"></i> Ya, Selesaikan
                    </button>
                </form>
            </div>
        </div>
    </div>
  </div>
  <script>
    function konfirmasiHapusPesanan(id) {
        const form = document.getElementById('formHapusPesanan');
        form.action = `/pesanan/${id}`;
        $('#modalKonfirmasiHapusPesanan').modal('show');
    }
    function konfirmasiSelesai(id) {
        const form = document.getElementById('formSelesai');
        form.action = `/pesanan/${id}/selesai`;
        $('#modalKonfirmasiSelesai').modal('show');
    }
  </script>
</body>

</html>