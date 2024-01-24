@extends('layout.template')
@section('content')

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <a href='{{url('mahasiswa/create')}}' class="btn btn-primary">+ Tambah Data</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">NIM</th>
                        <th class="col-md-4">Nama</th>
                        <th class="col-md-2">Jurusan</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $data->firstItem() ?>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$item->nim}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->jurusan}}</td>
                        <td>
                            <a href='{{url('mahasiswa/'.$item->nim.'/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                            <a href='' class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
        <!-- AKHIR DATA -->

@endsection
