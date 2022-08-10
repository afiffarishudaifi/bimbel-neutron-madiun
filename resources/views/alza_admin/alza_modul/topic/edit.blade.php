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
                    {!! Form::model($topic, ['method' => 'PATCH', 'route' => [config('pathadmin.admin_prefix') . 'topics.update', $topic->id], 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Kelas</label><select class="form-control" name="kelas_id">
                                        @foreach ($kelas as $result)
                                            <option value="{{ $result->id }}" {!! $topic->kelas_id == $result->id ? 'selected' : '' !!}>
                                                {{ $result->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>Mapel</label><select class="form-control"
                                        name="mapel_id">
                                        @foreach ($mapel as $result)
                                            <option value="{{ $result->id }}" {!! $topic->mapel_id == $result->id ? 'selected' : '' !!}>
                                                {{ $result->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="pengajar_id" value="{{ Session::get('id') }}">
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group"><label>Pengajar</label><select class="form-control"
                                        name="pengajar_id">
                                        @foreach ($pengajar as $result)
                                            <option value="{{ $result->id }}" {!! $topic->pengajar_id == $result->id ? 'selected' : '' !!}>
                                                {{ $result->nama_pengajar }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group"><label>title</label><input name="title" class="form-control"
                                        type="text" value="{{ $topic->title }}"></div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>desc</label>
                                    <textarea name="desc" class="form-control" rows="10" id="body">{!! html_entity_decode(htmlspecialchars_decode($topic->desc)) !!}</textarea>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Simpan</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix') . 'topics.index') }}"> Batal</a>
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
    @endonce
@endsection
