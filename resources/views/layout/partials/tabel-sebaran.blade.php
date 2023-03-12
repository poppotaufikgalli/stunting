<div class="row g-3 m-1 pb-2 bg-teal bg-gradient rounded">
	<div class="col d-flex justify-content-center align-items-center">
        <h3 class="h4 px-5 py-2 rounded-pill text-teal bg-light bg-gradient">Rekapitulasi Data Stunting</h3>
    </div>
	<div class="col-md-3 col-sm-12">
		<div class="card border-light h-100">
			<div class="card-body">
				<h3 class="h4 text-center">Sebaran Jenis Kelamin</h3>
				<canvas id="myChart2"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-sm-12">
		<div class="card border-light h-100">
			<div class="card-body">
				<h3 class="h4 text-center">Sebaran Tinggi Badan</h3>
				<canvas id="myChart3"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-12">
		<div class="card border-light h-100">
			<div class="card-body">
				<h3 class="h4 text-center">Balita Stunting Umur Per Tinggi Badan</h3>
				<canvas id="myChart4" ></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-sm-12">
		<div class="card h-100">
			<div class="card-body table-responsive">
				<h3 class="h4 text-center">Data Kelurahan Stunting</h3>
				<table class="table table-sm table-hover table-striped small">
					<thead class="table-dark">
						<tr>
							<th>No.</th>
							<th>Kecamatan</th>
							<th>Kelurahan</th>
							<th>Laki</th>
							<th>Perempuan</th>
							<th>Pendek</th>
							<th>Sangat Pendek</th>
						</tr>
					</thead>
					<tbody>
						@php($T1=0)
						@php($T2=0)
						@php($L=0)
                		@php($P=0)
						@php($Tot=0)
						@foreach($sebarankeckel as $key => $value)
							<tr>
								<td>{{$key +1}}</td>
								<td>{{$value->kec}}</td>
								<td>{{$value->desa_kel}}</td>
								<td class="text-center">{{$value->L}}</td>
								<td class="text-center">{{$value->P}}</td>
								<td class="text-center">{{$value->Pendek}}</td>
								<td class="text-center">{{$value->Sangat_Pendek}}</td>
							</tr>
							@php($T1=$T1+ $value->Pendek)
							@php($T2=$T2+ $value->Sangat_Pendek)
							@php($L=$L+ $value->L)
                    		@php($P=$P+ $value->P)
							@php($Tot=$Tot+ $value->jml)
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th colspan="3"></th>
							<th class="text-center">{{$L}}</th>
							<th class="text-center">{{$P}}</th>
							<th class="text-center">{{$T1}}</th>
							<th class="text-center">{{$T2}}</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function () {
		var Lk = '{{$L}}';
		var Pr = '{{$P}}';

		var T1 = '{{$T1}}';
		var T2 = '{{$T2}}';
		var Tot = '{{$Tot}}';

		var dtUmurTbu = {!! json_encode($dtUmurTbu) !!};

		Chart.defaults.font.family = "Nunito";

        chartColor = "#FFFFFF";
        chartColor2 = "#C0FF00";

		var ctx2 = document.getElementById('myChart2').getContext("2d"); 
        ctx2.width = 80;
        ctx2.height = 100;
        const ctx2Config = {
            type: 'pie',
            plugins: [ChartDataLabels],
            data: {
                labels: ["Laki-laki", "Perempuan"], 
                datasets: [{
                    label: '',
                    data: [Lk, Pr],
                     backgroundColor: [
                     	'rgba(75, 192, 192, 0.2)',
                     	'rgba(255, 99, 132, 0.2)',
                     	'rgba(255, 205, 86, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        
                        
                    ],
                    borderColor: [
                    	'rgb(75, 192, 192)',
                    	'rgb(255, 99, 132)',
                    	'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        
                    ],
                    borderWidth: 1
                }],
            },
            options: {
                responsive: true,
                plugins: {
                	labels: {
				        render: 'image',
				        images: [{
				            	src: '{{asset("img/boy.svg")}}',
				            	height: 150,
				            	width: 150
				          	},
				          	{
				            	src: '{{asset("img/girl.svg")}}',
				            	height: 150,
				            	width: 150
				          	},
				        ]
				    },
                    datalabels: {
                        formatter: function(value, context) {
                        	//console.log(context)
                        	let percentage = (value*100 / Tot).toFixed(2)+"%";
                            return context.chart.data.labels[context.dataIndex] +"\n" + value + ' (' + percentage + ')';
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


        var ctx3 = document.getElementById('myChart3').getContext("2d"); 
        ctx3.width = 80;
        ctx3.height = 100;
        const ctx3Config = {
            type: 'pie',
            plugins: [ChartDataLabels],
            data: {
                labels: ["Pendek", "Sangat Pendek"], 
                datasets: [{
                    label: '',
                    data: [T1, T2],
                     backgroundColor: [
                     	'rgba(255, 205, 86, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                     	'rgba(75, 192, 192, 0.2)',
                     	'rgba(255, 99, 132, 0.2)',
                     	
                        
                        
                    ],
                    borderColor: [
                    	'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                    	'rgb(75, 192, 192)',
                    	'rgb(255, 99, 132)',
                    	
                        
                    ],
                    borderWidth: 1
                }],
            },
            options: {
                responsive: true,
                plugins: {
					labels: {
			            render: () => {}
			        },
                    datalabels: {
                        formatter: function(value, context) {
                        	//console.log(context)
                        	let percentage = (value*100 / Tot).toFixed(2)+"%";
                            return context.chart.data.labels[context.dataIndex] +"\n" + value + ' (' + percentage + ')';
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

        var myChart3 = new Chart(ctx3, ctx3Config);

        var ctx4 = document.getElementById('myChart4').getContext("2d"); 
        ctx4.width = 80;
        ctx4.height = 100;
        const ctx4Config = {
		  	type: 'bar',
		  	plugins: [ChartDataLabels],
		  	data: {
			  	labels: dtUmurTbu.labels, 
			  	datasets: [{
			    	//axis: 'y',
			    	label: 'Pendek',
			    	data: dtUmurTbu.Pendek,
			    	fill: false,
			    	backgroundColor: [
				      'rgba(255, 99, 132, 0.5)',
				      
			    	],
			    	borderColor: [
				      'rgb(255, 99, 132)',
				      
			    	],
			    	borderWidth: 1,
			  	},{
			    	//axis: 'y',
			    	label: 'Sangat Pendek',
			    	data: dtUmurTbu.Sangat_Pendek,
			    	fill: false,
			    	backgroundColor: [
				      'rgba(255, 99, 132, 1)',
			    	],
			    	borderColor: [
				      'rgb(201, 203, 207)'
			    	],
			    	borderWidth: 1,
			  	}],
			},
			options: {
			    responsive: true,
			    scales: {
			      	x: {
			        	title: {
			          		display: true,
			          		text: 'Umur',
			        	}
			      	},
			      	y: {
			        	title: {
			          		display: true,
			          		text: 'Jumlah Balita',
			        	},
			        	max: 100,
			      	},
			    },
			    plugins:{
			    	datalabels: {
			    		anchor: 'end',
            			align: 'top',
                        formatter: function(value, context) {
                            return value;
                        },
                        font: {
                            weight: 'regular'
                        }
                    },
                    labels: {
			            render: () => {}
			        },
                    title: {
                        display: false,
                    }
			    }
			},
        }

        var myChart4 = new Chart(ctx4, ctx4Config);
    });
</script>