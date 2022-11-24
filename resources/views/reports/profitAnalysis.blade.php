@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')


@section('pageTitle', 'Profit Analysis')

@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>



<div class="content-wrapper" style="min-height: 0px; padding-top: 0px; " >




  <div class="card" style="min-height: 0px; padding-top: 0px; ">
    <div class="card-body">

        <h4 class="card-title text-md-center" >Profit Analysis</h4>



        <div class="text-md-center">
          @if ( (DB::table('profitanalysis_view')->count('itemId'))>0 )
              <a href="{{ route('report.profitAnalysis.profitAnalysisExcelReportDownload') }}" target="_blank">
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
                  <th scope="col">Date</th>
                  <th scope="col">Product Code</th>
                  <th scope="col">Product Name</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Buying Price</th>
                  <th scope="col">Selling Price</th>
                  <th scope="col">Profit</th>
                  <th scope="col">Supplier</th>
              </tr>
          </thead>
          
          <tbody>
                @foreach (DB::table('profitanalysis_view')->get() as $profitAnalysis)
                  <tr>
                      <td> {{ \Carbon\Carbon::parse($profitAnalysis->invoiceDate)->format('d-m-Y')}}</td>
                      <td>{{ $profitAnalysis->itemCode }}</td>
                      <td>{{ $profitAnalysis->itemName }}</td>
                      <td>{{ $profitAnalysis->qty }}</td>
                      <td>{{ $profitAnalysis->buyingPrice }}</td>
                      <td>{{ $profitAnalysis->totalPrice }}</td>
                      <td>{{ $profitAnalysis->profit}}</td>
                      <td>{{ $profitAnalysis->supplierTitle}}</td>
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


