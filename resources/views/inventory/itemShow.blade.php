@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Item List')

@section('page_content')


<script src="{{ asset('js/jquery.min.js') }}"></script>






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
                

      <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('successMsg') }}
      </div>


    @endif

    
    
          <div class="card">
            <div class="card-body">

        

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Update An Item</h4>




          <form class="form-sample" id="items_insert_form" method="post" enctype="multipart/form-data" action="{{ route('items.update', $itemdata->itemId) }}"  onsubmit="return confirm('Do you really want to proceed?');">

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
                              <input type="text" id="itemName" name="itemName" class="form-control" required value="{{ $itemdata->itemName }}">


                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Item Code</label>
                            <div class="col-sm-8">
                              <input type="text" id="itemCode" name="itemCode" class="form-control" required value="{{ $itemdata->itemCode }}">


                            </div>
                          </div>
                        </div>


                      
                    </div>


                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label  control-label">Category</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" id="bloodGroupId" name="bloodGroupId" class="form-control"> --}}

                              {{-- dynamic select/dropdown --}}
                                <select class="form-control m-bot15" name="categoryId" id="categoryId" required >
                                      <option value="{{ $itemdata->categoryId }}">{{ DB::table('category')->where('categoryId',$itemdata->categoryId )->pluck('category')->first() }}</option>

                                        @foreach(DB::table('category')->get() as $category)
                                            <option value="{{ $category->categoryId }}" >
                                              {{ ucfirst($category->category) }}
                                            </option> 
                                            @endforeach   


                                </select>


                            </div>
                          </div>
                        </div>
                        

                        <div class="col-md-6">
                          <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Description</label>
                            <div class="col-sm-8">
                              <input type="text" id="description" name="description" class="form-control" required value="{{ $itemdata->description }}">


                            </div>
                          </div>
                        </div>

                        
                  
                      
                    </div>


                    
                    <div class="col-md-12 text-center mt-4">
                        <input type="submit" class="btn btn-success mr-2"  value="Update">
                        {{-- <input type="button" class="btn btn-danger" onclick="formClearFunction()" value="Clear"> --}}
                         <a href="{{ route('inventory.settings') }}">
                          <button type="button" class="btn btn-danger" >
                              Cancel
                          </button>
                        </a>
                    </div>


                  </form>
        



            </div>
          </div>
        </div>





    </div>
  </div>
</div>









<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("items_insert_form").reset();
    }

</script>





@endsection