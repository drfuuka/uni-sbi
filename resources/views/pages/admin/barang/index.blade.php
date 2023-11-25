@extends('layouts.index')
@section('title', 'SBI | Admin - List Alat')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Beranda</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Beranda</a></li>
                        <li class="breadcrumb-item active">Daftar Alat</li>
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

                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h4 class="card-title">Daftar Alat SBI</h4>
                            <p class="card-title-desc">Daftar barang yang terdaftar pada data SBI</code>.
                            </p>
                        </div>

                        <div>
                            <a href="{{ route('admin.barang.create') }}" class="btn btn-primary ">+ Tambah Alat</a>
                        </div>
                    </div>


                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Kode Alat</th>
                                <th>Nama Alat</th>
                                <th>Jenis Alat</th>
                                <th>Status</th>
                                <th>Kondisi</th>
                                <th>Barcode</th>
                                <th>Pemilik</th>
                                <th>Department</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($barang as $item)
                                <tr>
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->jenis_barang }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->kondisi }}</td>
                                    <td style="height: 10px !important">
                                        <a href="{{ Storage::url($item->barcode) }}" download>
                                            <img class="img-fluid" alt="" src="{{ Storage::url($item->barcode) }}"
                                                width="75">
                                        </a>
                                    </td>
                                    <td>{{ $item->pemilik ? $item->pemilik : '-' }}</td>
                                    <td>{{ $item->department ? $item->department : '-' }}</td>
                                    <td style="max-width: 100px">
                                        <div class="d-flex gap-3">
                                            <a class="btn btn-outline-primary"
                                                href="{{ route('admin.barang.edit', $item->id) }}"><i
                                                    class="bx bx-search-alt"></i> Detail</a>
                                            <form action="{{ route('admin.barang.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="bx bx-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
