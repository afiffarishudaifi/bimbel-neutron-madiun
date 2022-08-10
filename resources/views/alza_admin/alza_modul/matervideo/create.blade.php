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
                    {!! Form::open(['route' => config('pathadmin.admin_prefix') . 'matervideos.store', 'method' => 'POST', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group"><label>Mapel</label><select class="form-control"
                                        name="mapel_id">
                                        @foreach ($mapel as $result)
                                            <option value="{{ $result->id }}">{{ $result->nama_mapel }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>Entitas</label><select class="form-control"
                                        name="entitas_id">
                                        @foreach ($entitas as $result)
                                            <option value="{{ $result->id }}">
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
                                            <option value="{{ $result->id }}">
                                                {{ $result->kelas->nama_kelas . ' (' . $result->mapel->nama_mapel . ')' . $result->matericategorys_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>link_embed</label><input name="link_embed"
                                        class="form-control" type="text" value="{{ old('link_embed') }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>no_urut</label><input name="no_urut"
                                        class="form-control" type="number" value="{{ old('no_urut') }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>nama_materivideo</label><input name="nama_materivideo"
                                        class="form-control" type="text" value="{{ old('nama_materivideo') }}"></div>
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

@endsection
