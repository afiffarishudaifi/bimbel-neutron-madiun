@extends('alza_admin.alza_layouts.alza_template')
@section('alzacontent')
    {!! Crud::render() !!}
    @once
        @push('ext_scripts')
            {!! Crud::renderjs() !!}
        @endpush
    @endonce
@endsection
