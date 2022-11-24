@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')



@section('pageTitle', 'Expenses')

@section('page_content')


<script src="{{ asset('js/jquery.min.js') }}"></script>


<script type="text/javascript">

    $(function(){

        $('#expenseUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var expenseId = button.data('expenseid') ;
              var expenseTypeId = button.data('expensetypeid') ;
              var expenseType = button.data('expensetype') ;
              var description = button.data('expensedescription') ;
              var purpose = button.data('expensepurpose') ;
              var amount = button.data('expenseamount') ;
              var expenseDate = button.data('expensedate') ;

              var modal = $(this);

              modal.find('.modal-body #expenseId').val(expenseId);
              modal.find('.modal-body #expenseTypeId').val(expenseTypeId);
              modal.find('.modal-body #expenseType').val(expenseType);
              modal.find('.modal-body #description').val(description);
              modal.find('.modal-body #purpose').val(purpose);
              modal.find('.modal-body #amount').val(amount);
              modal.find('.modal-body #expenseDate').val(expenseDate);
        });

    });
</script>




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

				<h4 class="card-title" style="text-align: center;">Add An Expense</h4>





				


          <form class="form-sample" id="supplier_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('expense.expenses.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    


                    <div class="row">


                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Expense Type</label>
                            <div class="col-sm-8">

                                <select class="form-control m-bot15" name="expenseTypeId" id="expenseTypeId" required >

                                        <option value="">--Select Expense Type--</option>

                                        @foreach($expenseTypes as $expensetype)
                                            <option value="{{ $expensetype->expenseTypeId }}">
                                              {{ title_case($expensetype->expenseType)}}
                                            </option> 
                                        @endforeach   


                                </select>


                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Expense Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="description" name="description" rows="2" required></textarea>

                            </div>
                          </div>
                        </div>

                        

                        

                    </div>



                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Purpose</label>
                            <div class="col-sm-8">
                              <input type="text" id="purpose" name="purpose" class="form-control" required>


                            </div>
                          </div>
                        </div>

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Amount</label>
                            <div class="col-sm-8">
                              <input type="number" id="amount" name="amount" class="form-control" required value="0" min="0">

                            </div>
                          </div>
                        </div>


                        



                        
                    </div>

                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label  control-label">Date</label>
                            <div class="col-sm-8">
                              <input type="date" value="{{ date('Y-m-d') }}" id="expenseDate" name="expenseDate" class="form-control" required>
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







<div class="content-wrapper" style="min-height: 0px; margin-top: -20px">
  <div class="card">
    <div class="card-body">

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Expenses</h4>

        {{-- <a href="{{ route('createproduct') }}" class="btn btn-info " style="margin-bottom: 10px; "><span>Add Service/Product Items</span></a> --}}

        <div class="text-md-center">
          @if ( (DB::table('expenses')->count('expenseId'))>0 )
              <a href="{{ route('report.expenses.expensesExcelReportDownload') }}" target="_blank">
                <button class="btn btn-success"><strong>Export to Excel</strong></button>
              </a>
          @else
                <button class="btn btn-success" onClick="alert('No Data Found !')"><strong>Export to Excel</strong></button>
          @endif
        </div>



    {{-- data table start --}}
    {{-- data table start --}}
    <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">Expense Type</th>
                  <th scope="col">Expense Description</th>
                  <th scope="col">Purpose</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Date</th>

                  <th scope="col">Action</th>
              </tr>
          </thead>
          
          <tbody>
               @foreach ($expenses as $expenses)
                  <tr>
                      {{-- <td>{{$loop->index+1}}</td> --}}

                      <td>{{title_case($expenses->expenseType)}}</td>
                      <td>{{$expenses->description}}</td>
                      <td>{{$expenses->purpose}}</td>
                      <td>{{$expenses->amount}}</td>
                      <td>{{ \Carbon\Carbon::parse($expenses->expenseDate)->format('d-m-Y')}}</td>
                      
                      <td id="tdtableaction">

                          {{-- <form  method="post" action="{{ route('supplier.delete', $user->id) }}/hrm/supplier/{{$suppliers->supplierId}}" >
                              {{ csrf_field() }}

                              <a href=""><i class="fa fa-edit"></i></a>
                              <a href=""><i  class="mdi mdi-delete-empty" style="color: red;"></i></a>
                          </form> --}}
                            <div class="d-inline-block">
                                <a role="button" href="#"   data-toggle="modal" data-target="#expenseUpdateModal"  data-expenseid='{{ $expenses->expenseId }}' data-expensetypeid='{{ $expenses->expenseTypeId }}' data-expensetype='{{ $expenses->expenseType }}' data-expensedescription='{{ $expenses->description }}' data-expensepurpose='{{ $expenses->purpose }}' data-expenseamount='{{ $expenses->amount }}' data-expensedate='{{ $expenses->expenseDate }}'><i class="fa fa-edit tooltipster" title="Edit Record ?"></i></a>
                            </div>



                          {{-- @if ( (DB::table('inventory')->where('supplierId', $suppliers->supplierId)->count())==0) --}}
                            <div class="d-inline-block">
                              <form  method="post" action="{{ route('expense.expenses.delete', $expenses->expenseId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
                                  {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <a>
                                      <button type="submit" value="DELETE" class="btn btn-link" >
                                        <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                      </button>
                                    </a>
                              </form>
                            </div>
                          {{-- @endif --}}


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





<!-- Expense Edit Modal -->
<!-- Expense Edit Modal -->
<div class="modal fade" id="expenseUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Update Expense</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              



              {{-- top side of the table --}}
              {{-- <h4 class="card-title offset-4" style="text-align: center;">Add A Role </h4> --}}

              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('expense.expenses.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="expenseId" id="expenseId" value="">
                          



                        <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Expense Type</label>
                            <div class="col-sm-8">

                                <select class="form-control m-bot15" name="expenseTypeId" id="expenseTypeId" required >

                                        <option value="">--Select Expense Type--</option>

                                        @foreach($expenseTypes as $expensetype)
                                            <option value="{{ $expensetype->expenseTypeId }}">
                                              {{ title_case($expensetype->expenseType)}}
                                            </option> 
                                        @endforeach   


                                </select>


                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Expense Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="description" name="description" rows="2" required></textarea>

                            </div>
                          </div>
                        </div>




                      <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Purpose</label>
                            <div class="col-sm-8">
                              <input type="text" id="purpose" name="purpose" class="form-control" required>


                            </div>
                          </div>
                        </div>

                      <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Amount</label>
                            <div class="col-sm-8">
                              <input type="number" id="amount" name="amount" class="form-control" required value="0" min="0">

                            </div>
                          </div>
                        </div>



                      <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label  control-label">Date</label>
                            <div class="col-sm-8">
                              <input type="date" value="{{ date('Y-m-d') }}" id="expenseDate" name="expenseDate" class="form-control" required>
                            </div>
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
<!-- Expense Edit Modal -->
<!-- Expense Edit Modal -->






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