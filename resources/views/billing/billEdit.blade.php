@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Invoice Update')
@section('pageOnLoad', 'onload=formClearFunction()')

@section('page_content')


<script src="{{ asset('js/jquery.min.js') }}"></script>


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

    {{-- message alert --}}
    {{-- message alert --}}
    @if ($errors->any())
        <ul>
          @foreach ($errors->all() as $error)
            <div class="alert alert-danger" id="alert-danger" role="alert" >
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ $error }}
            </div>
          @endforeach
        </ul>
    @endif

          

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


        


          <form class="form-sample" id="bills_update_form" method="post" enctype="multipart/form-data"   {{-- onsubmit="return confirm('Do you really want to proceed?');" --}}  {{-- onsubmit=" return checkForm()" --}} {{-- action="{{ route('bills.insert.pdf') }}" --}}>

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
                              <input type="text" id="invoiceNo" name="invoiceNo" class="form-control" required readonly value="{{ $billData->invoiceNo }}">


                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Invoice Date</label>
                            <div class="col-sm-8">
                              <input type="date"  id="invoiceDate" name="invoiceDate" class="form-control" required value="{{ \Carbon\Carbon::parse($billData->invoiceDate)->format('Y-m-d') }}">


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
                            <div class="col-sm-8">

                              {{-- dynamic select/dropdown --}}
                                <select class="form-control m-bot15 {{ $errors->has('customerId') ? ' is-invalid' : '' }}" name="customerId" id="customerId" required >

                                     
                                        <option value="{{ $billData->customerId }}" >{{ $billData->customerPhone.' ('.title_case($billData->customerName).')' }}</option>
                                        <option value="" >--Select Customer--</option>

                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->customerId }}" data-customername="{{ $customer->name }}" data-customermobile="{{ $customer->phone }}" data-customeraddress="{{ $customer->address }}">
                                              {{ $customer->phone.' ('.title_case($customer->name).')' }}
                                            </option> 
                                        @endforeach   


                                </select>
                                @if ($errors->has('customerId'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('customerId') }}</strong>
                                    </span>
                                @endif


                            </div>



                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Customer Name</label>
                            <div class="col-sm-8">

                                  <input type="text" id="customerName" name="customerName" class="form-control" readonly value="{{ $billData->customerName }}">

                            </div>
                          </div>
                        </div>



                  
                      
                      </div>

                      <div class="row">


                          


                          <div class="col-md-6">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label ">Customer Address</label>
                              <div class="col-sm-8">

            
                                    <input type="text" id="customerAddress" name="customerAddress" class="form-control" readonly value="{{ $billData->customerAddress }}">


                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label ">Mobile</label>
                              <div class="col-sm-8">
                                 
                                    <input type="text" id="customerMobile" name="customerMobile" class="form-control" readonly value="{{ $billData->customerPhone }}">


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
                                              <option value="{{ $item->itemId }}" data-description="{{ $item->description }}"  data-instock="{{ $item->itemInStock }}"data-itemcode="{{ $item->itemCode }}" data-price="{{ $item->unitPrice }}" data-item="{{ $item->itemName.' ('.$item->itemCode.')' }}"  data-sellingprice="{{ $item->sellingPrice }}">
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
                                  <input type="number" id="unitPrice" name="unitPrice" class="form-control" step="0.5"  value="0" min="0">


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

                        

                           


                        <input type="button" class="btn btn-primary add-row offset-md-6 mb-5 add_item"  value="Add Item" id="add_item">



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

                                {{-- existing records --}}
                                @foreach ($billDetailsData as $billDetailData)
                                    <tr>
                                      <td><input type='checkbox' name='record'></td>
                                      <td>
                                        <input  class='form-control' type='number' name='itemId[]'  value='{{ $billDetailData->itemId}}' readonly multiple hidden>
                                        <textarea class='form-control'  name='itemCode[]' rows='3'  multiple readonly>{{ $billDetailData->itemCode.' ('.title_case($billDetailData->itemName).')'}}</textarea>
                                        
                                        <input  class='form-control' type='number' name='billDetailId[]'  value='{{ $billDetailData->billDetailId}}' readonly multiple hidden >
                                        <input  class='form-control' type='number' name='inventoryId[]'  value='{{ $billDetailData->inventoryId}}' readonly multiple hidden >
                                        
                                      </td>
                                      <td>
                                        <textarea class='form-control'  name='description[]' rows='3'  multiple readonly>{{ $billDetailData->description}}</textarea>
                                      </td>
                                      <td>
                                        <input class='form-control' type='number' name='unitPrice[]'  value='{{ $billDetailData->unitPrice}}' readonly multiple>
                                      </td>
                                      <td>
                                        <input class='form-control' type='number' name='soldQty[]'  value='{{ $billDetailData->soldQty}}'  readonly multiple>
                                      </td>
                                      <td>
                                        <input class='form-control' type='number' name='discountPercent[]'  value='{{ $billDetailData->discountPercent}}'  readonly multiple>
                                      </td>
                                      <td>
                                        <input class='form-control' type='number' name='totalPrice[]'  value='{{ $billDetailData->totalPrice}}'  readonly multiple>
                                        <input class='form-control' type='number' name='supplierId[]'  value='{{ $billDetailData->supplierId}}'  readonly multiple hidden>
                                      </td>
                                    </tr>
                                @endforeach
                                
                                {{-- inputs will be loaded dynamically from user input --}}

                            </tbody>

                        </table>
                      <button type="button" class="btn btn-danger delete-row delete_item" id="delete_item">Delete Item</button>
                      
                      

                      <div class="float-right">

                        <div class="">
                              <div class="form-group row ">
                                <label class="col-sm-6 col-form-label ">Total Amount</label>
                                <div class="col-sm-6">
                                  <input type="number" id="totalAmount" name="totalAmount" class="form-control" required  value="{{ $billData->amountTotal }}"  readonly>
                                </div>
                              </div>
                            </div>


                          <div class="">
                              <div class="form-group row required required">
                                <label class="col-sm-6 col-form-label control-label">Discount Amount</label>
                                <div class="col-sm-6">
                                  <input type="number" id="discountAmount" name="discountAmount" class="form-control" required  min="0"   value="{{ $billData->discountAmount }}">


                                </div>
                              </div>
                            </div>


                            

                            <div class="">
                              <div class="form-group row required ">
                                <label class="col-sm-6 col-form-label control-label">Delivery Charge</label>
                                <div class="col-sm-6">
                                  <input type="number" id="deliveryCharge" name="deliveryCharge" class="form-control"  required     value="{{ $billData->deliveryCharge }}" min="0">

                                </div>
                              </div>
                            </div>

                      
                          


                          

                            <div class="">
                              <div class="form-group row ">
                                <label class="col-sm-6 col-form-label ">Total Receivable Amount</label>
                                <div class="col-sm-6">
                                  <input type="number" id="totalReceivableAmount" name="totalReceivableAmount" class="form-control" required readonly  value="{{ $billData->totalReceivableAmount }}">


                                </div>
                              </div>
                            </div>


                            <div class="">
                              <div class="form-group row ">
                                <label class="col-sm-6 col-form-label "> Total Paid</label>
                                <div class="col-sm-6">
                                  <input type="number"  step="0.1" class="form-control"  readonly  value="{{ $billData->totalTransaction }}" >
                                </div>
                              </div>
                            </div>


                            <div class="">
                              <div class="form-group row ">
                                <label class="col-sm-6 col-form-label ">Previous Total Due</label>
                                <div class="col-sm-6">
                                  <input type="number" id="previousTotalDue" step="0.1" class="form-control"  readonly  value="{{ $billData->totalDue }}" >
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
                              <input  type="text" id="transactionDate" class="form-control"   data-date-format="dd-mm-yyyy"  >
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
                            {{-- existing records --}}
                            @foreach ($transactionsData as $transaction)
                                <tr>
                                  <td><input type='checkbox' name='record'></td>
                                  <td>
                                    
                                    <input  class='form-control' type='text' name="pmntMethodTypeId[]"  value='{{ $transaction->pmntMethodTypeId}}' readonly multiple hidden >
                                    <input  class='form-control' type='text'  value='{{ $transaction->pmntMethodType}}' readonly multiple >
                                  </td>
                                  <td>
                                    <input  class='form-control' type='number'  step="0.1" name='transactionAmount[]' readonly value='{{ $transaction->transactionAmount}}'>
                                  </td>
                                  <td> 
                                    <input  class='form-control' type='text' name='transactionDate[]'  readonly multiple value='{{ YmdTodmY($transaction->transactionDate)}}'> 
                                  </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>

                      <button type="button" class="btn btn-danger delete-row delete_transaction" id="delete_transaction">Delete Transaction</button>

                    </fieldset>



                    <fieldset>
                      <legend>Status</legend>


                      <div class="row ">


                          <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Delivery Man</label>
                            <div class="col-sm-8">
                              <input type="text" id="deliveryMan" name="deliveryMan" class="form-control"  value="{{ $billData->deliveryMan }}">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Delivery Status</label>
                            <div class="col-sm-8">
                                <select class="form-control m-bot15" name="deliveryStatusId" id="deliveryStatusId" >
                                      <option value="{{ $billData->deliveryStatusId }}">{{ title_case($billData->deliveryStatus) }}</option>
                                    <option value="">--Select One--</option>
                                        @foreach($deliverystatus as $deliverystatus)
                                            <option value="{{ $deliverystatus->deliveryStatusId }}" >
                                              {{ title_case($deliverystatus->deliveryStatus) }}
                                            </option> 
                                        @endforeach   
                                </select>
                            </div>
                          </div>
                        </div>

                      </div>


                      <div class="col-md-12">
                        <div class="form-group row ">
                          <label class="col-sm-2 col-form-label">Special Instruction</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" id="specialInstruction" name="specialInstruction" rows="3" value="{{ $billData->specialInstruction }}"></textarea>
                          </div>
                        </div>
                      </div>

                    </fieldset>

                    
                    <div class="col-md-12 text-center mt-4">
                        <input type="submit" class="btn btn-success mr-2"  value="Update" onclick=" return checkFormForUpdate()" >
                        <input type="submit" class="btn btn-primary mr-2"  value="Update & Print" onclick=" return checkFormForUpdateAndPrint()">
                        <a href="{{ route('billList').'?billId='.$billData->billId }}"><input type="button" class="btn btn-danger"  value="Cancel"></a>
                    </div>





                  </form>
        



            </div>
          </div>
        </div>










<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("bills_update_form").reset();
    }


    // if the table records is empty user can't submit form
    // if the bill has not item then it has no meaning and generated error
    function checkFormForUpdate() 
    {
      var tbody = $("#item_table tbody");

      if (tbody.children().length > 0) 
      {
          $("#bills_update_form").attr("action", "{{ route('bills.update', $billData->billId) }}");
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
    function checkFormForUpdateAndPrint() {
        
      var tbody = $("#item_table tbody");

      if (tbody.children().length > 0) 
      {

          $("#bills_update_form").attr("action", "{{ route('bills.update.pdf', $billData->billId) }}");
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
            text: '--Select Payment Method--'
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
                                                  "' readonly multiple hidden>  "+
                                                  "<textarea class='form-control'  name='itemCode[]' rows='3'  multiple readonly>"+itemCode+"</textarea>" +" </td>"+ 
                                                  "<td>"+ "<textarea class='form-control'  name='description[]' rows='3'  multiple readonly>"+description+"</textarea>" +"</td>"
                                                   +"<td> <input class='form-control' type='number' name='unitPrice[]'  value='" + unitPrice + 
                                                  "' readonly multiple></td><td> <input class='form-control' type='number' name='soldQty[]'  value='" + soldQty +  
                                                  "'  readonly multiple></td>"+"<td> <input class='form-control' type='number' name='discountPercent[]'  value='"+discountPercent+"'  readonly multiple></td>"+"<td> <input class='form-control' type='number' name='totalPrice[]'  value='" + totalPrice + 
                                                  "'  readonly multiple><input  class='form-control' type='number' name='supplierId[]'  value='" +supplierId + 
                                                  "' readonly multiple hidden>"+"</td></tr>";
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
            $("item_table tbody").find('input[name="record"]').each(function(){
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
                                                + "<td> <input  class='form-control' type='text' name='transactionDate[]' readonly value='"+transactionDate+"'></td>"
                                                +"</tr>";
              $("#transaction_table tbody").append(markup);


               // after add item clearing fieldset=======
               $('#pmntMethodTypeId').val('').trigger('change');
               $('#transactionAmount').val('');

              
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