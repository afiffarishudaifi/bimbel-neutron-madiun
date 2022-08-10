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
                    {!! Form::model($pengajar, ['method' => 'PATCH', 'route' => [config('pathadmin.admin_prefix') . 'pengajars.update', $pengajar->id], 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group"><label>noinduk</label>
                                    <input name="noinduk" class="form-control" type="number"
                                        value="{{ $pengajar->noinduk }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>nama_pengajar</label><input name="nama_pengajar"
                                        class="form-control" type="text" value="{{ $pengajar->nama_pengajar }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>alamat</label>
                                    <textarea name="alamat" class="form-control" rows="10">{{ $pengajar->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>email</label>
                                    <input name="email" class="form-control" type="email"
                                        value="{{ $pengajar->email }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>password</label>
                                    <input name="password" class="form-control" type="password">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>tempat_lahir</label><input name="tempat_lahir"
                                        class="form-control" type="text" value="{{ $pengajar->tempat_lahir }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>tanggal_lahir</label><input name="tanggal_lahir"
                                        class="form-control" type="date" value="{{ $pengajar->tanggal_lahir }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>foto</label><input name="foto" class="form-control"
                                        type="file"><input type="hidden" name="imagenow" class="form-control"
                                        value="{{ $pengajar->foto }}"></div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Role:</strong>
                                    {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                                </div>
                            </div>
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
