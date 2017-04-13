@extends('admin.master.app')
@section('title', 'Profil')

@section('content')
<div class="wrapper">
@include('admin.master.navbar')
    <div class="main-panel">
        @include('admin.master.top_navbar', ['navbartitle' => 'Profil'])
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="category" style="text-align: right"><b>Kode Organisasi : </b></p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="category">@if (Auth::guest())kode
                                                @else{{ Auth::user()->id_organisasi }}@endif</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="category" style="text-align: right"><b>Tipe Tingkatan : </b></p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="category">@if (Auth::guest())tipe
                                                @else{{ Auth::user()->tipe_organisasi }}@endif</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="category" style="text-align: right"><b>Daerah : </b></p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="category">@if (Auth::guest())nama
                                                @else{{ Auth::user()->nama_organisasi }}@endif</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="category" style="text-align: right"><b>Alamat : </b></p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="category">@if (Auth::guest())alamat
                                                @else{{ Auth::user()->alamat }}@endif</p>
                                        </div>
                                    </div>

                                    <br>
                                </div>
                                <div class="col-lg-3">
                                <button onclick="window.location = '{{url('/edit_profil')}}';" type="button" class="btn btn-primary">EDIT PROFIL</button>
                                </div>
                            </div>
                              
                                                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.master.footer')

    </div>
</div>
@endsection