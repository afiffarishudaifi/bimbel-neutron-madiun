@extends('alza_admin.alza_layouts.alza_template')
@push('ext_css')
<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/summernote.min.css') }}">
<!--<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">-->
<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
@endpush
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
                    {!! Form::open([
                        'route' => config('pathadmin.admin_prefix') . 'jadwals.store',
                        'method' => 'POST',
                        'class' => 'form form-vertical',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group"><label>Kelas</label>
                                    <select class="form-control" name="kelas_id">
                                        @foreach ($kelas as $result)
                                            <option value="{{ $result->id }}">{{ $result->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>Mapel</label>
                                    <select class="form-control" name="mapel_id">
                                        @foreach ($mapel as $result)
                                            <option value="{{ $result->id }}">{{ $result->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>Pengajar</label>
                                    <select class="form-control" name="pengajar_id">
                                        @foreach ($pengajar as $result)
                                            <option value="{{ $result->id }}">{{ $result->nama_pengajar }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>hari</label>
                                    <select name="hari" class="form-control" value="{{ old('hari') }}"> 
                                        <option value="Senin">Senin</option>
<option value="Selasa">Selasa</option>
<option value="Rabu">Rabu</option>
<option value="Kamis">Kamis</option>
<option value="Jumat">Jumat</option>
<option value="Sabtu">Sabtu</option>
<option value="Minggu">Minggu</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                             <label>sampai_jam</label>
                            <div class='input-group date' id='timepicker1'>
                                
                                <input name="dari_jam" class="form-control" type="text" value="" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <label>sampai_jam</label>
                            <div class='input-group date' id='timepicker2'>
                                
                                <input name="sampai_jam" class="form-control" type="text" value="" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix') . 'jadwals.index') }}"> Batal</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@once

@push('ext_scripts')
{{-- <script src="{{ url('app-assets/js/jquery-3.5.1.js') }}"></script> --}}
<script src="{{ url('app-assets/js/summernote.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<script>
    $(document).ready(function() {
        //alert('test');
        $('#timepicker1').datetimepicker({
            format: 'HH:mm'
        });

        $('#timepicker2').datetimepicker({
            format: 'HH:mm'
        });

    });
</script>
@endpush
@endonce
@endsection
