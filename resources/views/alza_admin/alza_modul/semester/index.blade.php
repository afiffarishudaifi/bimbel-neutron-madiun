@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}
                    @can('semester-create')
                        <a class="btn btn-success btn-sm float-right"
                            href="{{ route(config('pathadmin.admin_prefix') . 'semesters.create') }}"> Tambah
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
                                    <th>Nama_semester</th>
                                    <th>Tahun</th>
                                    <th>Kode</th>

                                    <th width="280" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semesters as $key => $semester)
                                    <tr>
                                        <td>
                                            <center>{{ $key + 1 + $valuepage }}</center>
                                        </td>
                                        <td>{{ $semester->nama_semester }}</td>
                                        <td>{{ $semester->tahun }}</td>
                                        <td>{{ $semester->kode }}</td>

                                        <td>
                                            <center>
                                                @can('semester-edit')
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route(config('pathadmin.admin_prefix') . 'semesters.edit', $semester->id) }}">Ubah</a>
                                                @endcan
                                                @can('semester-delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => [config('pathadmin.admin_prefix') . 'semesters.destroy', $semester->id], 'style' => 'display:inline', 'class' => 'dels']) !!}
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
                    {{ $semesters->appends(['keyword' => Request::get('keyword')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
