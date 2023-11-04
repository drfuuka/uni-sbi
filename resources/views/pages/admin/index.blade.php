@extends('layouts.index')
@section('title', 'SBI | Admin Dashboard')

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

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Total Alat</p>
                                            <h4 class="mb-0">{{ $total_alat }}</h4>
                                        </div>
                                        <div class="avatar-sm align-self-center mini-stat-icon rounded-circle bg-primary">
                                            <span class="avatar-title"><i class="bx bx-copy-alt font-size-24"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Tersedia</p>
                                            <h4 class="mb-0">{{ $alat_tersedia }}</h4>
                                        </div>
                                        <div class="avatar-sm align-self-center mini-stat-icon rounded-circle bg-primary">
                                            <span class="avatar-title"><i class="bx bx-copy-alt font-size-24"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Sedang Dipinjam</p>
                                            <h4 class="mb-0">{{ $sedang_dipinjam }}</h4>
                                        </div>
                                        <div class="avatar-sm align-self-center mini-stat-icon rounded-circle bg-primary">
                                            <span class="avatar-title"><i class="bx bx-copy-alt font-size-24"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Dalam Inspeksi</p>
                                            <h4 class="mb-0">{{ $dalam_inspeksi }}</h4>
                                        </div>
                                        <div class="avatar-sm align-self-center mini-stat-icon rounded-circle bg-primary">
                                            <span class="avatar-title"><i class="bx bx-copy-alt font-size-24"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
