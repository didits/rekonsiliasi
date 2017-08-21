@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
<div class="wrapper">
    @include('admin.master.navbar')
    <div class="main-panel">
        @include('admin.master.top_navbar', ['navbartitle' => 'Input Data'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('input_listrik.store')}}" method="post">
                                    <input type="hidden" name="_method" value="POST">
{{--                                        {{dd($tipe)}}--}}
                                    <input type="hidden" name="id" value="{{$jenis->id}}">
                                    <input type="hidden" name="tipe" value="{{$tipe}}">
                                        {{ csrf_field() }}

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
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">KWH Meter Utama</h4>
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
                                                                            <input type="text" name="lwbp1_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['lwbp1_visual']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Stand Akhir LWBP2</label>
                                                                            <input type="text" name="lwbp2_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['lwbp2_visual']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Stand Akhir WBP</label>
                                                                            <input type="text" name="wbp_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['wbp_visual']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Stand Akhir KVARH</label>
                                                                            <input type="text" name="kvarh_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['kvarh_visual']}}">
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
                                                                            <label>Pemakaian KWH LWBP1</label>
                                                                            <input type="text" name="lwbp1_download" class="form-control" placeholder="" value="{{$data['beli']['download']['lwbp1_download']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pemakaian KWH LWBP2</label>
                                                                            <input type="text" name="lwbp2_download" class="form-control" placeholder="" value="{{$data['beli']['download']['lwbp2_download']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pemakaian KWH WBP</label>
                                                                            <input type="text" name="wbp_download" class="form-control" placeholder="" value="{{$data['beli']['download']['wbp_download']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pemakaian KWH KVARH</label>
                                                                            <input type="text" name="kvarh_download" class="form-control" placeholder="" value="{{$data['beli']['download']['kvarh_download']}}">
                                                                        </div>
                                                                        <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="meter-pembanding">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">KWH Meter Pembanding</h4>
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
                                                                            <input type="text" name="lwbp1_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['lwbp1_visual']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Stand Akhir LWBP2</label>
                                                                            <input type="text" name="lwbp2_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['lwbp2_visual']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Stand Akhir WBP</label>
                                                                            <input type="text" name="wbp_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['wbp_visual']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Stand Akhir KVARH</label>
                                                                            <input type="text" name="kvarh_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['kvarh_visual']}}">
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
                                                                            <label>Pemakaian KWH LWBP1</label>
                                                                            <input type="text" name="lwbp1_download" class="form-control" placeholder="" value="{{$data['beli']['download']['lwbp1_download']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pemakaian KWH LWBP2</label>
                                                                            <input type="text" name="lwbp2_download" class="form-control" placeholder="" value="{{$data['beli']['download']['lwbp2_download']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pemakaian KWH WBP</label>
                                                                            <input type="text" name="wbp_download" class="form-control" placeholder="" value="{{$data['beli']['download']['wbp_download']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pemakaian KWH KVARH</label>
                                                                            <input type="text" name="kvarh_download" class="form-control" placeholder="" value="{{$data['beli']['download']['kvarh_download']}}">
                                                                        </div>
                                                                        <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="pemakaian-sendiri">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">Pemakaian Sendiri</h4>
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
                                                                            <input type="text" name="lwbp1_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['lwbp1_visual']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Stand Akhir LWBP2</label>
                                                                            <input type="text" name="lwbp2_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['lwbp2_visual']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Stand Akhir WBP</label>
                                                                            <input type="text" name="wbp_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['wbp_visual']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Stand Akhir KVARH</label>
                                                                            <input type="text" name="kvarh_visual" class="form-control" placeholder="" value="{{$data['beli']['visual']['kvarh_visual']}}">
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
                                                                            <label>Pemakaian KWH LWBP1</label>
                                                                            <input type="text" name="lwbp1_download" class="form-control" placeholder="" value="{{$data['beli']['download']['lwbp1_download']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pemakaian KWH LWBP2</label>
                                                                            <input type="text" name="lwbp2_download" class="form-control" placeholder="" value="{{$data['beli']['download']['lwbp2_download']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pemakaian KWH WBP</label>
                                                                            <input type="text" name="wbp_download" class="form-control" placeholder="" value="{{$data['beli']['download']['wbp_download']}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pemakaian KWH KVARH</label>
                                                                            <input type="text" name="kvarh_download" class="form-control" placeholder="" value="{{$data['beli']['download']['kvarh_download']}}">
                                                                        </div>
                                                                        <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div> <!-- end tab content -->

                                            </div> <!-- end col-md-8 -->

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
                                                        @if($tipe=="gardu")
                                                            <label>Nama GI / GD</label>
                                                            <input type="text" class="form-control" disabled placeholder="Company" value="{{$jenis->nama_gardu}}">
                                                        @endif
                                                        @if($tipe=="penyulang")
                                                            <label>Nama Penyulang</label>
                                                            <input type="text" class="form-control" disabled placeholder="Company" value="{{$jenis->nama_penyulang}}">
                                                        @endif
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Rayon</label>
                                                        <input type="text" class="form-control" disabled placeholder="Company" value="{{Auth::user()->nama_organisasi}}">
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