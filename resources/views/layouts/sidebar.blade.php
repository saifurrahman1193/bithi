@section('sidebar_content')
  <nav class="sidebar sidebar-offcanvas" id="sidebar" style="z-index: 1000">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <div class="nav-link" style="margin-bottom: -50px;">
                <div class="profile-image mt-2 mb-0">
                  {{-- <img style="width: 7vw;" src="{{ asset('uploads/company/logo/company_logo.png') }}" alt="image"/> --}}
                  {{-- <img style="width: 7vw;" src={{ str_replace('\\', '/', public_path()).'/..'.'/'.DB::table('company')->pluck('logoUrl')->first() }} alt="logo"/> --}}
                  <img  src={{ asset(DB::table('company')->pluck('logoUrl')->first()) }} alt="logo" style="border-radius: 0%; max-width:50px; max-height:50px;">
                  <span class="online-status online"></span> <!--change class online to offline or busy as needed-->
                </div>
                
                {{-- <div class="profile-name">
                  <p class="name">
                    CZKCL
                  </p>
                  <p class="designation">
                    Super Admin
                  </p>
                </div> --}}


              </div>
            </li>


            <li class="nav-item"> 
              <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="icon-grid  menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

            @if ( (DB::table('userroles')
                               ->where('userId', auth::user()->id )
                               ->where('roleId', 1 )  // 1 = super admin
                               ->value('roleId')  
                          )==1 )

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#SuperAdmin"  aria-expanded="false" aria-controls="SuperAdmin">
                  <i class="icon-user menu-icon"></i>
                  <span class="menu-title">Super Admin</span>
                </a>
                <div class="collapse" id="SuperAdmin">
                  <ul class="nav flex-column sub-menu">

                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.index') }}"> Users </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admindashdisplay') }}"> Dashboard </a></li>

                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('user.create') }}"> Create User </a></li> --}}
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('role.index') }}"> Roles </a></li> --}}
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('user.userRoles') }}"> Assign Roles </a></li> --}}


                  </ul>
                </div>
              </li>
            @endif

            {{-- <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic-admin-dashboard"  aria-expanded="false" aria-controls="ui-basic-admin-dashboard">
                <i class=" icon-check menu-icon"></i>
                <span class="menu-title">Admin Dashboard</span>
              </a>
              <div class="collapse" id="ui-basic-admin-dashboard">
                <ul class="nav flex-column sub-menu">

                  <li class="nav-item"> <a class="nav-link" href="{{ route('productRequisitions.approval') }}"> Approve Requisitions </a></li>

                </ul>
              </div>
            </li>


            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic-audit-dashboard"  aria-expanded="false" aria-controls="ui-basic-audit-dashboard">
                <i class=" icon-check menu-icon"></i>
                <span class="menu-title">Audit Dashboard</span>
              </a>
              <div class="collapse" id="ui-basic-audit-dashboard">
                <ul class="nav flex-column sub-menu">

                  <li class="nav-item"> <a class="nav-link" href="{{ route('auditRequisitions.audit') }}"> Approved Requisition </a></li>

                </ul>
              </div>
            </li> --}}


            {{-- <li class="nav-item"> 
              <a class="nav-link" href="{{ route('customer') }}">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">Add Customer</span>
              </a>
            </li> --}}


            {{-- <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#e-commerce"  aria-expanded="false" aria-controls="e-commerce">
                <i class="icon-people menu-icon"></i>
                <span class="menu-title">HRM</span>
              </a>
              <div class="collapse" id="e-commerce">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('hr') }}"> HR </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('attendanceEntry') }}"> Attendance Entry</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('attendanceReport') }}"> Attendance Report</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('payroll') }}"> Payrolls </a></li>
                </ul>
              </div>
            </li> --}}

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#Inventory"  aria-expanded="false" aria-controls="Inventory">
                <i class="icon-basket-loaded menu-icon"></i>
                <span class="menu-title">Inventory</span>
                {{-- <span class="badge badge-info">3</span> --}}
              </a>
              <div class="collapse" id="Inventory">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('inventory') }}"> Inventory </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('inventory.return.product.list') }}"> Product Returns </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('inventory.settings') }}"> Inventory Settings</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('supplier') }}"> Suppliers </a></li>
                </ul>
              </div>
            </li>


            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#Billing"  aria-expanded="false" aria-controls="Billing">
                <i class="icon-credit-card menu-icon"></i>
                <span class="menu-title">Billing</span>
              </a>
              <div class="collapse" id="Billing">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('bills') }}"> Make An Invoice </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('billList') }}"> Bills </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('customers') }}"> Customers </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('productSoldToWhomCustomerList') }}"> Product Sold To Whom </a></li>

                </ul>
              </div>
            </li>





            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#Expense"  aria-expanded="false" aria-controls="Expense">
                <i class="icon-wallet  menu-icon"></i>
                <span class="menu-title">Expense</span>
              </a>
              <div class="collapse" id="Expense">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('expense.expenses.index') }}"> Expenses </a></li>

                </ul>
              </div>
            </li> 



            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#CRM"  aria-expanded="false" aria-controls="CRM">
                <i class="icon-bubbles   menu-icon"></i>
                <span class="menu-title">CRM</span>
              </a>
              <div class="collapse" id="CRM">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('crm.valuableCustomers') }} "> Valuable Customers </a></li>

                </ul>
              </div>
            </li>    


            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#Reports"  aria-expanded="false" aria-controls="Reports">
                <i class="icon-docs    menu-icon"></i>
                <span class="menu-title">Reports</span>
              </a>
              <div class="collapse" id="Reports">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('report.stockReport') }}"> Stock Report </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('report.receivableDue') }}"> Receivable Due </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('report.payableDue') }}"> Payable Due </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('report.profitAnalysis') }}"> Profit Analysis </a></li>

                </ul>
              </div>
            </li>  



            


            <li class="nav-item"> 
              <a class="nav-link" href="{{ route('company') }}">
                <i class="icon-settings   menu-icon"></i>
                <span class="menu-title">Company Settings</span>
              </a>
            </li>

{{-- 
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic2"  aria-expanded="false" aria-controls="ui-basic2">
                <i class="icon-envelope-letter menu-icon"></i>
                <span class="menu-title">Requisitions</span>
              </a>
              <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('productRequisitions.index') }}">Product/Material Requisition </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('fabricRequisitions') }}">Fabric Requisition </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('fuelRequisitions') }}">Fuel Requisition </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('fabricSettingsMainPage') }}">Fabric Settings </a></li>
                </ul>
              </div>
            </li>


            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#accounts"  aria-expanded="false" aria-controls="accounts">
                <i class=" icon-wallet  menu-icon"></i>
                <span class="menu-title">Accounts</span>
              </a>
              <div class="collapse" id="accounts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('accountsProductRequisitions') }}">Requisitions </a></li>
                </ul>
              </div>
            </li> --}}



            


{{-- #ui-basic --}}
            
            {{-- <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#page-layouts"  aria-controls="page-layouts"  >
                <i class="icon-briefcase menu-icon"></i>
                <span class="menu-title">Requisitions</span>
                <span class="badge badge-info">2</span>
              </a>
              <div class="collapse" id="page-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('requisition') }}"> Add Requisition </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('requisition_receive') }}"> Requisition Receive </a></li>
                </ul>
              </div>
            </li>




            <li class="nav-item"> 
              <a class="nav-link" href="{{ route('offermanage') }}">
                <i class="icon-briefcase menu-icon"></i>
                <span class="menu-title">Offer Management</span>
              </a>
            </li>

             <li class="nav-item"> 
              <a class="nav-link" href="{{ route('workorder') }}">
                <i class="icon-briefcase menu-icon"></i>
                <span class="menu-title">Work Order</span>
              </a>
            </li>

             <li class="nav-item"> 
              <a class="nav-link" href="{{ route('saleorder') }}">
                <i class="icon-briefcase menu-icon"></i>
                <span class="menu-title">Sales Order</span>
              </a>
            </li>

            <li class="nav-item"> 
              <a class="nav-link" href="{{ route('itemdelivery') }}">
                <i class="icon-briefcase menu-icon"></i>
                <span class="menu-title">Item Delivery</span>
              </a>
            </li> --}}










            {{-- <li class="nav-item">
              <a class="nav-link" href="index.html">
                <i class="icon-rocket menu-icon"></i>
                <span class="menu-title">Dashboard</span>
                <span class="badge badge-success">New</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/widgets.html">
                <i class="icon-shield menu-icon"></i>
                <span class="menu-title">Widgets</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
                <i class="icon-check menu-icon"></i>
                <span class="menu-title">Page Layouts</span>
                <span class="badge badge-danger">3</span>
              </a>
              <div class="collapse" id="page-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="pages/layout/boxed-layout.html">Boxed</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/layout/rtl-layout.html">RTL</a></li>
                  <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="pages/layout/horizontal-menu.html">Horizontal Menu</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
                <i class="icon-layers menu-icon"></i>
                <span class="menu-title">Sidebar Layouts</span>
                <span class="badge badge-warning">5</span>
              </a>
              <div class="collapse" id="sidebar-layouts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/layout/compact-menu.html">Compact menu</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-collapsed.html">Icon menu</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-hidden.html">Sidebar Hidden</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-hidden-overlay.html">Sidebar Overlay</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-fixed.html">Sidebar Fixed</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-target menu-icon"></i>
                <span class="menu-title">Basic UI Elements</span>
                <span class="badge badge-success">10</span>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/accordions.html">Accordions</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/badges.html">Badges</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/breadcrumbs.html">Breadcrumbs</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/modals.html">Modals</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/progress.html">Progress bar</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/pagination.html">Pagination</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tabs.html">Tabs</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tooltips.html">Tooltips</a></li>
                </ul>
                </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
                <i class="icon-cup menu-icon"></i>
                <span class="menu-title">Advanced Elements</span>
                <span class="badge badge-primary">8</span>
              </a>
              <div class="collapse" id="ui-advanced">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dragula.html">Dragula</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/clipboard.html">Clipboard</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/context-menu.html">Context menu</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/slider.html">Sliders</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/carousel.html">Carousel</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/colcade.html">Colcade</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/loaders.html">Loaders</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tour.html">Tour</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="icon-flag menu-icon"></i>
                <span class="menu-title">Form elements</span>
                <span class="badge badge-danger">3</span>
              </a>
              <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>                
                  <li class="nav-item"><a class="nav-link" href="pages/forms/advanced_elements.html">Advanced Elements</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/forms/validation.html">Validation</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/forms/wizard.html">Wizard</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#editors" aria-expanded="false" aria-controls="editors">
                <i class="icon-anchor menu-icon"></i>
                <span class="menu-title">Editors</span>
                <span class="badge badge-info">3</span>
              </a>
              <div class="collapse" id="editors">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link" href="pages/forms/text_editor.html">Text editors</a></li>
                  <li class="nav-item"><a class="nav-link" href="pages/forms/code_editor.html">Code editors</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="icon-pie-chart menu-icon"></i>
                <span class="menu-title">Charts</span>
                <span class="badge badge-warning">8</span>
              </a>
              <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/charts/morris.html">Morris</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/charts/flot-chart.html">Flot</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/charts/google-charts.html">Google charts</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/charts/sparkline.html">Sparkline js</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/charts/c3.html">C3 charts</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/charts/chartist.html">Chartists</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/charts/justGage.html">JustGage</a></li>
                </ul>
                </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Tables</span>
                <span class="badge badge-info">4</span>
              </a>
              <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/tables/data-table.html">Data table</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/tables/js-grid.html">Js-grid</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/tables/sortable-table.html">Sortable table</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/ui-features/popups.html">
                <i class="icon-diamond menu-icon"></i>
                <span class="menu-title">Popups</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/ui-features/notifications.html">
                <i class="icon-bell menu-icon"></i>
                <span class="menu-title">Notifications</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="icon-globe menu-icon"></i>
                <span class="menu-title">Icons</span>
                <span class="badge badge-info">4</span>
              </a>
              <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/icons/flag-icons.html">Flag icons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/icons/font-awesome.html">Font Awesome</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/icons/simple-line-icon.html">Simple line icons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/icons/themify.html">Themify icons</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps">
                <i class="icon-location-pin menu-icon"></i>
                <span class="menu-title">Maps</span>
                <span class="badge badge-success">2</span>
              </a>
              <div class="collapse" id="maps">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/maps/mapeal.html">Mapeal</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/maps/vector-map.html">Vector Map</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/maps/google-maps.html">Google Map</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-bubbles menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <span class="badge badge-danger">5</span>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                <i class="icon-support menu-icon"></i>
                <span class="menu-title">Error pages</span>
                <span class="badge badge-primary">2</span>
              </a>
              <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <i class="icon-user menu-icon"></i>
                <span class="menu-title">General Pages</span>
                <span class="badge badge-warning">6</span>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/landing-page.html"> Landing Page </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/profile.html"> Profile </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/faq.html"> FAQ </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/faq-2.html"> FAQ 2 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/news-grid.html"> News grid </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/timeline.html"> Timeline </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/search-results.html"> Search Results </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/portfolio.html"> Portfolio </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#e-commerce" aria-expanded="false" aria-controls="e-commerce">
                <i class="icon-briefcase menu-icon"></i>
                <span class="menu-title">E-commerce</span>
                <span class="badge badge-info">3</span>
              </a>
              <div class="collapse" id="e-commerce">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/invoice.html"> Invoice </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/pricing-table.html"> Pricing Table </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/orders.html"> Orders </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/apps/email.html">
                <i class="icon-cursor menu-icon"></i>
                <span class="menu-title">E-mail</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/apps/calendar.html">
                <i class="icon-calendar menu-icon"></i>
                <span class="menu-title">Calendar</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/apps/todo.html">
                <i class="icon-clock menu-icon"></i>
                <span class="menu-title">Todo List</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/apps/gallery.html">
                <i class="icon-picture menu-icon"></i>
                <span class="menu-title">Gallery</span>
              </a>
            </li> --}}
            {{-- <li class="nav-item nav-doc">
              <a class="nav-link bg-primary" href="pages/documentation.html">
                <i class="icon-magnet menu-icon"></i>
                <span class="menu-title">Documentation</span>
              </a>
            </li> --}}

            {{-- <li class="mt-4 nav-item nav-progress">
              <h6 class="nav-progress-heading mt-4 font-weight-normal">
                Today's Sales
                <span class="nav-progress-sub-heading">
                  50 sold
                </span>
              </h6>
              <div class="progress progress-sm">
                <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <h6 class="nav-progress-heading mt-4 font-weight-normal">
                Customer target
                <span class="nav-progress-sub-heading">
                  500
                </span>
              </h6>
              <div class="progress progress-sm">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </li> --}}




          </ul>
        </nav>
@endsection