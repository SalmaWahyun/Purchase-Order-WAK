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
                <button type="button" class="btn btn-inverse-primary btn-fw m-3 align-items-center" data-bs-toggle="modal" data-bs-target="#tambahkonsumen">
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
                          <th>
                            ID Konsumen
                            <a href="{{ route('konsumen', ['sort' => 'id_konsumen', 'order' => 'asc']) }}" 
                               class="text-dark" title="Urutkan Naik">↑</a>
                            <a href="{{ route('konsumen', ['sort' => 'id_konsumen', 'order' => 'desc']) }}" 
                               class="text-dark" title="Urutkan Turun">↓</a>
                          </th>
                          <th>Nama Konsumen</th>
                          <th>Alamat</th>
                          <th>No HP</th>
                          <th>Email</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($ms_konsumen as $konsumen)
                        <tr>
                            <td>{{ $konsumen->id_konsumen }}</td>
                            <td>{{ $konsumen->nama_konsumen }}</td>
                            <td>{{ $konsumen->alamat }}</td>
                            <td>{{ $konsumen->no_hp }}</td>
                            <td>{{ $konsumen->email }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                            data-bs-target="#editKonsumen{{ $konsumen->id_konsumen }}" title="Edit">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" 
                                            onclick="konfirmasiHapus('{{ $konsumen->id_konsumen }}')" title="Hapus">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>

                  <!-- Pagination -->
                  <div class="d-flex justify-content-center mt-4">
                    {{ $ms_konsumen->appends(request()->query())->links() }}
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
  @foreach ($ms_konsumen as $konsumen)
  <div class="modal fade" id="editKonsumen{{ $konsumen->id_konsumen }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Konsumen</h5>
            </div>
            <form action="{{ route('UpdateKonsumen', $konsumen->id_konsumen) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Konsumen</label>
                        <input type="text" class="form-control" name="nama_konsumen" 
                               value="{{ $konsumen->nama_konsumen }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" 
                                  required>{{ $konsumen->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" class="form-control" name="no_hp" 
                               value="{{ $konsumen->no_hp }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" 
                               value="{{ $konsumen->email }}" required>
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
                <p>Apakah Anda yakin ingin menghapus konsumen ini?</p>
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
        form.action = `/konsumen/${id}`;
        $('#modalKonfirmasiHapus').modal('show');
    }
  </script>
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