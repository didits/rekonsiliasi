@extends('admin.master.app')

@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

    <div class="wrapper">
        @include('admin.master.navbar')

        <div class="main-panel">
            @if($id_gi)
                @include('admin.master.top_navbar', ['navbartitle' => "DATAMASTER GARDU INDUK: " . $gi->nama_gi])
            @elseif($id_trafo_gi)
                @include('admin.master.top_navbar', ['navbartitle' => "DATAMASTER TRAFO GI: " . $trafo_gi->nama_trafo_gi])
            @elseif($id_penyulang)
                @include('admin.master.top_navbar', ['navbartitle' => "DATAMASTER PENYULANG: " . $penyulang->nama_penyulang])
            @elseif($id_gardu)
                @include('admin.master.top_navbar', ['navbartitle' => "DATAMASTER GARDU: " . $gardu->nama_gardu])
            @endif
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
                                            @if($gi)
                                                Gardu Induk {{$gi->nama_gi}}
                                            @elseif($trafo_gi)
                                                Trafo GI {{$trafo_gi->nama_trafo_gi}}
                                            @elseif($penyulang)
                                                Penyulang {{$penyulang->nama_penyulang}}
                                            @elseif($gardu)
                                                Gardu {{$gardu->nama_gardu}}
                                            @endif
                                        </a>
                                    </li>
                                    @if($gardu)
                                    @elseif($penyulang)
                                    <li class="">
                                        <a href="#home-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-home"></i><br>List GD
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#code-fork-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-code-fork"></i><br>List PCT
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#industry-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-industry"></i><br>List Pelanggan TM
                                        </a>
                                    </li>
                                    @else
                                    <li class="">
                                        <a href="#legal-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-legal"></i><br>
                                            @if($gi)
                                                List Trafo GI
                                            @elseif($trafo_gi)
                                                List Penyulang
                                            @elseif($penyulang)
                                                List Gardu
                                            @endif
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="description-logo">
                                    <div class="content" id="trafoheader">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        @if($gi)
                                                            <h4 class="title">GARDU INDUK {{$gi->nama_gi}}</h4>
                                                        @elseif($trafo_gi)
                                                            <h4 class="title">TRAFO GI {{$trafo_gi->nama_trafo_gi}}</h4>
                                                        @elseif($penyulang)
                                                            <h4 class="title">PENYULANG {{$penyulang->nama_penyulang}}</h4>
                                                        @endif
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
                                                                        <label>Alamat</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Alamat" value="{{$rayon->alamat_organisasi}}">
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
                                    @if($id_trafo_gi)
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

                                                            <p class="category">TRAFO GI {{$trafo_gi->nama_trafo_gi}}</p>
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
                                                                    </div>
                                                                    <div class="content">
                                                                        <form action="{{route('input_datamaster.store')}}" method="post">
                                                                            <input type="hidden" name="_method" value="POST">
                                                                            <input type="hidden" name="tipe" value="KWH">
                                                                            <input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>
                                                                            <input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">
                                                                            <input type="hidden" name="form_utama" value="{{$trafo_gi->id}}">

                                                                            {{--{{dd($gardu)}}--}}
                                                                            {{ csrf_field() }}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Merk</label>
                                                                                        <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{$decoded['utama']['KWH']['merk']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Nomor Seri</label>
                                                                                        <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{$decoded['utama']['KWH']['nomorseri']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Konstanta</label>
                                                                                        <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{$decoded['utama']['KWH']['konstanta']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Tegangan Arus</label>
                                                                                        <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{$decoded['utama']['KWH']['teganganarus']}}">
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
                                                                            <input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>
                                                                            <input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">
                                                                            <input type="hidden" name="form_utama" value="{{$trafo_gi->id}}">
                                                                            {{ csrf_field() }}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Ratio</label>
                                                                                        <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{$decoded['utama']['TA']['ratioct']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Burden (VA)</label>
                                                                                        <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{$decoded['utama']['TA']['burdenct']}}">
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
                                                                            <input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>
                                                                            <input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">
                                                                            <input type="hidden" name="form_utama" value="{{$trafo_gi->id}}">
                                                                            {{ csrf_field() }}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Ratio</label>
                                                                                        <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{$decoded['utama']['TT']['ratiopt']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Burden (VA)</label>
                                                                                        <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{$decoded['utama']['TT']['burdenpt']}}">
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
                                                                            <input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>
                                                                            <input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">
                                                                            <input type="hidden" name="form_utama" value="{{$trafo_gi->id}}">
                                                                            {{ csrf_field() }}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Faktor Kali Meter</label>
                                                                                        <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{$decoded['utama']['FK']['faktorkali']}}">
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

                                                <div class="tab-pane" id="meter-pembanding">
                                                    <div class="card">
                                                        <div class="header">
                                                            <h4 class="title">KWH Meter Pembanding</h4>
                                                            <p class="category">TRAFO GI {{$trafo_gi->nama_trafo_gi}}</p>
                                                        </div>
                                                        <div class="content">
                                                        </div>
                                                    </div>
                                                    <form action="{{route('input_datamaster.store')}}" method="post">
                                                        <input type="hidden" name="_method" value="POST">
                                                        <input type="hidden" name="tipe" value="all">
                                                        <input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>
                                                        <input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">
                                                        <input type="hidden" name="form_pembanding" value="{{$trafo_gi->id}}">
                                                        {{--{{dd($gardu)}}--}}
                                                        {{ csrf_field() }}

                                                    <div class="content" id="kwhmeter">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="header">
                                                                        <h4 class="title">KWH Meter</h4>
                                                                        {{--<p class="category">Data KWH Meter</p>--}}
                                                                    </div>
                                                                    <div class="content">
                                                                        {{--<form action="{{route('input_datamaster.store')}}" method="post">--}}
                                                                            {{--<input type="hidden" name="_method" value="POST">--}}
                                                                            {{--<input type="hidden" name="tipe" value="KWH">--}}
                                                                            {{--<input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>--}}
                                                                            {{--<input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">--}}
                                                                            {{--<input type="hidden" name="form_pembanding" value="{{$trafo_gi->id}}">--}}
                                                                            {{--{{dd($gardu)}}--}}
                                                                            {{--{{ csrf_field() }}--}}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Merk</label>
                                                                                        <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{$decoded['pembanding']['KWH']['merk']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Nomor Seri</label>
                                                                                        <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{$decoded['pembanding']['KWH']['nomorseri']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Konstanta</label>
                                                                                        <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{$decoded['pembanding']['KWH']['konstanta']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Tegangan Arus</label>
                                                                                        <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{$decoded['pembanding']['KWH']['teganganarus']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                            <div class="clearfix"></div>
                                                                        {{--</form>--}}
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
                                                                        {{--<form action="{{route('input_datamaster.store')}}" method="post">--}}
                                                                            {{--<input type="hidden" name="_method" value="POST">--}}
                                                                            {{--<input type="hidden" name="tipe" value="TA">--}}
                                                                            {{--<input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>--}}
                                                                            {{--<input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">--}}
                                                                            {{--<input type="hidden" name="form_pembanding" value="{{$trafo_gi->id}}">--}}
                                                                            {{--{{ csrf_field() }}--}}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Ratio</label>
                                                                                        <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{$decoded['pembanding']['TA']['ratioct']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Burden (VA)</label>
                                                                                        <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{$decoded['pembanding']['TA']['burdenct']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                            <div class="clearfix"></div>
                                                                        {{--</form>--}}
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
                                                                        {{--<form action="{{route('input_datamaster.store')}}" method="post">--}}
                                                                            {{--<input type="hidden" name="_method" value="POST">--}}
                                                                            {{--<input type="hidden" name="tipe" value="TT">--}}
                                                                            {{--<input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>--}}
                                                                            {{--<input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">--}}
                                                                            {{--<input type="hidden" name="form_pembanding" value="{{$trafo_gi->id}}">--}}
                                                                            {{--{{ csrf_field() }}--}}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Ratio</label>
                                                                                        <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{$decoded['pembanding']['TT']['ratiopt']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Burden (VA)</label>
                                                                                        <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{$decoded['pembanding']['TT']['burdenpt']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                            <div class="clearfix"></div>
                                                                        {{--</form>--}}
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
                                                                        {{--<form action="{{route('input_datamaster.store')}}" method="post">--}}
                                                                            {{--<input type="hidden" name="_method" value="POST">--}}
                                                                            {{--<input type="hidden" name="tipe" value="FK">--}}
                                                                            {{--<input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>--}}
                                                                            {{--<input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">--}}
                                                                            {{--<input type="hidden" name="form_pembanding" value="{{$trafo_gi->id}}">--}}
                                                                            {{--{{ csrf_field() }}--}}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Faktor Kali Meter</label>
                                                                                        <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{$decoded['pembanding']['FK']['faktorkali']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
                                                                            <div class="clearfix"></div>
                                                                        {{--</form>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>

                                                <div class="tab-pane" id="pemakaian-sendiri">
                                                    <div class="card">
                                                        <div class="header">
                                                            <h4 class="title">Pemakaian Sendiri</h4>
                                                            <p class="category">TRAFO GI {{$trafo_gi->nama_trafo_gi}}</p>
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
                                                                            <input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>
                                                                            <input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">
                                                                            <input type="hidden" name="form_ps" value="{{$trafo_gi->id}}">
                                                                            {{--{{dd($gardu)}}--}}
                                                                            {{ csrf_field() }}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Merk</label>
                                                                                        <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{$decoded['ps']['KWH']['merk']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Nomor Seri</label>
                                                                                        <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{$decoded['ps']['KWH']['nomorseri']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Konstanta</label>
                                                                                        <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{$decoded['ps']['KWH']['konstanta']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Tegangan Arus</label>
                                                                                        <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{$decoded['ps']['KWH']['teganganarus']}}">
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
                                                                            <input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>
                                                                            <input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">
                                                                            <input type="hidden" name="form_ps" value="{{$trafo_gi->id}}">
                                                                            {{ csrf_field() }}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Ratio</label>
                                                                                        <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{$decoded['ps']['TA']['ratioct']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Burden (VA)</label>
                                                                                        <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{$decoded['ps']['TA']['burdenct']}}">
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
                                                                            <input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>
                                                                            <input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">
                                                                            <input type="hidden" name="form_ps" value="{{$trafo_gi->id}}">
                                                                            {{ csrf_field() }}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Ratio</label>
                                                                                        <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{$decoded['ps']['TT']['ratiopt']}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Burden (VA)</label>
                                                                                        <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{$decoded['ps']['TT']['burdenpt']}}">
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
                                                                            <input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>
                                                                            <input type="hidden" name="form_trafogi" value="{{$trafo_gi->id}}">
                                                                            <input type="hidden" name="form_ps" value="{{$trafo_gi->id}}">
                                                                            {{ csrf_field() }}

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label>Faktor Kali Meter</label>
                                                                                        <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{$decoded['pembanding']['FK']['faktorkali']}}">
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
                                    @else
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
                                                                        {{--@if($id_gi)--}}
                                                                        {{--@elif($id_trafo_gi)--}}
                                                                        {{--@endif--}}
                                                                        @if($id_gi)
                                                                            <input type="hidden" name="idgardu" value={{$gi->id}}>
                                                                            <input type="hidden" name="form_gi" value={{$gi->id}}>
                                                                        @elseif($id_penyulang)
                                                                            <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                                            <input type="hidden" name="form_penyulang" value={{$penyulang->id}}>
                                                                        @elseif($id_gardu)
                                                                            <input type="hidden" name="idgardu" value={{$gardu->id}}>
                                                                            <input type="hidden" name="form_gardu" value={{$gardu->id}}>
                                                                        @endif
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
                                                                        @if($id_gi)
                                                                        <input type="hidden" name="idgardu" value={{$gi->id}}>
                                                                        <input type="hidden" name="form_gi" value="{{$gi->id}}">
                                                                        @elseif($id_penyulang)
                                                                        <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                                        <input type="hidden" name="form_penyulang" value={{$penyulang->id}}>
                                                                        @elseif($id_gardu)
                                                                        <input type="hidden" name="idgardu" value={{$gardu->id}}>
                                                                        <input type="hidden" name="form_gardu" value={{$gardu->id}}>
                                                                        @endif
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
                                                                        @if($id_gi)
                                                                            <input type="hidden" name="idgardu" value={{$gi->id}}>
                                                                            <input type="hidden" name="form_gi" value="{{$gi->id}}">
                                                                        @elseif($id_penyulang)
                                                                            <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                                            <input type="hidden" name="form_penyulang" value={{$penyulang->id}}>
                                                                        @elseif($id_gardu)
                                                                            <input type="hidden" name="idgardu" value={{$gardu->id}}>
                                                                            <input type="hidden" name="form_gardu" value={{$gardu->id}}>
                                                                        @endif
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
                                                                        @if($id_gi)
                                                                            <input type="hidden" name="idgardu" value={{$gi->id}}>
                                                                            <input type="hidden" name="form_gi" value="{{$gi->id}}">
                                                                        @elseif($id_penyulang)
                                                                            <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                                            <input type="hidden" name="form_penyulang" value={{$penyulang->id}}>
                                                                        @elseif($id_gardu)
                                                                            <input type="hidden" name="idgardu" value={{$gardu->id}}>
                                                                            <input type="hidden" name="form_gardu" value={{$gardu->id}}>
                                                                        @endif
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
                                    @endif
                                </div>
{{--DISINI PUNYA FORM.BLADE--}}
                                @if($penyulang)
                                <div class="tab-pane" id="home-logo">
                                    <div class="content" id="trafoheader">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">PENYULANG {{$penyulang->nama_penyulang}}</h4>
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
                                                                        <label>Alamat</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Alamat" value="">
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
                                                        <h4 class="title">PENYULANG {{$penyulang->nama_penyulang}}</h4>
                                                        <p class="category">Daftar GD</p>
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
                                                                <div class="{{$list = 0}}" style="display: none"></div>
                                                            @foreach($data as $key)
                                                            @if($key->tipe_gardu == 0)

                                                                <tr>
                                                                    <td class="text-center">{{$list+1}}</td>
                                                                    <td>{{$key->nama_gardu}}</td>
                                                                    <td>{{$rayon->nama_organisasi}}</td>
                                                                    <td class="td-actions text-right">
                                                                        <a href="{{url('/area/list_datamaster_gardu/'.$id_org.'/'.$key->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                            <i class="fa fa-user"></i>
                                                                        </a>
                                                                        <a href="#" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Edit Profile"
                                                                           onclick="edit_datamaster.showSwal('gd', {{$key->id}},'{{$key->nama_gardu}}','{{$key->alamat_gardu}}')">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <a href="#" rel="tooltip" title="" class="btn btn-danger btn-fill " data-original-title="Remove"
                                                                           onclick="hapus_datamaster.showSwal('gd', {{$id_org}}, {{$key->id}},'{{$key->nama_gardu}}')">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
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
                                                        <input type="hidden" name="GD" value="{{$id_penyulang}}">
                                                        <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                        <input type="hidden" name="idrayon" value={{$rayon->id_organisasi}}>
                                                        <input type="hidden" name="id_org" value={{$id_org}}>
                                                        <input type="hidden" name="tipe_" value=0>
                                                        {{ csrf_field() }}
                                                        <div class="header">Tambah Gardu Distribusi</div>
                                                        <div class="content">


                                                            <div class="form-group">
                                                                <label class="control-label">Nama Gardu Distribusi <star>*</star></label>
                                                                <input class="form-control" name="tambahnamagardu" type="text" required="required" aria-required="true">
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Alamat Gardu Distribusi <star>*</star></label>
                                                                <input class="form-control" name="tambahalamatgardu" type="text" required="required" aria-required="true">
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Rayon <star>*</star></label>
                                                                <input class="form-control" name="tambahnamarayon" type="text" disabled="" value="{{$rayon->nama_organisasi}}" required="required" aria-required="true">
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

                                <div class="tab-pane" id="code-fork-logo">
                                    <div class="content" id="trafoheader">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">PENYULANG {{$penyulang->nama_penyulang}}</h4>
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
                                                                        <label>Alamat</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Alamat" value="">
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
                                                        <h4 class="title">PENYULANG {{$penyulang->nama_penyulang}}</h4>
                                                        <p class="category">Daftar PCT</p>
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
                                                                <div class="{{$list = 0}}" style="display: none"></div>
                                                            @foreach($data as $key)
                                                            @if($key->tipe_gardu == 1)

                                                                <tr>
                                                                    <td class="text-center">{{$list+1}}</td>
                                                                    <td>{{$key->nama_gardu}}</td>
                                                                    <td>{{$rayon->nama_organisasi}}</td>
                                                                    <td class="td-actions text-right">
                                                                        <a href="{{url('/area/list_datamaster_gardu/'.$id_org.'/'.$key->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                            <i class="fa fa-user"></i>
                                                                        </a>
                                                                        <a href="#" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Edit Profile"
                                                                           onclick="edit_datamaster.showSwal('pct', {{$key->id}},'{{$key->nama_gardu}}','{{$key->alamat_gardu}}')">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <a href="#" rel="tooltip" title="" class="btn btn-danger btn-fill " data-original-title="Remove"
                                                                           onclick="hapus_datamaster.showSwal('pct', {{$id_org}}, {{$key->id}},'{{$key->nama_gardu}}')">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
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
                                                        <input type="hidden" name="GD" value="{{$id_penyulang}}">
                                                        <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                        <input type="hidden" name="idrayon" value={{$rayon->id_organisasi}}>
                                                        <input type="hidden" name="id_org" value={{$id_org}}>
                                                        <input type="hidden" name="tipe_" value=1>
                                                        {{ csrf_field() }}
                                                        <div class="header">Tambah PCT</div>
                                                        <div class="content">


                                                            <div class="form-group">
                                                                <label class="control-label">Nama PCT <star>*</star></label>
                                                                <input class="form-control" name="tambahnamagardu" type="text" required="required" aria-required="true">
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Alamat PCT <star>*</star></label>
                                                                <input class="form-control" name="tambahalamatgardu" type="text" required="required" aria-required="true">
                                                            </div>

                                                            {{--<div class="form-group">--}}
                                                                {{--<label class="control-label">Rayon <star>*</star></label>--}}
                                                                {{--<input class="form-control" name="tambahnamarayon" type="text" disabled="" value="{{$rayon->nama_organisasi}}" required="required" aria-required="true">--}}
                                                            {{--</div>--}}

                                                            <div class="form-group">
                                                                <label class="control-label">EXIM <star>*</star></label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="btn-group bootstrap-select">
                                                                            <div class="btn-group bootstrap-select">
                                                                                <select name="selectExim" class="selectpicker" data-title="Single Select" required="required" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                                                                                    <option class="bs-title-option" value="">Pilih EXIM</option>
                                                                                    <option value="pct_impor">Impor</option>
                                                                                    <option value="pct_ekspor">Ekspor</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Tujuan EXIM <star>*</star></label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="btn-group bootstrap-select">
                                                                            <div class="btn-group bootstrap-select">
                                                                                <select name="selectTujuanExim" class="selectpicker" data-title="Single Select" required="required" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                                                                                    <option class="bs-title-option" value="">Pilih Tujuan EXIM</option>
                                                                                    <option value="pct_penyulang">Penyulang</option>
                                                                                    <option value="pct_gd">GD</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Rayon <star>*</star></label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="btn-group bootstrap-select">
                                                                            <div class="btn-group bootstrap-select">
                                                                                <select name="selectareasingle" class="selectpicker" data-title="Single Select" required="required" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                                                                                    <option class="bs-title-option" value="">Area</option>
                                                                                    @foreach ($dropdown_area as $areas)

                                                                                        <option value="{{ $areas->id_organisasi }}">{{ $areas->nama_organisasi }}</option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="btn-group bootstrap-select">
                                                                            <div class="btn-group bootstrap-select">
                                                                                <select name="selectrayonsingle" class="selectpicker" data-title="Single Select" required="required" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                                                                                    <option class="bs-title-option" value="">Rayon</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group"  id="pct_selectPenyulang">
                                                                <label class="control-label">Gardu Distribusi <star>*</star></label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="btn-group bootstrap-select">
                                                                            <div class="btn-group bootstrap-select">
                                                                                <select name="selectpenyulangsingle" class="selectpicker" data-title="Single Select" required="required" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                                                                                    <option class="bs-title-option" value="">Penyulang</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group"  id="pct_selectGD">
                                                                <label class="control-label">Penyulang <star>*</star></label>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="btn-group bootstrap-select">
                                                                            <div class="btn-group bootstrap-select">
                                                                                <select name="selectpenyulangsingle" class="selectpicker" data-title="Single Select" required="required" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                                                                                    <option class="bs-title-option" value="">Penyulang</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="btn-group bootstrap-select">
                                                                            <div class="btn-group bootstrap-select">
                                                                                <select name="selectgdsingle" class="selectpicker" data-title="Single Select" required="required" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                                                                                    <option class="bs-title-option" value="">GD</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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

                                <div class="tab-pane" id="industry-logo">
                                    <div class="content" id="trafoheader">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">PENYULANG {{$penyulang->nama_penyulang}}</h4>
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
                                                                        <label>Alamat</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Alamat" value="">
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
                                                        <h4 class="title">PENYULANG {{$penyulang->nama_penyulang}}</h4>
                                                        <p class="category">Daftar Pelanggan TM</p>
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
                                                                <div class="{{$list = 0}}" style="display: none"></div>
                                                            @foreach($data as $key)
                                                            @if($key->tipe_gardu == 2)

                                                                <tr>
                                                                    <td class="text-center">{{$list+1}}</td>
                                                                    <td>{{$key->nama_gardu}}</td>
                                                                    <td>{{$rayon->nama_organisasi}}</td>
                                                                    <td class="td-actions text-right">
                                                                        <a href="{{url('/area/list_datamaster_gardu/'.$id_org.'/'.$key->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                            <i class="fa fa-user"></i>
                                                                        </a>
                                                                        <a href="#" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Edit Profile"
                                                                           onclick="edit_datamaster.showSwal('p_tm', {{$key->id}},'{{$key->nama_gardu}}','{{$key->alamat_gardu}}')">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        <a href="#" rel="tooltip" title="" class="btn btn-danger btn-fill " data-original-title="Remove"
                                                                           onclick="hapus_datamaster.showSwal('p_tm', {{$id_org}}, {{$key->id}},'{{$key->nama_gardu}}')">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
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
                                                        <input type="hidden" name="GD" value="{{$id_penyulang}}">
                                                        <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                        <input type="hidden" name="idrayon" value={{$rayon->id_organisasi}}>
                                                        <input type="hidden" name="id_org" value={{$id_org}}>
                                                        <input type="hidden" name="tipe_" value=2>
                                                        {{ csrf_field() }}
                                                        <div class="header">Tambah Pelanggan TM</div>
                                                        <div class="content">


                                                            <div class="form-group">
                                                                <label class="control-label">Nama Pelanggan TM <star>*</star></label>
                                                                <input class="form-control" name="tambahnamagardu" type="text" required="required" aria-required="true">
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Alamat Pelanggan TM <star>*</star></label>
                                                                <input class="form-control" name="tambahalamatgardu" type="text" required="required" aria-required="true">
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Rayon <star>*</star></label>
                                                                <input class="form-control" name="tambahnamarayon" type="text" disabled="" value="{{$rayon->nama_organisasi}}" required="required" aria-required="true">
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

                                @else
                                <div class="tab-pane" id="legal-logo">
                                    <div class="content" id="trafoheader">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        @if($id_gi)
                                                        <h4 class="title">GARDU INDUK {{$gi->nama_gi}}</h4>
                                                        @elseif($id_trafo_gi)
                                                        <h4 class="title">TRAFO GI {{$trafo_gi->nama_trafo_gi}}</h4>
                                                        @endif    {{--<p class="category">Data KWH Meter</p>--}}
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
                                                                        <label>Alamat</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Alamat" value="">
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
                                                        @if($id_gi)
                                                            <h4 class="title">GARDU INDUK {{$gi->nama_gi}}</h4>
                                                            <p class="category">Daftar Trafo GI</p>
                                                        @elseif($id_trafo_gi)
                                                            <h4 class="title">TRAFO GI {{$trafo_gi->nama_trafo_gi}}</h4>
                                                            <p class="category">Daftar Penyulang</p>
                                                        @elseif($id_penyulang)
                                                            {{--{{dd($penyulang)}}--}}
                                                            <h4 class="title">PENYULANG {{$penyulang->nama_penyulang}}</h4>
                                                            <p class="category">Daftar Gardu</p>
                                                        @endif    {{--<p class="category">Data KWH Meter</p>--}}
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
                                                                    @if($id_gi)

                                                                    <td>{{$key->nama_trafo_gi}}</td>
                                                                    @elseif($id_trafo_gi)

                                                                    <td>{{$key->nama_penyulang}}</td>
                                                                    @elseif($id_penyulang)

                                                                    <td>{{$key->nama_gardu}}</td>
                                                                    @endif

                                                                    <td>{{$rayon->nama_organisasi}}</td>
                                                                    <td class="td-actions text-right">
                                                                        @if($id_gi)
                                                                            <a href="{{url('/area/list_datamaster_trafo_gi/'.$id_org.'/'.$key->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                                <i class="fa fa-user"></i>
                                                                            </a>
                                                                        @elseif($id_trafo_gi)

                                                                        <a href="{{url('/area/list_datamaster_penyulang/'.$id_org.'/'.$key->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                            <i class="fa fa-user"></i>
                                                                        </a>
                                                                        @elseif($id_penyulang)

                                                                        <a href="{{url('/area/list_datamaster_gardu/'.$id_org.'/'.$key->id)}}" rel="tooltip" title="" class="btn btn-info btn-fill" data-original-title="View Datamaster">
                                                                            <i class="fa fa-user"></i>
                                                                        </a>
                                                                        @endif
{{--                                                                        {{dd($key)}}--}}

                                                                        <a href="#" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Edit Profile"
                                                                            @if($id_gi)
                                                                            onclick="edit_datamaster.showSwal('trafo_gi', {{$key->id}},'{{$key->nama_trafo_gi}}','{{$key->alamat_trafo_gi}}')">
                                                                            @elseif($id_trafo_gi)
                                                                            onclick="edit_datamaster.showSwal('penyulang', {{$key->id}},'{{$key->nama_penyulang}}','{{$key->alamat_penyulang}}')">
                                                                            @elseif($id_penyulang)
                                                                            onclick="edit_datamaster.showSwal('gardu', {{$key->id}},'{{$key->nama_gardu}}','{{$key->alamat_gardu}}')">
                                                                            @endif

                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
                                                                        {{--<a href="{{url('/area/delete/'.$id_org.'/'."GD".'/'.$key->id)}}" rel="tooltip" title="" class="btn btn-danger btn-fill " data-original-title="Remove">--}}
                                                                            {{--<i class="fa fa-times"></i>--}}
                                                                        {{--</a>--}}
                                                                        <a href="#" rel="tooltip" title="" class="btn btn-danger btn-fill " data-original-title="Remove"
                                                                            @if($id_gi)
                                                                            onclick="hapus_datamaster.showSwal('trafo_gi', {{$id_org}}, {{$key->id}},'{{$key->nama_trafo_gi}}')">
                                                                            @elseif($id_trafo_gi)
                                                                            onclick="hapus_datamaster.showSwal('penyulang', {{$id_org}}, {{$key->id}},'{{$key->nama_penyulang}}')">
                                                                            @elseif($id_penyulang)
                                                                            onclick="hapus_datamaster.showSwal('gd', {{$id_org}}, {{$key->id}},'{{$key->nama_gardu}}')">
                                                                            @endif

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
                                                    @if($id_gi)
                                                    <form action="{{route('input_datamaster.store')}}" method="post">
                                                        <input type="hidden" name="_method" value="POST">
                                                        <input type="hidden" name="trafogi" value="{{$id_gi}}">
                                                        <input type="hidden" name="idgardu" value={{$gi->id}}>
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
                                                                <input class="form-control" name="tambahnamarayon" type="text" disabled="" value="{{$rayon->nama_organisasi}}" required="required" aria-required="true">
                                                            </div>
                                                            <div class="category"><star>*</star> Required fields</div>
                                                        </div>

                                                        <div class="footer">
                                                            <button type="submit" class="btn btn-info btn-fill pull-right">Register</button>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </form>
                                                    @elseif($id_trafo_gi)
                                                    <form action="{{route('input_datamaster.store')}}" method="post">
                                                            <input type="hidden" name="_method" value="POST">
                                                            <input type="hidden" name="penyulang" value="{{$id_trafo_gi}}">
                                                            <input type="hidden" name="idtrafo_gi" value={{$trafo_gi->id}}>
                                                            <input type="hidden" name="idrayon" value={{$rayon->id_organisasi}}>
                                                            <input type="hidden" name="id_org" value={{$id_org}}>
                                                            {{ csrf_field() }}
                                                            <div class="header">Tambah Penyulang</div>
                                                            <div class="content">


                                                                <div class="form-group">
                                                                    <label class="control-label">Nama Penyulang <star>*</star></label>
                                                                    <input class="form-control" name="tambahnamapenyulang" type="text" required="required" aria-required="true">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label">Alamat Penyulang <star>*</star></label>
                                                                    <input class="form-control" name="tambahalamatpenyulang" type="text" required="required" aria-required="true">
                                                                </div>

                                                                {{--<div class="form-group">--}}
                                                                    {{--<label class="control-label">Rayon <star>*</star></label>--}}
                                                                    {{--<input class="form-control" name="tambahnamarayon" type="text" disabled="" value="{{$rayon->nama_organisasi}}" required="required" aria-required="true">--}}
                                                                {{--</div>--}}

                                                                <div class="form-group">
                                                                    <label class="control-label">Rayon <star>*</star></label>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="btn-group bootstrap-select">
                                                                                <div class="btn-group bootstrap-select">
                                                                                    <select name="selectareasingle" class="selectpicker" data-title="Single Select" required="required" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                                                                                        <option class="bs-title-option" value="">Area</option>
                                                                                        @foreach ($dropdown_area as $areas)

                                                                                            <option value="{{ $areas->id_organisasi }}">{{ $areas->nama_organisasi }}</option>
                                                                                        @endforeach

                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="btn-group bootstrap-select">
                                                                                <div class="btn-group bootstrap-select">
                                                                                    <select name="selectrayonsingle" class="selectpicker" data-title="Single Select" required="required" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                                                                                        <option class="bs-title-option" value="">Rayon</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="category"><star>*</star> Required fields</div>
                                                            </div>

                                                            <div class="footer">
                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Register</button>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </form>
                                                    @elseif($id_penyulang)
                                                    <form action="{{route('input_datamaster.store')}}" method="post">
                                                            <input type="hidden" name="_method" value="POST">
                                                            <input type="hidden" name="GD" value="{{$id_penyulang}}">
                                                            <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                            <input type="hidden" name="idrayon" value={{$rayon->id_organisasi}}>
                                                            <input type="hidden" name="id_org" value={{$id_org}}>
                                                            {{ csrf_field() }}
                                                            <div class="header">Tambah Gardu</div>
                                                            <div class="content">


                                                                <div class="form-group">
                                                                    <label class="control-label">Nama Gardu <star>*</star></label>
                                                                    <input class="form-control" name="tambahnamagardu" type="text" required="required" aria-required="true">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label">Alamat Gardu <star>*</star></label>
                                                                    <input class="form-control" name="tambahalamatgardu" type="text" required="required" aria-required="true">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label">Rayon <star>*</star></label>
                                                                    <input class="form-control" name="tambahnamarayon" type="text" disabled="" value="{{Auth::user()->nama_organisasi}}" required="required" aria-required="true">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label">Jenis Gardu <star>*</star></label>
                                                                    <label class="radio">
                                                                    <span class="icons"><span class="first-icon fa fa-circle-o"></span>
                                                                    <span class="second-icon fa fa-dot-circle-o"></span></span>
                                                                        <input type="radio" data-toggle="radio" name="optionsRadios" value="0" required>GD
                                                                    </label>
                                                                    <div class="clearfix"></div>
                                                                    <label class="radio">
                                                                    <span class="icons"><span class="first-icon fa fa-circle-o"></span>
                                                                    <span class="second-icon fa fa-dot-circle-o"></span></span>
                                                                        <input type="radio" data-toggle="radio" name="optionsRadios" value="1">PCT
                                                                    </label>
                                                                    <div class="clearfix"></div>
                                                                    <label class="radio">
                                                                    <span class="icons"><span class="first-icon fa fa-circle-o"></span>
                                                                    <span class="second-icon fa fa-dot-circle-o"></span></span>
                                                                        <input type="radio" data-toggle="radio" name="optionsRadios" value="2">Pelanggan TM
                                                                    </label>

                                                                </div>


                                                                <div class="category"><star>*</star> Required fields</div>
                                                            </div>

                                                            <div class="footer">
                                                                <button type="submit" class="btn btn-info btn-fill pull-right">Register</button>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endif

                            </div> <!-- end tab content -->

                        </div> <!-- end col-md-8 -->

                    </div>
                </div>
            </div>

            @include('admin.master.footer')

        </div>
    </div>

@endsection

@section('extra_plugin')

    <!--  Notifications Plugin    -->
    <script src="{{ URL::asset('dashboard/js/bootstrap-notify.js') }}"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="{{ URL::asset('dashboard/js/sweetalert2.js') }}"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="{{ URL::asset('dashboard/js/edit_remove_listrik.js') }}"></script>

@endsection

@section('extra_script')

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="selectareasingle"]').on('change', function () {
                var id_area = $(this).val();
                if (id_area) {
                    $.ajax({
                        url: '{{ url('populate/rayon/') }}' + '/' + id_area,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
//                            console.log(data);

                            $('select[name="selectrayonsingle"]').empty().append('<option class="bs-title-option" value="">Rayon</option>');
                            ;
                            $.each(data, function (key, value) {
                                $('select[name="selectrayonsingle"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                            $('.selectpicker').selectpicker('refresh');

                        }
                    });
                } else {
                    $('select[name="selectrayonsingle"]').empty().append('<option class="bs-title-option" value="">Rayon</option>');
                }
            });
            $('select[name="selectrayonsingle"]').on('change', function () {
                var id_rayon = $(this).val();
                console.log(id_rayon);
                if (id_rayon) {
                    $.ajax({
                        url: '{{ url('populate/penyulang/') }}' + '/' + id_rayon,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
//                            console.log(data);

                            $('select[name="selectpenyulangsingle"]').empty().append('<option class="bs-title-option" value="">Penyulang</option>');
                            ;
                            $.each(data, function (key, value) {
                                $('select[name="selectpenyulangsingle"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                            $('.selectpicker').selectpicker('refresh');

                        }
                    });
                } else {
                    $('select[name="selectpenyulangsingle"]').empty().append('<option class="bs-title-option" value="">Penyulang</option>');
                }
            });
            $('select[name="selectpenyulangsingle"]').on('change', function() {
                var id_penyulang = $(this).val();
                console.log(id_penyulang);
                if(id_penyulang) {
                    $.ajax({
                        url: '{{ url('populate/gd/') }}'+'/'+id_penyulang,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
//                            console.log(data);

                            $('select[name="selectgdsingle"]').empty().append('<option class="bs-title-option" value="">GD</option>');;
                            $.each(data, function(key, value) {
                                $('select[name="selectgdsingle"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                            $('.selectpicker').selectpicker('refresh');

                        }
                    });
                }else{
                    $('select[name="selectgdsingle"]').empty().append('<option class="bs-title-option" value="">Penyulang</option>');
                }
            });
        });
    </script>

    <script type="text/javascript">
        url_edit = "{{route('area.edit_datamaster')}}";
        url_delete = "{{url('area/hapus_datamaster')}}";
    </script>
@endsection