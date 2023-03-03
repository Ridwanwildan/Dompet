<?php
include "koneksi.php";
//query untuk total pengeluaran
$sql = 'SELECT SUM(price) AS total_pengeluaran FROM transaction';
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

//query untuk chart
$sql = "SELECT SUM(price) as total_price, date FROM transaction GROUP BY date ORDER BY date ASC";
$result2 = mysqli_query($conn, $sql);

//query untuk tabel pengeluaran terbaru
$sql = "SELECT price, date, name FROM transaction ORDER BY date DESC LIMIT 5";
$result3 = mysqli_query($conn, $sql);

//query untuk total pemasukan
$sql = "SELECT SUM(price) AS total_pemasukan FROM income";
$result4 = mysqli_query($conn, $sql);
$data2 = mysqli_fetch_assoc($result4);

//definisi array untuk chart
$prices = array();
$tanggal = array();
//Tampilkan array
while ($row = mysqli_fetch_assoc($result2)) {
  $prices[] = $row['total_price'];
  $tanggal[] = $row['date'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
  <title>Dompet</title>
</head>

<body>
  <!-- Navigation Bar -->
  <?php include "nav.php"; ?>

  <div class="container mt-4 pt-4">
    <!-- Row untuk card -->
    <div class="row">
      <!-- Pemasukan card -->
      <div class="col-4 d-flex justify-content-center">
        <div class="card" style="width: 18rem">
          <div class="card-body">
            <?php $pemasukan = $data2['total_pemasukan']; ?>
            <h5 class="card-title text-center">Pemasukan</h5>
            <h4 class="card-text text-center">
              Rp.<?php echo number_format($pemasukan, 0, ",", ",") ?>
            </h4>
            <div class="d-flex justify-content-center py-2">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                Tambah
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Pengeluaran card -->
      <div class="col-4 d-flex justify-content-center">
        <div class="card" style="width: 18rem">
          <div class="card-body">
            <h5 class="card-title text-center">Pengeluaran</h5>
            <?php $pengeluaran = $data['total_pengeluaran']; ?>
            <h4 class="card-text text-center">
              Rp.<?php echo number_format($pengeluaran, 0, ",", ","); ?>
            </h4>
            <div class="d-flex justify-content-center py-2">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Dompet card -->
      <div class="col-4 d-flex flex-column align-items-center justify-content-center">
        <div class="card" style="width: 18rem">
          <div class="card-body py-4">
            <h5 class="card-title text-center">Dompet</h5>
            <?php $dompet = $pemasukan - $pengeluaran; ?>
            <h4 class="card-text text-center">
              Rp.<?php echo number_format($dompet, 0, ",", ","); ?>
            </h4>
          </div>
        </div>
      </div>
    </div>
    <div class="row my-5">
      <!-- display chart -->
      <div class="col-8">
        <canvas class="mx-auto" id="myChart" style="width:100%;max-width:850px;"></canvas>
      </div>
      <!-- Tabel Pengeluaran terbaru -->
      <div class="col-4">
        <ul class="list-group">
          <li class="list-group-item list-group-item-success text-center fw-bold">
            Pengeluaran Terbaru
          </li>
          <li class="list-group-item list-group-item-success text-center fw-bold">
            <div class="row">
              <div class="col-4">
                Tanggal
              </div>
              <div class="col-4">
                Keterangan
              </div>
              <div class="col-4">
                Jumlah
              </div>
            </div>
          </li>
          <?php if ($result3) : ?>
            <?php while ($row = mysqli_fetch_array($result3)) : ?>
              <li class="list-group-item text-center">
                <div class="row">
                  <div class="col-4">
                    <?= date('d-m-Y', strtotime($row['date'])) ?>
                  </div>
                  <div class="col-4">
                    <?= strlen($row['name']) > 12 ? substr($row['name'], 0, 12) . '...' : $row['name'] ?>
                  </div>
                  <div class="col-4">
                    Rp.<?php echo number_format($row['price'], 0, ",", ","); ?>
                  </div>
                </div>
              </li>
            <?php endwhile; ?>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <?php include "out.php"; ?>
  <?php include "in.php"; ?>
  <!-- Chart -->
  <?php include "chart.php"; ?>
</body>

</html>