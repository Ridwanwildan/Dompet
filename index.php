<?php 
include "koneksi.php";
$sql = 'SELECT SUM(price) AS total_nominal FROM transaction';
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
?>

<?php
$sql = "SELECT SUM(price) as total_price, date FROM transaction GROUP BY date ORDER BY date ASC";
$result2 = mysqli_query($conn, $sql);
?>

<?php
$sql = "SELECT price, date, name FROM transaction ORDER BY date DESC LIMIT 5";
$result3 = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <title>Dompet</title>
  </head>
  <body>
    <!-- Navigation Bar -->
    <?php include "nav.php"; ?>
    
    <div class="container mt-4 pt-4">
      <?php 
      $prices = array();
      $tanggal = array();
      while ($row = mysqli_fetch_assoc($result2)) {
      $prices[] = $row['total_price'];
      $tanggal[] = $row['date'];
      }

      //print_r($prices); ?>
      <div class="row">
        <div class="col-4 d-flex justify-content-center">
          <div class="card" style="width: 18rem">
            <div class="card-body">
              <?php $pemasukan=18000000; ?>
              <h5 class="card-title text-center">Pemasukan</h5>
              <h4 class="card-text text-center">
                Rp.<?php echo number_format($pemasukan, 0, ",", ",") ?>
              </h4>
              <div class="d-flex justify-content-center py-2">
                <button type="button" class="btn btn-success">Tambah</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-4 d-flex justify-content-center">
          <div class="card" style="width: 18rem">
            <div class="card-body">
              <h5 class="card-title text-center">Pengeluaran</h5>
              <?php $pengeluaran = $data['total_nominal'];?>
              <h4 class="card-text text-center">
                Rp.<?php echo number_format($pengeluaran, 0, ",", ","); ?>
            </h4>
              <div class="d-flex justify-content-center py-2">
                <button
                  type="button"
                  class="btn btn-success"
                  data-bs-toggle="modal"
                  data-bs-target="#exampleModal"
                >
                  Tambah
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-4 d-flex flex-column align-items-center justify-content-center">
          <div class="card" style="width: 18rem">
            <div class="card-body py-4">
              <h5 class="card-title text-center">Dompet</h5>
              <?php $dompet = $pemasukan - $pengeluaran; ?>
              <h4 class="card-text text-center">
                Rp.<?php echo number_format($dompet, 0, ",", ",");?>
              </h4>
            </div>
          </div>
        </div>  
      </div>
      <div class="row my-5">
        <div class="col-8">
          <canvas class="mx-auto" id="myChart" style="width:100%;max-width:850px;"></canvas>
        </div>
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
          <?php if($result3): ?>
          <?php while($row = mysqli_fetch_array($result3)): ?>
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
    <!-- Pengeluaran Modal -->
    <?php include "input.php"; ?>
  </body>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js">
  </script>
  <script>
var xValues = <?php echo json_encode($tanggal); ?>;
new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: <?php echo json_encode($prices); ?>,
      borderColor: "green",
      borderWidth: 3,
      pointRadius: 0,
      pointHoverRadius: 10,
      hoverRadius: 10,
      pointBackgroundColor: "green",
      pointHoverBackgroundColor: "darkgreen",
      fill: false,
      label: 'Pengeluaran'
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      xAxes: [{
        ticks: {
          maxRotation: 45,
          minRotation: 45
        },
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          borderDash: [5, 10],
          color: "rgba(0, 0, 0, 0.2)"
        }
      }]
    },
    tooltips: {
      callbacks: {
        label: function(tooltipItem, data) {
          return "Pengeluaran : Rp." + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
      },
      mode: 'index',
      intersect: false,
      position: 'nearest',
      caretSize: 8,
      backgroundColor: 'white',
      titleFontColor: 'black',
      titleFontSize: 12,
      bodyFontColor: 'black',
      bodyFontSize: 12,
      borderColor: 'green',
      borderWidth: 1,
      padding: 12,
      pointStyle: 'circle'
    }
  }
});


</script>
</html>
