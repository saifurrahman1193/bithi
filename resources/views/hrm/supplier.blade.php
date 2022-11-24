@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Supplier')

@section('page_content')


<script src="{{ asset('js/jquery.min.js') }}"></script>




<div class="content-wrapper" style="min-height: 0px;">

  {{-- Notification --}}
    {{-- Notification --}}
    @if (session('successMsg'))
                

      <div class="alert alert-success" id="alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('successMsg') }}
      </div>


    @endif

    
          <div class="card">
            <div class="card-body">

				

				{{-- top side of the table --}}

				<h4 class="card-title" style="text-align: center;">Add A Supplier</h4>






				


          <form class="form-sample" id="supplier_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('supplier.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

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
                              <input type="text" id="supplierTitle" name="supplierTitle" class="form-control" required>


                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Contact Person Name</label>
                            <div class="col-sm-8">
                              <input type="text" id="contactPerson" name="contactPerson" class="form-control" required>


                            </div>
                          </div>
                        </div>

                        

                        

                    </div>



                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Email</label>
                            <div class="col-sm-8">
                              <input type="email" id="email" name="email" class="form-control" >


                            </div>
                          </div>
                        </div>

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Years Of Experience</label>
                            <div class="col-sm-8">
                              <input type="number" id="yearsOfExperience" name="yearsOfExperience" class="form-control" required>


                            </div>
                          </div>
                        </div>


                        



                        
                    </div>

                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label  control-label">Company Address</label>
                            <div class="col-sm-8">
                              <textarea class="form-control" id="companyAddress" name="companyAddress" rows="2" required></textarea>


                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Contact Number</label>
                            <div class="col-sm-8">
                              <input type="tel" pattern = "[+]{0,1}[0-9]{7,13}" title="+8801703188752" minlength="7" maxlength="14" id="contactNumber" name="contactNumber" class="form-control" required >


                            </div>
                          </div>
                        </div>


                                        


                        



                    </div>



                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Reference</label>
                            <div class="col-sm-8">
                              <input type="text" id="reference" name="reference" class="form-control" >


                            </div>
                          </div>
                        </div>  

                        

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Remarks</label>
                            <div class="col-sm-8">
                              <textarea class="form-control" id="remarks" name="remarks" rows="2"></textarea>


                            </div>
                          </div>
                        </div>



                    </div>


                   










                  <div class="col-md-12 text-center mt-4">


                  
                      {{-- <button type="submit" class="btn btn-success mr-2">Save</button> --}}
                      {{-- <button class="btn btn-light" onclick="formClearFunction()">Clear</button> --}}
                      <input type="submit" class="btn btn-success mr-2"  value="Save">
                      <input type="button" class="btn btn-danger" onclick="formClearFunction()" value="Clear">
                  </div>


                  </form>
        










            </div>
          </div>
        </div>









<div class="content-wrapper" style="min-height: 0px;">
  <div class="card">
    <div class="card-body">

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Suppliers</h4>

        {{-- <a href="{{ route('createproduct') }}" class="btn btn-info " style="margin-bottom: 10px; "><span>Add Service/Product Items</span></a> --}}



    {{-- data table start --}}
    {{-- data table start --}}
    <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  <th scope="col">#</th>
                  <th scope="col">Supplier Title</th>
                  <th scope="col">Contact Person</th>
                  <th scope="col">Years Of Experience</th>
                  <th scope="col">Reference</th>
                  <th scope="col">Remarks</th>
                  <th scope="col">Company Address</th>
                  <th scope="col">Contact Number</th>
                  <th scope="col">email</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          
          <tbody>
               @foreach (DB::table('supplier_view')->get() as $suppliers)
                  <tr>
                      <td>{{$loop->index+1}}</td>

                      <td>{{$suppliers->supplierTitle}}</td>
                      <td>{{$suppliers->contactPerson}}</td>

                      <td>{{$suppliers->yearsOfExperience}}</td>
                      <td>{{$suppliers->reference}}</td>
                      <td>{{$suppliers->remarks}}</td>

                      <td>{{$suppliers->companyAddress}}</td>
                      <td>{{$suppliers->contactNumber}}</td>
                      <td>{{$suppliers->email}}</td>
                      
                      <td id="tdtableaction">

                          {{-- <form  method="post" action="{{ route('supplier.delete', $user->id) }}/hrm/supplier/{{$suppliers->supplierId}}" >
                              {{ csrf_field() }}

                              <a href=""><i class="fa fa-edit"></i></a>
                              <a href=""><i  class="mdi mdi-delete-empty" style="color: red;"></i></a>
                          </form> --}}
                            <div class="d-inline-block">
                                <a href=" {{ route('supplier.show', $suppliers->supplierId) }}"><i class="fa fa-edit"></i></a>
                            </div>



                          @if ( $suppliers->isSuppUsed==0)
                            <div class="d-inline-block">
                              <form  method="post" action="{{ route('supplier.delete', $suppliers->supplierId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
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






<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("supplier_insert_form").reset();
    }

</script>



{{-- select 2 script --}}
{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

     $('#departmentId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Department--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true
     });

  });
</script>



@endsection