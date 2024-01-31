@extends('admin.layouts.layout')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    @section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Grafik LPPM Keseluruhan</h3>
                </div>
                <br>
                <div class="card-body scrollstyle">
                    <div class="col-md-5 col-sm-12">
                        <div class="row">
                            <div class="col">
                                <select class="form-control" id="filter-chart" style="border-radius: 10px;">
                                    <option value="">Pilih Chart</option>
                                    <option value="surattugas">Surat Tugas</option>
                                    <option value="seminar">Seminar</option>
                                    <option value="hakpaten">Hak Paten</option>
                                    <option value="prosiding">Prosiding</option>
                                    <option value="pengabdian">Pengabdian Masyarakat</option>
                                    <option value="jurnal">Jurnal</option>
                                    <option value="hakcipta">Hak Cipta</option>
                                    <option value="buku">Buku</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="col-12">
                        <div class="col">
                            <h4>Grafik Data</h4>
                        </div>

                        <div class="chart-container">
                            <canvas id="myChart" width="200" height="60"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>

    $(document).ready(function () {
        // Attach an event listener to the dropdown
        // loadChartData();

        $('#filter-chart').change(function () {
            const selectedChart = $('#filter-chart').val();

            if (selectedChart === "") {
                // Handle case when no chart is selected
                // You can clear the chart or show a message
            } else {
                console.log(selectedChart);
                loadChartData(selectedChart,true);
            }
        });
    });

    function loadChartData(menuName,forOneYear) {
        $.ajax({
            url: "/dashboardAdmin/getChartByMenu" + '/' + menuName+ '/' + forOneYear,
            type: "GET",
            dataType: 'json',
            success: function (data) {
                console.log();
                updateLineChart(data);
            },

            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                swal.fire("Error!", "Terjadi kesalahan saat mengambil data!", "error");
            }
        });
    }

    var myChart;

    function updateLineChart(data) {
    var ctx = document.getElementById('myChart').getContext('2d');

    // Hancurkan grafik yang ada (jika ada)
    if (myChart) {
        myChart.destroy();
    }

    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,  // Gunakan label yang dikirimkan dari backend
            datasets: [{
                label: 'Total Data',
                data: data.values,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
        });
    }


</script>

@endsection