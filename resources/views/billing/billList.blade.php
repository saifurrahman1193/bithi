@extends('layouts.app', ['company' =>  DB::table('company')->get()])
@extends('layouts.navbar')
@extends('layouts.sidebar')


@section('pageTitle', 'Bills')
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
            <h4 class="card-title" style="text-align: center;">Bills</h4>
            @if (request()->has('billId'))
                <a href="{{ route('billList') }}" class="btn btn-primary btn-sm mb-2"  role="button" aria-pressed="true">All Bills</a>
            @endif

            <table id="datatableBillListWScroll22" class="table table-striped table-bordered table-hover " >
                <thead>
                    <tr class="bg-primary text-light">
                        <th scope="col">Invoice</th>
                        <th scope="col">Invoice Date</th>
                        <th scope="col">Sold By</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Sales</th>
                        <th scope="col">Delivery Status</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>


<script>
    var deletemessage = "'Do you really want to delete ?'";
    $(document).ready( function () {
        $('#datatableBillListWScroll22').DataTable({
            "lengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, 'All']], 
            processing: true,
            serverSide: true,
            "bSort": true,
            // "ordering": true,
            "responsive": true,
            // "autoWidth": false,
            "scrollX": true,
            "scrollY": false,
            language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },
            "pagingType": "simple_numbers",
            "order": [[ 0, "desc" ]],
            // dom: 'Bfrtip',
            //  buttons: ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
            
            ajax: "/billing/bills/billListReport"+"{{request()->has('billId')? '?billId='.request('billId'): '' }}",
            datatype:'json',
            type: 'get',
            columns: [
                        { data: 'billId', 
                            render: function(data, type, full, meta){
                                return   data+'';
                            },
                         },
                         { data: 'invoiceDate', 
                            render: function(data, type, full, meta){
                                return   data+'';
                            },
                            width:100
                         },
                         { data: 'entryPerson', 
                            render: function(data, type, full, meta){
                                if (data) {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)
                                    let name=dataArray[0];
                                    let mail=dataArray[1];
                                    return   name+'<br><br>'+mail;
                                }
                                else return ''
                            },
                            width:100
                         },
                        { data: 'customerInfo',
                            render: function(data, type, full, meta){
                                if (data) {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)
                                    let customerName=dataArray[0];
                                    let customerPhone=dataArray[1];
                                    let customerDistrict=dataArray[2];
                                    return   customerName+'<br><br>'+customerPhone+'<br><br>'+customerDistrict;
                                }
                                else return ''
                            },
                            width:200

                        },
                        { data: 'totalReceivableAmount',
                            render: function(data, type, full, meta){
                                return   Math.round(data)+'<br>'+'<p class="text-muted mb-0">Total Amount</p>';
                            },
                            width:100
                        },
                        { data: 'deliveryStat', 
                            render: function(data, type, full, meta){
                                if (data) {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)
                                    let billId=dataArray[0];
                                    let deliveryStatusId=dataArray[1];
                                    let deliveryStatus=dataArray[2];
                                    if (deliveryStatusId==1) {
                                        return '<input class="btn btn-success p-2 deliveryStatusUpdateBillId" id="deliveryStatusUpdateBillId1" type="button" value="Done"  onclick="deliveryStatusUpdate('+billId+','+deliveryStatusId+')">';
                                    } else if(deliveryStatusId==2) {
                                        return '<input class="btn btn-danger p-2 deliveryStatusUpdateBillId" id="deliveryStatusUpdateBillId2" type="button" value="Processing"  onclick="deliveryStatusUpdate('+billId+','+deliveryStatusId+')">';
                                    }
                                }
                                else return ''
                            },
                            width:100
                         },
                         { data: 'due', 
                            render: function(data, type, full, meta){
                                if (data) {
                                    var str = "";
                                    if(data>0) str = "Due: <strong>"+data+"</strong>"
                                    else str =' <button type="button" class="btn btn-success">Paid</button>'
                                    return str;
                                }
                                else return ''
                            },
                            width:100
                         },
                        { data: 'billId' ,
                            render: function(data, type, full, meta){
                                return ' <div class="d-inline-block float-left {{-- ml-3 --}} tooltipster" title="Print Invoice">'+
                                '<a href="/billing/bills/report/'+data+'"  target="_blank"><i class="fa fa-file-pdf-o fa-xs" style=" color:black; font-size:27px"></i></a>'+'</div>'
                                +
                                '<div class="d-inline-block ml-2 tooltipster" title="Edit Invoice"> <a href="/billing/bills/billEdit/'+data+'"><i class="fa fa-edit" style="font-size:32px"></i></a> </div>'
                                +
                                '<div class="d-inline-block  tooltipster " title="Delete Invoice" >   <form  method="post" action="/billing/bills/billDelete/'+data+'" onsubmit="return confirm('+deletemessage+');" > <a href="javascript:void(0)">  <input type="hidden" name="_method" value="DELETE"> @csrf   <button type="submit" value="DELETE" class="btn btn-link" style="margin-top: -18px !important; margin-left: -12px;"> <i class="fa fa-trash " style="font-size:29px; color:red; "></i>  </button>  </a> </div>'
                                ;
                            },
                            width:120

                        }
                    ],
        });
     });
</script>



{{-- delivery status dynamic update --}}

<script type="text/javascript">
    function deliveryStatusUpdate(billId, deliveryStatusId) {
        console.log('called');
  
        var token = $("meta[name='csrf-token']").attr("content");
        console.log(billId);
        console.log(token);
        if (deliveryStatusId==1)
        {
            $.ajax(
            {
                url: '/billing/bills/billList/billListDeliveryStatusUpdate/'+billId,
                type: 'post',
                // dataType: "JSON",
                data: {
                // "billId": billId
                "_token": token,
                "_method": 'post',
                },
            })
            .done(function() {
                console.log("success");
                $("#"+billId+" #deliveryStatusUpdateBillId1").removeAttr("onclick");
                $("#"+billId+" #deliveryStatusUpdateBillId1").attr("onclick","deliveryStatusUpdate("+billId+", 2)");
                $("#"+billId+" #deliveryStatusUpdateBillId1").removeClass("btn-success");
                $("#"+billId+" #deliveryStatusUpdateBillId1").addClass("btn-danger");
                $("#"+billId+" #deliveryStatusUpdateBillId1").val("Processing");
                    $("#"+billId+" #deliveryStatusUpdateBillId1").prop('id', 'deliveryStatusUpdateBillId2');
                
                })
                .fail(function() {
                console.log("error");
                })
                .always(function() {
                console.log("complete");
            });
        }
        else
        {
            $.ajax(
            {
            url: '/billing/bills/billList/billListDeliveryStatusUpdate/'+billId,
            type: 'post',
            // dataType: "JSON",
            data: {
                "_token": token,
                "_method": 'post',
            },
            })
            .done(function() {
                console.log("success");
                $("#"+billId+" #deliveryStatusUpdateBillId2").removeAttr("onclick");
                $("#"+billId+" #deliveryStatusUpdateBillId2").attr("onclick","deliveryStatusUpdate("+billId+", 1)");
                $("#"+billId+" #deliveryStatusUpdateBillId2").removeClass("btn-danger");
                $("#"+billId+" #deliveryStatusUpdateBillId2").addClass("btn-success");
                $("#"+billId+" #deliveryStatusUpdateBillId2").val("Done");
                $("#"+billId+" #deliveryStatusUpdateBillId2").prop('id', 'deliveryStatusUpdateBillId1');
                
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
                
            });
        }
    }
  </script>
  
  
  {{-- Payment status dynamic update --}}
  
<script type="text/javascript">
    function paymentStatusUpdate(billId, paymentStatusId) {
        console.log('called');
  
        var token = $("meta[name='csrf-token']").attr("content");
        console.log(billId);
        console.log(token);
        if (paymentStatusId==1)
        {
            $.ajax(
            {
                url: '/billing/bills/billList/billListPaymentStatusUpdate/'+billId,
                type: 'post',
                // dataType: "JSON",
                data: {
                // "billId": billId
                "_token": token,
                "_method": 'post',
                },
            })
            .done(function() {
                console.log("success");
                $("#"+billId+" #paymentStatusUpdateBillId1").removeAttr("onclick");
                $("#"+billId+" #paymentStatusUpdateBillId1").attr("onclick","paymentStatusUpdate("+billId+", 2)");
                $("#"+billId+" #paymentStatusUpdateBillId1").removeClass("btn-success");
                $("#"+billId+" #paymentStatusUpdateBillId1").addClass("btn-danger");
                $("#"+billId+" #paymentStatusUpdateBillId1").val("Due");
                    $("#"+billId+" #paymentStatusUpdateBillId1").prop('id', 'paymentStatusUpdateBillId2');
                
                })
                .fail(function() {
                console.log("error");
                })
                .always(function() {
                console.log("complete");
            });
        }
        else
        {
            $.ajax(
            {
            url: '/billing/bills/billList/billListPaymentStatusUpdate/'+billId,
            type: 'post',
            // dataType: "JSON",
            data: {
                "_token": token,
                "_method": 'post',
            },
            })
            .done(function() {
                console.log("success");
                $("#"+billId+" #paymentStatusUpdateBillId2").removeAttr("onclick");
                $("#"+billId+" #paymentStatusUpdateBillId2").attr("onclick","paymentStatusUpdate("+billId+", 1)");
                $("#"+billId+" #paymentStatusUpdateBillId2").removeClass("btn-danger");
                $("#"+billId+" #paymentStatusUpdateBillId2").addClass("btn-success");
                $("#"+billId+" #paymentStatusUpdateBillId2").val("Paid");
                $("#"+billId+" #paymentStatusUpdateBillId2").prop('id', 'paymentStatusUpdateBillId1');
                
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
                
            });
        }
    }
  </script>
  

@endsection