@extends('layouts.index')
@section('title', 'SBI | Admin - Detail Inspeksi ' . $inspeksi['nama_barang'])

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
                <h4 class="mb-sm-0 font-size-18">Detail Inspeksi</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inspektor.inspeksi.index') }}">Daftar Inspeksi</a></li>
                        <li class="breadcrumb-item active">Ubah</li>
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

                    <h4 class="card-title">Detail Inspeksi</h4>
                    <p class="card-title-desc">Lihat detail data inspeksi</code>.
                    </p>

                    <form method="POST" action="{{ route('inspektor.inspeksi.update', $inspeksi->id) }}" class="border-0"
                        id="form">
                        @csrf
                        @method('PUT')

                        <input type="hidden" class="form-control mb-3" name="barang_id" id="barang_id"
                            value="{{ $inspeksi->barang_id }}">

                        <div class="card border shadow-sm rounded-md p-3" id="detail-barang">
                            <h4 class="mb-3">Alat Dalam Inspeksi</h4>
                            <label>Kode Alat</label>
                            <input type="text" class="form-control mb-3" disabled
                                value={{ $inspeksi->barang->kode_barang }}>
                            <label>Nama Alat</label>
                            <input type="text" class="form-control mb-3" disabled
                                value={{ $inspeksi->barang->nama_barang }}>
                            <label>Jenis Alat</label>
                            <input type="text" class="form-control mb-3" disabled
                                value={{ $inspeksi->barang->jenis_barang }} id='jenis-barang'>
                            <label>Status</label>
                            <input type="text" class="form-control mb-3" disabled value={{ $inspeksi->barang->status }}>
                            <label>Kondisi</label>
                            <input type="text" class="form-control mb-3" disabled value={{ $inspeksi->barang->kondisi }}>
                        </div>

                        <div id="onscan">

                            <div class="mb-3">
                                <label for="nomor_id">Nomor ID <span class="text-danger">*</span></label>

                                <input id="nomor_id" type="text"
                                    class="form-control @error('nomor_id') is-invalid @enderror" name="nomor_id"
                                    autocomplete="off" placeholder="Masukkan nomor ID" autofocus
                                    value="{{ $inspeksi->nomor_id }}">

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
                                    <option value="MOHAMAD NASUHI"
                                        {{ $inspeksi->inspektor_sbi_area === 'MOHAMAD NASUHI' ? 'selected' : '' }}>MOHAMAD
                                        NASUHI</option>
                                    <option value="MUHAMMAD FAHRURROZY ARDIANSYAH"
                                        {{ $inspeksi->inspektor_sbi_area === 'MUHAMMAD FAHRURROZY ARDIANSYAH' ? 'selected' : '' }}>
                                        MUHAMMAD FAHRURROZY ARDIANSYAH</option>
                                    <option value="DWI KURNIANTO"
                                        {{ $inspeksi->inspektor_sbi_area === 'DWI KURNIANTO' ? 'selected' : '' }}>DWI
                                        KURNIANTO</option>
                                    <option value="SARING"
                                        {{ $inspeksi->inspektor_sbi_area === 'SARING' ? 'selected' : '' }}>SARING</option>
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
                                    <option value="SBI" {{ $inspeksi->kepemilikan_alat === 'SBI' ? 'selected' : '' }}>
                                        SBI</option>
                                    <option value="Kontraktor"
                                        {{ $inspeksi->kepemilikan_alat === 'Kontraktor' ? 'selected' : '' }}>Kontraktor
                                    </option>
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
                                    <option value="mohammad.nasuhi@sig.id"
                                        {{ $inspeksi->email_eht === 'mohammad.nasuhi@sig.id' ? 'selected' : '' }}>
                                        mohammad.nasuhi@sig.id</option>
                                    <option value="d.kurnianto@sig.id"
                                        {{ $inspeksi->email_eht === 'd.kurnianto@sig.id' ? 'selected' : '' }}>
                                        d.kurnianto@sig.id</option>
                                    <option value="d.kurnianto@sig.id"
                                        {{ $inspeksi->email_eht === 'd.kurnianto@sig.id' ? 'selected' : '' }}>
                                        d.kurnianto@sig.id</option>
                                    <option value="saring.1084@sig.id"
                                        {{ $inspeksi->email_eht === 'saring.1084@sig.id' ? 'selected' : '' }}>
                                        saring.1084@sig.id</option>
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
                                    placeholder="Masukkan nama perusahaan kontraktor" autofocus
                                    value="{{ $inspeksi->nama_perusahaan_kontraktor }}">

                                @error('nama_perusahaan_kontraktor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="jenis_barang_portable">
                                <div class="mb-3">
                                    <label for="periode_inspeksi">Periode Inspeksi <span
                                            class="text-danger">*</span></label>

                                    <div class="alert alert-info">
                                        Keterangan: <br>
                                        Tag Inspeksi Warna Merah untuk Q 1 (Januari-Maret)<br>
                                        Tag Inspeksi Warna Hijau untuk Q 2 (April-Juni)<br>
                                        Tag Inspeksi Warna Biru untuk Q 3 (Juli-September)<br>
                                        Tag Inspeksi Warna Kuning untuk Q 4 (Oktober-Desember)
                                    </div>

                                    <select name="periode_inspeksi" id="periode_inspeksi" class="form-control">
                                        <option value="Q1"
                                            {{ $inspeksi->periode_inspeksi === 'Q1' ? 'selected' : '' }}>Q1 (Januari -
                                            Maret)</option>
                                        <option value="Q2"
                                            {{ $inspeksi->periode_inspeksi === 'Q2' ? 'selected' : '' }}>Q2 (April - Juni)
                                        </option>
                                        <option value="Q3"
                                            {{ $inspeksi->periode_inspeksi === 'Q3' ? 'selected' : '' }}>Q3 (Juli -
                                            September)</option>
                                        <option value="Q4"
                                            {{ $inspeksi->periode_inspeksi === 'Q4' ? 'selected' : '' }}>Q4 (Oktober -
                                            Desember)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="jenis_barang_stationer">
                                <div class="mb-3">
                                    <label for="periode_inspeksi">Periode Inspeksi <span
                                            class="text-danger">*</span></label>

                                    <div class="alert alert-info">
                                        Keterangan: <br>
                                        Tag Inspeksi Warna Orange untuk Semester 1 (Januari-Juni) <br>
                                        Tag Inspeksi Warna Putih untuk Semester 2 (Juli-Desember)
                                    </div>

                                    <select name="periode_inspeksi" id="periode_inspeksi" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="Semester 1"
                                            {{ $inspeksi->periode_inspeksi === 'Semester 1' ? 'selected' : '' }}>Semester 1
                                        </option>
                                        <option value="Semester 2"
                                            {{ $inspeksi->periode_inspeksi === 'Semester 2' ? 'selected' : '' }}>Semester 2
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="nomor_register">Nomor Register <span class="text-danger">*</span></label>

                                <input id="nomor_register" type="text"
                                    class="form-control @error('nomor_register') is-invalid @enderror"
                                    name="nomor_register" autocomplete="off" placeholder="Masukkan nomor register alat"
                                    autofocus required value="{{ $inspeksi->nomor_register }}">

                                @error('periode_inspeksi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="kondisi">Kondisi</label>
                                <select name="kondisi" id="kondisi" class="form-control">
                                    <option value="Sangat Buruk"
                                        {{ $inspeksi->kondisi === 'Sangat Buruk' ? 'selected' : '' }}>
                                        Sangat
                                        Buruk</option>
                                    <option value="Cukup Buruk"
                                        {{ $inspeksi->kondisi === 'Cukup Buruk' ? 'selected' : '' }}>
                                        Cukup
                                        Buruk</option>
                                    <option value="Baik" {{ $inspeksi->kondisi === 'Baik' ? 'selected' : '' }}>Baik
                                    </option>
                                </select>

                                @error('kondisi')
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
                                    <option value="Ya" {{ $inspeksi->syarat_inspeksi === 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak" {{ $inspeksi->syarat_inspeksi === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>

                                @error('syarat_inspeksi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="selesai">Selesaikan Inspeksi? <span class="text-danger">*</span></label>

                                <select name="selesai" id="selesai" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Ya" {{ $inspeksi->selesai === 'Ya' ? 'selected' : '' }}>Ya
                                    </option>
                                    <option value="Tidak" {{ $inspeksi->selesai === 'Tidak' ? 'selected' : '' }}>
                                        Tidak</option>
                                </select>

                                @error('selesai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="d-flex mt-3" onclick="$('#form').submit()">
                            <button class="btn btn-primary ms-auto">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('scripts')
    <script>
        function testScan() {
            $.ajax({
                url: `scan-barang/BRGA004`,
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

        $(document).ready(function() {

            if ($('#jenis-barang').val() === 'Stationer') {
                $('.jenis_barang_stationer').empty()
            }

            if ($('#jenis-barang').val() === 'Portable') {
                $('.jenis_barang_portable').empty()
            }

            if ($('#kepemilikan_alat').val() === 'Kontraktor') {
                $('.kepemilikan_alat_eht').show()
            }

            $('#kepemilikan_alat').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'Kontraktor') {
                    $('.kepemilikan_alat_eht').show()
                }
            });

        })
    </script>
@endsection
