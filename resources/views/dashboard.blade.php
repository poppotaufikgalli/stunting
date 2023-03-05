@extends('layout.master')

@section('title', "Dashboard :: Pelayanan Terpadu")

@section('content')
    <div class="container-fluid pt-3">
        <div class="panel-header">
            <!--<div id="chart"></div>-->
            <canvas id="myChart1"></canvas>
        </div>
    </div>
    <div class="container-fluid pt-3">
        <div class="row row-cols-1 row-cols-md-4 g-2">
            <div class="col ps-3">
                <div class="card card-panel-1 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 position-relative">
                                <div class="position-absolute top-0 start-50 translate-middle">
                                    <div class="card card-body shadow-sm">
                                        <h2>
                                            <i class="bi bi-123"></i>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="ms-5">
                                This is some content from a media component. You can replace this with any content and adjust it as needed.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col ps-3">
                <div class="card card-panel-1 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 position-relative">
                                <div class="position-absolute top-0 start-50 translate-middle">
                                    <div class="card card-body shadow-sm">
                                        <h2>
                                            <i class="bi bi-123"></i>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="ms-5">
                                This is some content from a media component. You can replace this with any content and adjust it as needed.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-panel-1 shadow">
                    <div class="card-body">
                        &nbsp;
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-panel-1 shadow">
                    <div class="card-body">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-3">
        <div class="row row-cols-1 row-cols-md-2 g-2">
            <div class="col">
                <div class="card h-100 shadow">
                    <div class="card-header text-center">
                        <h4 class="card-category">Sektor Pembangunan</h4>
                        <h5 class="card-title">Data Per...</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <canvas id="myChart2"></canvas>
                            </div>
                            <div class="col-12">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Sektor Primer</th>
                                            <th>Sektor Sekunder</th>
                                            <th>Sektor Tersier</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>% of Total Nilai Inv. Mata Uang along Sektor Utama</td>
                                            <td>8,4%</td>
                                            <td>53,1%</td>
                                            <td>38,5%</td>
                                        </tr>
                                        <tr>
                                            <td>% of Total Nilai Investasi (Dalam Rp. T) along Sektor Utama</td>
                                            <td>8,4%</td>
                                            <td>53,1%</td>
                                            <td>38,5%</td>
                                        </tr>
                                        <tr>
                                            <td>Nilai Inv. Mata Uang</td>
                                            <td>3.175.005</td>
                                            <td>20.095.846</td>
                                            <td>14.558.460</td>
                                        </tr>
                                        <tr>
                                            <td>TKI</td>
                                            <td>1.437</td>
                                            <td>62.671</td>
                                            <td>24.888</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow">
                    <div class="card-header text-center">
                        <h4 class="card-category">PMA vs PMDN Status</h4>
                        <h5 class="card-title">Data Per...</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        window.onload = function () {
            var sum_investasi = {{ $sum_investasi }};
            var sum_tki = {{ $sum_tki }};
            var sum_investasi_status_pm = {!! json_encode($sum_investasi_status_pm) !!};
            var sum_tki_status_pm = {!! json_encode($sum_tki_status_pm) !!};


            Chart.defaults.font.family = "Nunito";

            chartColor = "#FFFFFF";
            chartColor2 = "#C0FF00";

            var ctx = document.getElementById('myChart1').getContext("2d"); 
            var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
            
            gradientStroke.addColorStop(0, '#80b6f4');
            gradientStroke.addColorStop(1, chartColor); 
            var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
            gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
            gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)"); 

            var myChart = new Chart(ctx, { 
                type: 'line', 
                data: { 
                    labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"], 
                    datasets: [{ 
                        label: 'Nilai Inv. Mata Uang',
                        borderColor: chartColor, 
                        pointBorderColor: chartColor, 
                        pointBackgroundColor: "#1e3d60", 
                        pointHoverBackgroundColor: "#1e3d60", 
                        pointHoverBorderColor: chartColor, 
                        pointBorderWidth: 1, 
                        pointHoverRadius: 7, 
                        pointHoverBorderWidth: 2, 
                        pointRadius: 5, 
                        fill: true, 
                        backgroundColor: gradientFill, 
                        borderWidth: 2, 
                        data: [sum_investasi],
                        tension: 0.3,
                    },{
                        label: 'TKI',
                        borderColor: chartColor2, 
                        pointBorderColor: chartColor2, 
                        pointHoverBorderColor: chartColor2, 
                        pointBorderWidth: 1, 
                        pointRadius: 5, 
                        pointHoverRadius: 7, 
                        borderWidth: 2, 
                        data: [sum_tki],
                        tension: 0.3,
                    }
                    ] 
                }, 
                options: { 
                    layout: { 
                        padding: { 
                            left: 20, 
                            right: 20, 
                            top: 0, 
                            bottom: 0 
                        } 
                    }, 
                    plugins:{
                        legend:{
                            display: true,
                            position: 'bottom',
                        }
                    },
                    maintainAspectRatio: false, 
                    tooltips: { 
                        backgroundColor: '#fff', 
                        titleFontColor: '#333', 
                        bodyFontColor: '#666', 
                        bodySpacing: 4, 
                        xPadding: 12, 
                        mode: "nearest", 
                        intersect: 0, 
                        position: "nearest" 
                    }, 
                    scales: { 
                        x:{
                            grid:{
                                display: false,   
                            },
                            
                        },
                        y:{
                            grid:{
                                color: 'rgba(0,255,0,0.1)',
                                drawOnChartArea: true,
                                drawTicks: true,
                            },
                            
                        },
                    } 
                }
            }); 
            
            var ctx2 = document.getElementById('myChart2').getContext("2d"); 
            ctx.width = 100;
            ctx.height = 100;
            const ctx2Config = {
                type: 'doughnut',
                plugins: [ChartDataLabels],
                data: {
                    labels: ["Sektor Primer", "Sektor Sekunder", "Sektor Tersier"], 
                    datasets: [{
                        label: 'Sektor-sektor',
                        data: [3175004, 20095845, 14558460],
                         backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)'
                        ],
                        borderWidth: 1
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        datalabels: {
                            formatter: function(value, context) {
                                console.log(context)
                                return context.dataset.label +"\n" + (Math.round(value)).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                });
                            },
                            font: {
                                weight: 'bold'
                            }
                        },
                        legend: {
                            display: false,
                        },
                        title: {
                            display: false,
                        }
                    }
                }
            };

            var myChart2 = new Chart(ctx2, ctx2Config);

            //bar chart
            var e = document.getElementById("myChart3").getContext("2d");
            gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
            gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
            gradientFill.addColorStop(1, "rgb(44, 168, 255, 0.6)"); 
            var a = { 
                plugins: [ChartDataLabels],
                type: "bar", 
                data: { 
                    labels: ["PMA", "PMDN"], 
                    datasets: [{ 
                        label: "Nilai Inv. Mata Uang", 
                        backgroundColor: gradientFill, 
                        borderColor: "#2CA8FF", 
                        pointBorderColor: "#FFF", 
                        pointBackgroundColor: "#2CA8FF", 
                        pointBorderWidth: 2, 
                        pointHoverRadius: 4, 
                        pointHoverBorderWidth: 1, 
                        pointRadius: 4, 
                        fill: true, 
                        borderWidth: 1, 
                        data: [sum_investasi_status_pm["PMA"], sum_investasi_status_pm["PMDN"]] 
                    }] 
                }, 
                options: { 
                    maintainAspectRatio: false, 
                    legend: { 
                        display: false 
                    }, 
                    plugins:{
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            formatter: function(value, context) {
                                console.log(context.dataset.label)
                                return context.dataset.label +"\n" + (Math.round(value)).toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR',
                                });
                            },
                            font: {
                                weight: 'bold'
                            }
                        },
                    },
                    tooltips: { bodySpacing: 4, mode: "nearest", intersect: 0, position: "nearest", xPadding: 10, yPadding: 10, caretPadding: 10 }, 
                    responsive: 1, 
                    scales: { 
                        yAxes: [{ 
                            gridLines: 0, gridLines: { zeroLineColor: "transparent", drawBorder: false } 
                        }], 
                        xAxes: [{ 
                            display: 0, gridLines: 0, ticks: { display: false }, gridLines: { 
                                zeroLineColor: "transparent", 
                                drawTicks: false, 
                                display: false, 
                                drawBorder: false 
                            } 
                        }] 
                    }, 
                    layout: { 
                        padding: { 
                            left: 0, 
                            right: 0, 
                            top: 15, 
                            bottom: 15 
                        } 
                    } 
                } 
            }; 
            var viewsChart = new Chart(e, a);
        }
    </script>
@stop