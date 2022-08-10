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
                    {!! Form::open(['route' => config('pathadmin.admin_prefix') . 'pengajars.store', 'method' => 'POST', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group"><label>noinduk</label>
                                    <input name="noinduk" class="form-control" type="number"
                                        value="{{ old('noinduk') }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>nama_pengajar</label><input name="nama_pengajar"
                                        class="form-control" type="text" value="{{ old('nama_pengajar') }}" required></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>alamat</label>
                                    <textarea name="alamat" class="form-control" rows="10" required>{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>email</label>
                                    <input name="email" class="form-control" type="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>password</label>
                                    <input name="password" class="form-control" type="password"
                                        value="{{ old('password') }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>tempat_lahir</label><input name="tempat_lahir"
                                        class="form-control" type="text" value="{{ old('tempat_lahir') }}" required></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>tanggal_lahir</label><input name="tanggal_lahir"
                                        class="form-control" type="date" value="{{ old('tanggal_lahir') }}" required></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>foto</label><input name="foto" class="form-control"
                                        type="file" value="{{ old('foto') }}" required></div>
                            </div>
                            <!--<div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Role:</strong>
                                    {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                                </div>
                            </div>-->
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Simpan</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix') . 'pengajars.index') }}"> Batal</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
