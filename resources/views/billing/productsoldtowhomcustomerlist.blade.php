@extends('layouts.app', ['company' =>  DB::table('company')->get()])
@extends('layouts.navbar')
@extends('layouts.sidebar')


@section('pageTitle', 'Product Sold To Whom Customer List')
@section('page_content')

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>



<style type="text/css" media="screen">
  .dataTables_wrapper .dataTable .btn .toggle-on, .dataTables_wrapper .dataTable .btn .toggle-off  {
    padding-top: 8px;
  }
</style>


<div class="content-wrapper" style="min-height: 0px;">
    @if (session('successMsg'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('successMsg') }}
        </div>
    @endif
    

    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center;">Product Sold To Whom Customer List</h4>

            <div class="form-group row">
                <div class="col-sm-4">
                    <select class="form-control m-bot15 " id="itemId" onchange="datatableDataLoad(this.value)">
                        <option value="">--Select Item--</option>
                        @foreach ($itemData->sortBy('itemName') as $item)
                            <option  value="{{$item->itemId}}" >
                                {{$item->itemName}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <table id="datatableProductSoldToWhomCustomerListWScroll" class="table table-striped table-bordered table-hover " >
                <thead>
                    <tr class="bg-primary text-light">
                        <th scope="col">Bill Id</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Sold Qty</th>
                        <th scope="col">Sale</th>
                        <th scope="col">Sold By</th>
                        {{-- <th scope="col">Payment Status</th> --}}
                        {{-- <th scope="col">Date-Time</th> --}}
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>


<script>

    

    function datatableDataLoad(itemId) 
    {
        $('#datatableProductSoldToWhomCustomerListWScroll').DataTable({
            "lengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, 'All']], 
            processing: true,
            serverSide: true,
            "bSort": true,
            // "ordering": true,
            "responsive": true,
            // "autoWidth": false,
            "scrollX": true,
            "scrollY": false,
            destroy: true,
            language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },
            "pagingType": "simple_numbers",
            "order": [[ 0, "desc" ]],
            // dom: 'Bfrtip',
            //  buttons: ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
            
            ajax: "{{url('/')}}"+"/productSoldToWhomCustomerListData/"+itemId,
            datatype:'json',
            type: 'get',
            columns: [
                        { data: 'billId', 
                            render: function(data, type, full, meta){
                                if (data){
                                    return "<a href='/billing/bills/billList?billId="+data+"' target='_blank'>"+data+"</a>"
                                }
                                return   data+'';
                            },
                         },

                        { data: 'customerName', 
                            render: function(data, type, full, meta){
                                if (data){
                                    return data
                                }
                                return   data+'';
                            },
                            width:150
                        },
                        { data: 'soldQty', 
                            render: function(data, type, full, meta){
                                if (data){
                                    return data
                                }
                                return   data+'';
                            },
                            width:150
                        },
                        { data: 'totalPrice', 
                            render: function(data, type, full, meta){
                                if (data){
                                    return data
                                }
                                return   data+'';
                            },
                            width:150
                        },
                        { data: 'entryPerson', 
                            render: function(data, type, full, meta){
                                if (data){
                                    return data
                                }
                                return   data+'';
                            },
                            width:150
                        },
                        
                        
                         
                    ],
        });

    }


</script>

  


<script >
    $(document).ready(function() {
       $('#itemId').select2({
          placeholder: {
            id: '', // the value of the option
            text: '--Select Item--'
          },
          allowClear: true
       });
    });
</script>
  
@endsection