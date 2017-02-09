@extends('admin.master.app')
@section('title', 'Page Title')

@section('content')
<div class="wrapper">
@include('admin.master.navbar')
    <div class="main-panel">
@include('admin.master.top_navbar')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">PAYMENT REVIEW</h4>
                                <hr>
                            </div>
                            <div class="content">  
                            <div class="row">                        
                                <div class="col-lg-9">                                    
                                    <p>You have no items in your cart</p>
                                    
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                <a href="{{url('/#invest')}}"><button type="button" class="btn btn-info btn-fill">Invest Now</button></a>                                
                                </div>
                            </div>                                                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@include('admin.master.footer')
@endsection