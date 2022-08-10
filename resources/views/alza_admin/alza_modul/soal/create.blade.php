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
                    {!! Form::open(['route' => config('pathadmin.admin_prefix') . 'soals.store', 'method' => 'POST', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group"><label>Group Soal</label>
                                    <select class="form-control" name="groupsoal_id">
                                        @foreach ($groupsoal as $result)
                                            <option value="{{ $result->id }}">
                                                {{ $result->entitas->jenjang->nama_jenjang . ' ' . $result->entitas->kelas->nama_kelas . ' (' . $result->entitas->semester->nama_semester . ')' . ' | ' . $result->mapel->nama_mapel . ' - ' . $result->pengajar->nama_pengajar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>uraian</label>
                                    <textarea name="uraian" class="form-control" rows="10" id="body">{{ old('uraian') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>gambar</label><input name="gambar" class="form-control"
                                        type="file" value="{{ old('gambar') }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>opsia</label><input name="opsia" class="form-control"
                                        type="text" value="{{ old('opsia') }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>opsib</label><input name="opsib" class="form-control"
                                        type="text" value="{{ old('opsib') }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>opsic</label><input name="opsic" class="form-control"
                                        type="text" value="{{ old('opsic') }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>opsid</label><input name="opsid" class="form-control"
                                        type="text" value="{{ old('opsid') }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>opsie</label><input name="opsie" class="form-control"
                                        type="text" value="{{ old('opsie') }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>kunci</label><input name="kunci" class="form-control"
                                        type="text" value="{{ old('kunci') }}"></div>
                            </div>
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Simpan</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix') . 'soals.index') }}"> Batal</a>
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
                $('#body').summernote({
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
