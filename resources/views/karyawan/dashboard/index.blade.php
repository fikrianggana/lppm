@extends('karyawan.layouts.layout')

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
                                <select class="form-control" id="filter-month" style="border-radius: 10px;">
                                    <option value="">Pilih Bulan</option>
                                    @for ($month = 1; $month <= 12; $month++) 
                                        <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                    @endfor
                                </select>                                
                            </div>
                            
                        </div>
                    </div>
                    <br>
                    <div class="col-12">
                        <div class="col">
                            <h4>Grafik Total Pengajuan</h4>
                        </div>                
                    </div>
                    <br>
                    <div class="col-12">
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
        loadChartData();

        $('#filter-month').change(function () {
            const selectedMonth = $(this).val();

            if(selectedMonth === ""){
                loadChartData();
            }else{
                loadChartData(selectedMonth);
            }
        });
    });
    const labels = [];

    const data = {
        labels: 'Jumlah Data',
        datasets: [{
            label: 'Jumlah Data LPPM',
            data: [],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Data LPPM'
                    }
                }
            }
        }
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    window.addEventListener('resize', function () {
        updateChartSize();
    });

    // Function to update chart size
    function updateChartSize() {
        myChart.resize();
    }

    // Initial call to set up the chart size
    updateChartSize();

    function loadChartData(selectedMonth) {
    $.ajax({
        url: "/dashboardKaryawan/totalPengajuan",
        type: "GET",
        dataType: 'json',
        success: function (data) {
            // Filter data for the selected month
            const filteredData = selectedMonth
                ? data.filter(function (item) {
                      return item.bulan == selectedMonth;
                  })
                : data;

            // Initialize arrays to hold labels and values
            const labels = [];
            const values = [];

            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            // Iterate through each object in the filtered data array
            filteredData.forEach(function (item) {
                // Push month name and total_pengajuan to their respective arrays
                labels.push(monthNames[item.bulan - 1]); // gunakan monthNames array untuk mendapatkan nama bulan
                values.push(item.total_pengajuan);
            });

            // Update chart data with the extracted labels and values
            myChart.data.labels = labels;
            myChart.data.datasets[0].data = values;

            // Update the chart
            myChart.update();

            console.log(filteredData);
        },

        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            swal.fire("Error!", "Terjadi kesalahan saat mengambil data!", "error");
        }
    });
}

</script>

@endsection