@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Stock Report')

@section('page_content')




<script src="{{ asset('js/jquery.min.js') }}"></script>




<style type="text/css" media="screen">

    a{
          text-decoration: none;
          color: black;
    }
    a:hover{
          text-decoration: none;
    }
    img{
      max-width: 154px;
    }
    .card-title{
      text-align: center;
    }
</style>



<div class="content-wrapper" style="min-height: 0px;  " id="create-item">
  
  {{-- Notification --}}
    {{-- Notification --}}
    @if (session('successMsg'))
                

      <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('successMsg') }}
      </div>


    @endif
</div>



<div class="content-wrapper" style="min-height: 0px; padding-top: 0px; margin-top: -10px;" id="create-item">




      {{-- Attendance start--}}
      {{-- Attendance start--}}




  <div class="card" style="min-height: 0px; padding-top: 0px; margin-top: -30px;">
    <div class="card-body">

        <h4 class="card-title text-md-center" >Stock Report</h4>




        <div class=" row">

                {{-- restriction start --}}
                {{-- restriction start --}}



                  <div class="col-md-12" >
                    <div class="form-group row">

                      {{-- restriction 1  start--}}
                      <div class=" col-md-6 col-sm-6">

                            <div class="form-group row">
                              <label class="col-md-3 col-sm-3 col-form-label ">Category</label>

                              <div class="col-md-9 col-sm-9">
                                  <select class="form-control m-bot15 " id="category" name="category"  onchange ="location = this.options[this.selectedIndex].value;">
                                      @if (request()->has('category'))
                                          
                                        <option value="">{{ title_case(DB::table('stockreport_view')->where('categoryId', request('category'))->pluck('category')->first()) }}</option>
                                      @endif
                                          
                                          <option value="?">All</option>

                                          @foreach (DB::table('stockreport_view')->groupBy('categoryId')->get() as $category)
                    
                                            <option  value="?category={{ $category->categoryId }}" > 
                                                {{ ($category->category) }}
                                                
                                            </option> 
                                          @endforeach  

                                  </select>
                              </div>
                              
                            </div>
                      </div>
                      {{-- restriction 1  end--}}

                      

                      {{-- restriction 2  start--}}

                      <div class="col-md-6 col-sm-6">
                        <div class="form-group row">
                              <label class="col-md-3 col-sm-3 col-form-label float-right">Item Code</label>

                              <div class="col-md-9 col-sm-9">
                                  <select class="form-control m-bot15 " id="item" name="item"  onchange ="location = this.options[this.selectedIndex].value;">
                                      @if (request()->has('category') and  request()->has('item') )
                                          
                                        

                                        <option value="?category={{ request('category') }}&item={{ request('item') }}">{{ DB::table('item_view')->where('itemId', request('item'))->pluck('item')->first() }}</option>

                                        <option value="?category={{ request('category') }}">All</option>

                                        @foreach (DB::table('stockreport_view')->select('itemId', 'itemName', 'itemCode')->where('categoryId', request('category'))->get() as $item)
                    
                                          <option  value="?category={{ request('category') }}&item={{ ($item->itemId) }}" > 
                                              {{ title_case($item->itemName.'('.$item->itemCode.')') }}
                                              
                                          </option> 
                                        @endforeach 



                                      @elseif (request()->has('category') )
                                          
                                        <option value="?category={{ request('category') }}">All</option>
                                        

          
                                            @foreach (DB::table('stockreport_view')->select('itemId', 'itemName', 'itemCode')->where('categoryId', request('category'))->get() as $item)
                    
                                              <option  value="?category={{ request('category') }}&item={{ ($item->itemId) }}" > 
                                                  {{ title_case($item->itemName.'('.$item->itemCode.')') }}
                                                  
                                              </option> 
                                            @endforeach 
                                      @elseif (request()->has('item') )
                                          
                                        <option value="?item={{ request('item') }}">{{ DB::table('item_view')->where('itemId', request('item') )->pluck('item')->first() }}</option>

                                        <option value="?">All</option>
                                        

          
                                            @foreach ( DB::table('stockreport_view')->select('itemId', 'itemName', 'itemCode')->where('itemId', request('item'))->get() as $item)
                    
                                              <option  value="?item={{ ($item->itemId) }}" > 
                                                  {{ title_case($item->itemName.'('.$item->itemCode.')') }}
                                              </option> 
                                            @endforeach

                                      @else
                                          
                                        <option value="?">All</option>
                                        

          
                                            @foreach (DB::table('stockreport_view')->select('itemId', 'itemName', 'itemCode')->get() as $item)
                    
                                              <option  value="?item={{ ($item->itemId) }}" > 
                                                  {{ title_case($item->itemName.'('.$item->itemCode.')') }}
                                         
                                              </option> 
                                            @endforeach 

                                      
                                      @endif




                                  </select>


                                </div>
                            </div>
                      </div>
                    {{-- restriction 2  end--}}


                    </div>
                  </div>


                {{-- restriction end --}}
                {{-- restriction end --}}


                </div>
                

        {{-- <a href="{{ route('createproduct') }}" class="btn btn-info " style="margin-bottom: 10px; "><span>Add Service/Product Items</span></a> --}}



        <div class="text-md-right">

                @if ( (DB::table('stockreport_view')->count('itemId'))>0 )
                    <a href="{{ route('report.stockReport.stockReportFullExcelReportDownload') }}" target="_blank">
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
                  <th scope="col">Category</th>
                  <th scope="col">Item</th>
                  <th scope="col">Item Code</th>
                  <th scope="col">Description</th>
                  <th scope="col">Total Stock</th>
                  <th scope="col">Total Price</th>
              </tr>
          </thead>
          
          <tbody>
            @if (request()->has('category') and request()->has('item'))
               @foreach (DB::table('stockreport_view')
                ->Where(
                            [
                                ['categoryId', '=', request('category')],
                                ['itemId', '=', request('item')],
                            ]
                         )
                ->get() 
               as $stockreport_view)


                  <tr>

                      <td> {{ $stockreport_view->category }}</td>
                      <td> {{ $stockreport_view->itemName }}</td>
                      <td> {{ $stockreport_view->itemCode }}</td>
                      <td> {{ $stockreport_view->itemDescription }}</td>
                      <td> {{ number_format((float)$stockreport_view->inStock, 3) }}</td>
                      <td> {{ number_format($stockreport_view->totalPrice) }}</td>

                  </tr>
                @endforeach
            @elseif(request()->has('category'))
              @foreach (DB::table('stockreport_view')
                ->Where(
                            [
                                ['categoryId', '=', request('category')],
                            ]
                         )
                ->get() 
               as $stockreport_view)
                  <tr>
                      <td> {{ $stockreport_view->category }}</td>
                      <td> {{ $stockreport_view->itemName }}</td>
                      <td> {{ $stockreport_view->itemCode }}</td>
                      <td> {{ $stockreport_view->itemDescription }}</td>
                      <td> {{ number_format((float)$stockreport_view->inStock, 3) }}</td>
                      <td> {{ number_format($stockreport_view->totalPrice) }}</td>
                      
                  </tr>
                @endforeach

            @elseif(request()->has('item'))
              @foreach (DB::table('stockreport_view')
                ->Where(
                            [
                                ['itemId', '=', request('item')],
                            ]
                         )
                ->get() 
               as $stockreport_view)
                  <tr>
                      <td> {{ $stockreport_view->category }}</td>
                      <td> {{ $stockreport_view->itemName }}</td>
                      <td> {{ $stockreport_view->itemCode }}</td>
                      <td> {{ $stockreport_view->itemDescription }}</td>
                      <td> {{ number_format((float)$stockreport_view->inStock, 3) }}</td>
                      <td> {{ number_format($stockreport_view->totalPrice) }}</td>
                      
                  </tr>
                @endforeach

            @else
                
                @foreach (DB::table('stockreport_view')->get() as $stockreport_view)
                  <tr>
                      <td> {{ $stockreport_view->category }}</td>
                      <td> {{ $stockreport_view->itemName }}</td>
                      <td> {{ $stockreport_view->itemCode }}</td>
                      <td> {{ $stockreport_view->itemDescription }}</td>
                      <td> {{ number_format((float)$stockreport_view->inStock, 3) }}</td>
                      <td> {{ number_format($stockreport_view->totalPrice) }}</td>
                      
                  </tr>
                @endforeach

            @endif



             
             
          </tbody>
      </table>
    {{-- data table end --}}
    {{-- data table end --}}




    </div>
  </div>

</div>



{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

    $('#category').select2({
        placeholder: {
          id: '1234', // the value of the option
          text: '--Select Category--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true
     });

     $('#item').select2({
        placeholder: {
          id: '122', // the value of the option
          text: '--Select Item--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true
     });



  });
</script>


@endsection


