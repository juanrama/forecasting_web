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
            <h3>Form Layout</h3>
            <p class="text-subtitle text-muted">
              Multiple form layouts, you can use.
            </p>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav
              aria-label="breadcrumb"
              class="breadcrumb-header float-start float-lg-end"
            >
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Form Layout
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <section id="basic-horizontal-layouts">
        <div class="row match-height">
          <div class="col-md-6 col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Horizontal Form</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  <form method="post" action="/mhsregresi" class="form form-horizontal">
                    @csrf
                    <div class="form-body">
                      <div class="row">
                        <div class="col-md-4">
                          <label for="id_mhs"
                            >ID Mahasiswa</label
                          >
                        </div>
                        <div class="col-md-8 form-group">
                          <input
                            type="text"
                            id="id_mhs"
                            class="form-control @error('id_mhs') is-invalid @enderror"
                            name="id_mhs"
                            placeholder="ID Mahasiswa"
                            value="{{ old('id_mhs') }}"
                          />
                          @error('id_mhs')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="col-md-4">
                          <label for="angkatan">Angkatan</label>
                        </div>
                        <div class="col-md-8 form-group">
                          <input
                            type="number"
                            id="angkatan"
                            class="form-control @error('angkatan') is-invalid @enderror"
                            name="angkatan"
                            placeholder="Tahun Angkatan"
                            min="2017"
                            max="2019"
                            value="{{ old('angkatan') }}"
                          />
                          @error('angkatan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="col-md-4">
                          <label for="id_prodi"
                            >Prodi</label
                          >
                        </div>
                        <div class="col-md-8 form-group">
                          <input
                            type="number"
                            id="id_prodi"
                            class="form-control @error('prodi') is-invalid @enderror"
                            name="id_prodi"
                            placeholder="ID Prodi"
                            min="78"
                            max="887"
                            value="{{ old('id_prodi') }}"
                          />
                          @error('id_prodi')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                        </div>
                        <div class="col-md-4">
                        <label for="semester_1">IP Semester 1</label>
                        </div>
                        <div class="col-md-8 form-group">
                          <input
                            type="number"
                            step="0.01"
                            id="semester_1"
                            class="form-control @error('semester_1') is-invalid @enderror"
                            name="semester_1"
                            placeholder="IP Semester 1"
                            value="{{ old('semester_1') }}"
                          />
                          @error('semester_1')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                          <label for="semester_2">IP Semester 2</label>
                          </div>
                          <div class="col-md-8 form-group">
                            <input
                              type="number"
                              step="0.01"
                              id="semester_2"
                              class="form-control @error('semester_2') is-invalid @enderror"
                              name="semester_2"
                              placeholder="IP Semester 2"
                              value="{{ old('semester_2') }}"
                            />
                            @error('semester_2')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="col-md-4">
                            <label for="semester_3">IP Semester 3</label>
                            </div>
                            <div class="col-md-8 form-group">
                              <input
                                type="number"
                                step="0.01"
                                id="semester_3"
                                class="form-control @error('semester_3') is-invalid @enderror"
                                name="semester_3"
                                placeholder="IP Semester 3"
                                value="{{ old('semester_3') }}"
                              />
                              @error('semester_3')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                            </div>
                            <div class="col-md-4">
                              <label for="semester_4">IP Semester 4</label>
                              </div>
                              <div class="col-md-8 form-group">
                                <input
                                  type="number"
                                  step="0.01"
                                  id="semester_4"
                                  class="form-control @error('semester_4') is-invalid @enderror"
                                  name="semester_4"
                                  placeholder="IP Semester 4"
                                  value="{{ old('semester_4') }}"
                                />
                                @error('semester_4')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                              <div class="col-md-4">
                                <label for="semester_5">IP Semester 5</label>
                                </div>
                                <div class="col-md-8 form-group">
                                  <input
                                    type="number"
                                    step="0.01"
                                    id="semester_5"
                                    class="form-control @error('semester_5') is-invalid @enderror"
                                    name="semester_5"
                                    placeholder="IP Semester 5"
                                    value="{{ old('semester_5') }}"
                                  />
                                  @error('semester_5')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                          <button
                            type="submit"
                            class="btn btn-primary me-1 mb-1"
                          >
                            Submit
                          </button>
                          <button
                            type="reset"
                            class="btn btn-light-secondary me-1 mb-1"
                          >
                            Reset
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>
    
@endsection