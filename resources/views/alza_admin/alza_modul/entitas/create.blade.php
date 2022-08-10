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
                    {!! Form::open(['route' => config('pathadmin.admin_prefix') . 'entitass.store', 'method' => 'POST', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group"><label>Jenjang</label><select class="form-control"
                                        name="jenjang_id">
                                        @foreach ($jenjang as $result)
                                            <option value="{{ $result->id }}">{{ $result->nama_jenjang }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>Kelas</label><select class="form-control"
                                        name="kelas_id">
                                        @foreach ($kelas as $result)
                                            <option value="{{ $result->id }}">{{ $result->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>Semester</label><select class="form-control"
                                        name="semester_id">
                                        @foreach ($semester as $result)
                                            <option value="{{ $result->id }}">{{ $result->nama_semester }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Simpan</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix') . 'entitass.index') }}"> Batal</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
