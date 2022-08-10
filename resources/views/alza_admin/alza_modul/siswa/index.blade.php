@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}
                    @can('siswa-create')
                        <a class="btn btn-success btn-sm float-right"
                            href="{{ route(config('pathadmin.admin_prefix') . 'siswas.create') }}"> Tambah
                            Baru</a>
                    @endcan
                </h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="float-right mb-1">
                        <form action="" method="get">
                            <input type="search" name="keyword" class="form-control" placeholder="Pencarian..."
                                value="{!! !empty(Request::get('keyword')) ? Request::get('keyword') : '' !!}">
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="20">No</th>
                                    <th>Foto</th>
                                    <th>Nis</th>
                                    <th>Nama</th>

                                    <th width="280" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $key => $siswa)
                                    <tr>
                                        <td>
                                            <center>{{ $key + 1 + $valuepage }}</center>
                                        </td>
                                        <td><img class="img-thumbnail" src="{{ url('/storage/upload/' . $siswa->foto) }}"
                                                alt="{{ $siswa->nama }}" width="100"></td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>{{ $siswa->nama }}</td>

                                        <td>
                                            <center>
                                                @can('siswa-edit')
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route(config('pathadmin.admin_prefix') . 'siswas.edit', $siswa->id) }}">Ubah</a>
                                                @endcan
                                                @can('siswa-delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => [config('pathadmin.admin_prefix') . 'siswas.destroy', $siswa->id], 'style' => 'display:inline', 'class' => 'dels']) !!}
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="delme()">Hapus</button>
                                                    {!! Form::close() !!}
                                                @endcan
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p class="pt-1">{{ $labelcount }}</p>
                    </div>
                    {{ $siswas->appends(['keyword' => Request::get('keyword')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
