@extends('layouts.app', ['company' =>  DB::table('company')->get()])

@extends('layouts.navbar')
@extends('layouts.sidebar')




@section('pageTitle', 'Valuable Customers')

@section('page_content')

<script src="{{ asset('js/jquery.min.js') }}"></script>

<style type="text/css" media="screen">

    a{
          text-decoration: none;
          color: black;
    }
    a:hover{
          text-decoration: none;
    }
    .card img{
      max-width: 154px;
    }
    .card-title{
      text-align: center;
    }
</style>


<div class="content-wrapper" style="min-height: 0px;">

    <div class="row" style="margin-top: 10px;">
            
            @include('contents.valuableCustomers')
           
    </div>

</div>



@endsection