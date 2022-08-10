@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Identitas Web
                </h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="alert alert-info col-12" role="alert">
                        <span class="text-dark font-weight-bold">PANEL KONFIGURASI WEB :</span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal"
                                action="{{ route(config('pathadmin.admin_prefix') . 'iden.update', $iden->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Nama Web</label>
                                    <input type="text" class="form-control" name="nama_web"
                                        value="{{ $iden->nama_web }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Link Web</label>
                                    <input type="text" class="form-control" name="link_web"
                                        value="{{ $iden->link_web }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Tentang Web</label>
                                    <textarea name="about" id="body" cols="30" rows="10" class="form-control">{!! html_entity_decode(htmlspecialchars_decode($iden->about)) !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Alamat</label>
                                    <input type="text" class="form-control" name="alamat_web"
                                        value="{{ $iden->alamat_web }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Kontak</label>
                                    <input type="text" class="form-control" name="kontak_web"
                                        value="{{ $iden->kontak_web }}">
                                </div>
                                <div class="form-group">
                                    <img src="{{ url('/storage/logo/' . $iden->logo_web) }}" alt="{{ $iden->nama_web }}"
                                        class="img-thumbnail rounded mb-1" width="150"><br>
                                    <label for="exampleInputUsername1">Logo Web</label>
                                    <input type="file" class="form-control" name="logo_web">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Email Web</label>
                                    <input type="text" class="form-control" name="email_web"
                                        value="{{ $iden->email_web }}">
                                </div>
                                <div class="alert alert-info" role="alert">
                                    <span class="text-dark font-weight-bold">SEO WEB :</span>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Meta Deskripsi Web</label>
                                    <input type="text" class="form-control" name="meta_desc_web"
                                        value="{{ $iden->meta_desc_web }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Meta Keyword Web</label>
                                    <input type="text" class="form-control" name="meta_key_web"
                                        value="{{ $iden->meta_key_web }}">
                                </div>
                                <div class="alert alert-info" role="alert">
                                    <span class="text-dark font-weight-bold">SOSMED DAN MAPS :</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Maps Web</label>
                                    <input type="text" class="form-control" name="maps_web"
                                        value="{{ $iden->maps_web }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Instagram</label>
                                    <input type="text" class="form-control" name="ig_web" value="{{ $iden->ig_web }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Facebook</label>
                                    <input type="text" class="form-control" name="fb_web" value="{{ $iden->fb_web }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">YouTube</label>
                                    <input type="text" class="form-control" name="yt_web" value="{{ $iden->yt_web }}">
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                                <a href="{{ route(config('pathadmin.admin_prefix') . 'iden.index') }}"
                                    class="btn btn-light">Batal</a>
                            </form>
                        </div>
                    </div>
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
