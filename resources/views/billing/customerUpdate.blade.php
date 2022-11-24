@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Customer Update')

@section('page_content')




<script src="{{ asset('js/jquery.min.js') }}"></script>





<div class="content-wrapper" style="min-height: 0px;">
  <div class="card col col-md-7 offset-md-2">
    <div class="card-body">

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Customer Update</h4>





        <form class="form-sample" id="customer_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('customer.update', $customer->customerId) }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    

                      <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Customer</label>
                            <div class="col-sm-8">
                              <input type="text" id="name" name="name" class="form-control" required value="{{ $customer->name }}">


                            </div>
                          </div>
                        </div>



                        
                        <div class="col-md-12">
                          <div class="form-group row required" >
                            <label class="col-sm-4 col-form-label control-label">Phone</label>
                            <div class="col-sm-8">
                              <input type="tel" pattern = "[+]{0,1}[0-9]{7,13}" title="+8801703188752" minlength="7" maxlength="14"  id="phone" name="phone" class="form-control" required value="{{ $customer->phone }}">

                            </div>
                          </div>
                        </div>

                         <div class="col-md-12">
                          <div class="form-group row required" >
                            <label class="col-sm-4 col-form-label control-label">Address</label>
                            <div class="col-sm-8">
                              <input type="text" id="address" name="address" class="form-control" required value="{{ $customer->address }}">

                            </div>
                          </div>
                        </div>



                        <div class="col-md-12">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">District</label>
                            <div class="col-sm-8">
                                <select class="form-control " name="districtId" id="districtId"  style="width: 100%">

                                     
                                        <option value="{{ $customer->districtId }}">{{ DB::table('districts')->where('districtId', $customer->districtId)->pluck('district')->first() }}</option>

                                        @foreach($districts as $district)
                                            <option value="{{ $district->districtId }}">
                                              {{ title_case($district->district) }}
                                            </option> 
                                        @endforeach   


                                </select>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-12">
                          <div class="form-group row " >
                            <label class="col-sm-4 col-form-label ">Area</label>
                            <div class="col-sm-8">
                              <input type="text" id="area" name="area" class="form-control" value="{{ $customer->area }}">

                            </div>
                          </div>
                        </div> 
                      


                    
                  <div class="col-md-12 text-center mt-4">
                    
                      
                        {{-- <button type="submit" class="btn btn-success mr-2">Save</button> --}}
                        {{-- <button class="btn btn-light" onclick="formClearFunction()">Clear</button> --}}
                        <input type="submit" class="btn btn-success mr-2 float-right"  value="Update">
                        {{-- <input type="button" class="btn btn-danger" onclick="formClearFunction()" value="Clear"> --}}

                        {{-- <button type="button" class="btn btn-danger float-right mr-1" >Cancel</button> --}}
                        <a href="{{ route('customers') }}">
                          <button type="button" class="btn btn-danger  float-right mr-1" >
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
        document.getElementById("customer_insert_form").reset();
    }

</script>


{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

      // for modal
     $('#districtId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select District--'
        },
        allowClear: true,
        // dropdownParent: $("#customerSaveConfirmationModal")
     });

  });
</script>


@endsection