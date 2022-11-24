@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Inventory Settings')

@section('page_content')




<script src="{{ asset('js/jquery.min.js') }}"></script>



<script type="text/javascript">

    $(function(){

        $('#categoryUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var categoryId = button.data('categoryid') ;
              var category = button.data('category') ;

              var modal = $(this);

              modal.find('.modal-body #categoryId').val(categoryId);
              modal.find('.modal-body #category').val(category);
        });

    });
</script>




<div class="content-wrapper" style="min-height: 0px;">



  {{-- message alert --}}
          {{-- message alert --}}
          @if ($errors->any())
              <ul>
                @foreach ($errors->all() as $error)
                  {{-- <li>{{ $error }}</li> --}}
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
                

      <div class="alert alert-success" id="alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('successMsg') }}
      </div>


    @endif

  <div class="card">
    <div class="card-body">

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Categories</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#catSaveConfirmationModal" ><span>+ Create New Category</span></a>

        {{-- <a href="{{ route('createproduct') }}" class="btn btn-info " style="margin-bottom: 10px; "><span>Add Service/Product Items</span></a> --}}



    {{-- data table start --}}
    {{-- data table start --}}
    <table id="datatable1" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">Category</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          
          <tbody>
               @foreach ($categoryData as $category)
                  <tr>
                      {{-- <td>{{$loop->index+1}}</td> --}}

                      <td>{{$category->category}}</td>
                      <td id="tdtableaction">

                          <a role="button" href="#"   data-toggle="modal" data-target="#categoryUpdateModal" data-categoryid="{{$category->categoryId}}"  data-category="{{$category->category}}"><i class="fa fa-edit tooltipster" title="Edit Record ?"></i></a>


                          @if ( $category->isCategoryUsed==0)

                            <div class="d-inline-block tooltipster" title="Delete selected category ?">
                                <form  method="post" action="{{ route('category.delete', $category->categoryId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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



<div class="content-wrapper" style="min-height: 0px;">
  <div class="card">
    <div class="card-body">

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Items</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#itemSaveConfirmationModal" ><span>+ Create New Item</span></a>

        {{-- <a href="{{ route('createproduct') }}" class="btn btn-info " style="margin-bottom: 10px; "><span>Add Service/Product Items</span></a> --}}



    {{-- data table start --}}
    {{-- data table start --}}
    <table id="datatable2WScroll" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">Item Code</th>
                  <th scope="col">Item</th>
                  <th scope="col">Category</th>
                  <th scope="col">Description</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          
          <tbody>
               @foreach ($itemData as $item)
                  <tr>
                      {{-- <td>{{$loop->index+1}}</td> --}}

                      <td>{{$item->itemCode}}</td>
                      <td>{{$item->itemName}}</td>
                      <td>{{ $item->category }}</td>
                      <td>{{$item->itemDescription}}</td>
                      <td id="tdtableaction">

                          {{-- <form  method="post" action="{{ route('supplier.delete', $user->id) }}/hrm/supplier/{{$suppliers->supplierId}}" >
                              {{ csrf_field() }}

                              <a href=""><i class="fa fa-edit"></i></a>
                              <a href=""><i  class="mdi mdi-delete-empty" style="color: red;"></i></a>
                          </form> --}}
                            <div class="d-inline-block  tooltipster" title="Edit selected item ?">
                              <a href=" {{ route('items.show', $item->itemId) }}"><i class="fa fa-edit"></i></a>

                          </div>


                         @if ( $item->itemExistInBillDetails==0)

                            <div class="d-inline-block  tooltipster" title="Delete selected item ?">
                                <form  method="post" action="{{ route('items.delete', $item->itemId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
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





<!-- Category  Save Modal -->
<!-- Category  Save Modal -->
<div class="modal fade" id="catSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Add A Category</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              



              {{-- top side of the table --}}
              {{-- <h4 class="card-title offset-4" style="text-align: center;">Add A Role </h4> --}}

              <form class="form-horizontal" method="POST"  action="{{ route('category.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Category</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="category" name="category" required>
                                </div>
                              </div>
                            </div>

                        


                            

                              {{-- <button data-toggle="modal" data-target="#catSaveConfirmationModal"  type="submit"   class="btn btn-success mr-2 float-right">Save</button> --}}

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
<!-- Category  Save Modal -->
<!-- Category  Save Modal -->




<!-- Category  Edit Modal -->
<!-- Category  Edit Modal -->
<!-- Update Modal -->
<!-- Update Modal -->
<div class="modal fade" id="categoryUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Update Category</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body" >
              



              {{-- top side of the table --}}
              {{-- <h4 class="card-title offset-4" style="text-align: center;">Add A Role </h4> --}}

              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('inventory.settings.category.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="categoryId" id="categoryId" value="">
                          

                          <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Category</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="category" name="category" required>
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
<!-- Update Modal -->
<!-- Update Modal -->
<!-- Category  Edit Modal -->
<!-- Category  Edit Modal -->





<!-- item Save Modal -->
<!-- item Save Modal -->
<div class="modal fade" id="itemSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Add An Item</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              



              {{-- top side of the table --}}
              {{-- <h4 class="card-title offset-4" style="text-align: center;">Add A Role </h4> --}}

              <form class="form-sample" id="items_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('items.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

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







<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("category_insert_form").reset();
    }

</script>





@endsection