@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Edit Inventory')

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

        <h4 class="card-title" style="text-align: center;">Update Inventory</h4>






        


          <form class="form-sample" id="inventory_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('inventory.update', $inventoryData->inventoryId) }}"  onsubmit="return confirm('Do you really want to proceed?');">

                           {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    
                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Item</label>
                            <div class="col-sm-8">
                              <select class="form-control m-bot15" name="itemId" id="itemId" required  >

                                     <option value="{{ $inventoryData->itemId }}" value="{{ $inventoryData->itemId }}"   data-itemunitprice="{{ $inventoryData->unitPrice }}" data-itemsellingprice="{{ $inventoryData->sellingPrice }}">{{ $inventoryData->itemName.' ('.$inventoryData->itemCode.')' }}</option>

                                    @foreach(DB::table('item_inventory_billdtls_view')->get() as $items)
                                      <option value="{{ $items->itemId }}"  data-itemname="{{ $items->itemName }}"     data-itemdescription="{{ $items->description }}"  data-iteminstock="{{ $items->itemInStock }}" data-itemunitprice="{{ $items->unitPrice }}" data-itemsellingprice="{{ $items->sellingPrice }}">
                                         {{  title_case($items->itemName.' ('.$items->itemCode.')') }} 
                                      </option> 
                                    @endforeach  

                              </select>

                            </div>

                            

                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Item Name</label>
                            <div class="col-sm-8">
                                
                                    <input type="text" id="itemName" class="form-control" readonly value="{{ DB::table('item')->where('itemId', $inventoryData->itemId)->pluck('itemName')->first() }}">
                               

                            </div>
                          </div>
                        </div>  


                                      
                      
                    </div>




                    <div class="row">


                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Supplier</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" id="bloodGroupId" name="bloodGroupId" class="form-control"> --}}

                              {{-- dynamic select/dropdown --}}
                                <select class="form-control m-bot15" name="supplierId" id="supplierId" required>
                                      <option value="{{ $inventoryData->supplierId }}">{{ $inventoryData->supplierTitle }}</option>

                                        @foreach(App\Suppliers::all() as $supplier)
                                            <option value="{{ $supplier->supplierId }}" >
                                              {{ ucfirst($supplier->supplierTitle) }}
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
                               
                                    <input type="text" id="description"  class="form-control" readonly value="{{ $inventoryData->itemDescription }}">

                            </div>
                          </div>
                        </div>   

                     
                        
                      


                        
                      
                    </div>



                    <div class="row">

                      


                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Quantity</label>
                            <div class="col-sm-8">
                                <input type="number" id="quantity" name="quantity" class="form-control"  required min="0"  value="{{ $inventoryData->quantity }}"  step="0.01">

                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">In Stock</label>
                            <div class="col-sm-8">
                                
                                    <input type="text" id="inStockQty"  class="form-control" readonly value="{{ $inventoryData->itemInStock }}">

                            </div>
                          </div>
                        </div>



                      
                    </div>


                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Buying Price</label>
                            <div class="col-sm-8">
                                  <input type="number" id="unitPrice" name="unitPrice" class="form-control" min="0"  step="0.1" required value="{{ $inventoryData->unitPrice }}">
                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Total Price</label>
                            <div class="col-sm-8">
                                <input type="number" id="totalPrice" name="totalPrice" class="form-control" step="0.1"   readonly value="{{ $inventoryData->totalPrice }}">

                            </div>
                          </div>
                        </div>
                      
                    </div>


                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Selling Price</label>
                            <div class="col-sm-8">
                                  <input type="number" id="sellingPrice" name="sellingPrice" class="form-control" min="0" step="0.1" required value="{{ $inventoryData->sellingPrice }}">
                            </div>
                          </div>
                        </div>


                      
                    </div>




                     <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Paid Amount</label>
                            <div class="col-sm-8">
                                  <input type="number" id="paidAmount" name="paidAmount" class="form-control" min="0"  required value="{{ ($inventoryData->paidAmount)==null ? 0 : $inventoryData->paidAmount }}">
                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Due Amount</label>
                            <div class="col-sm-8">
                                <input type="number" id="dueAmount" name="dueAmount" class="form-control"   readonly value="{{ $inventoryData->dueAmount }}">
                            </div>
                          </div>
                        </div>
                  
                      
                    </div>




                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Unit Param</label>
                            <div class="col-sm-8">
                                {{-- <input type="text" id="unitParam" name="unitParam" class="form-control"> --}}
                                <select class="form-control m-bot15" name="unitParam" id="unitParam" required>
                                      <option value="{{ $inventoryData->unitParam }}">{{ $inventoryData->uom }}</option>

                                        @foreach(DB::table('uom')->get() as $uom)
                                            <option value="{{ $uom->uomId }}" >
                                              {{ ucfirst($uom->uom) }}
                                            </option> 
                                        @endforeach   


                                </select>

                            </div>
                          </div>
                        </div>

                      


                        



                        

                        <input type="number" id="entryPersonId" name="entryPersonId" class="form-control"   value="{{ Auth::user()->id }}" readonly hidden value="{{ Auth::user()->id }}">


                      
                    </div>



                    
                  <div class="col-md-12 text-center mt-4">
                    
                      
                        {{-- <button type="submit" class="btn btn-success mr-2">Save</button> --}}
                        {{-- <button class="btn btn-light" onclick="formClearFunction()">Clear</button> --}}
                        <input type="submit" class="btn btn-success mr-2"  value="Update">
                        {{-- <input type="button" class="btn btn-danger" onclick="formClearFunction()" value="Clear"> --}}
                        <a href="{{ route('inventory') }}">
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
        document.getElementById("inventory_insert_form").reset();
    }

</script>





{{-- select 2 script --}}
{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

     $('#itemId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Item--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true
     });


     $('#supplierId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Supplier--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true
     });


     $('#unitParam').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Unit Param--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true
     });


  });
</script>





<script type="text/javascript">

    
    $('#itemId, #supplierId, #quantity, #unitPrice, #unitParam, #totalPrice, #entryDate, #entryPersonId, #paidAmount, #dueAmount').on('keyup keypress blur change click mouseover input', function(e) {

          $('#totalPrice')[0].value = parseFloat($('#unitPrice')[0].value, 10) * parseFloat($('#quantity')[0].value, 10);
          $('#dueAmount')[0].value = parseFloat($('#totalPrice')[0].value, 10) - parseFloat($('#paidAmount')[0].value, 10);
          
    });


     $('#unitPrice, #itemId').on('keyup keypress blur change click mouseover input enter leave', function(e) {

          // if Buying price is added to the inventory for an item it can't be edited and become readonly
          

          var itemunitprice = $('select#itemId').find(':selected').data('itemunitprice');
          // var unitPrice = $("#unitPrice").val();
          // if (itemunitprice > 0) 
          // {
          //   $('#unitPrice').prop('readonly', true);
          // }
          // else if (itemunitprice == 0 || itemunitprice == null) 
          // {
          //   $('#unitPrice').prop('readonly', false);
          // }
          
    });


    $('#sellingPrice, #itemId').on('keyup keypress blur change click mouseover input enter leave', function(e) {

          // if selling price is added to the inventory for an item it can't be edited and become readonly

          var itemsellingprice = $('select#itemId').find(':selected').data('itemsellingprice');
          // var unitPrice = $("#unitPrice").val();
          // if (itemsellingprice > 0) 
          // {
          //   $('#sellingPrice').prop('readonly', true);
          //   console.log(sellingPrice);
          // }
          // else if (itemsellingprice == 0 || itemsellingprice == null) 
          // {
          //   $('#sellingPrice').prop('readonly', false);
          // }
          
    });


    





    // dynamically item data loading
    $(document).ready(function() {
        $('select#itemId').change(function() {

            var itemName = $('select#itemId').find(':selected').data('itemname');
            var itemDescription = $('select#itemId').find(':selected').data('itemdescription');
            var itemInStock = $('select#itemId').find(':selected').data('iteminstock');
            var unitPrice = $('select#itemId').find(':selected').data('itemunitprice');
            var sellingPrice = $('select#itemId').find(':selected').data('itemsellingprice');



            $('#itemName').val(itemName);
            $('#description').val(itemDescription);
            $('#inStockQty').val(itemInStock);
            $('#unitPrice').val(unitPrice);
            $('#sellingPrice').val(sellingPrice);


        });
    });


</script>


<script type="text/javascript">
  // restricting a field numeric input with respect  to another one
    $('#totalPrice, #paidAmount, #dueAmount').on('keyup keypress blur change click mouseover input', function(e) 
    {
        var totalPrice =  parseFloat($('#totalPrice')[0].value, 10);
        var paidAmount =  parseFloat($('#paidAmount')[0].value, 10);

        if (paidAmount > totalPrice)
        {
            $('#paidAmount')[0].value=totalPrice;
            alert("Please enter paid amount less than or equal to total price !");
        }
            
    });
</script>



@endsection