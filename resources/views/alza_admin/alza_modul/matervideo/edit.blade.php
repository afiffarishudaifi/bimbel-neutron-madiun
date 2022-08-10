@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> terjadi masalah saat proses penginputan.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::model($matervideo, ['method' => 'PATCH', 'route' => [config('pathadmin.admin_prefix') . 'matervideos.update', $matervideo->id], 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group"><label>Mapel</label><select class="form-control"
                                        name="mapel_id">
                                        @foreach ($mapel as $result)
                                            <option value="{{ $result->id }}" {!! $matervideo->mapel_id == $result->id ? 'selected' : '' !!}>
                                                {{ $result->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Entitas</label><select class="form-control" name="entitas_id">
                                        @foreach ($entitas as $result)
                                            <option value="{{ $result->id }}" {!! $matervideo->entitas_id == $result->id ? 'selected' : '' !!}>
                                                {{ $result->jenjang->nama_jenjang . ' ' . $result->kelas->nama_kelas . ' (' . $result->semester->nama_semester . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>Materi Kategori</label><select class="form-control"
                                        name="matericategory_id">
                                        @foreach ($matericategory as $result)
                                            <option value="{{ $result->id }}" {!! $matervideo->matericategory_id == $result->id ? 'selected' : '' !!}>
                                                {{ $result->kelas->nama_kelas . ' (' . $result->mapel->nama_mapel . ')' . $result->matericategorys_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>link_embed</label><input name="link_embed"
                                        class="form-control" type="text" value="{{ $matervideo->link_embed }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>no_urut</label><input name="no_urut"
                                        class="form-control" type="number" value="{{ $matervideo->no_urut }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>nama_materivideo</label><input name="nama_materivideo"
                                        class="form-control" type="text" value="{{ $matervideo->nama_materivideo }}">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Simpan</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix') . 'matervideos.index') }}"> Batal</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @once
        @push('ext_css')
            <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/summernote.min.css') }}">
        @endpush
        @push('ext_scripts')
            {{-- <script src="{{ url('app-assets/js/jquery-3.5.1.js') }}"></script> --}}
            <script src="{{ url('app-assets/js/summernote.js') }}"></script>
            <script>
                $(document).ready(function() {
                    $('#body').summernote({
                        height: '300px'
                    });
                });
            </script>
        @endpush
    @endonce
@endsection
