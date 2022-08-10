@extends('auth.template')

@section('alzaauth')
    <div class="signpanel-wrapper">
        <div class="signbox">
            <div class="signbox-header">
                <img src="{{ url('/assets/img/logo.png') }}" alt="Alza CMS">
                <p class="mg-b-0">{{ __('Reset Password') }}</p>
            </div><!-- signbox-header -->
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group px-2 mt-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="{{ __('Email Address') }}">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-dark btn-block">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>
        </div><!-- signbox -->
    </div><!-- signpanel-wrapper -->
@endsection
