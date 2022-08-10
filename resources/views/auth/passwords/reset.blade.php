@extends('auth.template')

@section('alzaauth')
    <div class="signpanel-wrapper">
        <div class="signbox">
            <div class="signbox-header">
                <img src="{{ url('/assets/img/logo.png') }}" alt="Alza CMS">
                <p class="mg-b-0">{{ __('Reset Password') }}</p>
            </div><!-- signbox-header -->
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">
                </div>

                <div class="form-group">
                    <<button type="submit" class="btn btn-dark">
                        {{ __('Reset Password') }}
                        </button>
                </div>
            </form>
        </div><!-- signbox -->
    </div><!-- signpanel-wrapper -->
@endsection
