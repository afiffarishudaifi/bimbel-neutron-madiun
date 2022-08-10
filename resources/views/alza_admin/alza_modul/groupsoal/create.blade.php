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
                    {!! Form::open(['route' => config('pathadmin.admin_prefix') . 'groupsoals.store', 'method' => 'POST', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group"><label>Entitas</label>
                                    <select class="form-control" name="entitas_id">
                                        @foreach ($entitas as $result)
                                            <option value="{{ $result->id }}">
                                                {{ $result->jenjang->nama_jenjang . ' ' . $result->kelas->nama_kelas . ' (' . $result->semester->nama_semester . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                                <div class="form-group"><label>Pengajar</label><select class="form-control"
                                        name="pengajar_id">
                                        @foreach ($pengajar as $result)
                                            <option value="{{ $result->id }}">{{ $result->nama_pengajar }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group"><label>Catatan</label>
                                    <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control">{{ old('catatan') }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group"><label>waktu</label><input name="waktu" class="form-control"
                                        type="number" value="{{ old('waktu') }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>start_date</label><input name="start_date"
                                        class="form-control" type="date" value="{{ old('start_date') }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>expired_date</label><input name="expired_date"
                                        class="form-control" type="date" value="{{ old('expired_date') }}"></div>
                            </div>
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Simpan</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix') . 'groupsoals.index') }}">
                                    Batal</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @push('ext_css')
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/summernote.min.css') }}">
    @endpush
    @push('ext_scripts')
        <script src="{{ url('assets/js/summernote.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#catatan').summernote({
                    height: '300px',
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript',
                            'subscript', 'clear'
                        ]],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ol', 'ul', 'paragraph', 'height']],
                        ['table', ['table']],
                        ['insert', ['link']],
                        ['view', ['undo', 'redo', 'fullscreen', 'codeview']]
                    ]
                });

                $('#abstrak').summernote({
                    height: '150px',
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript',
                            'subscript', 'clear'
                        ]],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ol', 'ul', 'paragraph', 'height']],
                        ['insert', ['link']],
                        ['view', ['undo', 'redo', 'fullscreen']]
                    ]
                });
            });
        </script>
    @endpush
@endsection
