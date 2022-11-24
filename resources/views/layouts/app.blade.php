

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hishab | @yield('pageTitle')</title>

    {{-- facebook --}}
    {{-- facebook --}}
    {{-- <meta property="og:url"           content="{{ route('news1') }}" /> --}}
    {{-- <meta property="og:type"          content="website" /> --}}
    <meta property="og:image"         content={{ asset($company[0]->logoUrl) }} />


    <meta property="og:url"           content={{ $company[0]->website }} />
    {{-- <meta property="og:type"          content=@yield('og_type') /> --}}
    <meta property="og:type" content="xxx:photo">
    <meta property="og:title"         content="{{ title_case($company[0]->name) }}" />
    <meta property="og:description"   content="Small Business Management Software." />
    {{-- <meta property="og:title"         content=@yield('og_title') /> --}}
    {{-- <meta property="og:description"   content=@yield('og_description') /> --}}
    {{-- <meta property="og:image"         content=@yield('og_image') /> --}}





    <!-- Styles -->
    <!-- Styles -->
    <!-- Styles -->
    
    <meta name="description" content="&amp;lt;img src=&amp;quot;{{ asset('images/users/czkcl.png') }}&amp;quot; alt=&amp;quot;review&amp;quot;...">
    <meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

    <link rel="stylesheet" media="all" href="{{ asset('css/style.css') }}" />
    {{-- <link rel="stylesheet" media="all" href="{{ asset('css/style1.css') }}" /> --}}
    {{-- <link rel="stylesheet" media="all" href="{{ asset('css/style2.css') }}" /> --}}


    <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Hishab</title>
      <!-- plugins:css -->
      {{-- <link rel="stylesheet" href="{{ asset('css/materialdesignicons.min.css') }}"> --}}
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.0.39/css/materialdesignicons.min.css">

      {{-- <link rel="stylesheet" href="{{ asset('css/simple-line-icons.css') }}"> --}}
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">

      
      {{-- <link rel="stylesheet" href="{{ asset('css/flag-icon.min.css') }}"> --}}
      {{-- <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.min.css') }}"> --}}
      <!-- endinject -->
      <!-- plugin css for this page -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
      {{-- <link rel="stylesheet" href="{{ asset('css/fontawesome-stars.css') }}"> --}}
      {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/themes/fontawesome-stars.css"> --}}
      <!-- End plugin css for this page -->



      {{-- pages  css --}}
      {{-- table  --}}
      {{-- data --}}
      {{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}"> --}}
      <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">

      {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.min.css') }}"> --}}

      {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}
      {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}"> --}}




      
      <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/tooltipster.bundle.min.css') }}">
 



      

      <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">





      

      <!-- endinject -->
      {{-- favicon icon --}}
      {{-- <link rel="shortcut icon" href="{{ asset('images/users/czkcl.png') }}" /> --}}
      <link rel="shortcut icon" href={{ asset($company[0]->logoUrl) }} />


      {{-- input fields background color setting --}}
      <style>
          .card input[type="text"], input[type="number"], input[type="date"], input[type="email"], input[type="select"], input[type="password"], .card select , .card textarea, select {
            /* background-color: #c8c8d1; */
            background-color: #e6e6fa;
          }
          /* pop up input fields */
          .form-group input[type="text"], input[type="number"], input[type="date"], input[type="email"], input[type="select"], input[type="password"], .card select , .form-group textarea, select {
            background-color: #e6e6fa;
          }
          .card input[type="text"]:read-only, input[type="number"]:read-only, input[type="date"]:read-only, input[type="email"]:read-only, input[type="password"]:read-only , .card textarea:read-only {
            /* background-color: #c8c8d1; */
            background-color: white;
          }
          
      </style>


      {{-- datatables --}}
      {{-- datatables --}}
      <style>

        /* search start*/

        div.dataTables_wrapper div.dataTables_filter input{

            border: 1px solid #00B4CC;
            padding: 5px;
            height: 20px;
            border-radius: 3px;
            outline: none;
            width: 30vw;
            padding: 13px;

        }

        #datatable1_filter, #datatable2_filter, #datatable3_filter, 
        #datatable1WScroll_filter,#datatable2WScroll_filter,#datatable3WScroll_filter,
        #datatable1_paginate, #datatable2_paginate, #datatable3_paginate, 
        #datatable1WScroll_paginate,#datatable2WScroll_paginate,#datatable3WScroll_paginate{
          float: right
        }

        div.dataTables_wrapper div.dataTables_length
        {
            max-width: 150px;
            margin-bottom: -40px;
        }

        /* search end*/

         .current{
            padding: 3px 7px;
            font-weight: bold;
            background: #03a9f3 !important;
            border: 1px solid #ddd;
            color: white !important;
            cursor: pointer;
            border-radius: 20px;
        }

        .dataTables_wrapper:hover .dataTables_paginate:hover .paginate_button:hover, .dataTables_wrapper:focus .dataTables_paginate:focus .paginate_button:focus{
            padding: 5px 9px;
            font-weight: bold;
            background: #03a9f3 !important;
            border: 1px solid #ddd;
            color: white !important;
            cursor: pointer;
            border-radius: 20px;
            margin: 0px 3px;
        }


        .dataTables_wrapper .dataTables_paginate .paginate_button {
            text-decoration: none;
            padding: 3px 7px;
            /* background: white; */
            border-color: #03a9f3;
            color: black;
        }



        /* datatable action buttons */
        #tdtableaction
        {
          /* padding: 0px 20px; */
          padding:  0px;
          font-size: 25px;
          text-align: center;
        }

        </style>


        


      

        <style type="text/css" media="screen">
            .form-group.required .control-label:after {
              content:"*";
              color:red;
            }
        </style>





</head>
<body @yield('pageOnLoad')>

<div class="pre-loader " style="z-index: 1000">
  <div class="sk-fading-circle ">
    <div class="sk-circle1 sk-circle "></div>
    <div class="sk-circle2 sk-circle"></div>
    <div class="sk-circle3 sk-circle"></div>
    <div class="sk-circle4 sk-circle"></div>
    <div class="sk-circle5 sk-circle"></div>
    <div class="sk-circle6 sk-circle"></div>
    <div class="sk-circle7 sk-circle"></div>
    <div class="sk-circle8 sk-circle"></div>
    <div class="sk-circle9 sk-circle"></div>
    <div class="sk-circle10 sk-circle"></div>
    <div class="sk-circle11 sk-circle"></div>
    <div class="sk-circle12 sk-circle"></div>
  </div>
</div>







{{-- start container here --}}
{{-- start container here --}}

<div class="container-scroller">


    <!-- partial:partials/_navbar.blade.php -->
    @yield('navbar_content')










    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="row row-offcanvas row-offcanvas-right">


        <!-- partial:partials/_settings-panel.html -->
        {{-- <div class="theme-setting-wrapper">
          <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles primary"></div>
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles pink"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default"></div>
            </div>
          </div>
        </div> --}}



        {{-- <div id="right-sidebar" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <ul class="nav nav-tabs" id="setting-panel" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
            </li>
          </ul>
          <div class="tab-content" id="setting-content">
            <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
              <div class="add-items d-flex px-3 mb-0">
                <form class="form w-100">
                  <div class="form-group d-flex">
                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                    <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                  </div>
                </form>
              </div>
              <div class="list-wrapper px-3">
                <ul class="d-flex flex-column-reverse todo-list">
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Team review meeting at 3.00 PM
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Prepare for presentation
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox">
                        Resolve all the low priority tickets due today
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked>
                        Schedule meeting for next week
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked>
                        Project review
                      </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                </ul>
              </div>
              <div class="events py-4 border-bottom px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                  <span>Feb 11 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
                <p class="text-gray mb-0">build a js based app</p>
              </div>
              <div class="events pt-4 px-3">
                <div class="wrapper d-flex mb-2">
                  <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                  <span>Feb 7 2018</span>
                </div>
                <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                <p class="text-gray mb-0 ">Call Sarah Graves</p>
              </div>
            </div>
            <!-- To do section tab ends -->
            <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
              <div class="d-flex align-items-center justify-content-between border-bottom">
                <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
              </div>
              <ul class="chat-list">
                <li class="list active">
                  <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Thomas Douglas</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">19 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <div class="wrapper d-flex">
                      <p>Catherine</p>
                    </div>
                    <p>Away</p>
                  </div>
                  <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                  <small class="text-muted my-auto">23 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Daniel Russell</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">14 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                  <div class="info">
                    <p>James Richardson</p>
                    <p>Away</p>
                  </div>
                  <small class="text-muted my-auto">2 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Madeline Kennedy</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">5 min</small>
                </li>
                <li class="list">
                  <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                  <div class="info">
                    <p>Sarah Graves</p>
                    <p>Available</p>
                  </div>
                  <small class="text-muted my-auto">47 min</small>
                </li>
              </ul>
            </div>
            <!-- chat tab ends -->
          </div>
        </div> --}}













        <!-- partial -->




        <!-- partial:partials/_sidebar.blade.php -->
        @yield('sidebar_content')




        
        {{-- individual page body --}}
        {{-- individual page body --}}
        @yield('page_content')















    



          





        <!-- partial -->
      </div>
      <!-- row-offcanvas ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


{{-- end container here --}}
{{-- end container here --}}









          <script src="{{ asset('js/jquery.min.js') }}"></script>
          
          <script src="{{ asset('js/tooltipster.bundle.min.js') }}"></script>
          
          {{-- <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script> --}}
          
          {{-- <script src="{{ asset('js/jquery-2.1.0.min.js') }}"></script> --}}

          {{-- <script src="{{ asset('js/jquery.barrating.min.js') }}"></script> --}}
          {{-- <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script> --}}
          {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
          {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}
          <script src="{{ asset('js/bootstrap.min.js') }}"></script>
          {{-- <script src="{{ asset('js/bootstrap-toggle.min.js') }}"></script> --}}
          
          <script type="text/javscript" src="{{ asset('js/bootstrap-confirmation.js') }}"></script>
          <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>

         {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/ripples.min.js"></script>  --}}


          {{-- <script type="text/javascript" >$.material.init()</script> --}}
          
    
          <!-- plugins:js -->
          {{-- <script src="{{ asset('js/popper.min.js') }}"></script> --}}
        {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}
          <!-- endinject -->
          <!-- Plugin js for this page-->
          {{-- <script src="{{ asset('js/Chart.min.js') }}"></script> --}}
          <script src="{{ asset('js/raphael.min.js') }}"></script>
          <script src="{{ asset('js/morris.min.js') }}"></script>
          <!-- End plugin js for this page-->
          <!-- inject:js -->
          <script src="{{ asset('js/off-canvas.js') }}"></script>
          <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
          <script src="{{ asset('js/misc.js') }}"></script>
          <script src="{{ asset('js/settings.js') }}"></script>
          {{-- <script src="{{ asset('js/todolist.js') }}"></script> --}}
          <!-- endinject -->
          <!-- Custom js for this page-->
          <script src="{{ asset('js/dashboard.js') }}"></script>
          <!-- End custom js for this page-->













<script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","errorBeacon":"bam.nr-data.net","licenseKey":"fcf8d519de","applicationID":"13909","transactionName":"NTU0DRQNDwshOmIZBRM3dR8TDg84Nys/FRQYBSoLAxQKAjM=","queueTime":0,"applicationTime":24,"agent":"","atts":"DXgvW1wZQRQtPChSS1QOMhwLByUINi0+BFNaeCkKCkBZASUkPhVdVCg/CBMHEBMbOD8fBRk5NRVEWEEPMDw9Sl5ZeHZbDxJBXWZ5fUNfQGp0SFFQTVZ3cG9cUwMpPws5AwQCKjxvSlM7NSAQCg4CSHFmfVBZITM0HQkVEEcKHG1BQVhqYVkxLTRRcGFtMQEGNj8uAwAoDjBneENGWGlsWU4pKzMJBGFQHR8xP1khBwAMK2FtMxkENTccSVdWSXRmf0hJRXRtTEYxAgElOiRfREVtdEpQQi4GPDwlHx9Zb3RISFRNVHR4fVJdVCg/Dw8RCggqandSQU9iPh9fUUEaOQ=="}</script>

    <script src="{{ asset('js/huge.js') }}" type="text/javascript"></script>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">








    
      


          
        












      <script type="text/javscript" src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
      

      {{-- <script type="text/javscript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script> --}}
      {{-- <script type="text/javscript" src="{{ asset('js/jquery-3.3.1.js') }}"></script> --}}


      <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>



            {{-- bootstrap data table --}}
      {{-- https://datatables.net/examples/styling/bootstrap4 --}}
      <script>
        // $(document).ready(function() {
        //     $('#datatable1').DataTable();

        // } );

        $(document).ready(function() {
            $('#datatable1').DataTable( {
                "pagingType": "simple_numbers",
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },
                // "dom": '<"top"fl>rt<"bottom"pi>'
            } );

            $('#datatable2').DataTable( {
                "pagingType": "simple_numbers",
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },
                // "dom": '<"top"fl>rt<"bottom"pi>'
            } );

            $('#datatable3').DataTable( {
                "pagingType": "simple_numbers",
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },
                // "dom": '<"top"fl>rt<"bottom"pi>'
            } );


            // with sxrol-x
            $('#datatable1WScroll').DataTable( {
                "pagingType": "simple_numbers",
                "scrollX": true,
                // "ordering": false,
                "responsive": true,
                "autoWidth": false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },
                // "dom": '<"top"fl>rt<"bottom"pi>'

            } );

            $('#datatable2WScroll').DataTable( {
                "pagingType": "simple_numbers",
                "scrollX": true,
                // "ordering": false,
                "responsive": true,
                "autoWidth": false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },
                // "dom": '<"top"fl>rt<"bottom"pi>'
            } );
            $('#datatable3WScroll').DataTable( {
                "pagingType": "simple_numbers",
                "scrollX": true,
                // "ordering": false,
                "responsive": true,
                "autoWidth": false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },
                // "dom": '<"top"fl>rt<"bottom"pi>'
            } );

            
        } );



      </script>


  
    {{-- notification --}}
    {{-- notification --}}
    <script type="text/javascript">
        window.setTimeout(function() {
            $(".alert#alert-success").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    </script>


    {{-- <script src="{{ asset('js/sweetalert.min.js') }}" type="text/javascript" charset="utf-8" async defer></script> --}}
    <script src="{{ asset('js/select2.min.js') }}" type="text/javascript" charset="utf-8" ></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>

    
{{-- tooltipser --}}
    <script>
        $('.tooltipster').tooltipster({
            theme: 'tooltipster-punk'
        });
    </script>


    {{-- preloader --}}
    <script type="text/javascript">
                (function($){
                  'use strict';
                    $(window).on('load', function () {
                        if ($(".pre-loader").length > 0)
                        {
                            $(".pre-loader").fadeOut("slow");
                        }
                    });
                })(jQuery)
    </script>

{{-- for toggle button --}}
{{--     <script>
      $(function() {
        $('#toggle-one').bootstrapToggle({
           
        });
        $('#toggle-two').bootstrapToggle({
          
        });
      })
    </script> --}}


</body>
</html>
