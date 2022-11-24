@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Customers')

@section('page_content')




<script src="{{ asset('js/jquery.min.js') }}"></script>





<div class="content-wrapper" style="min-height: 0px;">
  <div class="card">
    <div class="card-body">

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Customers</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#customerSaveConfirmationModal" ><span>+ Create New Customer</span></a>

        {{-- <a href="{{ route('createproduct') }}" class="btn btn-info " style="margin-bottom: 10px; "><span>Add Service/Product Customers</span></a> --}}



    {{-- data table start --}}
    {{-- data table start --}}
    <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">Customer Name</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Address</th>
                  <th scope="col">District</th>
                  <th scope="col">Area</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          
          <tbody>
               @foreach ($customerData as $customer)
                  <tr>
                      {{-- <td>{{$loop->index+1}}</td> --}}

                      <td>{{$customer->name}}</td>
                      <td>{{$customer->phone}}</td>
                      <td>{{$customer->address}}</td>
                      <td>{{$customer->district}}</td>
                      <td>{{title_case($customer->area)}}</td>
                      
                      <td id="tdtableaction">

                          {{-- <form  method="post" action="{{ route('supplier.delete', $user->id) }}/hrm/supplier/{{$suppliers->supplierId}}" >
                              {{ csrf_field() }}

                              <a href=""><i class="fa fa-edit"></i></a>
                              <a href=""><i  class="mdi mdi-delete-empty" style="color: red;"></i></a>
                          </form> --}}
                            <div class="d-inline-block  tooltipster" title="Edit selected Customer ?">
                              <a href=" {{ route('customer.show', $customer->customerId) }}"><i class="fa fa-edit"></i></a>

                          </div>


                          @if ( $customer->isCustomerUsed == 0 )
                            <div class="d-inline-block  tooltipster" title="Delete selected Customer ?">
                                <form  method="post" action="{{ route('customer.delete', $customer->customerId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="_method" value="DELETE">

                                    <a>
                                      <button type="submit" value="DELETE" class="btn btn-link" >
                                        <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                      </button>
                                    </a>

                              </form>
                            </div>
                          @endif





                      </td>
                  </tr>
                @endforeach

             
             
          </tbody>
      </table>
    {{-- data table end --}}
    {{-- data table end --}}








    </div>
  </div>
</div>







<!-- Customer Save Modal -->
<!-- Customer Save Modal -->
<div class="modal fade" id="customerSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Add A Customer</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              



              {{-- top side of the table --}}
              {{-- <h4 class="card-title offset-4" style="text-align: center;">Add A Role </h4> --}}

              <form class="form-sample" id="customer_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('customer.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    

                      <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Customer</label>
                            <div class="col-sm-8">
                              <input type="text" id="name" name="name" class="form-control" required>


                            </div>
                          </div>
                        </div>



                        
                        <div class="col-md-12">
                          <div class="form-group row required" >
                            <label class="col-sm-4 col-form-label control-label">Phone</label>
                            <div class="col-sm-8">
                              <input type="tel" pattern = "[+]{0,1}[0-9]{7,13}" title="+8801703188752" minlength="7" maxlength="14"  id="phone" name="phone" class="form-control" required>

                            </div>
                          </div>
                        </div>

                         <div class="col-md-12">
                          <div class="form-group row required" >
                            <label class="col-sm-4 col-form-label control-label">Address</label>
                            <div class="col-sm-8">
                              <input type="text" id="address" name="address" class="form-control" required>

                            </div>
                          </div>
                        </div>


                        <div class="col-md-12">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">District</label>
                            <div class="col-sm-8">
                                <select class="form-control " name="districtId" id="districtId"  style="width: 100%">

                                     
                                        <option value="">--Select District--</option>

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
                              <input type="text" id="area" name="area" class="form-control" >

                            </div>
                          </div>
                        </div>



                    
                  <div class="col-md-12 text-center mt-4">
                    
                      
                        {{-- <button type="submit" class="btn btn-success mr-2">Save</button> --}}
                        {{-- <button class="btn btn-light" onclick="formClearFunction()">Clear</button> --}}
                        <input type="submit" class="btn btn-success mr-2 float-right"  value="Save">
                        {{-- <input type="button" class="btn btn-danger" onclick="formClearFunction()" value="Clear"> --}}
                        <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                    </div>


                  </form>

               
      


      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save</button>
      </div> --}}
    </div>
  </div>
</div>
<!-- Customer Save Modal -->
<!-- Customer Save Modal -->







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
        dropdownParent: $("#customerSaveConfirmationModal")
     });

  });
</script>



@endsection