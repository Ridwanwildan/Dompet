<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js">
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
            legend: {
                display: false
            },
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