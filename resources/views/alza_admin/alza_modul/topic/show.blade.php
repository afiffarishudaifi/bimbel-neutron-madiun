@extends('alza_admin.alza_layouts.alza_template')

@section('alzacontent')
    <div class="col-md-12 col-12">
        <div class="card">

            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <form action="{{ route(config('pathadmin.admin_prefix') . 'posts.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea name="post" id="body" cols="30" rows="10" class="form-control"
                                            placeholder="ketikan sesuatu terkait topik saat ini."></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="file" name="attachment" id="" class="form-control">
                                        <input type="hidden" name="siswa_id" value="0">
                                        <input type="hidden" name="pengajar_id" value="{{ Session::get('id') }}">
                                        <input type="hidden" name="topic_id" value="{{ Request::segment(3) }}">
                                        <small class="text-dark text-sm">extensi :
                                            png,jpg,jpeg,xls,xlsx,doc,docx,pdf,ppt,pptx. Max : 2 mb</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm float-right">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            @forelse ($posts as $pst)
                                <div class="media mb-3">
                                    <img class="mr-3 rounded-circle" alt="{!! $pst->siswa_id != '0' ? $pst->siswa()[0]['nama'] : Session::get('nama') !!}"
                                        src="{!! $pst->siswa_id != '0' ? url('/storage/upload/' . $pst->siswa()[0]['foto']) : url('/storage/upload/' . Session::get('foto')) !!}" />
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-8 d-flex">
                                                <h5>{!! $pst->siswa_id != '0' ? $pst->siswa()[0]['nama'] : Session::get('nama') !!}</h5>
                                                <span>- {{ Alzaget::cek_terakhir($pst->created_at) }} lalu</span>
                                            </div>

                                            <div class="col-4">

                                                <div class="float-right reply">

                                                    <a href="#" data-toggle="modal" data-target="#my-modal"><span><i
                                                                class="fa fa-reply"></i>
                                                            Balas</span></a>
                                                    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog"
                                                        aria-labelledby="my-modal-title" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document"
                                                            style="width: 100%;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="my-modal-title">Balas
                                                                        Komentar
                                                                    </h5>
                                                                    <button class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route(config('pathadmin.admin_prefix') . 'replies.store') }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @method('POST')
                                                                        @csrf
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <textarea name="reply" id="reply" cols="30" rows="10" class="form-control" placeholder="ketikan balasan anda."></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <input type="file" name="attachment" id=""
                                                                                    class="form-control">
                                                                                <input type="hidden" name="siswa_id"
                                                                                    value="0">
                                                                                <input type="hidden" name="pengajar_id"
                                                                                    value="{{ Session::get('id') }}">
                                                                                <input type="hidden" name="post_id"
                                                                                    value="{{ $pst->id }}">
                                                                                <small class="text-dark text-sm">extensi :
                                                                                    png,jpg,jpeg,xls,xlsx,doc,docx,pdf,ppt,pptx.
                                                                                    Max : 2 mb</small>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <button type="submit"
                                                                                    class="btn btn-success btn-sm float-right">Kirim</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        {!! html_entity_decode(htmlspecialchars_decode($pst->post)) !!}
                                        @isset($pst->attachment)
                                            <p class="mb-0 pb-0"><strong>Attachment :</strong></p>
                                            <a href="{{ url('/storage/upload/' . $pst->attachment) }}"
                                                target="_blank">{{ $pst->attachment }}</a>
                                        @endisset


                                        {{-- reply --}}
                                        @forelse ($pst->reply as $rpl)
                                            <hr>
                                            <div class="media mt-4">
                                                <a class="pr-3" href="#"><img class="rounded-circle"
                                                        alt="{!! $rpl->siswa_id != '0' ? $rpl->siswa()[0]['nama'] : Session::get('nama') !!}" src="{!! $rpl->siswa_id != '0' ? url('/storage/upload/' . $rpl->siswa()[0]['foto']) : url('/storage/upload/' . Session::get('foto')) !!}" /></a>
                                                <div class="media-body">

                                                    <div class="row">
                                                        <div class="col-12 d-flex">
                                                            <h5>{!! $rpl->siswa_id != '0' ? $rpl->siswa()[0]['nama'] : Session::get('nama') !!}</h5>
                                                            <span>- {{ Alzaget::cek_terakhir($rpl->created_at) }}
                                                                lalu </span>&nbsp;<strong class="text-success">[ Comment
                                                                ]</strong>
                                                        </div>


                                                    </div>

                                                    {!! html_entity_decode(htmlspecialchars_decode($rpl->reply)) !!}
                                                    @isset($rpl->attachment)
                                                        <p class="mb-0 pb-0"><strong>Attachment :</strong></p>
                                                        <a href="{{ url('/storage/upload/' . $rpl->attachment) }}"
                                                            target="_blank">{{ $rpl->attachment }}</a>
                                                    @endisset
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse



                                    </div>
                                </div>
                                <hr>
                            @empty
                                <center>
                                    <h3>Belum Ada Respon</h3>
                                </center>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('ext_css')
        <style>
            .media img {

                width: 60px;
                height: 60px;
            }


            .reply a {

                text-decoration: none;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/summernote.min.css') }}">
    @endpush
    @push('ext_scripts')
        <script src="{{ url('assets/js/summernote.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('body').addClass('hide-left');
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

                $('#reply').summernote({
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
