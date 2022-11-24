@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')

@section('pageTitle', 'Assign Roles')


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
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{ session('successMsg') }}
            </div>


        @endif

      
        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Assign Roles to Users</h4>
        {{--user table retrieving--}}
           {{--user table retrieving--}}

           <a href="{{ route('user.create') }}" class="btn btn-default " style="margin-bottom: 10px; "><span>+ Create New User</span></a>
           <a href="{{ route('role.create') }}" class="btn btn-default " style="margin-bottom: 10px; "><span>+ Create New Role</span></a>

           <table id="datatable1" class="table table-bordered  table-striped table-hover ">
              <thead >
              <tr class="bg-primary text-light">
                {{-- <th class="text-center">#</th> --}}
                <th class="text-center" >Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Assigned Roles</th>
   
                {{-- <th   class="text-center">Action</th> --}}
              </tr>
              </thead>
              <tbody>

              @foreach ($users as $user)
                  <tr>
                      {{-- <td>{{$loop->index+1}}</td>  --}}
                      <td>
                        @foreach(App\Hr::where('employeeId', $user->hrId)->get() as $employees)
                            <option value="{{ $employees->employeeId }}" >
                                {{ title_case($employees->fullName) . ' ( '.$employees->employee.' )' }}
                            </option> 
                        @endforeach  
                      </td>
                      <td>{{$user->email}}</td>
                      <td>


                              <input type="number" name="userId" id="userId" value="{{ $user->id }}">
                                <div class="form-group">
                                    <select id="roleId" name="roleId" class="form-control" >
                                        @foreach (DB::table('roles')->get() as $roles)
                                              <option value="{{ $roles->roleId }}">{{ $roles->role }}</option>
                                        @endforeach
                                    </select>
                                </div>


                      </td>
                      

                      

                     {{--  <td id="tdtableaction" >


                            <div class="d-inline-block">
                                <a role="button" href=" {{ route('user.edit', $user->id) }}"><i class="fa fa-edit"></i></a>

                            </div>
                          <div class="d-inline-block">
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

                      </td> --}}

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






{{-- select 2 script --}}
{{-- select 2 script --}}
{{-- select 2 script --}}
{{-- <script >
  $(document).ready(function() {

     $('#roleId').select2({
      placeholder: "Select Role"
     });

  });
</script>
 --}}




@endsection

