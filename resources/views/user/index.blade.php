@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')

@section('pageTitle', 'Users')


@section('page_content')




<script src="{{ asset('js/jquery.min.js') }}"></script>

<script type="text/javascript">




$(function(){

    $('#updateConfirmationModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) ;
          var userId = button.data('userid') ;
          var userName = button.data('username') ;
          var userEmail = button.data('useremail') ;
          var modal = $(this);
          modal.find('.modal-body #name').val(userName);
          modal.find('.modal-body #email').val(userEmail);
          modal.find('.modal-body #id').val(userId);
    })


   $('#deleteConfirmModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) ;
          var userId = button.data('userid') ;
          var modal = $(this);
          modal.find('.modal-footer #userId').val(userId);
    });
});

</script>



          



   <div class="content-wrapper" style="min-height: 0px;">
    <div class="card">
      <div class="card-body">

        {{-- message alert --}}
          {{-- message alert --}}
          @if ($errors->any())
              <ul>
                @foreach ($errors->all() as $error)
                  {{-- <li>{{ $error }}</li> --}}
                  <div class="alert alert-danger" id="alert-danger" role="alert" >
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ $error }}
                  </div>
                @endforeach
              </ul>
          @endif


        {{-- message alert --}}
        {{-- message alert --}}
        @if (session('successMsg'))
            

            <div class="alert alert-success" id="alert-success" role="alert">
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
                          
                            <div class="d-inline-block " >
                                {{-- <a role="button" href=" {{ route('user.edit', $user->id) }}"><i class="fa fa-edit tooltipster" title="Edit Record ?"></i></a> --}}
                                <a role="button" href="#"   data-toggle="modal" data-target="#updateConfirmationModal" data-userid="{{$user->id}}" data-useremail="{{$user->email}}" data-username="{{$user->name}}"><i class="fa fa-edit tooltipster" title="Edit Record ?"></i></a>
                                <a role="button" href="#"  data-toggle="modal" data-target="#deleteConfirmModal" data-userid="{{$user->id}}"><i class="fa fa-trash tooltipster" title="Delete Record ?" style="color: red;"></i></a>

                            </div>
                         
                      </td>

                  </tr>

                  
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




<!-- Update Modal -->
<!-- Update Modal -->
<div class="modal fade" id="updateConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Update User Info</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              



              {{-- top side of the table --}}
              {{-- <h4 class="card-title offset-4" style="text-align: center;">Add A Role </h4> --}}

              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('user.update', 'test') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('patch')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="id" id="id" value="">
                          


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
                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} ">
                              <label for="password" class="col-md-4 ">Password</label>

                              <div class="col-md-12">
                                  <input id="password" type="password" class="form-control" name="password" >

                                  
                              </div>
                          </div>










                          <div class="form-group">
                              <div class="col-md-12 col-md-offset-4 mt-2">

                                  <button type="submit" class="btn btn-success float-right">
                                      Update
                                  </button>
                                  
                                  <a {{-- href="{{ route('user.index') }}" --}}>
                                    <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">
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
<!-- Update Modal -->
<!-- Update Modal -->






<!-- Delete Confirm Modal -->
<!-- Delete Confirm Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <h4 class="modal-title " id="deleteLabel">Delete !</h4>
            </div>
            <div class="modal-body  text-center">
                <p>Are you sure ?</p>
                <p>
                    You won't be able to revert this !
                </p>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                
                    <form action="{{route('user.destroy','test')}}" method="post">
                        {{method_field('delete')}}
                        {{csrf_field()}}

                        <input  type="hidden" name="userId" id="userId" value="">
                        <button type="submit" class="btn btn-danger" id="deleteConfirm">Delete</button>
                    </form>
                
            </div>
        </div>
    </div>
</div>
<!-- Delete Confirm Modal -->
<!-- Delete Confirm Modal -->










@endsection

