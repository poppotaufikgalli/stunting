<div class="row g-5">
    <div class="col-8">
        <div id="mapContainer" class="m-0 rounded shadow" style="height: 80vh;"></div>
    </div>
    <div class="col-4">
        <table class="table table-sm table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Kecamatan</th>
                    <th>Kelurahan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php($L=0)
                @php($P=0)
                @php($Tot=0)
                @foreach($sebarankeckel as $key => $value)
                    <tr>
                        <td>{{$key +1}}</td>
                        <td>{{$value->kec}}</td>
                        <td>{{$value->desa_kel}}</td>
                        <td class="text-center">{{$value->jml}}</td>
                    </tr>
                    @php($L=$L+ $value->L)
                    @php($P=$P+ $value->P)
                    @php($Tot=$Tot+ $value->jml)
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-center">Total</th>
                    <th class="text-center">{{$Tot}}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const myModalEl = document.getElementById('modalDataBalita')
        const modalDataBalita = new bootstrap.Modal(myModalEl, {})

        var dataLaporan = {!! json_encode($sebarankeckel) !!};
        var petakelurahantpi = {!! json_encode($petakelurahantpi) !!};

        var nulllayer = L.tileLayer('')
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        });

        var googleRoadMap = L.tileLayer('http://mt0.google.com/vt/lyrs=m&hl=en&x={x}&y={y}&z={z} ', {
            maxZoom: 19,
            attribution: '© Google Road Map'
        });

        var baseMaps = {
            "Google RoadMap": googleRoadMap,
            "OpenStreetMap": osm,
            "No Layer": nulllayer,
        };

        var map = new L.map('mapContainer', {
            center: new L.LatLng(0.916492,104.479722),
            zoom: 13,
            //scrollWheelZoom: false,
            layers: [nulllayer]
        });

        var layerControl = L.control.layers(baseMaps, null, {position: 'topleft'}).addTo(map);


        var sebaran = []
        var kecColor = ['#D98880', '#7FB3D5', '#7DCEA0', '#F8C471']

        for (var i = 0; i < dataLaporan.length; i++) {
            if(dataLaporan[i].desa_kel == 'SEI JANG'){
                dataLaporan[i].desa_kel = "SUNGAI JANG";
            }
            var kd_wil = dataLaporan[i].desa_kel.replace(" ", "_")
            
            sebaran[kd_wil] = dataLaporan[i].jml;
        }

        function getColor(kec) {
            switch(kec){
                case "TANJUNGPINANG BARAT" :
                    return kecColor[0]
                case "TANJUNGPINANG TIMUR" :
                    return kecColor[1]
                case "TANJUNGPINANG KOTA" :
                    return kecColor[2]
                case "BUKIT BESTARI" :
                    return kecColor[3]
                default :
                    return kecColor[0]
            }
        }

        function getColor2(d) {
            return d > 1000 ? '#800026' :
                   d > 500  ? '#BD0026' :
                   d > 200  ? '#E31A1C' :
                   d > 100  ? '#FC4E2A' :
                   d > 50   ? '#FD8D3C' :
                   d > 20   ? '#FEB24C' :
                   d > 10   ? '#FED976' :
                   d > 0    ? '#ffeec2' :
                              '#FFEDA0';
        }

        function getPetaKelurahan() {
            /*let xhr = new XMLHttpRequest();
            xhr.open('GET', 'geo/petakelurahantpi.geojson');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.responseType = 'json';
            xhr.onload = function() {
                if (xhr.status !== 200) return

                
            };
            xhr.send();*/

            var odata = L.geoJSON(petakelurahantpi, {
                style: function(feature){
                    var opacity = 0.8
                    //var nsebaran = sebaran[feature.properties.kd_wil]
                    var kd_wil = feature.properties.KELURAHAN.replace(" ", "_")
                    //var nsebaran = sebaran[kd_wil]
                    var nsebaran = feature.properties.sebaran;
                    if (nsebaran === 0) {
                        opacity = 0.3
                    }
                    var kec = feature.properties.KECAMATAN;
                    return {
                        weight: 2,
                        opacity: 1,
                        //color: getColor(kec),
                        color: getColor2(nsebaran),
                        dashArray: '3',
                        fillOpacity: opacity,
                    }
                },
                onEachFeature: function (feature, layer) {
                    //var nsebaran = sebaran[feature.properties.kd_wil]
                    var kd_wil = feature.properties.KELURAHAN.replace(" ", "_")
                    //var nsebaran = sebaran[kd_wil]
                    var nsebaran = feature.properties.sebaran;

                    if (nsebaran === 0) {
                        nsebaran = 0
                    }else{
                        var label = L.marker(layer.getBounds().getCenter(), {
                          icon: L.divIcon({
                            iconSize: "auto",
                            className: 'badge bg-danger text-white p-2 border border-white',
                            html: nsebaran,
                          })
                        }).addTo(map);
                    }

                    //feature.properties.jml = nsebaran;

                    layer.bindTooltip(feature.properties.KELURAHAN);

                    layer.on({
                        mouseover: function(e){
                            info.update(layer.feature.properties);
                        },
                        mouseout: function(e){
                            info.update();
                        },
                        //click: zoomToFeature
                    });
                }
            }).addTo(map);

            odata.on('click', function(e) { 
                //var kelurahan = e.feature.properties.KELURAHAN;
                modalDataBalita.show(e.layer.feature.properties)
            });
        }

        getPetaKelurahan();

        var info = L.control();

        info.onAdd = function (map) {
            this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
            this.update();
            return this._div;
        };

        // method that we will use to update the control based on feature properties passed
        info.update = function (props) {
            this._div.innerHTML = '<h4>Data Stunting Kelurahan</h4>' +  (props ?
                '<b>' + props.KELURAHAN + ' ('+props.sebaran+')</b><br />Pendek : ' + props.pendek + '<br />Sangat Pendek : ' +props.sangat_pendek 
                : 'Tunjuk Kelurahan');
        };

        info.addTo(map);

        myModalEl.addEventListener('show.bs.modal', e => {
            var KELURAHAN = e.relatedTarget.KELURAHAN
            var KECAMATAN = e.relatedTarget.KECAMATAN

            const modalTitle = myModalEl.querySelector('.modal-title')

            modalTitle.textContent = KECAMATAN + "/" +KELURAHAN
            getData(KECAMATAN, KELURAHAN)
        })

        let table = new DataTable('#table-data-1', {
            destroy: true,
            paging: true,
            ordering: true,
            info: true,
        });

        function getData(kec, kel) {
            let table = new DataTable('#table-data-1', {
                destroy: true,
                ajax: function (d, cb) {
                    fetch('/api/getDataEppgbm/'+kec+'/'+kel)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data)
                            cb(data)
                        });
                },
                columns: [
                    { 
                        data: null,
                        render: function ( data, type, row ) {
                            var namas = (row.nama).replace((row.nama).substr(1,(row.nama).length-3), (row.nama).substr(1,(row.nama).length-3).replace(/./g,"*"));
                            if(row.jk == 'L'){
                                return namas +' <span class="badge text-bg-primary">'+ row.jk +'</span>'    
                            }else{
                                return namas +' <span class="badge text-bg-pink">'+ row.jk +'</span>'
                            }
                            
                        }
                    },
                    { data: 'posyandu' },
                    { data: 'puskesmas' },
                    { data: 'berat' },
                    { data: 'tinggi' },
                    { 
                        data: 'tb_u',
                        render: function ( data, type, row ) {
                            if(data == 'Sangat Pendek'){
                                return "<span class='badge text-bg-danger'>"+data+"</span>";    
                            }else{
                                return "<span class='badge text-bg-warning'>"+data+"</span>";
                            }
                            
                        }
                    },
                    { 
                        data: 'tgl_pengukuran',
                        render: function ( data, type, row ) {
                            var dateSplit = data.split('-');
                            return type === "display" || type === "filter" ?
                                dateSplit[1] +'-'+ dateSplit[2] +'-'+ dateSplit[0] :
                                data;
                        }
                    }
                ]
            } );
        }
    });
</script>