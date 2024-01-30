@extends('admin.layouts.layout')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    @section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Grafik Sertifikasi Keseluruhan</h3>
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
    
                            {{-- <div class="col">
                                <select class="form-control" id="filter-prodi" style="border-radius: 10px;">
                                    <option value="">Pilih Prodi</option>
                                    @foreach($prodiList as $prodi)
                                        @if($prodi->status === 'Aktif')
                                            <option value="{{ $prodi->id_prodi }}">{{ $prodi->nama_prodi }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>                         --}}
                        
                            {{-- <div class="col">
                                <select class="form-control" id="filter-sertifikasi" style="border-radius: 10px;">
                                    <option value="">Pilih Sertifikasi</option>
                                </select>
                            </div> --}}
                            
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
    const labels = [];

    const data = {
        labels: 'My First Dataset',
        datasets: [{
            label: 'My First Dataset',
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
                        text: 'My First Dataset'
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

// Definisikan nilai bulan
loadChartData()


function loadChartData() {
    $.ajax({
        url: "/dashboardAdmin/totalPengajuan/",
        type: "GET",
        dataType: 'json',
        success: function (data) {
            // Initialize arrays to hold labels and values
            const labels = [];
            const values = [];

            // Define array of month names
            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            // Iterate through each object in the data array
            data.forEach(function(item) {
                // Get month name based on month number
                const monthName = monthNames[item.bulan - 1]; // Array index starts from 0

                // Push month name and total_pengajuan to their respective arrays
                labels.push(monthName);
                values.push(item.total_pengajuan);
            });

            // Update chart data with the extracted labels and values
            myChart.data.labels = labels;
            myChart.data.datasets[0].data = values;

            // Update the chart
            myChart.update();

            console.log(data);
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            swal.fire("Error!", "Terjadi kesalahan saat mengambil data!", "error");
        }
    });
}


</script>

@endsection