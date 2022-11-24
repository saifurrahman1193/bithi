<div class="col-md-12 col-lg-12 grid-margin stretch-card" >
        <div class="card">
          <div class="card-body" >

            @if (request()->has('year'))
              <h6 class="card-title">Revenue Report - {{ request('year') }}</h6>
            @else
              <h6 class="card-title">Revenue Report - {{ date('Y') }}</h6>
            @endif

            <div class="row">
              <div class="col-12 text-center">
                
              </div>
            </div>

            <div class="w-100 mx-auto">


                {{-- restriction 1  start--}}
                <div class=" col-md-6 col-sm-6 float-right mb-2">

                      <div class="form-group row float-right">
                        <label class="col-md-4 col-sm-3 col-form-label ">Year</label>

                        <div class="col-md-8 col-sm-9">
                            <select class="form-control m-bot15 " id="year" name="year"  onchange ="location = this.options[this.selectedIndex].value;">
                                @if (request()->has('year'))
                                    
                                  <option value="">{{ request('year') }}</option>
                                @else
                                  <option value="">{{ date('Y') }}</option>
                                @endif

                                  <option value="">--Year--</option>
                                    
                                    @foreach (DB::table('dash_revenue_all_years_stat_view')->where('amount','>', 0)->groupBy('invoiceYear')->get() as $year)
              
                                      <option  value="?year={{ $year->invoiceYear }}" > 
                                          {{ ($year->invoiceYear) }}
                                      </option> 
                                    @endforeach  

                            </select>
                        </div>
                        
                      </div>
                </div>
                {{-- restriction 1  end--}}





                <div id="top_x_div" style=" height: 300px;"  class="col-md-12 col-lg-12 grid-margin stretch-card"></div>


                
            </div>

          </div>
        </div>
    </div>  


    <script type="text/javascript">
  
        google.charts.load('current', {'packages':['bar']});
          google.charts.setOnLoadCallback(drawStuff);

          function drawStuff() {


            @if (request()->has('year'))
                


                var data = new google.visualization.arrayToDataTable([
                    ['Move', 'Amount'],
                        <?php
                            foreach(DB::table('dash_revenue_all_years_stat_view')->where('invoiceYear', request('year'))->orderBy('invoiceMonthId')->get() as $amounts)
                            {
                                echo '["'.$amounts->invoiceMonthName.'",'.$amounts->amount.'],';
                            }
                        ?>
                  ]);


            @else
                 var data = new google.visualization.arrayToDataTable([
                    ['Move', 'Amount'],
                        <?php
                            foreach(DB::table('dash_revenue_cur_year_stat_view')->get() as $amounts)
                            {
                                echo '["'.$amounts->invoiceMonthName.'",'.$amounts->amount.'],';
                            }
                        ?>
                  ]);

            @endif




            var options = {
              // width: 500,
              legend: { position: 'none' },
              // chart: {
              //   title: 'Chess opening moves',
              //   subtitle: 'popularity by percentage' },
              vAxis: {
                  format: '###,###,###,###.##' // show axis values to 3 decimal places

              },
              axes: {
                x: {
                  0: { side: 'bottom', label: ''} // Top x-axis.
                }
              },
              bar: { groupWidth: "70%" }
            };

            var chart = new google.charts.Bar(document.getElementById('top_x_div'));
            // Convert the Classic options to Material options.
            chart.draw(data, google.charts.Bar.convertOptions(options));
          };
    </script>