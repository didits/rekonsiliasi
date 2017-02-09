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
                                <h4 class="title">PROFIL</h4>
                                <hr>
                            </div>
                            <div class="content">                            
                            <div class="row">
                                <div class="col-lg-2">
                                    <i style="font-size:100px" class="pe-7s-user"></i>
                                </div>                            
                                <div class="col-lg-7">      
                                    <h5>Rekonsialiasi Daerah Jawa Timur</h5> 
                                    <p class="category"><b>Kode Organisasi : </b> 1000</p>
                                    <p class="category"><b>Tipe Tingkatan : </b> Kantor Distribusi</p>
                                    <p class="category"><b>Daerah : </b> Jawa Timur</p>
                                    <p class="category"><b>Alamat : </b> Jalan Menur Pumpungan No. 68, Menur Pumpungan, Sukolilo, Menur Pumpungan, Sukolilo, Kota SBY, Jawa Timur 60132</p>
                                    <br>
                                </div>
                                <div class="col-lg-3">
                                <button onclick="window.location = '{{url('/account/profile_edit')}}';" type="button" class="btn btn-primary">EDIT PROFIL</button>
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