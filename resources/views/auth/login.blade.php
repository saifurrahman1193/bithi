@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@section('pageTitle', 'Login')

<style type="text/css" media="screen">
    form .form-group i {
                            position: absolute;
                            right: 1rem;
                            height: 18px;
                            top: calc((100% - 18px) / 2);
                        }
</style>

@section('page_content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<div class="container mt-5 col-md-6">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                {{-- <h1 class="card-title mt-5 mb-5" style="text-align: center;">Hishab </h1> --}}
                <h1 class="card-title  mb-2" style="text-align: center;"> 
                    <img src="{{ asset('uploads/company/logo/company_logo.png') }}" alt="" width="150px;">
                 </h1>

                <div class="card-header bg-primary text-light ">
                    <i class=" icon-login  text-light mr-2"></i>
                        {{ __('Login') }}
                </div>

                <div class="card-body bg-secondary">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                <i class="mdi mdi-account"></i>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <i class="mdi mdi-eye"></i>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row mb-0 float-right mr-1">
                            {{-- <div class="col-md-8 offset-md-6"> --}}
                            <div class="">
                                <button type="submit" class="btn btn-success float-right">
                                    {{ __('Login') }}
                                </button>

           
                            </div>
                        </div>
                    </form>
                </div>

                {{-- <div class="card-header bg-secondary text-dark ">
                    <i class="  icon-phone   text-success mr-2"></i>
                        {{ __('Call us at 01944443334 to get the login credentials') }}
                </div> --}}

                <div class="card-header bg-secondary text-dark ">
                    <i class="fa  fa-code-fork  text-success mr-2"></i>
                        {{ __('Version : 2.0.0') }}
                </div>


            </div>
        </div>
    </div>
</div>






@endsection


