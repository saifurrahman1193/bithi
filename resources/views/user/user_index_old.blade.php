
{{-- authenticate --}}
{{-- Restrict with role --}}

{{-- checking if (0 = not admin) if 1 then admin --}}
{{-- <h1>admin_role_check : {{$admin_role_check}}</h1> --}}
{{-- @php

  $admin_role_check = DB::table('user_roles_view')
                               ->where('user_id', auth::user()->id )
                               ->Where('role_id', 1 )
                               ->value('role_id');

@endphp


@if ($admin_role_check===null) 
    <script>window.location = "/";</script>
@endif --}}






@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar')

@section('pageTitle', 'Users')


@section('page_content')

<script src="{{ asset('js/jquery.min.js') }}"></script>

    <div class="container">


      {{-- search Field --}}
      {{-- search Field --}}
      {{-- search Field --}}
      {{-- Live search in Laravel using AJAX --}}
      {{-- https://www.youtube.com/watch?v=ld5HwiENA8k --}}

      {{-- <div class="panel-body">
          <div class="form-group input-group">
              
              <form  method="get" >
                {{ csrf_field() }}
                <input type="search" name="q" id="q" 
                      placeholder="Search Users.." class="form-control" 
                      >
              </form>

              <span class="input-group-btn">
                <p>Search icon on a button:
                  <button type="button" class="btn btn-info">
                    <span class="glyphicon glyphicon-search"></span> Search
                  </button>
                </p>
              </span>
          </div>
      </div> --}}
      

      
          

           
   </div>  



   <div class="content-wrapper" style="min-height: 0px;">
    <div class="card">
      <div class="card-body">
        {{-- message alert --}}
        {{-- message alert --}}
        @if (session('successMsg'))
            

            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
              {{ session('successMsg') }}
            </div>


        @endif

      
        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Users</h4>
        {{--user table retrieving--}}
           {{--user table retrieving--}}

           <a href="{{-- {{ route('user.create') }} --}}" class="btn btn-default " style="margin-bottom: 10px; "  data-toggle="modal" data-target="#saveConfirmationModal" ><span>+ Create New User</span></a>

           <table id="datatable1" class="table table-bordered  table-striped table-hover ">
              <thead >
              <tr class="bg-primary text-light">
                {{-- <th class="text-center">#</th> --}}
                <th class="text-center" >Name</th>
                <th class="text-center">Email</th>
   
                <th   class="text-center">Action</th>
              </tr>
              </thead>
              <tbody>

              @foreach ($users as $user)
                  <tr>
                      {{-- <td>{{$loop->index+1}}</td>  --}}
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      

                      

                      <td id="tdtableaction" >

                          {{-- <form  method="post" action="{{ route('supplier.delete', $user->id) }}/hrm/supplier/{{$suppliers->supplierId}}" >
                              {{ csrf_field() }}

                              <a href=""><i class="fa fa-edit"></i></a>
                              <a href=""><i  class="mdi mdi-delete-empty" style="color: red;"></i></a>
                          </form> --}}
                            <div class="d-inline-block tooltipster" title="Edit User Information?">
                                <a role="button" href=" {{ route('user.edit', $user->id) }}"><i class="fa fa-edit"></i></a>

                            </div>
                          <div class="d-inline-block tooltipster" title="Delete The User ?">
                              <form  method="post" action="/user/{{$user->id}}"  onsubmit="return confirm('Do you really want to proceed?');">
                                {{ csrf_field() }}

                                  <input type="hidden" name="_method" value="DELETE">

                                  <a>
                                    <button type="submit" value="DELETE" class="btn btn-link" >
                                      <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                    </button>
                                  </a>

                              </form>


                            </div>

                      </td>

                  </tr>


                  {{-- profile pic --}}
                  {{-- profile pic --}}

                  {{-- <tr>
                    <td colspan="10">
                      <img src="{{ asset($user->profile_pic) }}" alt="alternate text" />
                    </td>
                  </tr> --}}


                  
              @endforeach
              
              </tbody>
            </table>







      </div>
    </div>
  </div>





<!-- Save Modal -->
<!-- Save Modal -->
<div class="modal fade" id="saveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Create A User</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              



              {{-- top side of the table --}}
              {{-- <h4 class="card-title offset-4" style="text-align: center;">Add A Role </h4> --}}

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
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save</button>
      </div> --}}
    </div>
  </div>
</div>
<!-- Save Modal -->
<!-- Save Modal -->







@endsection

