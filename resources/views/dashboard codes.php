 <!-- current year data -->

 SELECT         
        months.monthId as invoiceMonth,
        months.month as invoiceMonthName,        
		ifnull((select SUM(`bills`.`totalReceivableAmount`) from bills WHERE (YEAR(`bills`.`invoiceDate`) = YEAR(CURDATE())) and `bills`.`pmntStatusId` = 1 and invoiceMonthId=months.monthId ), 0) AS `amount`         
    FROM
        `bills`  right join months on (bills.invoiceMonthId = months.monthId)        
         GROUP BY  months.monthId
         


<!-- all year data -->

 select 
    years.yearId as invoiceYearId,  
    years.year as invoiceYear, 
    months.monthId as invoiceMonthId,
    months.month as invoiceMonthName,
    ifnull((select SUM(`bills`.`totalReceivableAmount`) from bills WHERE invoiceYearId=years.yearId and  `bills`.`pmntStatusId` = 1 and invoiceMonthId=months.monthId ), 0) AS `amount`
    from years, months , bills
    GROUP BY years.yearId, months.monthId
    order by years.yearId, months.monthId;




<script type="text/javascript">
  
    google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {


        @if (request()->has('year'))
            


            var data = new google.visualization.arrayToDataTable([
                ['Move', 'Amount'],
                    <?php
                        foreach(DB::table('dash_revenue_all_years_stat_view')->where('invoiceYear', request('year'))->get() as $amounts)
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
              format: '##,##,##,##,###.##' // show axis values to 3 decimal places

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