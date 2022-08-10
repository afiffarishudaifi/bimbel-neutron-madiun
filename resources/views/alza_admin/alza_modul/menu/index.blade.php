@extends('alza_admin.alza_layouts.alza_template')
@section('alzacontent')
    {!! Menu::render() !!}
    @push('ext_scripts')
        {!! Menu::scripts() !!}
    @endpush
@endsection
