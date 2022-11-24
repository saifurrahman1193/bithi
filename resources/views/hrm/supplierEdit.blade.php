@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Update Supplier')

@section('page_content')


<script src="{{ asset('js/jquery.min.js') }}"></script>




<div class="content-wrapper" style="min-height: 0px;">

  {{-- Notification --}}
    {{-- Notification --}}
    @if (session('successMsg'))
                

      <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('successMsg') }}
      </div>


    @endif

    
          <div class="card">
            <div class="card-body">

				

				{{-- top side of the table --}}

				<h4 class="card-title" style="text-align: center;">Update A Supplier</h4>






				


          <form class="form-sample" id="supplier_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('supplier.update', $supplierData->supplierId) }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    


                    <div class="row">
                        



                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Supplier Name</label>
                            <div class="col-sm-8">
                              <input type="text" id="supplierTitle" name="supplierTitle" class="form-control" required  value="{{ $supplierData->supplierTitle }}">


                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Contact Person Name</label>
                            <div class="col-sm-8">
                              <input type="text" id="contactPerson" name="contactPerson" class="form-control" required value="{{$supplierData->contactPerson  }}">


                            </div>
                          </div>
                        </div>



                        


                    </div>


                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Email</label>
                            <div class="col-sm-8">
                              <input type="email" id="email" name="email" class="form-control" value="{{ $supplierData->email }}">


                            </div>
                          </div>
                        </div>



                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Years Of Experience</label>
                            <div class="col-sm-8">
                              <input type="number" id="yearsOfExperience" name="yearsOfExperience" class="form-control" required 
                              value="{{ $supplierData->yearsOfExperience }}">


                            </div>
                          </div>
                        </div>


                    </div>

                    <div class="row">

                      

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label  control-label">Company Address</label>
                            <div class="col-sm-8">
                              <textarea class="form-control" id="companyAddress" name="companyAddress" rows="3" required>{{ $supplierData->companyAddress }}</textarea>


                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Contact Number</label>
                            <div class="col-sm-8">
                              <input type="tel" pattern = "[+]{0,1}[0-9]{7,13}" title="+8801703188752" minlength="7" maxlength="14" id="contactNumber" name="contactNumber" class="form-control" required value="{{ $supplierData->contactNumber }}">


                            </div>
                          </div>
                        </div>


                        



                    </div>


                    
                    <div class="row">

                      

                      <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Reference</label>
                            <div class="col-sm-8">
                              <input type="text" id="reference" name="reference" class="form-control" 
                              value="{{ $supplierData->reference }}">


                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Remarks</label>
                            <div class="col-sm-8">
                              <textarea class="form-control" id="remarks" name="remarks" rows="3" >{{ $supplierData->remarks }}</textarea>


                            </div>
                          </div>
                        </div>

                      






                    </div>





                  <div class="col-md-12 text-center mt-4">


                  
                      {{-- <button type="submit" class="btn btn-success mr-2">Save</button> --}}
                      {{-- <button class="btn btn-light" onclick="formClearFunction()">Clear</button> --}}
                      <input type="submit" class="btn btn-success mr-2"  value="Save">
                      {{-- <input type="button" class="btn btn-danger" onclick="formClearFunction()" value="Clear"> --}}
                      <a href="{{ route('supplier') }}">
                        <button type="button" class="btn btn-danger" >
                            Cancel
                        </button>
                      </a>
                  </div>


                  </form>
        










            </div>
          </div>
        </div>














<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("supplier_insert_form").reset();
    }

</script>





@endsection