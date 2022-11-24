@extends('layouts.app', ['company' =>  DB::table('company')->get()])


@extends('layouts.navbar')
@extends('layouts.sidebar')

@section('pageTitle', 'Roles')


@section('page_content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

  <style type="text/css" media="screen">
        .content-wrapper{
              padding: 0 40px;
        }
    
  </style>

<div class="content-wrapper mt2" style="min-height: 0px;">
    <div class="container">
      
		{{-- message alert --}}
        {{-- message alert --}}
        @if (session('successMsg'))
            

            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{ session('successMsg') }}
            </div>


        @endif

    </div>  
</div>  




<div class="content-wrapper" style="min-height: 0px;">
    <div class="card">
            
        <div class="card-body">




            {{-- top side of the table --}}
            <h4 class="card-title" style="text-align: center;">Update A Role </h4>

            <form class="form-horizontal" method="post"  action="{{ route('role.updating', $roleData[0]->roleId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
              {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Role Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="role" name="role" value="{{ $roleData[0]->role }}">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Role Description</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="description" name="description" value="{{ $roleData[0]->description }}">
                          </div>
                        </div>
                      </div>

                    </div>


                    <div class="text-center mt-4">
                      <button   type="submit"   class="btn btn-success mr-2">Update</button>
                      <a href="{{ route('role.index') }}">
                        <button type="button" class="btn btn-danger " >
                            Cancel
                        </button>
                      </a>
                      {{-- <button class="btn btn-light">Clear</button> --}}
                    </div>


              </form>

             
    
        </div>


        

    </div>

</div>




    



{{-- ajax section --}}
{{-- ajax section --}}

{{-- <script  type="text/javascript" >



    $('#insert').click(function(){
          $.ajax({
            type:'post',
            url: '{{ route('role.store') }}',
            data:{
              '_token':$('input[name=_token').val(),
              'Role': $('input[name=Role]').val(),
              'Role_desc': $('input[name=Role_desc]').val()
            },
            success:function(data){
              window.location.reload();
            },
          });
        });

</script>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script> --}}

{{-- <script>
         jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('role.store') }}",
                  method: 'post',
                  data: {
                     Role: jQuery('#Role').val(),
                     Role_desc: jQuery('#Role_desc').val()
                  },
                  success: function(result){
                     jQuery('.alert').show();
                     jQuery('.alert').html(result.success);
                  }});
               });
            });
      </script> --}}



@endsection

