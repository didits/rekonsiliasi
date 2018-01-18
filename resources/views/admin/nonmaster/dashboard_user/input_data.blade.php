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
                                @if($tipe == "trafo_gi")

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="nav-container">
                                            <ul class="nav nav-icons" role="tablist">
                                                <li class="active">
                                                    <a href="#beli" role="tab" data-toggle="tab">
                                                        <i class="fa fa-download"></i><br>
                                                        Transaksi Beli [{{$date2}}]
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#jual" role="tab" data-toggle="tab">
                                                        <i class="fa fa-upload"></i><br>
                                                        Transaksi Jual
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#lalu" role="tab" data-toggle="tab">
                                                        <i class="fa fa-database"></i><br>
                                                        Input Bulan Lalu [{{$date}}]
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="beli">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="nav-container">
                                                            <ul class="nav nav-icons" role="tablist">
                                                                <li class="active">
                                                                    <a href="#meter-utama" role="tab" data-toggle="tab">
                                                                        <i class="fa fa-bolt"></i><br>
                                                                        KWH Meter Utama
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#meter-pembanding" role="tab" data-toggle="tab">
                                                                        <i class="fa fa-exchange"></i><br>
                                                                        KWH Meter Pembanding
                                                                    </a>
                                                                </li>
                                                                <li class="">
                                                                    <a href="#pemakaian-sendiri" role="tab" data-toggle="tab">
                                                                        <i class="fa fa-building-o"></i><br>
                                                                        Pemakaian Sendiri
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="meter-utama">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="nav-container">
                                                                            <ul class="nav nav-icons" role="tablist">
                                                                                <li class="active">
                                                                                    <a href="#utama-visual" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-tachometer"></i><br>
                                                                                        Visual
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#utama-download" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-cloud-download"></i><br>
                                                                                        Download
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-content">
                                                                            <div class="tab-pane active" id="utama-visual">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="visual" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="meter" value="utama">
                                                                                            <input type="hidden" name="form_utama" value="1">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Utama [{{$date2}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">VISUAL</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP1</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual" class="form-control" placeholder="" value="{{$data['beli']['utama']['visual']['lwbp1_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP2</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual" class="form-control" placeholder="" value="{{$data['beli']['utama']['visual']['lwbp2_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir WBP</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual" class="form-control" placeholder="" value="{{$data['beli']['utama']['visual']['wbp_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir KVARH</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="kvarh_visual" class="form-control" placeholder="" value="{{$data['beli']['utama']['visual']['kvarh_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Daya Konsiden</label>
                                                                                                                <input type="text" style="" pattern="(\d+\.?\d{0,})?(\d+)" name="konsiden_visual" class="form-control" placeholder="" value="{{$data['beli']['utama']['visual']['konsiden_visual']}}">
                                                                                                            </div>
                                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                                            <div class="clearfix"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div> <!-- end col-md-8 -->
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane" id="utama-download">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="meter" value="utama">
                                                                                            <input type="hidden" name="download" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="form_utama" value="1">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Utama [{{$date2}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
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
                                                                                                                <label>Pemakaian KWH LWBP1</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download" class="form-control" placeholder="" value="{{$data['beli']['utama']['download']['lwbp1_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH LWBP2</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download" class="form-control" placeholder="" value="{{$data['beli']['utama']['download']['lwbp2_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH WBP</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download" class="form-control" placeholder="" value="{{$data['beli']['utama']['download']['wbp_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH KVARH</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="kvarh_download" class="form-control" placeholder="" value="{{$data['beli']['utama']['download']['kvarh_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Daya Konsiden</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="konsiden_download" class="form-control" placeholder="" value="{{$data['beli']['utama']['download']['konsiden_download']}}">
                                                                                                            </div>
                                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                                            <div class="clearfix"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div> <!-- end col-md-8 -->
                                                                                </div>
                                                                            </div>
                                                                        </div> <!-- end tab content -->
                                                                    </div> <!-- end col-md-8 -->
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane" id="meter-pembanding">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="nav-container">
                                                                            <ul class="nav nav-icons" role="tablist">
                                                                                <li class="active">
                                                                                    <a href="#pembanding-visual" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-tachometer"></i><br>
                                                                                        Visual
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#pembanding-download" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-cloud-download"></i><br>
                                                                                        Download
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>

                                                                        <div class="tab-content">
                                                                            <div class="tab-pane active" id="pembanding-visual">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="meter" value="pembanding">
                                                                                            <input type="hidden" name="visual" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="form_pembanding" value="1">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Pembanding [{{$date2}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">VISUAL</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP1</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual" class="form-control" placeholder="" value="{{$data['beli']['pembanding']['visual']['lwbp1_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP2</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual" class="form-control" placeholder="" value="{{$data['beli']['pembanding']['visual']['lwbp2_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir WBP</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual" class="form-control" placeholder="" value="{{$data['beli']['pembanding']['visual']['wbp_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir KVARH</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="kvarh_visual" class="form-control" placeholder="" value="{{$data['beli']['pembanding']['visual']['kvarh_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Daya Konsiden</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="konsiden_visual" class="form-control" placeholder="" value="{{$data['beli']['pembanding']['visual']['konsiden_visual']}}">
                                                                                                            </div>
                                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                                            <div class="clearfix"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div> <!-- end col-md-8 -->
                                                                                </div>
                                                                            </div>

                                                                            <div class="tab-pane" id="pembanding-download">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="meter" value="pembanding">
                                                                                            <input type="hidden" name="download" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="form_pembanding" value="1">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Pembanding [{{$date2}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
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
                                                                                                                <label>Pemakaian KWH LWBP1</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download" class="form-control" placeholder="" value="{{$data['beli']['pembanding']['download']['lwbp1_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH LWBP2</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download" class="form-control" placeholder="" value="{{$data['beli']['pembanding']['download']['lwbp2_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH WBP</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download" class="form-control" placeholder="" value="{{$data['beli']['pembanding']['download']['wbp_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH KVARH</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="kvarh_download" class="form-control" placeholder="" value="{{$data['beli']['pembanding']['download']['kvarh_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Daya Konsiden</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="konsiden_download" class="form-control" placeholder="" value="{{$data['beli']['pembanding']['download']['konsiden_download']}}">
                                                                                                            </div>
                                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                                            <div class="clearfix"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div> <!-- end col-md-8 -->
                                                                                </div>
                                                                            </div>

                                                                        </div> <!-- end tab content -->
                                                                    </div> <!-- end col-md-8 -->
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane" id="pemakaian-sendiri">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="nav-container">
                                                                            <ul class="nav nav-icons" role="tablist">
                                                                                <li class="active">
                                                                                    <a href="#ps-visual" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-tachometer"></i><br>
                                                                                        Visual
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#ps-download" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-cloud-download"></i><br>
                                                                                        Download
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>

                                                                        <div class="tab-content">
                                                                            <div class="tab-pane active" id="ps-visual">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="meter" value="ps">
                                                                                            <input type="hidden" name="visual" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="form_ps" value="1">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Pemakaian Sendiri [{{$date2}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">VISUAL</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP1</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual" class="form-control" placeholder="" value="{{$data['beli']['ps']['visual']['lwbp1_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP2</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual" class="form-control" placeholder="" value="{{$data['beli']['ps']['visual']['lwbp2_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir WBP</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual" class="form-control" placeholder="" value="{{$data['beli']['ps']['visual']['wbp_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir KVARH</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="kvarh_visual" class="form-control" placeholder="" value="{{$data['beli']['ps']['visual']['kvarh_visual']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Daya Konsiden</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="konsiden_visual" class="form-control" placeholder="" value="{{$data['beli']['ps']['visual']['konsiden_visual']}}">
                                                                                                            </div>
                                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                                            <div class="clearfix"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div> <!-- end col-md-8 -->
                                                                                </div>
                                                                            </div>

                                                                            <div class="tab-pane" id="ps-download">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="meter" value="ps">
                                                                                            <input type="hidden" name="form_ps" value="1">
                                                                                            <input type="hidden" name="download" value="{{$jenis->id}}">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Pemakaian Sendiri [{{$date2}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
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
                                                                                                                <label>Pemakaian KWH LWBP1</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download" class="form-control" placeholder="" value="{{$data['beli']['ps']['download']['lwbp1_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH LWBP2</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download" class="form-control" placeholder="" value="{{$data['beli']['ps']['download']['lwbp2_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH WBP</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download" class="form-control" placeholder="" value="{{$data['beli']['ps']['download']['wbp_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH KVARH</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="kvarh_download" class="form-control" placeholder="" value="{{$data['beli']['ps']['download']['kvarh_download']}}">
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Daya Konsiden</label>
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="konsiden_download" class="form-control" placeholder="" value="{{$data['beli']['ps']['download']['konsiden_download']}}">
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
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="jual">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                            <input type="hidden" name="_method" value="POST">
                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                            <input type="hidden" name="jual" value="{{$jenis->id}}">
                                                            {{ csrf_field() }}

                                                            <div class="card">
                                                                <div class="header">
                                                                    <h4 class="title">Transaksi Jual</h4>
                                                                </div>
                                                                <div class="content">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Total Pemakaian KWH</label>
                                                                                {{--<input type="text" name="tpe_jual" class="form-control" placeholder="" value="">--}}
                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_jual" class="form-control" placeholder="" value="{{$data['jual']['total_kwh_jual']}}">
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
                                            <div class="tab-pane" id="lalu">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="nav-container">
                                                            <ul class="nav nav-icons" role="tablist">
                                                                <li class="active">
                                                                    <a href="#meter-utama-lalu" role="tab" data-toggle="tab">
                                                                        <i class="fa fa-bolt"></i><br>
                                                                        KWH Meter Utama
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#meter-pembanding-lalu" role="tab" data-toggle="tab">
                                                                        <i class="fa fa-exchange"></i><br>
                                                                        KWH Meter Pembanding
                                                                    </a>
                                                                </li>
                                                                <li class="">
                                                                    <a href="#pemakaian-sendiri-lalu" role="tab" data-toggle="tab">
                                                                        <i class="fa fa-building-o"></i><br>
                                                                        Pemakaian Sendiri
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="meter-utama-lalu">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="nav-container">
                                                                            <ul class="nav nav-icons" role="tablist">
                                                                                <li class="active">
                                                                                    <a href="#utama-visual-lalu" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-tachometer"></i><br>
                                                                                        Visual
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#utama-download-lalu" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-cloud-download"></i><br>
                                                                                        Download
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="tab-content">
                                                                            <div class="tab-pane active" id="utama-visual-lalu">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="visual" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="meter" value="utama">
                                                                                            <input type="hidden" name="form_utama" value="1">
                                                                                            <input type="hidden" name="lalu" value="1">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Utama Bulan Lalu [{{$date}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">VISUAL</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP1</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['utama']['visual']['lwbp1_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['utama']['visual']['lwbp1_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP2</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['utama']['visual']['lwbp2_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['utama']['visual']['lwbp2_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir WBP</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['utama']['visual']['wbp_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['utama']['visual']['wbp_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Total Pemakaian Energi</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="{{$dt['hasil_pengolahan']['utama']['visual']['total_pemakaian_kwh_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="{{$dt2['hasil_pengolahan']['utama']['visual']['total_pemakaian_kwh_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                                            <div class="clearfix"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div> <!-- end col-md-8 -->
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane" id="utama-download-lalu">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="meter" value="utama">
                                                                                            <input type="hidden" name="download" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="form_utama" value="1">
                                                                                            <input type="hidden" name="lalu" value="1">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Utama Bulan Lalu [{{$date}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
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
                                                                                                                <label>Pemakaian KWH LWBP1</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['utama']['download']['lwbp1_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['utama']['download']['lwbp1_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH LWBP2</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['utama']['download']['lwbp2_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['utama']['download']['lwbp2_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH WBP</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['utama']['download']['wbp_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['utama']['download']['wbp_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Total Pemakaian Energi</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="{{$dt['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="{{$dt2['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                                            <div class="clearfix"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div> <!-- end col-md-8 -->
                                                                                </div>
                                                                            </div>
                                                                        </div> <!-- end tab content -->
                                                                    </div> <!-- end col-md-8 -->
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane" id="meter-pembanding-lalu">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="nav-container">
                                                                            <ul class="nav nav-icons" role="tablist">
                                                                                <li class="active">
                                                                                    <a href="#pembanding-visual-lalu" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-tachometer"></i><br>
                                                                                        Visual
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#pembanding-download-lalu" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-cloud-download"></i><br>
                                                                                        Download
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>

                                                                        <div class="tab-content">
                                                                            <div class="tab-pane active" id="pembanding-visual-lalu">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="meter" value="pembanding">
                                                                                            <input type="hidden" name="visual" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="lalu" value="1">
                                                                                            <input type="hidden" name="form_pembanding" value="1">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Pembanding Bulan Lalu [{{$date}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">VISUAL</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP1</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['pembanding']['visual']['lwbp1_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['pembanding']['visual']['lwbp1_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP2</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['pembanding']['visual']['lwbp2_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['pembanding']['visual']['lwbp2_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir WBP</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['pembanding']['visual']['wbp_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['pembanding']['visual']['wbp_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Total Pemakaian Energi</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="{{$dt['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="{{$dt2['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                                            <div class="clearfix"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div> <!-- end col-md-8 -->
                                                                                </div>
                                                                            </div>

                                                                            <div class="tab-pane" id="pembanding-download-lalu">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="meter" value="pembanding">
                                                                                            <input type="hidden" name="download" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="form_pembanding" value="1">
                                                                                            <input type="hidden" name="lalu" value="1">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Pembanding Bulan Lalu [{{$date}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
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
                                                                                                                <label>Pemakaian KWH LWBP1</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['pembanding']['download']['lwbp1_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['pembanding']['download']['lwbp1_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH LWBP2</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['pembanding']['download']['lwbp2_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['pembanding']['download']['lwbp2_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH WBP</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['pembanding']['download']['wbp_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['pembanding']['download']['wbp_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Total Pemakaian Energi</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="{{$dt['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="{{$dt2['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                                            <div class="clearfix"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div> <!-- end col-md-8 -->
                                                                                </div>
                                                                            </div>

                                                                        </div> <!-- end tab content -->
                                                                    </div> <!-- end col-md-8 -->
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane" id="pemakaian-sendiri-lalu">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="nav-container">
                                                                            <ul class="nav nav-icons" role="tablist">
                                                                                <li class="active">
                                                                                    <a href="#ps-visual-lalu" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-tachometer"></i><br>
                                                                                        Visual
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#ps-download-lalu" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-cloud-download"></i><br>
                                                                                        Download
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>

                                                                        <div class="tab-content">
                                                                            <div class="tab-pane active" id="ps-visual-lalu">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="meter" value="ps">
                                                                                            <input type="hidden" name="visual" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="form_ps" value="1">
                                                                                            <input type="hidden" name="lalu" value="1">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Pemakaian Sendiri Bulan Lalu [{{$date}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">VISUAL</h4>
                                                                                                </div>
                                                                                                <div class="content">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP1</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['ps']['visual']['lwbp1_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['ps']['visual']['lwbp1_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir LWBP2</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['ps']['visual']['lwbp2_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['ps']['visual']['lwbp2_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Stand Akhir WBP</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['ps']['visual']['wbp_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['ps']['visual']['wbp_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Total Pemakaian Energi</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="{{$dt['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="{{$dt2['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                                            <div class="clearfix"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div> <!-- end col-md-8 -->
                                                                                </div>
                                                                            </div>

                                                                            <div class="tab-pane" id="ps-download-lalu">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                                            <input type="hidden" name="_method" value="POST">
                                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                            <input type="hidden" name="meter" value="ps">
                                                                                            <input type="hidden" name="form_ps" value="1">
                                                                                            <input type="hidden" name="download" value="{{$jenis->id}}">
                                                                                            <input type="hidden" name="lalu" value="1">
                                                                                            {{ csrf_field() }}

                                                                                            <div class="card">
                                                                                                <div class="header">
                                                                                                    <h4 class="title">KWH Meter Pemakaian Sendiri Bulan Lalu [{{$date}}]</h4>
                                                                                                </div>
                                                                                                <div class="content">
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
                                                                                                                <label>Pemakaian KWH LWBP1</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['ps']['download']['lwbp1_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['ps']['download']['lwbp1_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH LWBP2</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['ps']['download']['lwbp2_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['ps']['download']['lwbp2_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Pemakaian KWH WBP</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['ps']['download']['wbp_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['ps']['download']['wbp_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            <div class="form-group">
                                                                                                                <label>Total Pemakaian Energi</label>
                                                                                                                @if($dt)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="{{$dt['hasil_pengolahan']['ps']['download']['total_pemakaian_kwh_download']}}">
                                                                                                                @elseif($dt2)
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="{{$dt2['hasil_pengolahan']['ps']['download']['total_pemakaian_kwh_download']}}">
                                                                                                                @else
                                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="">
                                                                                                                @endif
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
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif($tipe == "pct")

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="nav-container">
                                            <ul class="nav nav-icons" role="tablist">
                                                <li class="active">
                                                    <a href="#meter-impor" role="tab" data-toggle="tab">
                                                        <i class="fa fa-bolt"></i><br>
                                                        Meter Impor
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#meter-ekspor" role="tab" data-toggle="tab">
                                                        <i class="fa fa-exchange"></i><br>
                                                        Meter Ekspor
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="meter-impor">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="header">Impor Dari</div>
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Area</label>
                                                                            <input type="text" class="form-control" disabled="" placeholder="Area" value="{{$decoded['lokasi']['ekspor']['area']}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Rayon</label>
                                                                            <input type="text" class="form-control" disabled="" placeholder="Rayon" value="{{$decoded['lokasi']['ekspor']['rayon']}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Penyulang</label>
                                                                    <input type="text" class="form-control" disabled="" placeholder="Penyulang" value="{{$decoded['lokasi']['ekspor']['penyulang']}}">
                                                                </div>
                                                            </div>
                                                            <div class="footer">
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="nav-container">
                                                            <ul class="nav nav-icons" role="tablist">
                                                                <li class="active">
                                                                    <a href="#impor-visual" role="tab" data-toggle="tab">
                                                                        <i class="fa fa-tachometer"></i><br>
                                                                        Visual
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#impor-download" role="tab" data-toggle="tab">
                                                                        <i class="fa fa-cloud-download"></i><br>
                                                                        Download
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="impor-visual">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                            <input type="hidden" name="_method" value="POST">
                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                            <input type="hidden" name="meter" value="impor">
                                                                            <input type="hidden" name="form_impor" value="1">
                                                                            <input type="hidden" name="download" value=0>
                                                                            <input type="hidden" name="visual" value="{{$jenis->id}}">
                                                                            {{ csrf_field() }}

                                                                            <div class="card">
                                                                                <div class="header">
                                                                                    <h4 class="title">Meter Impor</h4>
                                                                                </div>
                                                                                <div class="content">
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="header">
                                                                                    <h4 class="title">VISUAL</h4>
                                                                                </div>
                                                                                <div class="content">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label>Stand Awal</label>
                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="awal_visual" class="form-control" placeholder="" value="{{$data['beli']['impor']['visual']['awal_visual']}}">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Stand Akhir</label>
                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="akhir_visual" class="form-control" placeholder="" value="{{$data['beli']['impor']['visual']['akhir_visual']}}">
                                                                                            </div>
                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div> <!-- end col-md-8 -->
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane" id="impor-download">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                            <input type="hidden" name="_method" value="POST">
                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                            <input type="hidden" name="download" value="{{$jenis->id}}">
                                                                            <input type="hidden" name="meter" value="impor">
                                                                            <input type="hidden" name="visual" value=0>
                                                                            <input type="hidden" name="form_impor" value="1">
                                                                            {{ csrf_field() }}

                                                                            <div class="card">
                                                                                <div class="header">
                                                                                    <h4 class="title">Meter Impor</h4>
                                                                                </div>
                                                                                <div class="content">
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
                                                                                                <label>Total KWH Impor</label>
                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="total_kwh_download" class="form-control" placeholder="" value="{{$data['beli']['impor']['download']['total_kwh_download']}}">
                                                                                            </div>
                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div> <!-- end col-md-8 -->
                                                                </div>
                                                            </div>

                                                        </div> <!-- end tab content -->
                                                    </div> <!-- end col-md-8 -->
                                                </div>
                                            </div>

                                            <div class="tab-pane" id="meter-ekspor">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="header">Ekspor Ke</div>
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Area</label>
                                                                            <input type="text" class="form-control" disabled="" placeholder="Area" value="{{$decoded['lokasi']['ekspor']['area']}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Rayon</label>
                                                                            <input type="text" class="form-control" disabled="" placeholder="Rayon" value="{{$decoded['lokasi']['ekspor']['rayon']}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Penyulang</label>
                                                                    <input type="text" class="form-control" disabled="" placeholder="Penyulang" value="{{$decoded['lokasi']['ekspor']['penyulang']}}">
                                                                </div>
                                                            </div>

                                                            <div class="footer">
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="nav-container">
                                                            <ul class="nav nav-icons" role="tablist">
                                                                <li class="active">
                                                                    <a href="#ekspor-visual" role="tab" data-toggle="tab">
                                                                        <i class="fa fa-tachometer"></i><br>
                                                                        Visual
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#ekspor-download" role="tab" data-toggle="tab">
                                                                        <i class="fa fa-cloud-download"></i><br>
                                                                        Download
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="ekspor-visual">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                            <input type="hidden" name="_method" value="POST">
                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                            <input type="hidden" name="meter" value="ekspor">
                                                                            <input type="hidden" name="visual" value="{{$jenis->id}}">
                                                                            <input type="hidden" name="download" value=0>
                                                                            <input type="hidden" name="form_ekspor" value="1">

                                                                            {{ csrf_field() }}

                                                                            <div class="card">
                                                                                <div class="header">
                                                                                    <h4 class="title">Meter Ekspor</h4>
                                                                                </div>
                                                                                <div class="content">
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="header">
                                                                                    <h4 class="title">VISUAL</h4>
                                                                                </div>
                                                                                <div class="content">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label>Stand Awal</label>
                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="awal_visual" class="form-control" placeholder="" value="{{$data['beli']['ekspor']['visual']['awal_visual']}}">
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label>Stand Akhir</label>
                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="akhir_visual" class="form-control" placeholder="" value="{{$data['beli']['ekspor']['visual']['akhir_visual']}}">
                                                                                            </div>
                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div> <!-- end col-md-8 -->
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane" id="ekspor-download">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <form action="{{route('input_listrik.store')}}" method="post">
                                                                            <input type="hidden" name="_method" value="POST">
                                                                            <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                            <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                            <input type="hidden" name="meter" value="ekspor">
                                                                            <input type="hidden" name="download" value="{{$jenis->id}}">
                                                                            <input type="hidden" name="visual" value=0>
                                                                            <input type="hidden" name="form_ekspor" value="1">
                                                                            {{ csrf_field() }}

                                                                            <div class="card">
                                                                                <div class="header">
                                                                                    <h4 class="title">Meter Ekspor</h4>
                                                                                </div>
                                                                                <div class="content">
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
                                                                                                <label>Total KWH Ekspor</label>
                                                                                                <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="total_kwh_download" class="form-control" placeholder="" value="{{$data['beli']['ekspor']['download']['total_kwh_download']}}">
                                                                                            </div>
                                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                                            <div class="clearfix"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div> <!-- end col-md-8 -->
                                                                </div>
                                                            </div>

                                                        </div> <!-- end tab content -->
                                                    </div> <!-- end col-md-8 -->
                                                </div>
                                            </div>
                                        </div> <!-- end tab content -->
                                    </div> <!-- end col-md-8 -->
                                </div>
                                @else

                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="nav-container">
                                                <ul class="nav nav-icons" role="tablist">
                                                    <li class="active">
                                                        <a href="#beli" role="tab" data-toggle="tab">
                                                            <i class="fa fa-download"></i><br>
                                                            Transaksi Beli [{{$date2}}]
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#jual" role="tab" data-toggle="tab">
                                                            <i class="fa fa-upload"></i><br>
                                                            Transaksi Jual
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#lalu" role="tab" data-toggle="tab">
                                                            <i class="fa fa-database"></i><br>
                                                            Input Bulan Lalu [{{$date}}]
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="beli">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-12">
                                                                <div class="nav-container">
                                                                    <ul class="nav nav-icons" role="tablist">
                                                                        <li class="active">
                                                                            <a href="#visual" role="tab" data-toggle="tab">
                                                                                <i class="fa fa-tachometer"></i><br>
                                                                                Visual
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#download" role="tab" data-toggle="tab">
                                                                                <i class="fa fa-cloud-download"></i><br>
                                                                                Download
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane active" id="visual">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <form action="{{route('input_listrik.store')}}" method="post">
                                                                                    <input type="hidden" name="_method" value="POST">
                                                                                    <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                    <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                    <input type="hidden" name="visual" value="{{$jenis->id}}">
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
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['lwbp1_visual']}}">
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Stand Akhir LWBP2</label>
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['lwbp2_visual']}}">
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Stand Akhir WBP</label>
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['wbp_visual']}}">
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Stand Akhir KVARH</label>
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="kvarh_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['kvarh_visual']}}">
                                                                                                    </div>
                                                                                                    @if($tipe=="penyulang")

                                                                                                    <div class="form-group">
                                                                                                        <label>Tegangan Ujung</label>
                                                                                                        <input type="number" step="any" name="tu_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['tu_visual']}}">
                                                                                                        {{--<input type="number" name="tu_visual" class="form-control" placeholder="" value="">--}}
                                                                                                    </div>
                                                                                                    @endif

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
                                                                    <div class="tab-pane" id="download">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <form action="{{route('input_listrik.store')}}" method="post">
                                                                                    <input type="hidden" name="_method" value="POST">
                                                                                    <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                    <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                    <input type="hidden" name="download" value="{{$jenis->id}}">
                                                                                    {{ csrf_field() }}
                                                                                    <div class="card">
                                                                                        <div class="header">
                                                                                            <h4 class="title">DOWNLOAD</h4>
                                                                                        </div>
                                                                                        <div class="content">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label>Pemakaian KWH LWBP1</label>
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download" class="form-control" placeholder="" value="{{$data['beli']['download']['lwbp1_download']}}">
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Pemakaian KWH LWBP2</label>
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download" class="form-control" placeholder="" value="{{$data['beli']['download']['lwbp2_download']}}">
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Pemakaian KWH WBP</label>
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download" class="form-control" placeholder="" value="{{$data['beli']['download']['wbp_download']}}">
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Pemakaian KWH KVARH</label>
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="kvarh_download" class="form-control" placeholder="" value="{{$data['beli']['download']['kvarh_download']}}">
                                                                                                    </div>
                                                                                                    @if($tipe=="penyulang")

                                                                                                    <div class="form-group">
                                                                                                        <label>Tegangan Ujung</label>
                                                                                                        <input type="number" step="any" name="tu_download" class="form-control" placeholder="" value="{{$data['beli']['download']['tu_download']}}">
                                                                                                    </div>
                                                                                                    @endif

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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="jual">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form action="{{route('input_listrik.store')}}" method="post">
                                                                <input type="hidden" name="_method" value="POST">
                                                                <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                <input type="hidden" name="jual" value="{{$jenis->id}}">
                                                                {{ csrf_field() }}

                                                                <div class="card">
                                                                    <div class="header">
                                                                        <h4 class="title">Transaksi Jual</h4>
                                                                    </div>
                                                                    <div class="content">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Total Pemakaian KWH</label>
                                                                                    {{--<input type="text" name="tpe_jual" class="form-control" placeholder="" value="">--}}
                                                                                    <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_jual" class="form-control" placeholder="" value="{{$data['jual']['total_kwh_jual']}}">
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
                                                <div class="tab-pane" id="lalu">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-12">
                                                                <div class="nav-container">
                                                                    <ul class="nav nav-icons" role="tablist">
                                                                        <li class="active">
                                                                            <a href="#visual-lalu" role="tab" data-toggle="tab">
                                                                                <i class="fa fa-tachometer"></i><br>
                                                                                Visual
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#download-lalu" role="tab" data-toggle="tab">
                                                                                <i class="fa fa-cloud-download"></i><br>
                                                                                Download
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane active" id="visual-lalu">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <form action="{{route('input_listrik.store')}}" method="post">
                                                                                    <input type="hidden" name="_method" value="POST">
                                                                                    <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                    <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                    <input type="hidden" name="visual" value="{{$jenis->id}}">
                                                                                    <input type="hidden" name="lalu" value="1">
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
                                                                                                        @if($dt2 == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['visual']['lwbp1_visual']}}">
                                                                                                        @elseif($dt == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['visual']['lwbp1_visual']}}">
                                                                                                        @else
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Stand Akhir LWBP2</label>
                                                                                                        @if($dt2 == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['visual']['lwbp2_visual']}}">
                                                                                                        @elseif($dt == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['visual']['lwbp2_visual']}}">
                                                                                                        @else
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Stand Akhir WBP</label>
                                                                                                        @if($dt2 == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="{{$dt['beli']['visual']['wbp_visual']}}">
                                                                                                        @elseif($dt == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['visual']['wbp_visual']}}">
                                                                                                        @else
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Total Pemakaian Energi</label>
                                                                                                        @if($dt2 == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="{{$dt['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']}}">
                                                                                                        @elseif($dt == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="{{$dt2['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']}}">
                                                                                                        @else
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_visual_lalu" class="form-control" placeholder="" value="">
                                                                                                        @endif
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
                                                                    <div class="tab-pane" id="download-lalu">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <form action="{{route('input_listrik.store')}}" method="post">
                                                                                    <input type="hidden" name="_method" value="POST">
                                                                                    <input type="hidden" name="id" value="{{$jenis->id}}">
                                                                                    <input type="hidden" name="tipe" value="{{$tipe}}">
                                                                                    <input type="hidden" name="download" value="{{$jenis->id}}">
                                                                                    <input type="hidden" name="lalu" value="1">
                                                                                    {{ csrf_field() }}
                                                                                    <div class="card">
                                                                                        <div class="header">
                                                                                            <h4 class="title">DOWNLOAD</h4>
                                                                                        </div>
                                                                                        <div class="content">
                                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label>Pemakaian KWH LWBP1</label>
                                                                                                        @if($dt2 == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['download']['lwbp1_download']}}">
                                                                                                        @elseif($dt == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['download']['lwbp1_download']}}">
                                                                                                        @else
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp1_download_lalu" class="form-control" placeholder="" value="">
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Pemakaian KWH LWBP2</label>
                                                                                                        @if($dt2 == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['download']['lwbp2_download']}}">
                                                                                                        @elseif($dt == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['download']['lwbp2_download']}}">
                                                                                                        @else
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="lwbp2_download_lalu" class="form-control" placeholder="" value="">
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Pemakaian KWH WBP</label>
                                                                                                        @if($dt2 == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="{{$dt['beli']['download']['wbp_download']}}">
                                                                                                        @elseif($dt == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="{{$dt2['beli']['download']['wbp_download']}}">
                                                                                                        @else
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="wbp_download_lalu" class="form-control" placeholder="" value="">
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label>Total Pemakaian Energi</label>
                                                                                                        @if($dt2 == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="{{$dt['hasil_pengolahan']['download']['total_pemakaian_kwh_download']}}">
                                                                                                        @elseif($dt == null)
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="{{$dt2['hasil_pengolahan']['download']['total_pemakaian_kwh_download']}}">
                                                                                                        @else
                                                                                                        <input type="text" pattern="(\d+\.?\d{0,})?(\d+)" name="tpe_download_lalu" class="form-control" placeholder="" value="">
                                                                                                        @endif
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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

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
                                                @if($tipe=="gi")

                                                <div class="form-group">
                                                    <label>Nama Gardu Induk</label>
                                                    <input type="text" class="form-control" disabled placeholder="GI" value="{{$jenis->nama_gi}}">
                                                </div>
                                                @elseif($tipe=="trafo_gi")

                                                <div class="form-group">
                                                    <label>Nama Trafo GI</label>
                                                    <input type="text" class="form-control" disabled placeholder="Trafo GI" value="{{$jenis->nama_trafo_gi}}">
                                                </div>
                                                @elseif($tipe=="penyulang")

                                                <div class="form-group">
                                                    <label>Nama Penyulang</label>
                                                    <input type="text" class="form-control" disabled placeholder="Penyulang" value="{{$jenis->nama_penyulang}}">
                                                </div>
                                                @elseif($tipe=="gd")

                                                <div class="form-group">
                                                    <label>Nama GD</label>
                                                    <input type="text" class="form-control" disabled placeholder="Company" value="{{$jenis->nama_gardu}}">
                                                </div>
                                                @elseif($tipe=="pct")

                                                <div class="form-group">
                                                    <label>Nama PCT</label>
                                                    <input type="text" class="form-control" disabled placeholder="PCT" value="{{$jenis->nama_gardu}}">
                                                </div>
                                                @elseif($tipe=="tm")

                                                <div class="form-group">
                                                    <label>Nama Pelanggan TM</label>
                                                    <input type="text" class="form-control" disabled placeholder="TM" value="{{$jenis->nama_gardu}}">
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Rayon</label>
                                                    <input type="text" class="form-control" disabled placeholder="Rayon" value="{{Auth::user()->nama_organisasi}}">
                                                </div>
                                            </div>
                                        </div>
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