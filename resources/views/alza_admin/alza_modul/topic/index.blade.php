@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}
                    @can('topic-create')
                        <a class="btn btn-success btn-sm float-right"
                            href="{{ route(config('pathadmin.admin_prefix') . 'topics.create') }}"> Tambah
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
                                    <th>Title</th>
                                    <th>Mapel</th>
                                    <th>Kelas</th>
                                    <th>Direspon</th>
                                    <th>
                                        <center>Oleh</center>
                                    </th>
                                    <th width="280" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topics as $key => $topic)
                                    <tr>
                                        <td>
                                            <center>{{ $key + 1 + $valuepage }}</center>
                                        </td>
                                        <td>{{ $topic->title }}</td>
                                        <td>{{ $topic->mapel->nama_mapel }}</td>
                                        <td>{{ $topic->kelas->nama_kelas }}</td>
                                        <td><strong class="text-success">{{ count($topic->post) }}x Direspon</strong>
                                        </td>
                                        <td>
                                            <center>
                                                @forelse ($topic->postImages as $p)
                                                    <img src="{!! $p->siswa_id != '0' ? url('/storage/upload/' . $p->siswa()[0]['foto']) : url('/storage/upload/' . Session::get('foto')) !!}" class="rounded-circle img-thumbnail"
                                                        width="50px">
                                                @empty
                                                @endforelse
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ url('/' . config('pathadmin.admin_name') . '/topics/' . $topic->id . '/show') }}">Lihat</a>
                                                @can('topic-edit')
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route(config('pathadmin.admin_prefix') . 'topics.edit', $topic->id) }}">Ubah</a>
                                                @endcan
                                                @can('topic-delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => [config('pathadmin.admin_prefix') . 'topics.destroy', $topic->id], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!}
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
                    {{ $topics->appends(['keyword' => Request::get('keyword')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
