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
                    {!! Form::model($siswa, ['method' => 'PATCH', 'route' => [config('pathadmin.admin_prefix') . 'siswas.update', $siswa->id], 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group"><label>nis</label>
                                    <input name="nis" class="form-control" type="text" value="{{ $siswa->nis }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>nama</label><input name="nama" class="form-control"
                                        type="text" value="{{ $siswa->nama }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>email</label><input name="email" class="form-control"
                                        type="email" value="{{ $siswa->email }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>alamat</label><input name="alamat" class="form-control"
                                        type="text" value="{{ $siswa->alamat }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="Laki-Laki" {!! $siswa->gender == 'Laki-Laki' ? 'selected' : '' !!}>Laki-Laki</option>
                                        <option value="Perempuan" {!! $siswa->gender == 'Perempuan' ? 'selected' : '' !!}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>password</label><input name="password"
                                        class="form-control" type="password" value="{{ $siswa->password }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>foto</label><input name="foto" class="form-control"
                                        type="file"><input type="hidden" name="imagenow" class="form-control"
                                        value="{{ $siswa->foto }}"></div>
                            </div>
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Simpan</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix') . 'siswas.index') }}"> Batal</a>
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
