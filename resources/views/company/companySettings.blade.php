@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Company Settings')

@section('page_content')




{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>




<div class="content-wrapper" style="min-height: 0px;">

  {{-- Notification --}}
    {{-- Notification --}}
    @if (session('successMsg'))
                

      <div class="alert alert-success"  id="alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('successMsg') }}
      </div>


    @endif


  <div class="card col col-md-7 offset-md-2">
    <div class="card-body">

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Company Settings</h4>





        <form class="form-sample" id="company_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('company.update', $company->companyId) }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    

                      <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Name</label>
                            <div class="col-sm-8">
                              <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required value="{{ $company->name }}">
                              @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif


                            </div>
                          </div>
                        </div>



                        
                        

                         <div class="col-md-12">
                          <div class="form-group row required" >
                            <label class="col-sm-4 col-form-label control-label">Address</label>
                            <div class="col-sm-8">
                              <textarea class="form-control" id="address" name="address" rows="2"  required>{{ $company->address }}</textarea>

                            </div>
                          </div>
                        </div>


                        <div class="col-md-12">
                          <div class="form-group row required" >
                            <label class="col-sm-4 col-form-label control-label">Contact</label>
                            <div class="col-sm-8">
                              <input type="text" id="contact" name="contact" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" required value="{{ $company->contact }}">
                               @if ($errors->has('contact'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif

                            </div>
                          </div>
                        </div>


                        <div class="col-md-12">
                          <div class="form-group row required" >
                            <label class="col-sm-4 col-form-label control-label">E-Mail</label>
                            <div class="col-sm-8">
                              <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required value="{{ $company->email }}">
                               @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>
                          </div>
                        </div>


                        <div class="col-md-12">
                          <div class="form-group row required" >
                            <label class="col-sm-4 col-form-label control-label">Logo</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" id="logoUrl" name="logoUrl" class="form-control" required value="{{ $company->logoUrl }}"> --}}
                              <input type="file" name="logoUrl" value="logoUrl" class="form-control{{ $errors->has('logoUrl') ? ' is-invalid' : '' }}" placeholder="logoUrl" value="{{ $company->logoUrl }}"  id="companyLogoUploadInput">
                               @if ($errors->has('logoUrl'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('logoUrl') }}</strong>
                                    </span>
                                @endif

                                <img id="companyLogoUploadPreview" src="{{ empty($company->logoUrl) ? '#' : asset($company->logoUrl) }}" alt="your image" style="max-width: 200px; max-height: 200px;" />

                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group row " >
                            <label class="col-sm-4 col-form-label ">Website</label>
                            <div class="col-sm-8">
                              <input type="text" id="website" name="website" class="form-control"  value="{{ $company->website }}">

                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group row " >
                            <label class="col-sm-4 col-form-label ">Facebook</label>
                            <div class="col-sm-8">
                              <input type="text" id="facebook" name="facebook" class="form-control"  value="{{ $company->facebook }}">

                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group row " >
                            <label class="col-sm-4 col-form-label ">Instagram</label>
                            <div class="col-sm-8">
                              <input type="text" id="instagram" name="instagram" class="form-control"  value="{{ $company->instagram }}">

                            </div>
                          </div>
                        </div>



                  
                      


                    
                  <div class="col-md-12 text-center mt-4">
                    
                      
                        {{-- <button type="submit" class="btn btn-success mr-2">Save</button> --}}
                        {{-- <button class="btn btn-light" onclick="formClearFunction()">Clear</button> --}}
                        <input type="submit" class="btn btn-success mr-2 float-right"  value="Save">
                        {{-- <input type="button" class="btn btn-danger" onclick="formClearFunction()" value="Clear"> --}}

                        {{-- <button type="button" class="btn btn-danger float-right mr-1" >Cancel</button> --}}

                    </div>


                  </form>








    </div>
  </div>
</div>







<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("company_insert_form").reset();
    }

</script>



<script type="text/javascript">
  {{-- image upload and preview --}}

  function readURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#companyLogoUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#companyLogoUploadInput").change(function() 
  {
    readURL(this);
  });

</script>


@endsection