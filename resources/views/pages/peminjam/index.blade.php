@extends('layouts.index')
@section('title', 'SBI | Peminjaman Barang')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Beranda</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Beranda</a></li>
                        <li class="breadcrumb-item active">Beranda</li>
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

                    <h4 class="card-title">Peminjaman / Pengembalian Alat</h4>
                    <p class="card-title-desc">Lakukan peminjaman / pengembalian alat</code>.
                    </p>

                    <form method="POST" action="{{ route('peminjam.pinjam') }}" class="border-0" id="form">
                        @csrf

                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

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

                        <div id="alert"></div>

                        {{-- <div class="d-flex mt-3" onclick="$('#form').submit()">
                            <button class="btn btn-primary ms-auto" id="btn-pinjam" style="display: none">
                                Pinjam
                            </button>
                        </div> --}}

                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
                            let message
                            let alert

                            if (result.status === 'Dalam Inspeksi') {
                                message = 'Alat sedang dalam inspeksi'
                                alert = `<div class="alert alert-danger">
                                    ` + message + `
                                </div>`

                                $('#alert').html(alert)
                            }
                            if (result.status === 'Dipinjam') {
                                $.ajax({
                                    url: `pinjam`,
                                    type: 'POST',
                                    data: {
                                        barang_id: $('#barang_id').val()
                                    },
                                    success: function(result) {
                                        console.log('asd');
                                        message = 'Alat berhasil dikembalikan'
                                        alert = `<div class="alert alert-success">
                                            ` + message + `
                                        </div>`

                                        $('#alert').html(alert)

                                    }
                                })
                            }
                        } else {
                            $.ajax({
                                url: `pinjam`,
                                type: 'POST',
                                data: {
                                    barang_id: $('#barang_id').val()
                                },
                                success: function(result) {
                                    message = 'Alat berhasil dipinjam'
                                    alert = `<div class="alert alert-success">
                                    ` + message + `
                                </div>`

                                    $('#alert').html(alert)
                                }
                            })
                            // $('#btn-pinjam').show()
                            // $('#btn-pinjam').text('Pinjam Alat')
                        }
                    }

                    // $('#btn-scan').show()
                    // $('#btn-kembalikan').show()

                    $('#btn-scan-cancel').hide()
                }
            })
        }

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like
            $.ajax({
                url: `scan-barang/${decodedText}`,
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
                            let message
                            let alert

                            if (result.status === 'Dalam Inspeksi') {
                                message = 'Alat sedang dalam inspeksi'
                                alert = `<div class="alert alert-danger">
                                    ` + message + `
                                </div>`

                                $('#alert').html(alert)
                            }
                            if (result.status === 'Dipinjam') {
                                $.ajax({
                                    url: `pinjam`,
                                    type: 'POST',
                                    data: {
                                        barang_id: $('#barang_id').val()
                                    },
                                    success: function(result) {
                                        console.log('asd');
                                        message = 'Alat berhasil dikembalikan'
                                        alert = `<div class="alert alert-success">
                                            ` + message + `
                                        </div>`

                                        $('#alert').html(alert)

                                    }
                                })
                            }
                        } else {
                            $.ajax({
                                url: `pinjam`,
                                type: 'POST',
                                data: {
                                    barang_id: $('#barang_id').val()
                                },
                                success: function(result) {
                                    message = 'Alat berhasil dipinjam'
                                    alert = `<div class="alert alert-success">
                                        ` + message + `
                                    </div>`

                                    $('#alert').html(alert)
                                }
                            })
                            // $('#btn-pinjam').show()
                            // $('#btn-pinjam').text('Pinjam Alat')
                        }
                    }

                    // $('#btn-scan').show()
                    // $('#btn-kembalikan').show()

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
