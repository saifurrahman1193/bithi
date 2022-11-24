@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')


@section('pageTitle', 'Receivable Due')

@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>



<div class="content-wrapper" style="min-height: 0px; padding-top: 0px; " >




  <div class="card" style="min-height: 0px; padding-top: 0px; ">
    <div class="card-body">

        <h4 class="card-title text-md-center" >Receivable Due</h4>

        <div class="text-md-center">
          

          @if ( (DB::table('receivable_due_view')->count('invoiceNo'))>0 )
              <a href="{{ route('report.receivableDue.receivableDueExcelReportDownload') }}" target="_blank">
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
                  <th scope="col">Invoice NO</th>
                  <th scope="col">Date</th>
                  <th scope="col">Due Amount</th>
                  <th scope="col">Customer Name</th>
              </tr>
          </thead>
          
          <tbody>
                @foreach (DB::table('receivable_due_view')->get() as $receivable_due)
                  <tr>
                      <td> {{ $receivable_due->invoiceNo }}</td>
                      <td> {{ \Carbon\Carbon::parse($receivable_due->invoiceDate)->format('d-m-Y')}}</td>
                      <td> {{ number_format($receivable_due->totalReceivableAmount) }}</td>
                      <td> {{ $receivable_due->customerName }}</td>
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


