@extends('layouts.index')
@section('title', 'SBI | Admin - List Barang')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Beranda</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Beranda</a></li>
                        <li class="breadcrumb-item active">Daftar Inspeksi</li>
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
                            <h4 class="card-title">Daftar Inspeksi SBI</h4>
                            <p class="card-title-desc">Daftar alat pada SBI yang sedang dalam inspeksi.</code>.
                            </p>
                        </div>

                        <div>
                            <a href="{{ route('inspektor.inspeksi.create') }}" class="btn btn-primary ">+ Inspeksi</a>
                        </div>
                    </div>


                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Kode Inspeksi</th>
                                <th>Nomor ID</th>
                                <th>Nama Inspektor</th>
                                <th>Alat</th>
                                <th>Kondisi</th>
                                <th>Kepemilikan</th>
                                <th>Periode</th>
                                <th>Progres</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($inspeksi as $item)
                                <tr>
                                    <td>{{ $item['kode_inspeksi'] }}</td>
                                    <td>{{ $item['nomor_id'] }}</td>
                                    <td>{{ $item['nama_inspektor'] }}</td>
                                    <td>{{ $item['nama_barang'] }}</td>
                                    <td>{{ $item['kondisi'] }}</td>
                                    <td>{{ $item['kepemilikan_alat'] }}</td>
                                    <td>{{ $item['periode_inspeksi'] }}</td>
                                    <td>
                                        @if ($item['selesai'])
                                            <span class="badge bg-primary bg-soft px-2 py-2 text-primary">Selesai</span>
                                        @else
                                            <span class="badge bg-warning bg-soft px-2 py-2 text-warning">Proses</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a class="btn btn-outline-primary"
                                                href="{{ route('inspektor.inspeksi.edit', $item['id']) }}"><i
                                                    class="bx bx-search-alt"></i> Lihat Detail</a>
                                            <form action="{{ route('inspektor.inspeksi.destroy', $item['id']) }}"
                                                method="post">
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

@section('script')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript" />
@endsection
