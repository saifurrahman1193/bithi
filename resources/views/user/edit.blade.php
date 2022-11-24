@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')

@section('pageTitle', 'Update User Info')

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
			<h4 class="card-title" style="text-align: center;">Update User Info</h4>
		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">
	                {{-- <div class="panel-heading">Change User Information</div> --}}

	                <div class="panel-body">
	                    <form  autocomplete="off" class="form-horizontal" method="POST" action="/user/{{$users[0]->id}}"  onsubmit="return confirm('Do you really want to proceed?');">
	                        {{ csrf_field() }}

	                        {{-- must be needed to update --}}
	                        <input type="hidden" name="_method" value="put">


	                        <div class="form-group">
	                            <label for="name" class="col-md-4 control-label">Name</label>

	                            <div class="col-md-12">
	                                {{-- <input id="email" type="email" class="form-control" name="email" value="" required> --}}

	                                  <input type="text" id="name" name="name" class="form-control"  value="{{ $users[0]->name }}" >


	                                
	                            </div>
	                        </div>


	                        

	                        <div class="form-group">
	                            <label for="email" class="col-md-4 control-label">E-Mail</label>

	                            <div class="col-md-12">
	                                {{-- <input id="email" type="email" class="form-control" name="email" value="" required> --}}

	                                  <input type="email" id="email" name="email" class="form-control"  value="{{ $users[0]->email }}" readonly>


	                                
	                            </div>
	                        </div>

	                        

	                        {{-- password --}}
	                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                            <label for="password" class="col-md-4 control-label">Password</label>

	                            <div class="col-md-12">
	                                <input id="password" type="password" class="form-control" name="password" value="" required>

	                                @if ($errors->has('password'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>







	                        <div class="form-group">
	                            <div class="col-md-12 ">
	                                

	                                <button type="submit" class="btn btn-success float-right">
	                                    Update
	                                </button>

	                                <a href="{{ route('user.index') }}">
	                                	<button type="button" class="btn btn-danger float-right mr-2" >
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