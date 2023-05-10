@extends('dashboard.layouts.main')

@section('container')
<div id="main">
  <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
      <i class="bi bi-justify fs-3"></i>
    </a>
  </header>

  <div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Data IP Mahasiswa Semester 1 - 5</h3>
          <p class="text-subtitle text-muted">
            Berikut ini merupakan data index prestasi mahasiswa dari semester 1 hingga semester 5
          </p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav
            aria-label="breadcrumb"
            class="breadcrumb-header float-start float-lg-end"
          >
          </nav>
        </div>
      </div>
    </div>
    <section class="section">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('mhs_regresi_cari') }}" method="GET">
            @csrf
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="filter_angkatan">Filter Angkatan:</label>
                <select class="form-control" name="angkatan" id="filter_angkatan">
                  <option value="">- Pilih Angkatan -</option>
                  @foreach($angkatan_list as $angkatan1)
                    <option value="{{ $angkatan1 }}" @if($angkatan1 == $angkatan_selected) selected @endif>{{ $angkatan1 }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label for="filter_prodi">Filter Prodi:</label>
                <select class="form-control" name="prodi" id="filter_prodi">
                  <option value="">- Pilih Prodi -</option>
                  @foreach($prodi_list as $prodi)
                    <option value="{{ $prodi}}" @if($prodi == $prodi_selected) selected @endif>{{ $prodi }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Filter</button>
          </form>
          <table class="table table-striped" id="table1">
            <thead>
              <tr>
                <th>ID Mahasiswa</th>
                <th>Angkatan</th>
                <th>Prodi</th>
                <th>Semester 1</th>
                <th>Semester 2</th>
                <th>Semester 3</th>
                <th>Semester 4</th>
                <th>Semester 5</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($akademik as $ak)
              <tr>
                <td>{{ $ak -> id_mhs }}</td>
                <td>{{ $ak -> angkatan }}</td>
                <td>{{ $ak -> id_prodi }}</td>
                <td>{{ $ak -> semester_1 }}</td>
                <td>{{ $ak -> semester_2 }}</td>
                <td>{{ $ak -> semester_3 }}</td>
                <td>{{ $ak -> semester_4 }}</td>
                <td>{{ $ak -> semester_5 }}</td>
              </tr>
                  
              @endforeach
            </tbody>
          </table>
          {{ $akademik->links() }}
        </div>
      </div>
    </section>
        <div class="card">
          <div class="card-header">Prediksi IPK Mahasiswa</div>

          <div class="card-body">
              <form method="get" action="/mhsregresi/regpred">
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
                              Tampilkan Prediksi
                          </button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
      @if(session()->has('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
      @endif
  </div>
</div>

    
@endsection