@extends('admin.master.app')

@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

    <div class="wrapper">
        @include('admin.master.navbar')

        <div class="main-panel">
            @include('admin.master.top_navbar', ['navbartitle' => "DATAMASTER GARDU INDUK: " . $gardu->nama_gi])

            <div class="content">
                <div class="container-fluid">

                    <div class="row">

                        <div class="col-md-12">
                            {{--<h3 class="title text-center">Data Master</h3>--}}
                            {{--<br>--}}
                            <div class="nav-container">
                                <ul class="nav nav-icons" role="tablist">

                                    <li class="active">
                                        <a href="#description-logo" role="tab" data-toggle="tab" aria-expanded="true">
                                            <i class="fa fa-info-circle"></i><br>
                                            Gardu Induk {{$gardu->nama_gi}}
                                        </a>
                                    </li>
                                    @foreach($data as $list => $key)

                                        <li class="">
                                            <a href="#map-logo{{$list+1}}" role="tab" data-toggle="tab" aria-expanded="false">
                                                <i class="fa fa-map-marker"></i><br>
                                                Trafo GI {{$key->nama_trafo_gi}}
                                            </a>
                                        </li>
                                    @endforeach

                                    <li class="">
                                        <a href="#legal-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-legal"></i><br>
                                            Edit Trafo GI
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="description-logo">
                                    <div class="content" id="trafoheader">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">GARDU INDUK {{$gardu->nama_gi}}</h4>
                                                        {{--<p class="category">Data KWH Meter</p>--}}
                                                    </div>
                                                    <div class="content">
                                                        <form action="{{route('input_datamaster.store')}}" method="post">
                                                            <input type="hidden" name="_method" value="POST">
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Area</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Area" value="{{Auth::user()->nama_organisasi}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Rayon</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Rayon" value="{{$rayon->nama_organisasi}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Kapasitas</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Kapasitas" value="{{$decoded['TT']['ratiopt']}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12">

                                            {{--<div class="tab-content">--}}
                                            <div class="tab-pane active" id="meter-utama">
                                                <div class="content" id="kwhmeter">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="header">
                                                                    <h4 class="title">KWH Meter</h4>
                                                                    {{--<p class="category">Data KWH Meter</p>--}}
                                                                </div>
                                                                <div class="content">
                                                                    <form action="{{route('input_datamaster.store')}}" method="post">
                                                                        <input type="hidden" name="_method" value="POST">
                                                                        <input type="hidden" name="tipe" value="KWH">
                                                                        <input type="hidden" name="idgardu" value={{$gardu->id}}>
                                                                        <input type="hidden" name="form_gi" value="{{$gardu->id}}">
                                                                        {{--{{dd($gardu)}}--}}
                                                                        {{ csrf_field() }}

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Merk</label>
                                                                                    <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{$decoded['KWH']['merk']}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Nomor Seri</label>
                                                                                    <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{$decoded['KWH']['nomorseri']}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Konstanta</label>
                                                                                    <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{$decoded['KWH']['konstanta']}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Tegangan Arus</label>
                                                                                    <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{$decoded['KWH']['teganganarus']}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                        <div class="clearfix"></div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content" id="trafoarus">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="header">
                                                                    <h4 class="title">Trafo Arus (CT)</h4>
                                                                    {{--<p class="category">Data KWH Meter</p>--}}
                                                                </div>
                                                                {{--{{dd($decoded)}}--}}
                                                                <div class="content">
                                                                    <form action="{{route('input_datamaster.store')}}" method="post">
                                                                        <input type="hidden" name="_method" value="POST">
                                                                        <input type="hidden" name="tipe" value="TA">
                                                                        <input type="hidden" name="idgardu" value={{$gardu->id}}>
                                                                        <input type="hidden" name="form_gi" value="{{$gardu->id}}">
                                                                        {{ csrf_field() }}

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Ratio</label>
                                                                                    <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{$decoded['TA']['ratioct']}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Burden (VA)</label>
                                                                                    <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TA']['burdenct']}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                        <div class="clearfix"></div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content" id="trafotegangan">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="header">
                                                                    <h4 class="title">Trafo Tegangan (PT)</h4>
                                                                    {{--<p class="category">Data KWH Meter</p>--}}
                                                                </div>
                                                                <div class="content">
                                                                    <form action="{{route('input_datamaster.store')}}" method="post">
                                                                        <input type="hidden" name="_method" value="POST">
                                                                        <input type="hidden" name="tipe" value="TT">
                                                                        <input type="hidden" name="idgardu" value={{$gardu->id}}>
                                                                        <input type="hidden" name="form_gi" value="{{$gardu->id}}">
                                                                        {{ csrf_field() }}

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Ratio</label>
                                                                                    <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{$decoded['TT']['ratiopt']}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Burden (VA)</label>
                                                                                    <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TT']['burdenpt']}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                        <div class="clearfix"></div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content" id="faktorkalimeter">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="header">
                                                                    <h4 class="title">Faktor Kali Meter</h4>
                                                                    {{--<p class="category">Data KWH Meter</p>--}}
                                                                </div>

                                                                <div class="content">
                                                                    <form action="{{route('input_datamaster.store')}}" method="post">
                                                                        <input type="hidden" name="_method" value="POST">
                                                                        <input type="hidden" name="tipe" value="FK">
                                                                        <input type="hidden" name="idgardu" value={{$gardu->id}}>
                                                                        <input type="hidden" name="form_gi" value="{{$gardu->id}}">
                                                                        {{ csrf_field() }}

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Faktor Kali Meter</label>
                                                                                    <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{$decoded['FK']['faktorkali']}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                        <div class="clearfix"></div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{--</div> <!-- end tab content -->--}}

                                        </div> <!-- end col-md-8 -->

                                    </div>

                                </div>
                                @foreach($data as $list => $key)

                                    <div class="tab-pane" id="map-logo{{$list+1}}">
                                        <div class="content" id="trafoheader">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="header">
                                                            <h4 class="title">TRAFO GI {{$key->nama_trafo_gi}}</h4>
                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                        </div>
                                                        <div class="content">
                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                <input type="hidden" name="_method" value="POST">
                                                                <input type="hidden" name="tipe" value="KWH">
                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                {{ csrf_field() }}

                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Area</label>
                                                                            <input type="text" class="form-control" disabled="" placeholder="Area" value="{{Auth::user()->nama_organisasi}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Rayon</label>
                                                                            <input type="text" class="form-control" disabled="" placeholder="Rayon" value="{{$rayon->nama_organisasi}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Kapasitas</label>
                                                                            <input type="text" class="form-control" disabled="" placeholder="Kapasitas" value="{{json_decode($key->data_master, true)['utama']['TT']['ratiopt']}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="nav-container">
                                                    <ul class="nav nav-icons" role="tablist">
                                                        <li class="active">
                                                            <a href="#meter-utama-trafo-gi{{$list+1}}" role="tab" data-toggle="tab">
                                                                <i class="fa fa-bolt"></i><br>
                                                                KWH Meter Utama
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#meter-pembanding-trafo-gi{{$list+1}}" role="tab" data-toggle="tab">
                                                                <i class="fa fa-exchange"></i><br>
                                                                KWH Meter Pembanding
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#pemakaian-sendiri-trafo-gi{{$list+1}}" role="tab" data-toggle="tab">
                                                                <i class="fa fa-building-o"></i><br>
                                                                Pemakaian Sendiri
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="meter-utama-trafo-gi{{$list+1}}">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">KWH Meter Utama</h4>
                                                                <p class="category">TRAFO GI {{$key->nama_trafo_gi}}</p>
                                                            </div>
                                                            <div class="content">
                                                            </div>
                                                        </div>
                                                        <div class="content" id="kwhmeter">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">KWH Meter</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>
                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="KWH">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_utama" value="{{$key->id}}">
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Merk</label>
                                                                                            <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{json_decode($key->data_master, true)['utama']['KWH']['merk']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Nomor Seri</label>
                                                                                            <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{json_decode($key->data_master, true)['utama']['KWH']['nomorseri']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Konstanta</label>
                                                                                            <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{json_decode($key->data_master, true)['utama']['KWH']['konstanta']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Tegangan Arus</label>
                                                                                            <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{json_decode($key->data_master, true)['utama']['KWH']['teganganarus']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content" id="trafoarus">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">Trafo Arus (CT)</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>

                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="TA">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_utama" value="{{$key->id}}">
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Ratio</label>
                                                                                            <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{json_decode($key->data_master, true)['utama']['TA']['ratioct']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Burden (VA)</label>
                                                                                            <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{json_decode($key->data_master, true)['utama']['TA']['burdenct']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content" id="trafotegangan">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">Trafo Tegangan (PT)</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>
                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="TT">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_utama" value="{{$key->id}}">
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Ratio</label>
                                                                                            <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{json_decode($key->data_master, true)['utama']['TT']['ratiopt']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Burden (VA)</label>
                                                                                            <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{json_decode($key->data_master, true)['utama']['TT']['burdenpt']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content" id="faktorkalimeter">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">Faktor Kali Meter</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>
                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="FK">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_utama" value="{{$key->id}}">
                                                                                {{--form--}}
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Faktor Kali Meter</label>
                                                                                            <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{json_decode($key->data_master, true)['utama']['FK']['faktorkali']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="meter-pembanding-trafo-gi{{$list+1}}">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">KWH Meter Pembanding</h4>
                                                                <p class="category">TRAFO GI {{$key->nama_key}}</p>
                                                            </div>
                                                            <div class="content">
                                                            </div>
                                                        </div>
                                                        <div class="content" id="kwhmeter">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">KWH Meter</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>
                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="KWH">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_pembanding" value="{{$key->id}}">
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Merk</label>
                                                                                            <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{json_decode($key->data_master, true)['pembanding']['KWH']['merk']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Nomor Seri</label>
                                                                                            <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{json_decode($key->data_master, true)['pembanding']['KWH']['nomorseri']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Konstanta</label>
                                                                                            <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{json_decode($key->data_master, true)['pembanding']['KWH']['konstanta']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Tegangan Arus</label>
                                                                                            <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{json_decode($key->data_master, true)['pembanding']['KWH']['teganganarus']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content" id="trafoarus">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">Trafo Arus (CT)</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>
                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="TA">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_pembanding" value="{{$key->id}}">
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Ratio</label>
                                                                                            <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{json_decode($key->data_master, true)['pembanding']['TA']['ratioct']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Burden (VA)</label>
                                                                                            <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{json_decode($key->data_master, true)['pembanding']['TA']['burdenct']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content" id="trafotegangan">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">Trafo Tegangan (PT)</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>
                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="TT">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_pembanding" value="{{$key->id}}">
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Ratio</label>
                                                                                            <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{json_decode($key->data_master, true)['pembanding']['TT']['ratiopt']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Burden (VA)</label>
                                                                                            <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{json_decode($key->data_master, true)['pembanding']['TT']['burdenpt']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content" id="faktorkalimeter">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">Faktor Kali Meter</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>
                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="FK">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_pembanding" value="{{$key->id}}">
                                                                                {{--form--}}
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Faktor Kali Meter</label>
                                                                                            <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{json_decode($key->data_master, true)['pembanding']['FK']['faktorkali']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="pemakaian-sendiri-trafo-gi{{$list+1}}">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">Pemakaian Sendiri</h4>
                                                                <p class="category">TRAFO GI {{$key->nama_key}}</p>
                                                            </div>
                                                            <div class="content">
                                                            </div>
                                                        </div>
                                                        <div class="content" id="kwhmeter">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">KWH Meter</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>
                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="KWH">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_ps" value="{{$key->id}}">
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Merk</label>
                                                                                            <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{json_decode($key->data_master, true)['ps']['KWH']['merk']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Nomor Seri</label>
                                                                                            <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{json_decode($key->data_master, true)['ps']['KWH']['nomorseri']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Konstanta</label>
                                                                                            <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{json_decode($key->data_master, true)['ps']['KWH']['konstanta']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Tegangan Arus</label>
                                                                                            <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{json_decode($key->data_master, true)['ps']['KWH']['teganganarus']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content" id="trafoarus">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">Trafo Arus (CT)</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>
                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="TA">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_ps" value="{{$key->id}}">
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Ratio</label>
                                                                                            <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{json_decode($key->data_master, true)['ps']['TA']['ratioct']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Burden (VA)</label>
                                                                                            <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{json_decode($key->data_master, true)['ps']['TA']['burdenct']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content" id="trafotegangan">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">Trafo Tegangan (PT)</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>
                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="TT">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_ps" value="{{$key->id}}">
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Ratio</label>
                                                                                            <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{json_decode($key->data_master, true)['ps']['TT']['ratiopt']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Burden (VA)</label>
                                                                                            <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{json_decode($key->data_master, true)['ps']['TT']['burdenpt']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content" id="faktorkalimeter">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="header">
                                                                            <h4 class="title">Faktor Kali Meter</h4>
                                                                            {{--<p class="category">Data KWH Meter</p>--}}
                                                                        </div>
                                                                        <div class="content">
                                                                            <form action="{{route('input_datamaster.store')}}" method="post">
                                                                                <input type="hidden" name="_method" value="POST">
                                                                                <input type="hidden" name="tipe" value="FK">
                                                                                <input type="hidden" name="form_trafogi" value="{{$key->id}}">
                                                                                <input type="hidden" name="form_ps" value="{{$key->id}}">
                                                                                {{--form--}}
                                                                                {{ csrf_field() }}

                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label>Faktor Kali Meter</label>
                                                                                            <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{json_decode($key->data_master, true)['ps']['FK']['faktorkali']}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                                <div class="clearfix"></div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div> <!-- end tab content -->

                                            </div> <!-- end col-md-8 -->

                                        </div>
                                    </div>
                                @endforeach

                                <div class="tab-pane" id="legal-logo">
                                    <div class="content" id="trafoheader">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">GARDU INDUK {{$gardu->nama_gi}}</h4>
                                                        {{--<p class="category">Data KWH Meter</p>--}}
                                                    </div>
                                                    <div class="content">
                                                        <form action="{{route('input_datamaster.store')}}" method="post">
                                                            <input type="hidden" name="_method" value="POST">
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Area</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Area" value="{{Auth::user()->nama_organisasi}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Rayon</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Rayon" value="{{$rayon->nama_organisasi}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Kapasitas</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Kapasitas" value="{{$decoded['TT']['ratiopt']}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content" id="tabelpenyulang-">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">GARDU INDUK {{$gardu->nama_gi}}</h4>
                                                        <p class="category">Daftar Trafo GI</p>
                                                    </div>
                                                    <div class="content table-responsive table-full-width">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th>Nama</th>
                                                                <th>Rayon</th>
                                                                <th class="text-right">Tindakan</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($data as $list => $key)

                                                                <tr>
                                                                    <td class="text-center">{{$list+1}}</td>
                                                                    <td>{{$key->nama_trafo_gi}}</td>
                                                                    <td>{{$rayon->nama_organisasi}}</td>
                                                                    <td class="td-actions text-right">
                                                                        <a href="#" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="View Profile">
                                                                            <i class="fa fa-user"></i>
                                                                        </a>
                                                                        <a href="#" rel="tooltip" title="" class="btn btn-success btn-simple btn-xs" data-original-title="Edit Profile">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <a href="#" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="Remove">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content" id="tambahpenyulang-">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <form action="{{route('input_datamaster.store')}}" method="post">
                                                        <input type="hidden" name="_method" value="POST">
                                                        <input type="hidden" name="trafogi" value="{{$idgardu}}">
                                                        <input type="hidden" name="idgardu" value={{$gardu->id}}>
                                                        <input type="hidden" name="idrayon" value={{$rayon->id_organisasi}}>
                                                        <input type="hidden" name="id_org" value={{$id_org}}>
                                                        {{ csrf_field() }}
                                                        <div class="header">Tambah Trafo GI</div>
                                                        <div class="content">


                                                            <div class="form-group">
                                                                <label class="control-label">Nama Trafo GI <star>*</star></label>
                                                                <input class="form-control" name="tambahnamatrafogi" type="text" required="required" aria-required="true">
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Alamat Trafo GI <star>*</star></label>
                                                                <input class="form-control" name="tambahalamattrafogi" type="text" required="required" aria-required="true">
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Rayon <star>*</star></label>
                                                                <input class="form-control" name="tambahnamarayon" type="text" disabled="" value="{{Auth::user()->nama_organisasi}}" required="required" aria-required="true">
                                                            </div>
                                                            <div class="category"><star>*</star> Required fields</div>
                                                        </div>

                                                        <div class="footer">
                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Register</button>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end tab content -->

                        </div> <!-- end col-md-8 -->

                    </div>
                </div>
            </div>

            @include('admin.master.footer')

        </div>
    </div>
@endsection