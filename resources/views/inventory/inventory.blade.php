@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Inventory')

@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>




<script>
        $(document).ready(function() {

            // with sxrol-x
            $('#datatableInventoryWScroll').DataTable( {
                "order": [[ 10, "desc" ]],              
                "pagingType": "simple_numbers",
                "scrollX": true,
                "responsive": true,
                "autoWidth": false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },

            } );
        } );
</script>



<script type="text/javascript">

    $(function(){

        $('#returnProductModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var inventoryId = button.data('inventoryid') ;
              var prodReturnDate = button.data('prodreturndate') ;
              var prodReturnItem = button.data('prodreturnitem') ;
              var prodReturnSupplier = button.data('prodreturnsupplier') ;
              var prodReturnRecQuantity = button.data('prodreturnrecquantity') ;
              var returnProductQty = button.data('returnproductqty') ;
              var prodReturnItemInStock = button.data('returnproductinstock') ;
              var causeOfReturns = button.data('causeofreturns') ;




              var modal = $(this);

              modal.find('.modal-body #inventoryId').val(inventoryId);
              modal.find('.modal-body #prodReturnDate').val(prodReturnDate);
              modal.find('.modal-body #prodReturnItem').val(prodReturnItem);
              modal.find('.modal-body #prodReturnSupplier').val(prodReturnSupplier);
              modal.find('.modal-body #prodReturnRecQuantity').val(prodReturnRecQuantity);
              modal.find('.modal-body #returnProductQty').val(returnProductQty);
              modal.find('.modal-body #prodReturnItemInStock').val(prodReturnItemInStock);
              modal.find('.modal-body #causeOfReturns').val(causeOfReturns);

        });

    });
</script>



<div class="content-wrapper" style="min-height: 0px;">

  {{-- Notification --}}
    {{-- Notification --}}
    @if (session('successMsg'))
                

      <div class="alert alert-success"  id="alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('successMsg') }}
      </div>


    @endif


    
          <div class="card">
            <div class="card-body">

        

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Add A Inventory</h4>





          <form class="form-sample" id="inventory_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('inventory.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    
                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Item</label>
                            <div class="col-sm-7">
                              <select class="form-control m-bot15" name="itemId" id="itemId" required  >

                                    <option value="">--Select Item--</option>

                                    @foreach(DB::table('item_inventory_billdtls_view')->get() as $items)
                                      <option value="{{ $items->itemId }}"  data-itemname="{{ $items->itemName }}"     data-itemdescription="{{ $items->description }}"  data-iteminstock="{{ $items->itemInStock }}" 
                                        data-itemunitprice="{{ $items->lastUnitPrice }}" data-itemsellingprice="{{ $items->lastSellingPrice }}" data-unitparam="{{ $items->unitParam }}"  data-supplierid="{{ $items->supplierId }}" >
                                         {{  title_case($items->itemName.' ('.$items->itemCode.')') }} 
                                      </option> 
                                    @endforeach  

                              </select>

                            </div>

                            <div class="col-sm-1">
                                  <a href="javascript:void(0)">
                                      <i class=" icon-plus text-success" style="font-size:25px;" data-toggle="modal" data-target="#itemSaveConfirmationModal"></i>
                                  </a>
                            </div>

                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Item Name</label>
                            <div class="col-sm-8">
                                
                                    <input type="text" id="itemName" name="itemName" class="form-control" readonly >
                               

                            </div>
                          </div>
                        </div>  


                                      
                      
                    </div>




                    <div class="row">


                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Supplier</label>
                            <div class="col-sm-7">
                                <select class="form-control m-bot15" name="supplierId" id="supplierId" required>
                                      <option value="">--Select One--</option>

                                        @foreach(App\Suppliers::all() as $supplier)
                                            <option value="{{ $supplier->supplierId }}" >
                                              {{ ucfirst($supplier->supplierTitle) }}
                                            </option> 
                                        @endforeach   
                                </select>
                            </div>
                            <div class="col-sm-1">
                                  <a href="javascript:void(0)">
                                      <i class=" icon-plus text-success" style="font-size:25px;" data-toggle="modal" data-target="#supplierSaveConfirmationModal"></i>
                                  </a>
                            </div>

                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Customer</label>
                            <div class="col-sm-8">
                                <select class="form-control m-bot15" name="customerId" id="customerId" >
                                      <option value="">--Select One--</option>

                                        @foreach(DB::table('customers')->get() as $customer)
                                            <option value="{{ $customer->customerId }}" >
                                              {{ $customer->name.' '.$customer->phone.' '.$customer->address }}
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



                    <div class="row">

                      


                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Quantity</label>
                            <div class="col-sm-8">
                                <input type="number" id="quantity" name="quantity" class="form-control"  required min="0" step="0.01">

                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">In Stock</label>
                            <div class="col-sm-8">
                                
                                    <input type="text" id="inStockQty" name="inStockQty" class="form-control" readonly value="0">

                            </div>
                          </div>
                        </div>



                      
                    </div>


                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Buying Price</label>
                            <div class="col-sm-8">

                                  <input type="number" id="unitPrice" name="unitPrice" class="form-control" min="0" value="0" required step="0.1" >

                            </div>
                          </div>
                        </div>





                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Total Price</label>
                            <div class="col-sm-8">
                                <input type="number" id="totalPrice" name="totalPrice" class="form-control"   readonly value="0">

                            </div>
                          </div>
                        </div>

                      
                    </div>


                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Selling Price</label>
                            <div class="col-sm-8">

                                  <input type="number" id="sellingPrice" name="sellingPrice" class="form-control" min="0" value="0" step="0.1" required >

                            </div>
                          </div>
                        </div>




                      
                    </div>



                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Paid Amount</label>
                            <div class="col-sm-8">
                                  <input type="number" id="paidAmount" name="paidAmount" class="form-control" min="0"  required >
                            </div>
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Due Amount</label>
                            <div class="col-sm-8">
                                <input type="number" id="dueAmount" name="dueAmount" class="form-control"   readonly value="0">
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
                                      <option value="">--Select One--</option>

                                        @foreach(DB::table('uom')->get() as $uom)
                                            <option value="{{ $uom->uomId }}" >
                                              {{ ucfirst($uom->uom) }}
                                            </option> 
                                        @endforeach   


                                </select>

                            </div>
                          </div>
                        </div>

                      


                        <input type="date" id="entryDate" name="entryDate" class="form-control" value="{{ date('Y-m-d') }}" readonly hidden>



                        

                        <input type="number" id="entryPersonId" name="entryPersonId" class="form-control"   value="{{ Auth::user()->id }}" readonly hidden value="{{ Auth::user()->id }}">


                      
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

        <h4 class="card-title" style="text-align: center;">Inventory</h4>

        {{-- <a href="{{ route('createproduct') }}" class="btn btn-info " style="margin-bottom: 10px; "><span>Add Service/Product Items</span></a> --}}



    {{-- data table start --}}
    {{-- data table start --}}
    <table id="datatableInventoryWScroll" class="table table-striped table-bordered table-hover " width="100%" >
          <thead>
              <tr class="bg-primary text-light">
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">Inventory Id</th>
                  <th scope="col">Category</th>
                  <th scope="col">Item</th>
                  <th scope="col">Item Description</th>
                  <th scope="col">Supplier</th>
                  <th scope="col">Customer</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Unit Param</th>
                  <th scope="col">Buying Price</th>
                  <th scope="col">Total Price</th>
                  <th scope="col">Selling Price</th>
                  <th scope="col">Paid Amount</th>
                  <th scope="col">Due Amount</th>
                  <th scope="col">Entry Date</th>
                  <th scope="col">Entry Person</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          
          <tbody>
               @foreach (DB::table('inventory_view')->get() as $inventory)
                  <tr>
                      {{-- <td>{{$loop->index+1}}</td> --}}

                      <td>  {{$inventory->inventoryId}}</td>
                      <td>  {{$inventory->category}}</td>

                      <td> {{$inventory->itemName.' ('.$inventory->itemCode.')'}}</td>
                      <td> {{$inventory->itemDescription}}</td>

                      <td>{{$inventory->supplierTitle}}</td>
                      <td>{!! $inventory->customerName.'<br><br>'.$inventory->customerPhone.'<br><br>'.$inventory->customerAddress !!}</td>
                      <td>{{$inventory->quantity}}</td>
                      <td>{{title_case($inventory->uom)}}</td>
                      <td>{{$inventory->unitPrice}}</td>
                      <td>{{$inventory->totalPrice}}</td>
                      <td>{{$inventory->sellingPrice}}</td>
                      <td>{{$inventory->paidAmount}}</td>
                      <td>{{$inventory->dueAmount}}</td>
                      <td>{{ \Carbon\Carbon::parse($inventory->entryDate)->format('d-m-Y')}}</td>
                      <td>
                            {{ title_case($inventory->entryPerson) }}
                      </td>


                      <td id="tdtableaction">

                          <div class="d-inline-block  tooltipster" title="Edit selected inventory ?">
                            <a href=" {{ route('inventory.edit', $inventory->inventoryId) }}"><i class="fa fa-edit"></i></a>

                          </div>

                          <div class="d-inline-block">
                                <a role="button" href="#" data-toggle="modal" data-target="#returnProductModal"  data-inventoryid='{{ $inventory->inventoryId }}' data-prodreturndate='{{ $inventory->entryDate }}'  data-prodreturnitem='{{$inventory->itemName.' ('.$inventory->itemCode.')'}}' data-prodreturnsupplier='{{ $inventory->supplierTitle }}'  data-prodReturnrecquantity='{{ $inventory->quantity }}'  data-returnproductqty='{{ $inventory->returnProductQty }}'  data-returnproductinstock='{{ $inventory->itemInStock }}' data-causeofreturns='{{ $inventory->causeOfReturns }}' ><i class="fa fa-undo tooltipster text-danger" title="Product Return ?"></i></a>
                          </div>


                          @if ( $inventory->itemExistInBillDetails==0 )
                              <div class="d-inline-block  tooltipster" title="Delete selected inventory ?">
                                  <form  method="post" action="{{ route('inventory.delete', $inventory->inventoryId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
                                      {{ csrf_field() }}

                                        <input type="hidden" name="_method" value="DELETE">

                                        {{-- <button type="submit" value="DELETE" class="btn btn-link" >
                                            <i class="mdi mdi-delete-empty" style="color: red;font-size: 25px; "></i>
                                        </button> --}}
                                        <a>
                                          <button type="submit" value="DELETE" class="btn btn-link" >
                                            <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                          </button>
                                        </a>
                                     {{--  <a method="delete" href="{{ route('supplier.delete', $suppliers->supplierId) }}"><i   class="mdi mdi-delete-empty" style="color: red;"></i></a> --}}


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
          id: '123', // the value of the option
          text: '--Select Supplier--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true
     });


     $('#unitParam').select2({
        placeholder: {
          id: '123', // the value of the option
          text: '--Select Unit Param--'
        },
        allowClear: true
     });

     $('#customerId').select2({
        placeholder: {
          id: '123', // the value of the option
          text: '--Select Customer--'
        },
        allowClear: true
     });



     


  });
</script>





<!-- Product Return Modal -->
<!-- Product Return Modal -->
<div class="modal fade" id="returnProductModal" tabindex="-1" role="dialog" aria-labelledby="returnProductModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="itemSaveModalLabel">Return Product</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              



              {{-- top side of the table --}}
              {{-- <h4 class="card-title offset-4" style="text-align: center;">Add A Role </h4> --}}

              <form class="form-sample" id="items_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('inventory.product.return') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{method_field('put')}}
                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>

                    <input type="hidden" name="inventoryId" id="inventoryId" value="">

                    <div class="col-md-12">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Date</label>
                            <div class="col-sm-8">
                              <input type="text" id="prodReturnDate"  class="form-control" readonly>


                            </div>
                          </div>
                        </div> 
                    

                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Product</label>
                            <div class="col-sm-8">
                              <input type="text" id="prodReturnItem"  class="form-control" readonly>


                            </div>
                          </div>
                        </div>


                        <div class="col-md-12">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Supplier</label>
                            <div class="col-sm-8">
                              <input type="text" id="prodReturnSupplier"  class="form-control" readonly>


                            </div>
                          </div>
                        </div> 





                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Received Quantity</label>
                            <div class="col-sm-8">
                              <input type="text" id="prodReturnRecQuantity" class="form-control" readonly>


                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Total Stock</label>
                            <div class="col-sm-8">
                              <input type="text" id="prodReturnItemInStock" class="form-control" readonly>


                            </div>
                          </div>
                        </div>


                        <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Return Quantity</label>
                            <div class="col-sm-8">
                              <input type="text" id="returnProductQty" name="returnProductQty" class="form-control" required>


                            </div>
                          </div>
                        </div>


                        <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Cause Of Returns</label>
                            <div class="col-sm-8">
                              <input type="text" id="causeOfReturns" name="causeOfReturns" class="form-control" required>
                            </div>
                          </div>
                        </div>
                      


                    
                  <div class="col-md-12 text-center mt-4">
                        <input type="submit" class="btn btn-success mr-2 float-right"  value="Save">
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
<!-- Product Return Modal -->
<!-- Product Return Modal -->






<!-- item Save Modal -->
<!-- item Save Modal -->
<div class="modal fade" id="itemSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="itemSaveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="itemSaveModalLabel">Add A Product</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              



              {{-- top side of the table --}}
              {{-- <h4 class="card-title offset-4" style="text-align: center;">Add A Role </h4> --}}

              <form class="form-sample" id="items_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('inventory.items.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>

                    <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Item Code</label>
                            <div class="col-sm-8">
                              <input type="text" id="itemCode" name="itemCode" class="form-control" required>


                            </div>
                          </div>
                        </div> 
                    

                      <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Item Name</label>
                            <div class="col-sm-8">
                              <input type="text" id="itemName" name="itemName" class="form-control" required>


                            </div>
                          </div>
                        </div>

                        



                        
                        <div class="col-md-12">
                          <div class="form-group row required" >
                            <label class="col-sm-4 col-form-label control-label">Category</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" id="bloodGroupId" name="bloodGroupId" class="form-control"> --}}

                              {{-- dynamic select/dropdown --}}
                                <select class="form-control m-bot15" name="categoryId" id="categoryId" required>
                                      <option value="">--Select One--</option>

                                        @foreach(DB::table('category')->get() as $category)
                                            <option value="{{ $category->categoryId }}" >
                                              {{ ucfirst($category->category) }}
                                            </option> 
                                        @endforeach   


                                </select>


                            </div>
                          </div>
                        </div>
                   


                  
                      



                      <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Description</label>
                            <div class="col-sm-8">
                              <input type="text" id="description" name="description" class="form-control" required>


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
<!-- item Save Modal -->
<!-- item Save Modal -->





<!-- supplier Save Modal -->
<!-- supplier Save Modal -->
<div class="modal fade" id="supplierSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="supplierSaveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="supplierSaveModalLabel">Add A Supplier</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              



              {{-- top side of the table --}}
              {{-- <h4 class="card-title offset-4" style="text-align: center;">Add A Role </h4> --}}

              <form class="form-sample" id="items_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('inventorySupplierInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    



                        <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Supplier Name</label>
                            <div class="col-sm-8">
                              <input type="text" id="supplierTitle" name="supplierTitle" class="form-control" required>


                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Contact Person Name</label>
                            <div class="col-sm-8">
                              <input type="text" id="contactPerson" name="contactPerson" class="form-control" required>


                            </div>
                          </div>
                        </div>

                        

                        





                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Email</label>
                            <div class="col-sm-8">
                              <input type="email" id="email" name="email" class="form-control" >


                            </div>
                          </div>
                        </div>

                      <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Years Of Experience</label>
                            <div class="col-sm-8">
                              <input type="number" id="yearsOfExperience" name="yearsOfExperience" class="form-control" required>


                            </div>
                          </div>
                        </div>


                        



                        


                      <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label  control-label">Company Address</label>
                            <div class="col-sm-8">
                              <textarea class="form-control" id="companyAddress" name="companyAddress" rows="2" required></textarea>


                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Contact Number</label>
                            <div class="col-sm-8">
                              <input type="tel" pattern = "[+]{0,1}[0-9]{7,13}" title="+8801703188752" minlength="7" maxlength="14"  id="contactNumber" name="contactNumber" class="form-control" required>


                            </div>
                          </div>
                        </div>


                                        


                        







                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label class="col-sm-4 col-form-label ">Reference</label>
                            <div class="col-sm-8">
                              <input type="text" id="reference" name="reference" class="form-control" >


                            </div>
                          </div>
                        </div>  

                        

                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Remarks</label>
                            <div class="col-sm-8">
                              <textarea class="form-control" id="remarks" name="remarks" rows="2"></textarea>


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
<!-- supplier Save Modal -->
<!-- supplier Save Modal -->






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
          var unitParam = $('select#itemId').find(':selected').data('unitparam');
          
          // var unitPrice = $("#unitPrice").val();
          // if (itemsellingprice > 0) 
          // {
          //   $('#sellingPrice').prop('readonly', true);
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
            var unitParam = $('select#itemId').find(':selected').data('unitparam');
            var supplierId = $('select#itemId').find(':selected').data('supplierid');



            $('#itemName').val(itemName);
            $('#description').val(itemDescription);
            $('#inStockQty').val(itemInStock);
            $('#unitPrice').val(unitPrice);
            $('#sellingPrice').val(sellingPrice);
            $('#unitParam').val(unitParam).trigger('change');
            $('#supplierId').val(supplierId).trigger('change');


            

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