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
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            border: 1px solid #000;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .footer {
            margin-top: 20px;
        }
        .footer table {
            border: none;
        }
        .footer td {
            border: none;
        }
        .right-align {
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }
        .print-button {
            margin: 20px 0;
            text-align: center;
        }
        .print-button button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="print-button">
        <button onclick="printInvoice()">Cetak Invoice</button>
    </div>

    <div id="invoice-container" class="container">
        <h2>INVOICE</h2>
        <p><strong>CV. WAK PUTRA JAYA</strong></p>
        <table>
            <tr>
                <td><strong>Invoice No.</strong></td>
                <td>: <?= $invoice_no ?? 'INV-001' ?></td>
                <td><strong>Tanggal</strong></td>
                <td>: <?= $tanggal ?? date('d-m-Y') ?></td>
            </tr>
            <tr>
                <td><strong>Kepada</strong></td>
                <td colspan="3">: <?= $kepada ?? 'Nama Pelanggan' ?></td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan (Rp)</th>
                    <th>Subtotal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data_barang = [
                    ["Ayam Fillet Paha (BLP)", 5, 40000],
                    ["Ayam Fillet Dada (BLD)", 3, 45000],
                    ["Ayam Potong Dadu", 2, 35000],
                ];
                $total = 0;
                foreach ($data_barang as $index => $barang) {
                    $subtotal = $barang[1] * $barang[2];
                    $total += $subtotal;
                    echo "<tr>
                        <td>" . ($index + 1) . "</td>
                        <td>{$barang[0]}</td>
                        <td>{$barang[1]}</td>
                        <td class='right-align'>" . number_format($barang[2], 0, ',', '.') . "</td>
                        <td class='right-align'>" . number_format($subtotal, 0, ',', '.') . "</td>
                    </tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="bold right-align">Total</td>
                    <td class="bold right-align"><?= number_format($total, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p><strong>Catatan:</strong> <?= $catatan ?? 'Pembayaran dapat dilakukan melalui transfer bank ke rekening kami.' ?></p>
            <br>
            <p><strong>Penerima:</strong> CV. WAK PUTRA JAYA</p>
        </div>
    </div>

    <script>
        function printInvoice() {
            // Ambil elemen invoice saja
            const invoiceContent = document.getElementById('invoice-container').innerHTML;

            // Buat halaman cetak baru
            const printWindow = window.open('', '', 'width=800,height=600');
            printWindow.document.write('<html><head><title>Invoice</title>');
            printWindow.document.write('<style>');
            printWindow.document.write('body { font-family: Arial, sans-serif; }');
            printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-top: 10px; }');
            printWindow.document.write('table, th, td { border: 1px solid black; }');
            printWindow.document.write('th, td { padding: 8px; text-align: left; }');
            printWindow.document.write('.right-align { text-align: right; }');
            printWindow.document.write('.bold { font-weight: bold; }');
            printWindow.document.write('</style></head><body>');
            printWindow.document.write(invoiceContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</body>
</html>

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
  <!-- container-scroller -->
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
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
