@extends('dashboard.layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Prediksi IPK Mahasiswa</div>

                <div class="card-body">
                    <form method="POST" action="/grafik">
                        @csrf

                        <div class="form-group row">
                            <label for="id_mhs" class="col-md-4 col-form-label text-md-right">ID Mahasiswa</label>

                            <div class="col-md-6">
                                <input id="id_mhs" type="text" class="form-control @error('id_mhs') is-invalid @enderror" name="id_mhs" value="{{ old('id_mhs') }}" required autocomplete="id_mhs" autofocus>

                                @error('id_mhs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Tampilkan Grafik
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div id="chartNilai" class="card">
                </div>
            </div>
        </div>
    </div>
</div>

@section('footer')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
    Highcharts.chart('chartNilai', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monthly Average Temperature'
        },
        subtitle: {
            text: 'Source: ' +
                '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
                'target="_blank">Wikipedia.com</a>'
        },
        xAxis: {
            categories: ['Smt 1', 'Smt 2', 'Smt 3', 'Smt 4', 'Smt 5', 'Smt 6']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Reggane',
            data: {{ $nilai }}
        }, {
            name: 'Tallinn',
            data: [-2.9, -3.6, -0.6, 4.8, 10.2, 5]
        }]
    });
    </script>
    @endsection
@endsection