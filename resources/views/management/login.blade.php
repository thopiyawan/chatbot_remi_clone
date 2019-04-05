@extends('layouts.app')

@section('script')
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<link rel="stylesheet" href="{{URL::asset('css/stylecss_test.css')}}">
@endsection

@section('content')
<div class="container">
	<center>
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
				<div class="card-header"><center>
				<h3>เข้าสู่ระบบ</h3>
				</center>
				
				</div>

                <div class="card-body">
                    <form method="POST" action="doctor_login">
                        <div class="form-group row">
                            <label for="doctor_id" class="col-md-4 col-form-label text-md-right">{{ __('Doctor ID') }}</label>

                            <div class="col-md-6">
                                <input id="doctor_id" type="text" class="form-control{{ $errors->has('doctor_id') ? ' is-invalid' : '' }}" name="doctor_id" value="{{ old('doctor_id') }}" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required value="">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	</center>
</div>
@endsection
