@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Inventory')

@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>









<div class="content-wrapper" style="min-height: 0px;">

  {{-- Notification --}}
    {{-- Notification --}}
    @if (session('successMsg'))
                

      <div class="alert alert-success"  id="alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('successMsg') }}
      </div>


    @endif





  <div class="card">
    <div class="card-body">

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Product Returns</h4>

        {{-- <a href="{{ route('createproduct') }}" class="btn btn-info " style="margin-bottom: 10px; "><span>Add Service/Product Items</span></a> --}}



    {{-- data table start --}}
    {{-- data table start --}}
    <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " width="100%" >
          <thead>
              <tr class="bg-primary text-light">
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">Date</th>
                  <th scope="col">Product</th>
                  <th scope="col">Supplier</th>
                  <th scope="col">Received Quantity</th>
                  <th scope="col">Total Stock</th>
                  <th scope="col">Return Quantity</th>
                  <th scope="col">Return Value</th>
                  <th scope="col">Cause Of Returns</th>
              </tr>
          </thead>
          
          <tbody>
               @foreach (DB::table('inventory_view')->whereNotNull('returnProductQty')->orderBy('entryDate', 'desc')->get() as $inventory)
                  <tr>

                      <td>{{ \Carbon\Carbon::parse($inventory->entryDate)->format('d-m-Y')}}</td>
                      <td> {{$inventory->itemName.' ('.$inventory->itemCode.')'}}</td>
                      <td>{{$inventory->supplierTitle}}</td>
                      <td>{{$inventory->quantity}}</td>
                      <td>{{$inventory->itemInStock}}</td>
                      <td>{{$inventory->returnProductQty}}</td>
                      <td>{{number_format($inventory->returnProductQty*$inventory->unitPrice)}}</td>
                      <td>{{$inventory->causeOfReturns}}</td>
                      
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