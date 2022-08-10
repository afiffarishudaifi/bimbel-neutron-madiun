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
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::open(['route' => config('pathadmin.admin_prefix') . 'permissions.store', 'method' => 'POST', 'class' => 'form form-vertical']) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama Permissions</label>
                                    {!! Form::text('name', null, ['placeholder' => 'Masukan nama permission yang ingin dibuat', 'class' => 'form-control']) !!}
                                    <input type="hidden" name="guard_name" value="web">
                                    <input type="hidden" name="guard_name" value="web">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Guard Name</label>
                                    <input type="text" name="guard_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Simpan</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix') . 'permissions.index') }}"> Batal</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
@push('ext_css')
    <link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/summernote.min.css') }}">
@endpush
@push('ext_scripts')
    <script src="{{ url('app-assets/js/summernote.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#body').summernote({
                height: '300px'
            });
        });
    </script>
@endpush
