@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Bills')

@section('page_content')


<script src="{{ asset('js/jquery.min.js') }}"></script>


<style type="text/css" media="screen">
  fieldset{
   border:1px solid #cccc;
   padding: 8px;
}
</style>


<div class="content-wrapper" style="min-height: 0px;">

    {{-- Notification --}}
    {{-- Notification --}}
    @if (session('successMsg'))
                

      <div class="alert alert-success"  id="alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('successMsg') }}
      </div>


      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif


    
          <div class="card">
            <div class="card-body">

        

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Add A Bill</h4>


        


          <form class="form-sample" id="bills_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('bills.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    
                    



                    

                    

                    <fieldset class="mb-5">
                      <legend>Customer</legend>
                      <div class="row">


                        


                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Customer ID</label>
                            <div class="col-sm-8">

                              {{-- dynamic select/dropdown --}}
                                <select class="form-control m-bot15" name="customerId" id="customerId" required onchange ="location = this.options[this.selectedIndex].value;">

                                      @if (request()->has('customerId'))
                                        <option value="{{ request('customerId') }}">{{ DB::table('customers')->where('customerId', request('customerId'))->pluck('phone')->first() }}</option>
                                      @else 
                                        <option value="">--Select Customer Phone--</option>
                                      @endif

                                        @foreach(DB::table('customers')->get() as $customer)
                                            <option value="?customerId={{ $customer->customerId }}&itemId={{ request('itemId') }}" >
                                              {{ $customer->phone }}
                                            </option> 
                                        @endforeach   


                                </select>


                            </div>



                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Customer Name</label>
                            <div class="col-sm-8">

                               @if (request()->has('customerId'))
                                  <input type="text" id="customerName" name="customerName" class="form-control" readonly value="{{ title_case(DB::table('customers')->where('customerId', request('customerId'))->pluck('name')->first()) }}">
                              @else 
                                  <input type="text" id="customerName" name="customerName" class="form-control" readonly>
                              @endif

                            </div>
                          </div>
                        </div>



                  
                      
                      </div>

                      <div class="row">


                          


                          <div class="col-md-6">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label ">Customer Address</label>
                              <div class="col-sm-8">

                                @if (request()->has('customerId'))

                                    <input type="text" id="customerAddress" name="customerAddress" class="form-control" readonly value="{{ title_case(DB::table('customers')->where('customerId', request('customerId'))->pluck('address')->first()) }}">
                                @else 
                                    <input type="text" id="customerAddress" name="customerAddress" class="form-control" readonly>
                                @endif


                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label ">Mobile</label>
                              <div class="col-sm-8">
                                @if (request()->has('customerId'))

                                    <input type="text" id="customerMobile" name="customerMobile" class="form-control" readonly value="{{ title_case(DB::table('customers')->where('customerId', request('customerId'))->pluck('phone')->first()) }}">
                                @else 
                                    <input type="text" id="customerMobile" name="customerMobile" class="form-control" readonly>
                                @endif


                              </div>
                            </div>
                          </div>



                    
                        
                      </div>
                    </fieldset>

                    

                    <fieldset class="mb-5">
                      <legend>Item</legend>

                      <div class="row ">


                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Item Code</label>
                            <div class="col-sm-8">

                              {{-- dynamic select/dropdown --}}
                                <select class="form-control m-bot15" name="itemId" id="itemId" required  onchange ="location = this.options[this.selectedIndex].value;">
                                      @if (request()->has('itemId'))
                                        <option value="{{ request('itemId') }}">{{ DB::table('item')->where('itemId', request('itemId'))->pluck('itemCode')->first() }}</option>
                                      @else 

                                        <option value="">--Select Item Code--</option>

                                      @endif

                                        @foreach(DB::table('item')->get() as $item)
                                            <option value="?customerId={{ request('customerId') }}&itemId={{ $item->itemId }}" >
                                              {{ $item->itemCode }}
                                            </option> 
                                        @endforeach   


                                </select>


                            </div>



                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Item Name</label>
                            <div class="col-sm-8">

                                @if (request()->has('itemId'))
                                    <input type="text" id="itemName" name="itemName" class="form-control" readonly value="{{ DB::table('item')->where('itemId', request('itemId'))->pluck('itemName')->first() }}">
                                @else 
                                    <input type="text" id="itemName" name="itemName" class="form-control" readonly >
                                @endif

                            </div>
                          </div>
                        </div>

                      
                      </div>


                      <div class="row ">

                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">In Stock</label>
                            <div class="col-sm-8">

                                @if (request()->has('itemId'))
                                    <input type="text" id="insStockQty" name="insStockQty" class="form-control" readonly 
                                    value="{{ (DB::table('inventory')->where('itemId', request('itemId'))->sum('quantity') )-(DB::table('bills')->where('itemId', request('itemId'))->sum('soldQty') ) }}"
                                    >
                                @else 
                                    <input type="text" id="insStockQty" name="insStockQty" class="form-control" readonly >
                                @endif

                            </div>
                          </div>
                        </div>



                          <div class="col-md-6">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Unit Price</label>
                              <div class="col-sm-8">
                                <input type="number" id="unitPrice" name="unitPrice" class="form-control" required value="0" min="0">


                              </div>
                            </div>
                          </div>

                          

                    
                        
                      </div>


                      <div class="row ">


                        <div class="col-md-6">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Sold Qty</label>
                              <div class="col-sm-8">
                                <input type="number" id="soldQty" name="soldQty" class="form-control" required value="0" >


                              </div>
                            </div>
                          </div>


                          <div class="col-md-6">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Total</label>
                              <div class="col-sm-8">
                                <input type="number" id="totalPrice" name="totalPrice" class="form-control" required  value="0" readonly>

                              </div>
                            </div>
                          </div>

                          

                    
                        
                      </div>

                      <div class="row ">

                        <div class="col-md-6">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Discount Amount</label>
                              <div class="col-sm-8">
                                <input type="number" id="discountAmount" name="discountAmount" class="form-control" required  min="0" value="0">


                              </div>
                            </div>
                          </div>


                          <div class="col-md-6">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Delivery Charge</label>
                              <div class="col-sm-8">
                                <input type="number" id="deliveryCharge" name="deliveryCharge" class="form-control" required  value="0" min="0">


                              </div>
                            </div>
                          </div>

                    
                        
                      </div>


                      <div class="row ">

                        

                          <div class="col-md-6">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Total Receivable Amount</label>
                              <div class="col-sm-8">
                                <input type="number" id="totalReceivableAmount" name="totalReceivableAmount" class="form-control" required readonly  value="0" min="0">


                              </div>
                            </div>
                          </div>

                    
                        
                      </div>
                    </fieldset>


                    <fieldset class="mb-5">
                      <legend>Invoice</legend>
                      <div class="row ">


                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Invoice No</label>
                            <div class="col-sm-8">
                              <input type="text" id="invoiceNo" name="invoiceNo" class="form-control" required>


                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Invoice Date</label>
                            <div class="col-sm-8">
                              <input type="date" value="{{ date('Y-m-d') }}" id="invoiceDate" name="invoiceDate" class="form-control" required>


                            </div>
                          </div>
                        </div>

                  
                      
                      </div>

                      <div class="row ">


                        

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Delivery Man</label>
                            <div class="col-sm-8">
                              <input type="text" id="deliveryMan" name="deliveryMan" class="form-control" required>


                            </div>
                          </div>
                        </div>

                  
                      
                    </div>
                    </fieldset>



                    <fieldset>
                      <legend>Status</legend>

                      <div class="row ">


                        

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">QC Status</label>
                            <div class="col-sm-8">

                              {{-- dynamic select/dropdown --}}
                                <select class="form-control m-bot15" name="qcStatusId" id="qcStatusId" >
                                      <option value="">--Select One--</option>

                                        @foreach(DB::table('qcstatus')->get() as $qcstatus)
                                            <option value="{{ $qcstatus->qcStatusId }}" >
                                              {{ $qcstatus->qcStatus }}
                                            </option> 
                                        @endforeach   


                                </select>


                            </div>



                          </div>
                        </div>


                      

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Call</label>
                            <div class="col-sm-8">

                              {{-- dynamic select/dropdown --}}
                                <select class="form-control m-bot15" name="callId" id="callId" required>
                                      <option value="">--Select One--</option>

                                        @foreach(DB::table('billcalls')->get() as $billcall)
                                            <option value="{{ $billcall->billCallId }}" >
                                              {{ $billcall->billCall }}
                                            </option> 
                                        @endforeach   


                                </select>


                            </div>



                          </div>
                        </div>

                  
                      
                      </div>


                      <div class="row ">


                         

                          <div class="col-md-6">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Delivery Status</label>
                              <div class="col-sm-8">

                                {{-- dynamic select/dropdown --}}
                                  <select class="form-control m-bot15" name="deliveryStatusId" id="deliveryStatusId" required>
                                        <option value="">--Select One--</option>

                                          @foreach(DB::table('deliverystatus')->get() as $deliverystatus)
                                              <option value="{{ $deliverystatus->deliveryStatusId }}" >
                                                {{ $deliverystatus->deliveryStatus }}
                                              </option> 
                                          @endforeach   


                                  </select>


                              </div>


                            </div>
                          </div>



                          


                          <div class="col-md-6">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Payment Status</label>
                              <div class="col-sm-8">

                                {{-- dynamic select/dropdown --}}
                                  <select class="form-control m-bot15" name="pmntStatusId" id="pmntStatusId" required>
                                        <option value="">--Select One--</option>

                                          @foreach(DB::table('paymentstatus')->get() as $paymentstatus)
                                              <option value="{{ $paymentstatus->paymentStatusId }}" >
                                                {{ $paymentstatus->paymentStatus }}
                                              </option> 
                                          @endforeach   


                                  </select>


                              </div>


                            </div>
                          </div>


                    
                        
                      </div>



                    </fieldset>





                    
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






<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("bills_insert_form").reset();
    }

</script>



{{-- select 2 script --}}
{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

     $('#customerId').select2({
        placeholder: {
          id: '1234', // the value of the option
          text: '--Select Customer Phone--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true
     });

     $('#itemId').select2({
        placeholder: {
          id: '1234', // the value of the option
          text: '--Select Item--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true
     });




  });
</script>



<script type="text/javascript">

    // restricting a field numeric input with respect  to another one
    $('#soldQty').on('keyup keypress blur change click mouseover input', function(e) 
    {
        var maxSoldQty =  parseInt($('#insStockQty')[0].value);
        var soldQtyInput =  parseInt($('#soldQty')[0].value);

        if (soldQtyInput > maxSoldQty)
        {
            $('#soldQty')[0].value=maxSoldQty;
            alert("Sold Quatity cannot be greater than stock quantity");
        }
            
    });

    
    $('#invoiceNo, #customerId, #invoiceDate, #deliveryMan, #itemId, #unitPrice, #soldQty,  #totalPrice, #discountAmount, #deliveryCharge, #totalReceivableAmount, #specialInstruction,  #qcStatusId, #callId, #deliveryStatusId, #pmntStatusId ').on('keyup keypress blur change click mouseover input', function(e) {



          $('#totalPrice')[0].value = parseInt($('#unitPrice')[0].value) * parseInt($('#soldQty')[0].value);

          $('#totalReceivableAmount')[0].value = parseInt($('#totalPrice')[0].value) - parseInt($('#discountAmount')[0].value) + parseInt($('#deliveryCharge')[0].value);

          
    });

</script>



@endsection