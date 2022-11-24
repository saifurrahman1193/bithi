@extends('layouts.app', ['company' =>  DB::table('company')->get()])
{{-- @extends('layouts.app') --}}
@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Dashboard')

@section('page_content')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/google_chart_loader.js') }}"></script>

<style type="text/css" media="screen">

    a{
          text-decoration: none;
          color: black;
    }
    a:hover{
          text-decoration: none;
    }
    .card img{
      max-width: 154px;
    }
    .card-title{
      text-align: center;
    }
</style>

<div class="content-wrapper" style="min-height: 0px;">

    <div class="row" style="margin-top: 10px;">

           



            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column mb-2">



                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="text-center">
                        <p class="mb-0">Net Sales Of {{ date('F') }}</p>
                        <h3 style="text-align:center;">{{ number_format($dash_bill_sum_thisMBill_v_tReceiAmnt) }} BDT</h3>
                      </div>
                    </div>
                  </div>
                </div>



              
               
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column mb-2">



                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="text-center">
                        <p class="mb-0">Avg. Sales Of {{ date('F') }}</p>
                        <h3 style="text-align:center;">{{ number_format( ($dash_bill_sum_thisMBill_v_tReceiAmnt)/date('d')  )  }} BDT</h3>
                      </div>
                    </div>
                  </div>
                </div>

               
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column mb-2">


                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="text-center">
                        <p class="mb-0">Total Sales of {{ date('Y') }}</p>
                        <h3 style="text-align:center;">{{ number_format(DB::table('dash_bill_sum_thisyearbill_view')->sum('totalReceivableAmount')) }} BDT</h3>
                      </div>
                    </div>
                  </div>
                </div>

               
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column">



                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="text-center">
                        <p class="mb-0">Total Orders</p>
                        <h3 style="text-align:center;">{{ number_format(DB::table('bills')->count('billId')) }} </h3>
                      </div>
                    </div>
                  </div>
                </div>

                

              
               
            </div>
            
           
          


            
    </div>



</div>


<div class="content-wrapper" style="min-height: 0px; ">

  <div class="row" style="margin-top: -20px;">


     <div class="col-md-6 col-lg-6 col-sm-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body" {{-- style="background-color: rgba(0,0,0,0.1)" --}}>
                {{-- <h6 class="card-title">Your Valuable Customers</h6> --}}
                <h6 class="card-title">Today Purchase : {{number_format($todayPurchaseAmount)}}</h6>

                

                <div class="w-100 mx-auto">

                    {{-- data table start --}}
                    {{-- data table start --}}
                    <table  class="table table-striped table-bordered table-hover " >
                      <thead>
                          <tr class="bg-primary text-light text-center">
                              <th scope="col">Item</th>
                          </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($todayPurchase as $item)
                            <tr>
                              <td>
                                {{$item->itemName}}
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
      </div>

      <div class="col-md-6 col-lg-6  col-sm-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body" {{-- style="background-color: rgba(0,0,0,0.1)" --}}>
                <h6 class="card-title">Today Sale : {{number_format($todaySaleAmount)}}</h6>
                <h6 class="card-title">Today Paid Sale : {{number_format($todayTransactionAmount)}}</h6>
                <h6 class="card-title">Today Due Sale : {{number_format($todayDueAmount)}}</h6>

                

                <div class="w-100 mx-auto">

                    {{-- data table start --}}
                    {{-- data table start --}}
                    <table  class="table table-striped table-bordered table-hover " >
                      <thead>
                          <tr class="bg-primary text-light text-center">
                              <th scope="col">Item</th>
                          </tr>
                      </thead>
                      
                      <tbody>
                              @foreach ($todaySale as $item)
                                  <tr>
                                    <td>
                                      {{$item->itemName}}
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
      </div>

          
  </div>



</div>



<div class="content-wrapper" style="min-height: 0px; ">

  <div class="row" style="margin-top: -20px;">


     <div class="col-md-12 col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body" {{-- style="background-color: rgba(0,0,0,0.1)" --}}>
                {{-- <h6 class="card-title">Your Valuable Customers</h6> --}}
                {{-- <h6 class="card-title">Customers Summary</h6> --}}

                

                <div class="w-100 mx-auto">

                    {{-- data table start --}}
                    {{-- data table start --}}
                    <table  class="table table-striped table-bordered table-hover " >
                          <thead>
                              <tr class="bg-primary text-light text-center">
                                  <th scope="col">Stock Price</th>
                                  <th scope="col">Total Cash Received</th>
                                  <th scope="col">Total Receivable Due</th>
                                  <th scope="col">Total Payable Due</th>
                                  <th scope="col">Extra Expenses ({{ Date('F') }})</th>
                              </tr>
                          </thead>
                          
                          <tbody>
                                  <tr style="text-align: center;">
                                      <td><h3>{{ number_format(DB::table('stockreport_view')->sum('totalPrice')) }}</h3> </td>
                                      <td><h3>{{ number_format((DB::table('dash_bill_sum_totalbill_view')->sum('totalReceivableAmount'))-( $dash_bill_sum_pendbill_v_tReceiAmnt ) ) }}</h3> </td>
                                      <td><h3>{{ number_format($dash_bill_sum_pendbill_v_tReceiAmnt) }}</h3> </td>
                                      <td><h3>{{ number_format(DB::table('inventory')->sum('dueAmount')) }}</h3> </td>
                                      <td><h3>{{ number_format(DB::table('expenses')->whereYear('expenseDate', Date('Y'))
                                        ->whereMonth('expenseDate', Date('m'))
                                      ->sum('amount')) }}</h3> </td>
                                  </tr>
                          </tbody>
                      </table>
                    {{-- data table end --}}
                    {{-- data table end --}}
                    
                    
                </div>

              </div>
            </div>
          </div>

         



          {{-- <div class="col-lg-3 d-flex flex-column">
            <div class="row flex-grow">



              <div class="col-12 col-md-6 col-lg-12 grid-margin stretch-card ">
                <div class="card" style="background: #01A8A9; color: #D8EEF5;">

                  <div class="card-body">
                    <h6 class="card-title" style="color: #D8EEF5;">Product Summary</h6>
                    <div class="row">
                      <div class="col-12 text-center">
                        <div class="row"><p>Total Items : <strong>{{ DB::table('item')->distinct('itemCode')->count('itemCode') }}</strong></p></div>
                        <div class="row"><p>Total Categories : <strong>{{ DB::table('category')->count('categoryId') }}</strong></p></div>
                        
                        <div class="row"><p>Total Stock Price : <strong>
                          {{ 
                                number_format(DB::table('stockreport_view')->sum('totalPrice'))
                          }}
                        </strong></p></div>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>

              <div class="col-12 col-md-6 col-lg-12 grid-margin stretch-card">
                <div class="card" style="background: #0285BF; color: #D8EEF5;">

                  <div class="card-body">
                    <h6 class="card-title" style="color: #D8EEF5;">Bill Summary</h6>
                    <div class="row">
                      <div class="col-12 text-center">
                        <div class="row"><p>Total Bills : <strong>{{ number_format(DB::table('dash_bill_sum_totalbill_view')->sum('totalReceivableAmount')) }}</strong></p></div>
                        <div class="row"><p>This Month Bill : <strong>{{ number_format(DB::table('dash_bill_sum_thismonthbill_view')->sum('totalReceivableAmount')) }}</strong></p></div>
                        <div class="row"><p>This Year Bill : <strong>{{ number_format(DB::table('dash_bill_sum_thisyearbill_view')->sum('totalReceivableAmount')) }}</strong></p></div>
                        <div class="row"><p>Pending Bills : <strong>{{ number_format(DB::table('dash_bill_sum_pendingbill_view')->sum('totalReceivableAmount')) }}</strong></p></div>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
             
            </div>
          </div> --}}
          
          
  </div>

  


</div>





<div class="content-wrapper" style="min-height: 0px; ">

  <div class="row" style="margin-top: -20px;">


     <div class="col-md-6 col-lg-6 col-sm-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body" {{-- style="background-color: rgba(0,0,0,0.1)" --}}>
                {{-- <h6 class="card-title">Your Valuable Customers</h6> --}}
                <h6 class="card-title">Today Purchase : {{number_format($todayPurchaseAmount)}}</h6>
                

                <div class="w-100 mx-auto">

                    {{-- data table start --}}
                    {{-- data table start --}}
                    <table  class="table table-striped table-bordered table-hover " >
                      <thead>
                          <tr class="bg-primary text-light text-center">
                              <th scope="col">Item</th>
                          </tr>
                      </thead>
                      
                      <tbody>
                        @foreach ($todayPurchase as $item)
                            <tr>
                              <td>
                                {{$item->itemName}}
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
      </div>

      <div class="col-md-6 col-lg-6  col-sm-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body" {{-- style="background-color: rgba(0,0,0,0.1)" --}}>
                <h6 class="card-title">Today Sale : {{number_format($todaySaleAmount)}}</h6>


                <div class="w-100 mx-auto">

                    {{-- data table start --}}
                    {{-- data table start --}}
                    <table  class="table table-striped table-bordered table-hover " >
                      <thead>
                          <tr class="bg-primary text-light text-center">
                              <th scope="col">Item</th>
                          </tr>
                      </thead>
                      
                      <tbody>
                              @foreach ($todaySale as $item)
                                  <tr>
                                    <td>
                                      {{$item->itemName}}
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
      </div>

          
  </div>



</div>




<div class="content-wrapper" style="min-height: 0px; ">
  <div class="row" >
    <div class="col-md-12  grid-margin stretch-card">

      <div class="card">
        <h3 class="card-title mt-2">Low Stock Report</h3>
        <div class="card-body" {{-- style="background-color: rgba(0,0,0,0.1)" --}}>
          {{-- <h6 class="card-title">Your Valuable Customers</h6> --}}

          

          <div class="w-100 mx-auto">

            <table id="datatableLowStockListWScroll" class="table table-striped table-bordered table-hover " >
                <thead>
                    <tr class="bg-primary text-light">
                        <th scope="col">Item</th>
                        <th scope="col">Qty</th>
                    </tr>
                </thead>

            </table>
              
              
              
          </div>

        </div>
      </div>
    </div>
  </div>
</div>











<div class="content-wrapper" style="min-height: 0px; ">

    <div class="row" style="margin-top: -20px;">


       <div class="col-md-6 col-lg-6 col-sm-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body" {{-- style="background-color: rgba(0,0,0,0.1)" --}}>
                  {{-- <h6 class="card-title">Your Valuable Customers</h6> --}}
                  <h6 class="card-title">Highest Sold</h6>

                  

                  <div class="w-100 mx-auto">

                      {{-- data table start --}}
                      {{-- data table start --}}
                      <table  class="table table-striped table-bordered table-hover " >
                            <thead>
                                <tr class="bg-primary text-light text-center">
                                    <th scope="col">SL</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                    @foreach ( $highest_sold as $item)
                                      <tr style="text-align: center;">
                                        <td>{{ $loop->index+1 }} </td>
                                        <td> {{ $item->item }}</td>
                                        <td> {{ number_format($item->soldQty) }}</td>
                                        <td> {{ number_format($item->totalPrice) }}</td>
                                      </tr>
                                    @endforeach
                            </tbody>
                        </table>
                      {{-- data table end --}}
                      {{-- data table end --}}
                      
                      
                  </div>

                </div>
              </div>
        </div>

        <div class="col-md-6 col-lg-6  col-sm-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body" {{-- style="background-color: rgba(0,0,0,0.1)" --}}>
                  <h6 class="card-title">Lowest Sold</h6>

                  

                  <div class="w-100 mx-auto">

                      {{-- data table start --}}
                      {{-- data table start --}}
                      <table  class="table table-striped table-bordered table-hover " >
                            <thead>
                                <tr class="bg-primary text-light text-center">
                                    <th scope="col">SL</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                    @foreach ($dash_lowest_sold as $item)
                                      <tr style="text-align: center;">
                                        <td>{{ $loop->index+1 }} </td>
                                        <td> {{ $item->item }}</td>
                                        <td> {{ number_format($item->soldQty) }}</td>
                                        <td> {{ number_format($item->totalPrice) }}</td>
                                      </tr>
                                    @endforeach
                            </tbody>
                        </table>
                      {{-- data table end --}}
                      {{-- data table end --}}
                      
                      
                  </div>

                </div>
              </div>
        </div>

            
    </div>



</div>







{{-- bargraph against revenue report --}}
<div class="content-wrapper" style="margin-top: -40px;">
      @include('contents.barGraphAgainstRevenue')
</div>




<script>
  var deletemessage = "'Do you really want to delete ?'";
  $(document).ready( function () {
      $('#datatableLowStockListWScroll').DataTable({
          processing: true,
          serverSide: true,
          "bSort": true,
          "responsive": true,
          "autoWidth": false,
          "scrollX": true,
          "scrollY": false,
          language: {
                  search: "_INPUT_",
                  searchPlaceholder: "Search..."
              },
          "pagingType": "simple_numbers",
          // dom: 'Bfrtip',
          //  buttons: ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
          "order": [[ 1, "asc" ]],
          
          ajax: "{{ route('lowStockReport') }}",
          columns: [
                      { data: 'itemName', 
                          render: function(data, type, full, meta){
                              return   data;
                          },
                       },
                       { data: 'inStock', 
                          render: function(data, type, full, meta){
                              return   data;
                          },
                       },
                     
                  ],
      });
   });
</script>




@endsection