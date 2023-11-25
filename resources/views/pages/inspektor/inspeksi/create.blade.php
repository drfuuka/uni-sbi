@extends('layouts.index')
@section('title', 'SBI | Admin - Tambah Alat')

@section('content')
    <style>
        .kepemilikan_alat_eht {
            display: none
        }
    </style>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Lakukan Inspeksi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inspektor.inspeksi.index') }}">Daftar Inspeksi</a></li>
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

                    <h4 class="card-title">Tambah Inspeksi</h4>
                    <p class="card-title-desc">Lakukan inspeksi alat</code>.
                    </p>

                    <form method="POST" action="{{ route('inspektor.inspeksi.store') }}" class="border-0" id="form">
                        @csrf

                        <input type="hidden" class="form-control mb-3" name="barang_id" id="barang_id">
                        <div class="alert alert-info">
                            Kamu bisa memakai fitur scan untuk scan barcode alat
                        </div>

                        <div class="d-flex gap-3 justify-content-center mb-3">
                            <button class="btn btn-light" id="btn-scan-cancel" style="display: none">Batal</button>
                            <button class="btn btn-primary" id="btn-scan">Scan Alat</button>
                            {{-- <button class="btn btn-primary" id="btn-test-scan">Test Scan</button> --}}
                        </div>


                        <div id="reader" width="600px" class="mb-3"></div>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div id="alert"></div>

                        <div id="onscan" style="display: none">

                            <div class="mb-3">
                                <label for="nomor_id">Nomor ID <span class="text-danger">*</span></label>

                                <input id="nomor_id" type="text"
                                    class="form-control @error('nomor_id') is-invalid @enderror" name="nomor_id"
                                    autocomplete="off" placeholder="Masukkan nomor ID" autofocus>

                                @error('nomor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="inspektor_sbi_area">Inspektor SBI Area <span
                                        class="text-danger">*</span></label>

                                <select name="inspektor_sbi_area" id="inspektor_sbi_area" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="Muhammad sigit">Muhammad sigit</option>
                                    <option value="Andri Suroso">Andri Suroso</option>
                                    <option value="Syaifur Rahman">Syaifur Rahman</option>
                                    <option value="Pangki Parnomo">Pangki Parnomo</option>
                                    <option value="Wasito">Wasito</option>
                                    <option value="Frediyanto">Frediyanto</option>
                                    <option value="Anton Nurcahyo">Anton Nurcahyo</option>
                                    <option value="Budiman H.P">Budiman H.P</option>
                                    <option value="Bayulianto">Bayulianto</option>
                                    <option value="Rojikin">Rojikin</option>
                                    <option value="Sofyantinanto">Sofyantinanto</option>
                                </select>

                                @error('inspektor_sbi_area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kepemilikan_alat">Kepemilikan Alat <span class="text-danger">*</span></label>

                                <select name="kepemilikan_alat" id="kepemilikan_alat" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="SBI">SBI</option>
                                    <option value="Kontraktor">Kontraktor</option>
                                </select>

                                @error('kepemilikan_alat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-2 kepemilikan_alat_eht">
                                <label for="email_eht">Alamat Email Pemilik EHT <span class="text-danger">*</span></label>

                                <select name="email_eht" id="email_eht" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="mohammad.nasuhi@sig.id">mohammad.nasuhi@sig.id</option>
                                    <option value="d.kurnianto@sig.id">d.kurnianto@sig.id</option>
                                    <option value="d.kurnianto@sig.id">d.kurnianto@sig.id</option>
                                    <option value="saring.1084@sig.id">saring.1084@sig.id</option>
                                    <option value="Other">Other</option>
                                </select>

                                @error('email_eht')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-2 kepemilikan_alat_eht">
                                <label for="nama_perusahaan_kontraktor">Nama Perusahaan Kontraktor <span
                                        class="text-danger">*</span></label>

                                <input id="nama_perusahaan_kontraktor" type="text"
                                    class="form-control @error('nama_perusahaan_kontraktor') is-invalid @enderror"
                                    name="nama_perusahaan_kontraktor" autocomplete="off"
                                    placeholder="Masukkan nama perusahaan kontraktor" autofocus>

                                @error('nama_perusahaan_kontraktor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="jenis_barang_portable">
                            </div>

                            <div class="jenis_barang_stationer">
                            </div>

                            <div class="mb-3">
                                <label for="nomor_register">Nomor Register <span class="text-danger">*</span></label>

                                <input id="nomor_register" type="text"
                                    class="form-control @error('nomor_register') is-invalid @enderror"
                                    name="nomor_register" autocomplete="off" placeholder="Masukkan nomor register alat"
                                    autofocus required>

                                @error('periode_inspeksi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="syarat_inspeksi">Apakah persyaratan pemeriksaan sudah benar? <span
                                        class="text-danger">*</span></label>

                                <select name="syarat_inspeksi" id="syarat_inspeksi" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>

                                @error('syarat_inspeksi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex mt-3" onclick="$('#form').submit()">
                                <button class="btn btn-primary ms-auto">
                                    Simpan
                                </button>
                            </div>


                        </div>

                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        function testScan() {
            $.ajax({
                url: `scan-barang/BRGA003`,
                success: function(result) {

                    $('#alert').empty()
                    if ($('#detail-barang').length) {
                        $('#detail-barang').remove()
                    }

                    if (result.nama_barang) {
                        var cardHtml = `<div class="card border shadow-sm rounded-md p-3" id="detail-barang">
                            <h4 class="mb-3">Alat Terdeteksi</h4>
                            <label>Kode Alat</label>
                            <input type="text" class="form-control mb-3" disabled id="kode_barang">
                            <label>Nama Alat</label>
                            <input type="text" class="form-control mb-3" disabled id="nama_barang">
                            <label>Jenis Alat</label>
                            <input type="text" class="form-control mb-3" disabled id="jenis_barang">
                            <label>Status</label>
                            <input type="text" class="form-control mb-3" disabled id="status_barang">
                            <label>Kondisi</label>
                            <input type="text" class="form-control mb-3" disabled id="kondisi_barang">
                        </div>`

                        $('#reader').after(cardHtml)

                        $('#barang_id').val(result.id)
                        $('#kode_barang').val(result.kode_barang)
                        $('#nama_barang').val(result.nama_barang)
                        $('#jenis_barang').val(result.jenis_barang)
                        $('#status_barang').val(result.status)
                        $('#kondisi_barang').val(result.kondisi)

                        if (result.status !== 'Tersedia') {
                            $('#onscan').hide()
                            let message

                            if (result.status === 'Dalam Inspeksi') {
                                message = 'Alat sedang dalam inspeksi'
                            }
                            if (result.status === 'Dipinjam') {
                                message = 'Alat sedang dalam peminjaman'
                            }

                            var alert = `<div class="alert alert-danger">
                                ` + message + `
                            </div>`

                            $('#alert').html(alert)

                        } else {
                            $('#onscan').slideDown()

                            var portableHTML = `<div class="mb-3">
                                <label for="periode_inspeksi">Periode Inspeksi <span class="text-danger">*</span></label>
        
                                <div class="alert alert-info">
                                    Keterangan: <br>
                                    Tag Inspeksi Warna Merah untuk Q 1 (Januari-Maret)<br>
                                    Tag Inspeksi Warna Hijau untuk Q 2 (April-Juni)<br>
                                    Tag Inspeksi Warna Biru untuk Q 3 (Juli-September)<br>
                                    Tag Inspeksi Warna Kuning untuk Q 4 (Oktober-Desember)
                                </div>
        
                                <select name="periode_inspeksi" id="periode_inspeksi" class="form-control">
                                    <option value="Q1">Q1 (Januari - Maret)</option>
                                    <option value="Q2">Q2 (April - Juni)</option>
                                    <option value="Q3">Q3 (Juli - September)</option>
                                    <option value="Q4">Q4 (Oktober - Desember)</option>
                                </select>
                            </div>`;

                            var stationerHTML = `<div class="mb-3">
                                <label for="periode_inspeksi">Periode Inspeksi <span class="text-danger">*</span></label>
        
                                <div class="alert alert-info">
                                    Keterangan: <br>
                                    Tag Inspeksi Warna Orange untuk Semester 1 (Januari-Juni) <br>
                                    Tag Inspeksi Warna Putih untuk Semester 2 (Juli-Desember)
                                </div>
        
                                <select name="periode_inspeksi" id="periode_inspeksi" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="Semester 1">Semester 1</option>
                                    <option value="Semester 2">Semester 2</option>
                                </select>
                            </div>`

                            if (result.jenis_barang === 'Stationer') {
                                $('.jenis_barang_portable').html(stationerHTML)
                                $('.jenis_barang_stationer').empty()
                            }

                            if (result.jenis_barang === 'Portable') {
                                $('.jenis_barang_stationer').html(portableHTML)
                                $('.jenis_barang_portable').empty()
                            }
                        }
                    }

                    $('#btn-scan').show()
                    $('#btn-scan-cancel').hide()
                }
            })
        }

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like
            $.ajax({
                url: `scan-barang/${decodedText}`,
                success: function(result) {
                    if (result.status === 'Dalam Inspeksi') {
                        let message
                        if (result.status === 'Dalam Inspeksi') {
                            message = 'Alat sedang dalam inspeksi'
                        }
                        if (result.status === 'Dipinjam') {
                            message = 'Alat sedang dalam peminjaman'
                        }
                        var alert = `<div class="alert alert-danger">
                            ` + message + `
                        </div>`
                        $('#alert').html(alert)

                    } else {
                        $('#alert').empty()
                        if ($('#detail-barang').length) {
                            $('#detail-barang').remove()
                        }

                        if (result.nama_barang) {
                            var cardHtml = `<div class="card border shadow-sm rounded-md p-3" id="detail-barang">
                                <h4 class="mb-3">Alat Terdeteksi</h4>
                                <label>Kode Alat</label>
                                <input type="text" class="form-control mb-3" disabled id="kode_barang">
                                <label>Nama Alat</label>
                                <input type="text" class="form-control mb-3" disabled id="nama_barang">
                                <label>Jenis Alat</label>
                                <input type="text" class="form-control mb-3" disabled id="jenis_barang">
                                <label>Status</label>
                                <input type="text" class="form-control mb-3" disabled id="status_barang">
                                <label>Kondisi</label>
                                <input type="text" class="form-control mb-3" disabled id="kondisi_barang">
                            </div>`

                            $('#reader').after(cardHtml)

                            $('#barang_id').val(result.id)
                            $('#kode_barang').val(result.kode_barang)
                            $('#nama_barang').val(result.nama_barang)
                            $('#jenis_barang').val(result.jenis_barang)
                            $('#status_barang').val(result.status)
                            $('#kondisi_barang').val(result.kondisi)

                            $('#onscan').slideDown()

                            var portableHTML = `<div class="mb-3">
                                <label for="periode_inspeksi">Periode Inspeksi <span class="text-danger">*</span></label>
        
                                <div class="alert alert-info">
                                    Keterangan: <br>
                                    Tag Inspeksi Warna Merah untuk Q 1 (Januari-Maret)<br>
                                    Tag Inspeksi Warna Hijau untuk Q 2 (April-Juni)<br>
                                    Tag Inspeksi Warna Biru untuk Q 3 (Juli-September)<br>
                                    Tag Inspeksi Warna Kuning untuk Q 4 (Oktober-Desember)
                                </div>
        
                                <select name="periode_inspeksi" id="periode_inspeksi" class="form-control">
                                    <option value="Q1">Q1 (Januari - Maret)</option>
                                    <option value="Q2">Q2 (April - Juni)</option>
                                    <option value="Q3">Q3 (Juli - September)</option>
                                    <option value="Q4">Q4 (Oktober - Desember)</option>
                                </select>
                            </div>`;

                            var stationerHTML = `<div class="mb-3">
                                <label for="periode_inspeksi">Periode Inspeksi <span class="text-danger">*</span></label>
        
                                <div class="alert alert-info">
                                    Keterangan: <br>
                                    Tag Inspeksi Warna Orange untuk Semester 1 (Januari-Juni) <br>
                                    Tag Inspeksi Warna Putih untuk Semester 2 (Juli-Desember)
                                </div>
        
                                <select name="periode_inspeksi" id="periode_inspeksi" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="Semester 1">Semester 1</option>
                                    <option value="Semester 2">Semester 2</option>
                                </select>
                            </div>`

                            if (result.jenis_barang === 'Stationer') {
                                $('.jenis_barang_portable').html(stationerHTML)
                                $('.jenis_barang_stationer').empty()
                            }

                            if (result.jenis_barang === 'Portable') {
                                $('.jenis_barang_stationer').html(portableHTML)
                                $('.jenis_barang_portable').empty()
                            }

                        } else {
                            alert('something wrong')
                        }
                    }

                    html5QrcodeScanner.clear()
                    $('#btn-scan').show()
                    $('#btn-scan-cancel').hide()

                }
            });

        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 30,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);

        $(document).ready(function() {
            $('#btn-scan-cancel').hide()
            $('#btn-scan').show()

            $('#btn-test-scan').click(function(e) {
                e.preventDefault();
                testScan()
            })

            $('#btn-scan').click(function(e) {
                e.preventDefault();
                html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                $('#btn-scan-cancel').show()
                $('#btn-scan').hide()
            })

            $('#btn-scan-cancel').click(function(e) {
                e.preventDefault();
                html5QrcodeScanner.clear()
                $('#btn-scan').show()
                $('#btn-scan-cancel').hide()
            })

            $('#kepemilikan_alat').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'Kontraktor') {
                    $('.kepemilikan_alat_eht').show()
                }
            });

        })
    </script>
@endsection
