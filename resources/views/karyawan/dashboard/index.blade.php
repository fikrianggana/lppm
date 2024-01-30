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
                    
                        <div class="chart-container">
                            <canvas id="myChart" width="200" height="60"></canvas>
                        </div>                
                    </div>

                    <div class="col-12">
                        <div class="col">
                            <h4>Grafik Total Seminar</h4>
                        </div>                
                        <div class="chart-container">
                            <canvas id="myChartSeminar" width="200" height="60"></canvas>
                        </div>                
                    </div>

                    <div class="col-12">
                        <div class="col">
                            <h4>Grafik Total Hak Paten</h4>
                        </div>                
                        <div class="chart-container">
                            <canvas id="myChartHakPaten" width="200" height="60"></canvas>
                        </div>                
                    </div>

                    <div class="col-12">
                        <div class="col">
                            <h4>Grafik Total Prosiding</h4>
                        </div>                
                        <div class="chart-container">
                            <canvas id="myChartPro" width="200" height="60"></canvas>
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
        loadChartData(),loadGrafikseminar(), loadGrafikHakPaten(), loadGrafikProsiding();


        $('#filter-month').change(function () {
            const selectedMonth = $(this).val();

            if(selectedMonth === ""){
                loadChartData();
                loadGrafikseminar();
                loadGrafikHakPaten();
                loadGrafikProsiding();
            }else{
                loadChartData(selectedMonth);
                loadGrafikseminar(selectedMonth);
                loadGrafikHakPaten(selectedMonth);
                loadGrafikProsiding(selectedMonth);
            }
        });
    });
    const labels = [];

    const data = {
        labels: '',
        datasets: [{
            label: '',
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
                        text: ''
                    }
                }
            }
        }
    };

    var myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    var myChartSeminar = new Chart(
        document.getElementById('myChartSeminar'),
        config
    );

    var myChartHpt = new Chart(
        document.getElementById('myChartHakPaten'),
        config
    );

    var myChartPro = new Chart(
        document.getElementById('myChartPro'),
        config
    );

    window.addEventListener('resize', function () {
        updateChartSize();
    });

    // Function to update chart size
    function updateChartSize() {
        myChart.resize();
        myChartSeminar.resize();
        myChartHpt.resize();
        myChartPro.resize();
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

            // Update chart title and label
            myChart.options.scales.y.title.text = 'Jumlah Data Pengajuan'; // Update y-axis title
            myChart.data.datasets[0].label = 'Jumlah Data Pengajuan'; // Update dataset label

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


    function loadGrafikseminar(selectedMonth) {
        $.ajax({
            url: "/dashboardKaryawan/totalSeminar", // Update the URL to match your route
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
                    // Push month name and total_seminar to their respective arrays
                    labels.push(monthNames[item.bulan - 1]); // use the monthNames array to get the month name
                    values.push(item.total_seminar);
                });

                // Update chart data with the extracted labels and values
                myChartSeminar.data.labels = labels;
                myChartSeminar.data.datasets[0].data = values;

                // Update chart title and label
                myChartSeminar.options.scales.y.title.text = 'Jumlah Data Seminar'; // Update y-axis title
                myChartSeminar.data.datasets[0].label = 'Jumlah Data Seminar'; // Update dataset label
                
                // Update the chart
                myChartSeminar.update();

                console.log(filteredData);
            },

            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                swal.fire("Error!", "Terjadi kesalahan saat mengambil data!", "error");
            }
        });
    }

    
    function loadGrafikHakPaten(selectedMonth) {
        $.ajax({
            url: "/dashboardKaryawan/totalHakPaten", // Update the URL to match your route
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
                    // Push month name and total_seminar to their respective arrays
                    labels.push(monthNames[item.bulan - 1]); // use the monthNames array to get the month name
                    values.push(item.total_hakpaten);
                });

                // Update chart data with the extracted labels and values
                myChartHpt.data.labels = labels;
                myChartHpt.data.datasets[0].data = values;

                // Update chart title and label
                myChartHpt.options.scales.y.title.text = 'Jumlah Data Hak Paten'; // Update y-axis title
                myChartHpt.data.datasets[0].label = 'Jumlah Data Hak Paten'; // Update dataset label

                // Update the chart
                myChartHpt.update();

                console.log(filteredData);
            },

            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                swal.fire("Error!", "Terjadi kesalahan saat mengambil data!", "error");
            }
        });
    }

    
    function loadGrafikProsiding(selectedMonth) {
        $.ajax({
            url: "/dashboardKaryawan/totalProsiding", // Update the URL to match your route
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
                    // Push month name and total_seminar to their respective arrays
                    labels.push(monthNames[item.bulan - 1]); // use the monthNames array to get the month name
                    values.push(item.total_prosiding);
                });

                // Update chart data with the extracted labels and values
                myChartPro.data.labels = labels;
                myChartPro.data.datasets[0].data = values;

                // Update chart title and label
                myChartPro.options.scales.y.title.text = 'Jumlah Data Prosiding'; // Update y-axis title
                myChartPro.data.datasets[0].label = 'Jumlah Data Prosiding'; // Update dataset label


                // Update the chart
                myChartPro.update();

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