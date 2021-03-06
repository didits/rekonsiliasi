@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
<div class="wrapper">
    @include('admin.master.top_navbar', ['navbartitle' => 'Input Data'])

    @include('admin.master.navbar')

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('input_listrik.update', 1)}}" method="post">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="tipe" value="{{$tipe}}">
                                        {{ csrf_field() }}
                                        <div class="card">
                                            <div class="header">
                                                <h4 class="title">VISUAL</h4>
                                            </div>
                                            <div class="content">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Stand Akhir LWBP1</label>
                                                            <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual" class="form-control" placeholder="" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Stand Akhir LWBP2</label>
                                                            <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual" class="form-control" placeholder="" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Stand Akhir WBP</label>
                                                            <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual" class="form-control" placeholder="" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Pemakaian KVARH</label>
                                                            <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="kvarh_visual" class="form-control" placeholder="" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="header">
                                                <h4 class="title">DOWNLOAD</h4>
                                            </div>
                                            <div class="content">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Stand Akhir LWBP1</label>
                                                            <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download" class="form-control" placeholder="" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Stand Akhir LWBP2</label>
                                                            <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download" class="form-control" placeholder="" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Stand Akhir WBP</label>
                                                            <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download" class="form-control" placeholder="" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Pemakaian KVARH</label>
                                                            <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="kvarh_download" class="form-control" placeholder="" value="">
                                                        </div>
                                                        <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-12">
                            <div class="row" style="position: fixed;padding-right : 30px">
                                <!-- Profil -->
                                <div class="col-md-12">
                                    <div class="card card-user">
                                        <div class="image">
                                            <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Nama GI / GD</label>
                                                        <input type="text" class="form-control" disabled placeholder="Company" value="GI 147">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Area</label>
                                                        <input type="text" class="form-control" disabled placeholder="Company" value="Surabaya">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Rayon</label>
                                                        <input type="text" class="form-control" disabled placeholder="Company" value="Sukolilo">
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="submit" class="btn btn-info btn-fill pull-right">Input Listrik</button>
                                            <div class="clearfix"></div>
                                        </div>
                                        <hr>

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