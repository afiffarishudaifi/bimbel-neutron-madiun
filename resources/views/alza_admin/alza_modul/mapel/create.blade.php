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
                    {!! Form::open(['route' => config('pathadmin.admin_prefix').'mapels.store', 'method' => 'POST', 'class' => 'form form-vertical','enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">
                            
                            <div class="col-12"><div class="form-group"><label>nama_mapel</label><input name="nama_mapel" class="form-control" type="text" value="{{ old('nama_mapel') }}"></div></div><div class="col-12"><div class="form-group"><label>kode</label><input name="kode" class="form-control" type="text" value="{{ old('kode') }}"></div></div>
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Simpan</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix').'mapels.index') }}"> Batal</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
