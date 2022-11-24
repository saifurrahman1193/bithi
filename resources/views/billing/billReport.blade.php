<html>
<head>
  <title>Bill Report</title>
<style type="text/css" media="screen">

table {
  border-collapse: collapse;
}
    p.header-title{
        font-size: 10pt;
        line-height: 5px;
        text-align:center;        
    }
  
  p.invoice-mst-info{
        font-size: 10pt;
        line-height: 5px;
    }

/*   #item-table {
  border-collapse: collapse;
  } */
   tbody tr, thead tr{
    border: 1px solid #666;
  }
/*   #item-table tbody td, thead td  {
    border: 0px;
  }  */

  td span {
  background: #f2f0e4;
  padding: 0 20px;
  color: black;
}
</style>
</head>

<body>
        <p class="header-title" ><strong style="font-size: 20pt">{{ title_case($billlistsummary->companyName) }}</strong></p>
        <p class="header-title"  style="font-size: 8pt" >{{ $billlistsummary->companyAddress }}</p>
        <p class="header-title "  >{{ $billlistsummary->companyEmail.', '.$billlistsummary->companyPhone }}</p>
        <p class="header-title "  >{{ $billlistsummary->companyWebsite}}</p>
        <p class="header-title"  ><strong>BILL</strong></p>
        @if (!preg_match('/localhost:8000/i', url('/')))
          <img  src={{ asset(DB::table('company')->pluck('logoUrl')->first()) }} alt="logo"  width="75px" style="margin-top: -125px; margin-left: 40px;">
        @else
          <img  src={{ public_path().DB::table('company')->pluck('logoUrl')->first() }} alt="logo"  width="75px" style="margin-top: -75px; margin-left: 40px;">
        @endif

<table width="90%" border="0" align="center">

    <tbody>
        <tr>
    
              <td style="max-width: 500px;">
                <p class="invoice-mst-info"  align="left">
                  <table style="max-width: 500px;">
                      <tbody>
                          <tr><td>Invoice No: <strong>{{$billlistsummary->invoiceNo}}</strong></td></tr>
                          <tr><td>Customer ID: <strong>{{$billlistsummary->customerPhone}}</strong></td></tr>
                          <tr><td>Customer Name: <strong>{{strtoupper($billlistsummary->customerName)}}</strong></td></tr>
                          <tr><td>Address: {{$billlistsummary->customerAddress  }}</td></tr>
                      </tbody>
                  </table>
                </p>

                    {{-- <p class="invoice-mst-info"  align="left">Invoice No: <strong>{{$billlistsummary->invoiceNo}}</strong></p> --}}
                      {{-- <p class="invoice-mst-info"  align="left">Customer ID: <strong>{{$billlistsummary->customerPhone}}</strong></p> --}}
                      {{-- <p class="invoice-mst-info"  align="left">Customer Name: <strong>{{title_case($billlistsummary->customerName)}}</strong></p> --}}
                      {{-- <p class="invoice-mst-info"  align="left">Address/Mobile: <strong>{{$billlistsummary->customerAddress .' '.$billlistsummary->customerPhone }}</strong></p> --}}

              </td>
              <td align="right" style="max-width: 200px;">
                    <p class="invoice-mst-info"  >Invoice Date: <strong>{{$billlistsummary->invoiceDate}}</strong></p>
                      {{-- <p class="invoice-mst-info"  >Deliveryman: <strong>{{$billlistsummary->deliveryMan}}</strong></p>
                      <p class="invoice-mst-info"  >District: <strong>{{$billlistsummary->customerDistrict}}</strong></p> --}}
              </td>
    
    
        </tr>
    </tbody>
    
  </table>

 <br>
  <table border="1" id="item-table" width="90%" align="center">
    <thead >
      <tr align="center">
        <th>SL#</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>Unit Price</th>
        <th>Sold Qty</th>
        {{-- <th>Total</th>
        <th>Disc(%)</th> --}}

        <th>Total Amount</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($billlDetails as $billlDetails)
        <tr >
          <td align="center">{{$loop->index+1}}</td>

          <td>{{ title_case($billlDetails->itemName).' ('.$billlDetails->itemCode.')' }}</td>
          <td>{{ title_case($billlDetails->description) }}</td>
          <td align="center">{{ $billlDetails->unitPrice }}</td>
          <td align="center">{{ $billlDetails->soldQty }}</td>
          {{-- <td align="center">{{ $billlDetails->unitPrice*$billlDetails->soldQty }}</td>
          <td align="center">{{ $billlDetails->discountPercent }}</td> --}}
          <td align="center">{{ numberFormat($billlDetails->totalPrice) }}</td>
        </tr>
      @endforeach
      
      <tr align="right">

        <td align="right" colspan="4">TOTAL : </td>
        <td align="center">{{$billlistsummary->qtyTotal}}</td>
        <td align="center" style="font-weight: bold;">{{numberFormat($billlistsummary->amountTotal)}}</td>
      </tr>
      


    </tbody>

    
  </table>
  
   <br>
   
  <table border="0" id="item-table" width="90%" align="center">

    <tbody>

        <tr >
        <td> <strong>Taka in Word :  {{ $ntw }}</strong></td>
        </tr>
          


    </tbody>

    
  </table>
  
  

  <br>
  
  <table width="90%" border="0" align="center">

    <tbody>
        <tr>
    
              <td>
                      {{-- <p class="invoice-mst-info"  align="left">QC : <strong>{{title_case($billlistsummary->qcStatus)}}</strong></p>
                      <p class="invoice-mst-info"  align="left">Call: <strong>{{title_case($billlistsummary->billCall)}}</strong></p>
                      <p class="invoice-mst-info"  align="left">Delivery Status: <strong>{{title_case($billlistsummary->deliveryStatus)}}</strong></p> --}}
                      {{-- <p class="invoice-mst-info"  align="left">Payment Status: <strong>{{title_case($billlistsummary->paymentStatus)}}</strong></p> --}}
              </td>
              <td align="right">
                    {{-- <p class="invoice-mst-info"  >Invoice Amount: <strong>{{$billlistsummary->amountTotal}}</strong></p>
                      <p class="invoice-mst-info"  >Discount Amount: <strong>{{$billlistsummary->discountAmount}}</strong></p>
                      <p class="invoice-mst-info"  >Delivery Charge: <strong>{{$billlistsummary->deliveryCharge}}</strong></p>
                      <p class="invoice-mst-info"  >Total Receivable Amount: <strong>{{$billlistsummary->totalReceivableAmount}}</strong></p> --}}

                    <table align="right">
                      <tbody>
                        <tr>
                          <td>Invoice Amount</td>
                          <td>:</td>
                          <td align="right"><strong>{{numberFormat($billlistsummary->amountTotal)}}</strong></td>
                        </tr>
                        <tr>
                          <td>Previous Dated <strong>{{YmdTodmy($billlistsummary->lastSecondInvoiceDate)}}</strong> Dues</td>
                          <td>:</td>
                          <td align="right"><strong>{{numberFormat($billlistsummary->lastSecondInvoiceDatedDue)}}</strong></td>
                        </tr>
                        <tr>
                          <td>Delivery Charge</td>
                          <td>:</td>
                          <td align="right"><strong>{{numberFormat($billlistsummary->deliveryCharge)}}</strong></td>
                        </tr>
                        <tr>
                          <td>Discount Amount</td>
                          <td>:</td>
                          <td align="right"><strong>{{numberFormat($billlistsummary->discountAmount)}}</td>
                        </tr>
                        <tr>
                          <td>Amount Paid</td>
                          <td>:</td>
                          <td align="right"><strong>{{numberFormat($billlistsummary->transactionAmount)}}</strong></td>
                        </tr>
                        <tr>
                          <td>Grand Total</td>
                          <td>:</td>
                          <td align="right"><strong>{{numberFormat($billlistsummary->lastInvoiceDatedDue)}}</strong></td>
                        </tr>

                        {{-- <tr>
                          <td>Total Receivable Amount</td>
                          <td>:</td>
                          <td align="right"><strong>{{numberFormat($billlistsummary->totalReceivableAmount)}}</strong></td>
                        </tr> --}}
                        
                        {{-- <tr>
                          <td>Due</td>
                          <td>:</td>
                          <td align="right"><strong>{{numberFormat($billlistsummary->due)}}</strong></td>
                        </tr> --}}
                        {{-- <tr>
                          <td>Total Paid</td>
                          <td>:</td>
                          <td align="right"><strong>{{numberFormat($billlistsummary->totalTransaction)}}</strong></td>
                        </tr> --}}
                        {{-- <tr>
                          <td>Total Previous Due</td>
                          <td>:</td>
                          <td align="right"><strong>{{numberFormat($billlistsummary->totalDue)}}</strong></td>
                        </tr> --}}
                        
                      </tbody>
                    </table>


          </td>
    
    
        </tr>
    </tbody>
    
  </table>

  <br>
  <br>
  <br>


<table width="90%" border="0" align="center">

    <tbody>
        <tr>
              <td><i><strong>Notes:</strong> {{$billlistsummary->specialInstruction}}</i></td>    
  
        </tr>
    </tbody>
    
  </table>
  

<br>
<br>
<br>
  <table width="90%" border="0" align="center" style="margin-top: 100px;">
    <tbody>
        <tr>
              <td><hr ><p align="center">Signature-Store</p></td>    
              <td style="width: 200px;"><p></p></td>    
              {{-- <td><hr ><p align="center">Signature-Accounts</p></td>     --}}
              <td><hr ><p align="center">Customer's Signature</p></td>    
        </tr>
    </tbody>
  </table>
</body>
</html>