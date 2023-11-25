@extends('layouts.index')
@section('title', 'SBI | Admin - Tambah Alat')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tambah Alat</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.barang.index') }}">Daftar Alat</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Tambah Alat</h4>
                    <p class="card-title-desc">Tambah data alat</code>.
                    </p>

                    <form method="POST" action="{{ route('admin.barang.store') }}" class="border-0">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-2">
                            <label for="nama_barang">Nama Alat</label>

                            <input id="nama_barang" type="text"
                                class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang"
                                autocomplete="off" placeholder="Masukkan nama alat" autofocus>

                            @error('nama_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="jenis_barang">Jenis Alat</label>
                            <select name="jenis_barang" id="jenis_barang" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Stationer">Stationer</option>
                                <option value="Portable">Portable</option>
                            </select>

                            @error('jenis_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="status_barang">Status</label>
                            <select name="status" id="status_barang" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Dipinjam">Dipinjam</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="kondisi">Kondisi</label>
                            <select name="kondisi" id="kondisi" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Sangat Buruk">Sangat Buruk</option>
                                <option value="Cukup Buruk">Cukup Buruk</option>
                                <option value="Baik">Baik</option>
                            </select>

                            @error('kondisi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="pemilik">Pemilik</label>
                            <select name="pemilik" id="pemilik" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="SBI">SBI</option>
                                <option value="Kontraktor">Kontraktor</option>
                            </select>

                            @error('pemilik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="department">Department</label>
                            <select name="department" id="department" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                @php
                                    for ($i = 1; $i <= 12; $i++) {
                                        echo '<option value="Department ' . $i . '">Department ' . $i . '</option>';
                                    }
                                @endphp
                            </select>


                            @error('department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex mt-3">
                            <button type="submit" class="btn btn-primary ms-auto">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
