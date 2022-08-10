@extends('alza_admin.alza_layouts.alza_template')
@section('alzacontent')
    <div class="col-lg-12">
        <div class="row row-sm">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body pd-b-0">
                        <h6 class="card-body-title tx-12 tx-spacing-2 mg-b-20 tx-success">Pengajar</h6>
                        <h2 class="tx-lato tx-inverse">{{ $pengajar->count() }}</h2>
                    </div><!-- card-body -->
                    <div id="rs1" class="ht-50 ht-sm-70 mg-r--1"></div>
                </div><!-- card -->
            </div><!-- col-6 -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body pd-b-0">
                        <h6 class="card-body-title tx-12 tx-spacing-2 mg-b-20 tx-danger">Siswa</h6>
                        <h2 class="tx-lato tx-inverse">{{ $siswa->count() }}</h2>
                    </div><!-- card-body -->
                    <div id="rs2" class="ht-50 ht-sm-70 mg-r--1"></div>
                </div><!-- card -->
            </div><!-- col-6 -->
        </div><!-- row -->
    </div><!-- col-8 -->
    {{-- <div class="col-lg-4">
        <div class="card pd-40 tx-center">
            <div class="d-flex justify-content-center mg-b-30">
                <img src="http://themepixels.me/demo/katniss/img/icon1.svg" class="wd-100" alt="">
            </div>
            <h6 class="tx-md-20 tx-inverse mg-b-20">Document Management</h6>
            <p class="tx-13">Far far away, behind the word mountains, far from the countries Vokalia and
                Consonantia. Even the all-powerful Pointing has no control about the blind texts.</p>
            <a href="#" class="btn btn-default btn-block">Getting Started</a>
        </div><!-- card -->

        <div class="card mg-t-20">
            <div class="card-header d-flex justify-content-between">
                <span class="tx-uppercase tx-12 tx-medium tx-inverse">Recent Messages</span>
                <a href="#" class="tx-gray-600"><i class="icon ion-more"></i></a>
            </div><!-- card-header -->
            <div class="list-group list-group-flush">
                <div class="list-group-item">
                    <div class="media">
                        <img src="../img/img1.jpg" class="wd-30 rounded-circle" alt="">
                        <div class="media-body mg-l-10">
                            <h6 class="mg-b-0 tx-inverse tx-13">Katherine Lumaad</h6>
                            <p class="mg-b-0 tx-gray-500 tx-12">an hour ago</p>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <p class="mg-t-10 mg-b-0 tx-13">The European languages are members of the same family. Their separate
                        existence is a myth...</p>
                </div><!-- list-group-item -->
                <div class="list-group-item">
                    <div class="media">
                        <img src="../img/img2.jpg" class="wd-30 rounded-circle" alt="">
                        <div class="media-body mg-l-10">
                            <h6 class="mg-b-0 tx-inverse tx-13">Mary Grace Ceballos</h6>
                            <p class="mg-b-0 tx-gray-500 tx-12">2 hours ago</p>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <p class="mg-t-10 mg-b-0 tx-13">The European languages are members of the same family. Their separate
                        existence is a myth...</p>
                </div><!-- list-group-item -->
                <div class="list-group-item">
                    <div class="media">
                        <img src="../img/img4.jpg" class="wd-30 rounded-circle" alt="">
                        <div class="media-body mg-l-10">
                            <h6 class="mg-b-0 tx-inverse tx-13">Rowella Sombrio</h6>
                            <p class="mg-b-0 tx-gray-500 tx-12">3 hours ago</p>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <p class="mg-t-10 mg-b-0 tx-13">The European languages are members of the same family. Their separate
                        existence is a myth...</p>
                </div><!-- list-group-item -->
            </div><!-- list-group -->
            <div class="card-footer">
                <a href="#" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Show all messages</a>
            </div><!-- card-footer -->
        </div><!-- card -->

        <div class="card card-body pd-20 mg-t-20">
            <h6 class="card-body-title tx-12 tx-spacing-1">Get Connected</h6>
            <p>Just select any of your available social account to get started.</p>
            <div class="tx-20">
                <a href="#" class="tx-primary mg-r-5"><i class="fa fa-facebook"></i></a>
                <a href="#" class="tx-info mg-r-5"><i class="fa fa-twitter"></i></a>
                <a href="#" class="tx-danger mg-r-5"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="tx-danger mg-r-5"><i class="fa fa-pinterest"></i></a>
                <a href="#" class="tx-inverse mg-r-5"><i class="fa fa-github"></i></a>
                <a href="#" class="tx-pink mg-r-5"><i class="fa fa-instagram"></i></a>
            </div>
        </div><!-- card -->

    </div> --}}
@endsection
