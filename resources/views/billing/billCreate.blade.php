@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Invoice')
@section('pageOnLoad', 'onload=formClearFunction()')

@section('page_content')


{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


<style type="text/css" media="screen">
  fieldset{
   border:1px solid #cccc;
   padding: 8px;
}
</style>


<style type="text/css">
    form{
        margin: 20px 0;
    }
    form input, button{
        padding: 5px;
    }
    table{
        width: 100%;
        margin-bottom: 20px;
    border-collapse: collapse;
    }
    table, th, td{
        border: 1px solid #cdcdcd;
    }
    table th, table td{
        padding: 10px;
        text-align: left;
    }
</style>



<div class="content-wrapper" style="min-height: 0px;" >

    {{-- Notification --}}
    {{-- Notification --}}
    @if (session('successMsg'))
                

      <div class="alert alert-success"  id="alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('successMsg') }}
      </div>

      @if ($errors->any())
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>

      @endif
      
    @endif


    
          <div class="card">
            <div class="card-body">

        

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Invoice</h4>


        


          <form class="form-sample" id="bills_insert_form" method="POST" enctype="multipart/form-data"   {{-- onsubmit="return confirm('Do you really want to proceed?');" --}}  {{-- onsubmit=" return checkForm()" --}} {{-- action="{{ route('bills.insert.pdf') }}" --}}>

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    
                    

                    
                  <input type="number" id="entryPersonId" name="entryPersonId" class="form-control" hidden readonly value="{{ Auth::user()->id }}" >



                  <fieldset class="mb-4" style="margin-top: -40px;">
                      <legend>Invoice</legend>
                      <div class="row ">


                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Invoice No</label>
                            <div class="col-sm-8">
                              <input type="text" id="invoiceNo" name="invoiceNo" class="form-control" required readonly value="{{ 'INV '.sprintf('%05d',((DB::table('bills')->max('billId'))+1) ) }}">


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

                      
                    </fieldset>



                    <fieldset class="mb-4" >
                      <legend>Customer</legend>
                      <div class="row">


                        


                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Customer ID</label>
                            <div class="col-sm-7">

                              {{-- dynamic select/dropdown --}}
                                <select class="form-control m-bot15" name="customerId" id="customerId" required >

                                     
                                        <option value="">--Select Customer--</option>

                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->customerId }}" data-customername="{{ $customer->name }}" data-customermobile="{{ $customer->phone }}" data-customeraddress="{{ $customer->address }}">
                                              {{ $customer->phone.' ('.title_case($customer->name).')' }}
                                            </option> 
                                        @endforeach   


                                </select>


                            </div>

                            <div class="col-sm-1">
                                  <a href="javascript:void(0)">
                                      <i class=" icon-plus text-success" style="font-size:25px;" data-toggle="modal" data-target="#customerSaveConfirmationModal"></i>
                                  </a>
                            </div>



                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Customer Name</label>
                            <div class="col-sm-8">

                                  <input type="text" id="customerName" name="customerName" class="form-control" readonly>

                            </div>
                          </div>
                        </div>



                  
                      
                      </div>

                      <div class="row">


                          


                          <div class="col-md-6">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label ">Customer Address</label>
                              <div class="col-sm-8">

            
                                    <input type="text" id="customerAddress" name="customerAddress" class="form-control" readonly>


                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label ">Mobile</label>
                              <div class="col-sm-8">
                                 
                                    <input type="text" id="customerMobile" name="customerMobile" class="form-control" readonly>


                              </div>
                            </div>
                          </div>



                    
                        
                      </div>
                    </fieldset>

                    


                    



                    <fieldset  class=" mb-4">
                      <legend>Add Items</legend>

                        <div class="row ">
                          <div class="col-md-6">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Item</label>
                              <div class="col-sm-8">
                                  <select class="form-control m-bot15" name="itemId" id="itemId"   >
                                      <option value="">--Select Item Code--</option>
                                      @foreach($items as $item)
                                          <option value="{{ $item->itemId }}" data-description="{{ $item->description }}"  data-instock="{{ $item->itemInStock }}" data-itemcode="{{ $item->itemCode }}" data-price="{{ $item->unitPrice }}" data-item="{{ $item->itemName.' ('.$item->itemCode.')' }}" data-sellingprice="{{ $item->sellingPrice }}" >
                                            {{ $item->itemName.' ('.$item->itemCode.')' }}
                                          </option> 
                                      @endforeach   
                                  </select>
                              </div>
                            </div>
                          </div>


                            <div class="col-md-6">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label ">Description</label>
                                <div class="col-sm-8">
                                  <input type="text" id="description" name="description" class="form-control" readonly >


                                </div>
                              </div>
                            </div>
                            
                          
                        </div>

                        <div class="row ">

                          <div class="col-md-6">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Supplier</label>
                                <div class="col-sm-8">

                                  <select class="form-control m-bot15" name="supplierIdselector" id="supplierIdselector"   >
                                    <option value="">--Select Supplier--</option>
                                  </select>

                                </div>
                              </div>
                            </div>



                        </div>



                        <div class="row ">

                          <div class="col-md-6">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Sold Qty</label>
                                <div class="col-sm-8">
                                  <input type="number" id="soldQty" name="soldQty" class="form-control"  value="0" min="0">


                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label ">In Stock</label>
                                <div class="col-sm-8">
                                  <input type="number" id="instock" name="instock" class="form-control" readonly >


                                </div>
                              </div>
                            </div>

                          

                            

                            


                        </div>

                        <div class="row ">

                          <div class="col-md-6">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Selling Price</label>
                                <div class="col-sm-8">
                                  <input type="number" id="unitPrice" name="unitPrice" class="form-control"  value="0" min="0">


                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label ">Unit Price</label>
                                <div class="col-sm-8">
                                  <input type="number" id="buyingPrice" name="buyingPrice" class="form-control" readonly >


                                </div>
                              </div>
                            </div>


                          
                        </div>


                        <div class="row ">

                          
                            <div class="col-md-6">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label ">Discount (%)</label>
                                <div class="col-sm-8">
                                  <input type="number" id="discountPercent" name="discountPercent" class="form-control"  value="0" min="0" max="100">


                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label ">Total</label>
                                <div class="col-sm-8">
                                  <input type="number" id="totalPrice" name="totalPrice" class="form-control"   value="0" readonly>

                                </div>
                              </div>
                            </div>

                          
                        </div>

                        

                           


                        <input type="button" class="btn btn-primary add_item offset-md-6 mb-5" value="Add Item" id="add_item">



                        <table id="item_table">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Unit Price</th>
                                    <th>Sold Qty</th>
                                    <th>Discount (%)</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>


                                {{-- inputs will be loaded dynamically from user input --}}


                            </tbody>

                        </table>
                      <button type="button" class="btn btn-danger delete-row delete_item" id="delete_item">Delete Item</button>
                      
                      

                      <div class="float-right">

                        <div class="">
                              <div class="form-group row ">
                                <label class="col-sm-6 col-form-label ">Total Amount</label>
                                <div class="col-sm-6">
                                  <input type="number" id="totalAmount" name="totalAmount" class="form-control" required  value="0"  readonly>
                                </div>
                              </div>
                            </div>


                          <div class="">
                              <div class="form-group row required required">
                                <label class="col-sm-6 col-form-label control-label">Discount Amount</label>
                                <div class="col-sm-6">
                                  <input type="number" id="discountAmount" name="discountAmount" class="form-control" required  min="0" value="0">


                                </div>
                              </div>
                            </div>


                            

                            <div class="">
                              <div class="form-group row required ">
                                <label class="col-sm-6 col-form-label control-label">Delivery Charge</label>
                                <div class="col-sm-6">
                                  <input type="number" id="deliveryCharge" name="deliveryCharge" class="form-control"  required  value="0" min="0">

                                </div>
                              </div>
                            </div>

                      
                          


                          

                            <div class="">
                              <div class="form-group row ">
                                <label class="col-sm-6 col-form-label ">Total Receivable Amount</label>
                                <div class="col-sm-6">
                                  <input type="number" id="totalReceivableAmount" name="totalReceivableAmount" class="form-control" required readonly  value="0" >


                                </div>
                              </div>
                            </div>


                            

                            {{-- <p id="demo">hello</p> --}}

                      
                          
                        </div>


                        


                    </fieldset>

                    <fieldset class="mb-5">
                      <legend>Payment Transactions</legend>
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Payment Method</label>
                            <div class="col-sm-8">
                              <select class="form-control m-bot15"  id="pmntMethodTypeId" >
                                <option value="">--Select One--</option>
                                  @foreach($pmntmethodtype->sortBy('pmntMethodType') as $pmntMethodType)
                                      <option value="{{ $pmntMethodType->pmntMethodTypeId }}"  data-pmntmethodtype="{{ $pmntMethodType->pmntMethodType }}">
                                        {{ $pmntMethodType->pmntMethodType }}
                                      </option> 
                                  @endforeach   
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Amount</label>
                            <div class="col-sm-8">
                              <input type="number" id="transactionAmount"  class="form-control"   min="0" value="0" step="0.1">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Date</label>
                            <div class="col-sm-8">
                              <input  type="text" id="transactionDate"  class="form-control"   data-date-format="dd-mm-yyyy"  >
                            </div>
                          </div>
                        </div>

                      </div>

                      <input type="button" class="btn btn-primary add_transaction offset-md-6 mb-5" value="Add Transaction" id="add_transaction">

                      <table id="transaction_table">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Payment Method</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- inputs will be loaded dynamically from user input --}}
                        </tbody>
                      </table>

                      <button type="button" class="btn btn-danger delete-row delete_transaction" id="delete_transaction">Delete Transaction</button>

                    </fieldset>


                    <fieldset>
                      <legend>Status</legend>

                      {{-- <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Payment Method</label>
                              <div class="col-sm-8">
                                  <select class="form-control m-bot15" name="pmntMethodTypeId" id="pmntMethodTypeId" required>
                                        <option value="">--Select One--</option>
                                          @foreach($pmntmethodtype as $pmntMethodType)
                                              <option value="{{ $pmntMethodType->pmntMethodTypeId }}" >
                                                {{ title_case($pmntMethodType->pmntMethodType) }}
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
                                  <select class="form-control m-bot15" name="pmntStatusId" id="pmntStatusId" required>
                                        <option value="">--Select One--</option>
                                          @foreach($paymentstatus as $paymentstatus)
                                              <option value="{{ $paymentstatus->paymentStatusId }}" >
                                                {{ title_case($paymentstatus->paymentStatus) }}
                                              </option> 
                                          @endforeach   
                                  </select>
                              </div>
                            </div>
                          </div>
                      </div> --}}


                      <div class="row ">


                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Delivery Man</label>
                            <div class="col-sm-8">
                              <input type="text" id="deliveryMan" name="deliveryMan" class="form-control" >
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Delivery Status</label>
                            <div class="col-sm-8">
                                <select class="form-control m-bot15" name="deliveryStatusId" id="deliveryStatusId" >
                                    @foreach($deliverystatus as $deliverystatus)
                                        <option value="{{ $deliverystatus->deliveryStatusId }}" {{$deliverystatus->deliveryStatusId==2 ? 'selected':''}}>
                                          {{ title_case($deliverystatus->deliveryStatus) }}
                                        </option> 
                                    @endforeach   
                                </select>
                            </div>
                          </div>
                        </div>                        

                      </div>

                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Special Instruction</label>
                              <div class="col-sm-10">
                                <textarea class="form-control" id="specialInstruction" name="specialInstruction" rows="3"></textarea>
                              </div>
                            </div>
                        </div>
                      </div>


                      

                    </fieldset>





                    
                    <div class="col-md-12 text-center mt-4">
                      
                        {{-- <button type="submit" class="btn btn-success mr-2">Save</button> --}}
                        {{-- <button class="btn btn-light" onclick="formClearFunction()">Clear</button> --}}
                        <input type="submit" class="btn btn-success mr-2"  value="Save" onclick=" return checkFormForSave()" >
                        <input type="submit" class="btn btn-primary mr-2"  value="Save & Print" onclick=" return checkFormForSaveAndPrint()">
                        <input type="button" class="btn btn-danger" onclick="formClearFunction()" value="Clear">
                    </div>





                  </form>
        



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

              <form class="form-sample" id="customer_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('bills.customer.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

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

                                        @foreach(DB::table('districts')->get() as $district)
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
                        <input type="submit" class="btn btn-success mr-2 float-right"  value="Save" >
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
        document.getElementById("bills_insert_form").reset();
    }


    // if the table records is empty user can't submit form
    // if the bill has not item then it has no meaning and generated error
    function checkFormForSave() 
    {
      var tbody = $("#item_table tbody");

      if (tbody.children().length > 0) 
      {
          $("#bills_insert_form").attr("action", "{{ route('bills.insert') }}");
          return confirm('Do you really want to proceed?');
      }
      else if (tbody.children().length == 0) 
      {
          alert('At least one item must be added to the bill !');
          return false;
      }

    }


    // if the table records is empty user can't submit form
    // if the bill has not item then it has no meaning and generated error
    function checkFormForSaveAndPrint() {
        
      var tbody = $("#item_table tbody");

      if (tbody.children().length > 0) 
      {

          $("#bills_insert_form").attr("action", "{{ route('bills.insert.pdf') }}");
          return confirm('Do you really want to proceed?');
      }
      else if (tbody.children().length == 0) {

          alert('At least one item must be added to the bill !');
          return false;
      }

    }




          






</script>



{{-- select 2 script --}}
{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

     $('#customerId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Customer--'
        },
        allowClear: true
     });

     $('#itemId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Item--'
        },
        allowClear: true
     });


     $('#districtId').select2({
          placeholder: {
            id: '', // the value of the option
            text: '--Select District--'
          },
          allowClear: true,
          dropdownParent: $("#customerSaveConfirmationModal")
       });

       $('#pmntMethodTypeId').select2({
          placeholder: {
            id: '', // the value of the option
            text: '--Select payment method--'
          },
          allowClear: true,
       });


  });
</script>


<script type="text/javascript">
  // null handling===========================
  $(' #deliveryCharge').on('change leave', function(e) {

        if ($('#deliveryCharge')[0].value === '') {
          $('#deliveryCharge')[0].value = 0;
        }

    });

  $(' #discountAmount').on('change leave', function(e) {

        if ($('#discountAmount')[0].value === '') {
          $('#discountAmount')[0].value = 0;
        }

    });



  $(' #soldQty').on('change leave', function(e) {

        if ($('#soldQty')[0].value === '') {
          $('#soldQty')[0].value = 0;
        }

    });

  $(' #unitPrice').on('change leave', function(e) {

        if ($('#unitPrice')[0].value === '') {
          $('#unitPrice')[0].value = 0;
        }

    });

  $(' #discountPercent').on('change leave', function(e) {

        if ($('#discountPercent')[0].value === '') {
          $('#discountPercent')[0].value = 0;
        }

    });

  



</script>


<script type="text/javascript">





  // dynamically customer data loading
  $(document).ready(function(e) {
      $('select#customerId').change(function() {
          var customername = $('select#customerId').find(':selected').data('customername');
          var customeraddress = $('select#customerId').find(':selected').data('customeraddress');
          var customermobile = $('select#customerId').find(':selected').data('customermobile');

          $('#customerName').val(customername);
          $('#customerAddress').val(customeraddress);
          $('#customerMobile').val(customermobile);
      });
  });





    // dynamically item data loading
    $(document).ready(function() {
        $('select#itemId').change(function() {

            var buyingPrice = $('select#itemId').find(':selected').data('price');
            var sellingPrice = $('select#itemId').find(':selected').data('sellingprice');
            var description = $('select#itemId').find(':selected').data('description');
            var instock = $('select#itemId').find(':selected').data('instock');


            $('#buyingPrice').val(buyingPrice);
            $('#unitPrice').val(sellingPrice);
            $('#description').val(description);
            $('#instock').val(instock);



            $('#soldQty').val('0');
        });
    });


    
    $(' #itemId, #unitPrice, #soldQty,#discountPercent, #totalPrice').on('keyup keypress blur change click mouseover input', function(e) {

        var totalAmount = parseFloat($('#unitPrice')[0].value, 10) * parseFloat($('#soldQty')[0].value, 10);

        var discountAmount = parseFloat($('#discountPercent')[0].value);

        var discountAmount = (discountAmount*totalAmount)/100;

        $('#totalPrice')[0].value = totalAmount-discountAmount;

    });

    $(' #totalAmount, #discountAmount, #deliveryCharge, #totalReceivableAmount, #totalPrice, #itemId, #unitPrice').on('keyup keypress blur change click mouseover input', function(e) {

        $('#totalReceivableAmount')[0].value = parseFloat($('#totalAmount')[0].value, 10) - parseFloat($('#discountAmount')[0].value, 10)+parseFloat($('#deliveryCharge')[0].value, 10);

    });






</script>


<script type="text/javascript">
    $(document).ready(function(){
        $(".add_item").click(function(){


            // getting items values
            var itemId = $("#itemId").val();
            var supplierId = $("#supplierIdselector").val();
            var itemCode = $('select#itemId').find(':selected').data('item');
            
            
            var description = $('select#itemId').find(':selected').data('description');
            
            var unitPrice = $("#unitPrice").val();
            var soldQty = $("#soldQty").val();
            var discountPercent = $("#discountPercent").val();
            var totalPrice = $("#totalPrice").val();



            if (totalPrice > 0) 
            {

                // adding row
                var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input  class='form-control' type='number' name='itemId[]'  value='" +itemId + 
                                                  "' readonly multiple hidden> "+
                                                  "<textarea class='form-control'  name='itemCode[]' rows='3'  multiple readonly>"+itemCode+"</textarea>" +" </td>"+ 
                                                  "<td>"+ "<textarea class='form-control'  name='description[]' rows='3'  multiple readonly>"+description+"</textarea>" +"</td>"
                                                   +"<td> <input class='form-control' type='number' name='unitPrice[]'  value='" + unitPrice + 
                                                  "' readonly multiple></td><td> <input class='form-control' type='number' name='soldQty[]'  value='" + soldQty +  
                                                  "'  readonly multiple></td>"+"<td> <input class='form-control' type='number' name='discountPercent[]'  value='"+discountPercent+"'  readonly multiple></td>"+"<td> <input class='form-control' type='number' name='totalPrice[]'  value='" + totalPrice + 
                                                  "'  readonly multiple><input  class='form-control' type='number' name='supplierId[]'  value='" +supplierId + "' readonly multiple hidden>"+"</td> </tr>";
                $("#item_table tbody").append(markup);


                // adding value of inserted row totalPrice to totalAmount
                document.getElementById("totalAmount").value = parseFloat(document.getElementById("totalAmount").value , 10)+parseFloat(totalPrice , 10) ;

                 $('#totalReceivableAmount')[0].value = parseFloat($('#totalAmount')[0].value , 10) - parseFloat($('#discountAmount')[0].value , 10)+parseFloat($('#deliveryCharge')[0].value , 10);


                 // after add item clearing fieldset=======
                 $('#itemId').val('');
                 $('#itemCode').val('');
                 $('#description').val('');
                 $('#soldQty').val('0');
                 $('#discountPercent').val('0');
                 $('#instock').val('0');
                 $('#buyingPrice').val('0');
                 $('#totalPrice').val('0');
                 $('#unitPrice').val('0');

                
            }
            else 
            {
                alert('Please enter all required fields !');
                return false;
            }

            

        });


        
        // Find and remove selected table rows
        $(".delete_item").click(function(){
            $("#item_table tbody").find('input[name="record"]').each(function(){
              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                    // subtract value of before delete the row totalPrice from totalAmount
                    var table = document.getElementById("item_table");
                    var totalprice = $("input[name='totalPrice[]']").map(function(){return $(this).val();}).get();
                    var totalprice = totalprice[rowindex-1];
                    console.log(totalprice);

                    document.getElementById("totalAmount").value = parseFloat(document.getElementById("totalAmount").value, 10)-totalprice ;

                     $('#totalReceivableAmount')[0].value = parseFloat($('#totalAmount')[0].value, 10) - parseFloat($('#discountAmount')[0].value, 10)+parseFloat($('#deliveryCharge')[0].value, 10);


                    // removing the checked row
                    $(this).parents("tr").remove();
                }
            });
        });
    });   



    // restricting a field numeric input with respect  to another one
    $('#soldQty').on('keyup keypress blur change click mouseover input', function(e) 
    {
        var maxSoldQty =  parseFloat($('#instock')[0].value, 10);
        var soldQtyInput =  parseFloat($('#soldQty')[0].value, 10);

        if (soldQtyInput > maxSoldQty)
        {
            $('#soldQty')[0].value=maxSoldQty;
            alert("Out of stock !");
        }
            
    });


</script>




<script type="text/javascript">
  $(document).ready(function(){
      $(".add_transaction").click(function(){

          // getting transaction values
          var pmntMethodTypeId = $("#pmntMethodTypeId").val();
          var pmntMethodType = $('select#pmntMethodTypeId').find(':selected').data('pmntmethodtype');
          var transactionAmount = $("#transactionAmount").val();
          var transactionDate = $("#transactionDate").val();


          if (pmntMethodTypeId > 0 &&  transactionAmount>0) 
          {

              // adding row
              var markup = "<tr><td><input type='checkbox' name='record'></td>"+
                                                "<td> <input  class='form-control' type='number' name='pmntMethodTypeId[]'  value='" +pmntMethodTypeId + "' readonly multiple hidden> <input  class='form-control' type='text'  readonly value='"+pmntMethodType+"'></td>"
                                                + "<td> <input  class='form-control' type='text' name='transactionAmount[]' readonly value='"+transactionAmount+"'></td>"
                                                +"<td>  <input  class='form-control' type='text' name='transactionDate[]' readonly value='"+transactionDate+"'></td>"
                                                +"</tr>";
              $("#transaction_table tbody").append(markup);


               // after add item clearing fieldset=======
               $('#pmntMethodTypeId').val('').trigger('change');
               $('#transactionAmount').val('');
               $('#transactionDate').val('');

              
          }
          else 
          {
              alert('Please enter all required fields!');
              return false;
          }

      });


      
      // Find and remove selected table rows
      $(".delete_transaction").click(function(){
          $("#transaction_table tbody").find('input[name="record"]').each(function(){
            if($(this).is(":checked")){

                  var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                  console.log(rowindex);

                  // subtract value of before delete the row totalPrice from totalAmount
                  var table = document.getElementById("transaction_table");

                  // removing the checked row
                  $(this).parents("tr").remove();
              }
          });
      });
  });   



  // restricting a field numeric input with respect  to another one
  $('#soldQty').on('keyup keypress blur change click mouseover input', function(e) 
  {
      var maxSoldQty =  parseFloat($('#instock')[0].value, 10);
      var soldQtyInput =  parseFloat($('#soldQty')[0].value, 10);

      if (soldQtyInput > maxSoldQty)
      {
          $('#soldQty')[0].value=maxSoldQty;
          alert("Out of stock !");
      }
          
  });


</script>




{{-- supplier loading depended of item --}}
<script type="text/javascript">
  $(document).ready(function() {

    $('select[name="itemId"]').on('change', function(){
        var itemId = $(this).val();
        if(itemId) {
            $.ajax({
                url: '/billing/bills/billCreate/suppliers/get/'+itemId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                    $('select[name="supplierIdselector"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="supplierIdselector"]').append('<option value="'+ key +'">' + value + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="supplierIdselector"]').empty();
        }

    });

});
</script>


<script type="text/javascript">
	$(function() {
	   
	   $( "#transactionDate" ).datepicker(
		   { 
			 // maxDate:0,
			 dateFormat: 'dd-mm-yy' 
		 }
	   );
	   
	});
</script>


@endsection