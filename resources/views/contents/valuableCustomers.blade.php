<div class="col-md-12 col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body" style="background-color: rgba(0,0,0,0.1)">
      <h6 class="card-title">Your Valuable Customers</h6>
      {{-- <h6 class="card-title">Customers Summary</h6> --}}

      <div class="row">
        <div class="col-12 text-center">
          <div class="row"><p>Total Customers : <strong>{{ DB::table('customers')->count('customerId') }}</strong></p></div>
        </div>
      </div>

      <div class="w-100 mx-auto">

          {{-- data table start --}}
          {{-- data table start --}}
          <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
                <thead>
                    <tr class="bg-primary text-light">
                        <th scope="col">SL NO</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Phone NO</th>
                        <th scope="col">Total Orders</th>
                        <th scope="col">Total Value</th>
                    </tr>
                </thead>
                
                <tbody>
                     @foreach (DB::table('dash_cust_sum_most_freq_cust_list_view')->orderBy('totalOrders', 'desc')->get() as $customers)
                        <tr>
                            <td> {{ $loop->index+1 }}</td>
                            <td> {{ $customers->name }}</td>
                            <td> {{ $customers->phone }}</td>
                            <td> {{ $customers->totalOrders }}</td>
                            <td> {{ number_format($customers->totalValue) }}</td>
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