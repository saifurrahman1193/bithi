

@extends('layouts.app', ['company' =>  DB::table('company')->get()])
@extends('layouts.navbar')
@extends('layouts.sidebar')

@section('pageTitle', 'Create User')

@section('page_content')
    {{-- <h1>add new user</h1>   --}}

    
<script src="{{ asset('js/jquery.min.js') }}"></script>	


	{{-- add new user --}}
	<div class="container">

		

		{{-- showing error after "add new user" button clicking --}}
		{{-- showing error after "add new user" button clicking --}}
		@if ($errors->any())
			@foreach ($errors->all() as $error)
				<div class="alert alert-dismissible alert-danger">
				  <button type="button" class="close" data-dismiss="alert">×</button>
				  <strong>Oh snap!</strong>
				  {{$error}}
				</div>
			@endforeach
		@endif



		{{-- add new user form --}}
		{{-- add new user form --}}

		<div class="content-wrapper" style="min-height: 0px;">
		<div class="card col-md-8">
		<div class="card-body">
        <h4 class="card-title" style="text-align: center;">Create New User</h4>


		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">
	                {{-- <div class="panel-heading">Add New User</div> --}}

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="/user"  onsubmit="return confirm('Do you really want to proceed?');">
	                        {{ csrf_field() }}


	                        {{-- Upload profile picture --}}
	                        {{-- Upload profile picture --}}
	                        {{-- <div class="form-group{{ $errors->has('profile_pic') ? ' has-error' : '' }}">
	                            <label for="profile_pic" class="col-md-4 control-label">Upload your image</label>

	                            <div class="col-md-12">

	                                <input type="file"  name="profile_pic" value="" placeholder="" >


	                                @if ($errors->has('profile_pic'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('profile_pic') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div> --}}

	                        


	                        {{-- name --}}
	                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} required">
	                            <label for="name" class="col-md-4 control-label">Name</label>

	                            <div class="col-md-12">
	                                <input id="name" type="text" class="form-control" name="name" 
	                                 
	                                required >

	                               
	                            </div>
	                        </div>

	                        


	                        {{-- email --}}
	                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} required">
	                            <label for="email" class="col-md-4 control-label">E-Mail</label>

	                            <div class="col-md-12">
	                                <input id="email" type="email" class="form-control" name="email" 
	                                 
	                                required >

	                               
	                            </div>
	                        </div>

	                        {{-- password --}}
	                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} required">
	                            <label for="password" class="col-md-4 control-label">Password</label>

	                            <div class="col-md-12">
	                                <input id="password" type="password" class="form-control" name="password" required>

	                                
	                            </div>
	                        </div>










	                        <div class="form-group">
	                            <div class="col-md-12 col-md-offset-4 mt-2">

	                                <button type="submit" class="btn btn-success float-right">
	                                    Save
	                                </button>
	                                
	                                <a href="{{ route('user.index') }}">
	                                	<button type="button" class="btn btn-danger float-right mr-2">
		                                    Cancel
		                                </button>
	                                </a>
	                            </div>
	                        </div>


	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	    </div>
	    </div>
	    </div>

	</div>
	{{-- end add new user  --}}



@endsection