@extends('auth.template')

@section('alzaauth')
    <div class="signpanel-wrapper">
        <div class="signbox">
            <div class="signbox-header">
                <img src="{!! Alzaget::logo() !!}" alt="{!! Alzaget::title() !!}" width="175px;" height="36px;"
                    class="img-responsive">

            </div><!-- signbox-header -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="signbox-body">

                    <div class="form-group">
                        <label class="form-control-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="form-control-label">Password:</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Masuk Sebagai</label>
                        <select name="level" class="form-control @error('password') is-invalid @enderror">
                            <option value="-"> -- pilih -- </option>
                            <option value="pengajar"> Pengajar </option>
                            <option value="admin"> Administrator </option>
                        </select>
                        @error('level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- form-group -->
                    {{-- <div class="form-group">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div><!-- form-group --> --}}
                    <button class="btn btn-dark btn-block">{{ __('Login') }}</button>
                    {{-- <div class="tx-center bd pd-10 mg-t-40">Not yet a member? <a href="page-signup.html">Create an
                            account</a></div> --}}
                </div><!-- signbox-body -->
            </form>
        </div><!-- signbox -->
    </div><!-- signpanel-wrapper -->
@endsection
