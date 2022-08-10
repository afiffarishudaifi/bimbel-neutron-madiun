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
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    {!! Form::open(['route' => config('pathadmin.admin_prefix') . 'rombels.store', 'method' => 'POST', 'class' => 'form form-vertical', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group"><label>Siswa</label>
                                    <select class="form-control siswa_id" name="siswa_id">
                                    </select>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group"><label>Entitas</label><select class="form-control "
                                        name="entitas_id">
                                        @foreach ($entitas as $result)
                                            <option value="{{ $result->id }}">
                                                {{ $result->jenjang->nama_jenjang .' ' .$result->kelas->nama_kelas .' (' .$result->semester->nama_semester .')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end border-top">
                                <button type="submit" class="btn btn-primary btn-sm mr-1 mb-1 mt-1">Simpan</button>
                                <a class="btn btn-light-secondary btn-sm mr-1 mb-1 mt-1"
                                    href="{{ route(config('pathadmin.admin_prefix') . 'rombels.index') }}"> Batal</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @push('ext_css')
        <link rel="stylesheet" href="{{ url('assets/css/select2.css') }}">
    @endpush
    @push('ext_scripts')
        <script src="{{ url('/assets/js/select2.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                let uri = "{{ url('/') }}";
                let path = "{{ '/' . config('pathadmin.admin_name') . '/searchsiswa' }}";
                $('.siswa_id').select2({
                    placeholder: 'Cari siswa',
                    ajax: {
                        url: uri + path,
                        type: "post",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                search: params.term // search term
                            };
                        },
                        processResults: function(response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    }
                });
            });
        </script>
    @endpush
@endsection
