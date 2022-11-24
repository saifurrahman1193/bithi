@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')


@section('pageTitle', 'Payable Due')

@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>



<div class="content-wrapper" style="min-height: 0px; padding-top: 0px; " >




  <div class="card" style="min-height: 0px; padding-top: 0px; ">
    <div class="card-body">

        <h4 class="card-title text-md-center" >Payable Due</h4>


        <div class="text-md-center">
          
          @if ( (DB::table('payable_due_view')->count('itemId'))>0 )
              <a href="{{ route('report.payableDue.payableDueExcelReportDownload') }}" target="_blank">
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
                  <th scope="col">Item</th>
                  <th scope="col">Date</th>
                  <th scope="col">Total Amount</th>
                  <th scope="col">Due Amount</th>
                  <th scope="col">Supplier</th>
              </tr>
          </thead>
          
          <tbody>
                @foreach (DB::table('payable_due_view')->get() as $payable_due)
                  <tr>
                      <td> {{ $payable_due->item }}</td>
                      <td> {{ \Carbon\Carbon::parse($payable_due->inventroyDate)->format('d-m-Y') }}</td>
                      <td> {{ number_format($payable_due->totalAmount) }}</td>
                      <td> {{ number_format($payable_due->dueAmount) }}</td>
                      <td> {{ $payable_due->supplier }}</td>
                  </tr>
                @endforeach
          </tbody>
      </table>
    {{-- data table end --}}
    {{-- data table end --}}



    </div>
  </div>

</div>




@endsection


