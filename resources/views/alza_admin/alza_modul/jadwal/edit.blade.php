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
                {!! Form::model($jadwal, [
                'method' => 'PATCH',
                'route' => [config('pathadmin.admin_prefix') . 'jadwals.update', $jadwal->id],
                'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group"><label>Kelas</label>
                                <select class="form-control" name="kelas_id">
                                    @foreach ($kelas as $result)
                                    <option value="{{ $result->id }}" {!! $jadwal->kelas_id == $result->id ? 'selected' : '' !!}>
                                        {{ $result->nama_kelas }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>Mapel</label><select class="form-control" name="mapel_id">
                                    @foreach ($mapel as $result)
                                    <option value="{{ $result->id }}" {!! $jadwal->mapel_id == $result->id ? 'selected' : '' !!}>
                                        {{ $result->nama_mapel }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group"><label>Pengajar</label>
                                <select class="form-control" name="pengajar_id">
                                    @foreach ($pengajar as $result)
                                    <option value="{{ $result->id }}" {!! $jadwal->pengajar_id == $result->id ? 'selected' : '' !!}>
                                        {{ $result->nama_pengajar }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group"><label>hari</label>

                                <select name="hari" class="form-control" value="">
                                    <option value="Senin" {{ $jadwal->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ $jadwal->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ $jadwal->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ $jadwal->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ $jadwal->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ $jadwal->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                    <option value="Minggu" {{ $jadwal->hari == 'Minggu' ? 'selected' : '' }}>Minggu</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                             
                            <div class='input-group date' id='timepicker1'>
                                <label>sampai_jam</label>
                                <input name="dari_jam" class="form-control" type="text" value="{{ $jadwal->dari_jam }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class='input-group date' id='timepicker2'>
                                <label>sampai_jam</label>
                                <input name="sampai_jam" class="form-control" type="text" value="{{ $jadwal->sampai_jam }}" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end border-top">
                            <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Proses</button>
                            <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1" href="{{ route(config('pathadmin.admin_prefix') . 'jadwals.index') }}"> Batal</a>
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