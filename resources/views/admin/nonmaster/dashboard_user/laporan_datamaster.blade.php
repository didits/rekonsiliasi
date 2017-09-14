@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
    <div class="wrapper">
        @include('admin.master.navbar')
        <div class="main-panel">
            @include('admin.master.top_navbar', ['navbartitle' => 'DATA MASTER'])
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Laporan Data Master</h4>
                                    @if($unit == "gi")
                                    <p class="category">Gardu Induk {{$master->nama_gi}}</p>
                                        
                                    @elseif($unit == "tgi")
                                        <p class="category">Trafo GI {{$master->nama_trafo_gi}}</p>

                                    @elseif($unit == "penyulang")
                                        <p class="category">Penyulang {{$master->nama_penyulang}}</p>

                                    @elseif($unit == "gd")
                                        <p class="category">GD {{$master->nama_gardu}}</p>
                                        
                                    @elseif($unit == "pct")
                                        <p class="category">PCT {{$master->nama_nama_gardu}}</p>

                                    @elseif($unit == "p_tm")
                                        <p class="category">Pelanggan TM {{$master->nama_gardu}}</p>
                                        
                                    @endif
                                    
                                </div>
                                <div class="content">
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($unit == "tgi")

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
                                        <div class="col-md-3">
                                            <div class="content" id="kwhmeter">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">KWH Meter</h4>
                                                            </div>
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Merk</label>
                                                                            <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{$decoded['KWH']['merk']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Nomor Seri</label>
                                                                            <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{$decoded['KWH']['nomorseri']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Konstanta</label>
                                                                            <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{$decoded['KWH']['konstanta']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Tegangan Arus</label>
                                                                            <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{$decoded['KWH']['teganganarus']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
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
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Ratio</label>
                                                                            <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{$decoded['TA']['ratioct']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Burden (VA)</label>
                                                                            <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TA']['burdenct']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="content" id="trafotegangan">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">Trafo Tegangan (PT)</h4>
                                                                {{--<p class="category">Data KWH Meter</p>--}}
                                                            </div>
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Ratio</label>
                                                                            <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{$decoded['TT']['ratiopt']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Burden (VA)</label>
                                                                            <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TT']['burdenpt']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="content" id="faktorkalimeter">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">Faktor Kali Meter</h4>
                                                                {{--<p class="category">Data KWH Meter</p>--}}
                                                            </div>
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Faktor Kali Meter</label>
                                                                            <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{$decoded['FK']['faktorkali']}}" disabled>
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

                                <div class="tab-pane" id="meter-pembanding">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="content" id="kwhmeter">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">KWH Meter</h4>
                                                            </div>
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Merk</label>
                                                                            <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{$decoded['KWH']['merk']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Nomor Seri</label>
                                                                            <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{$decoded['KWH']['nomorseri']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Konstanta</label>
                                                                            <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{$decoded['KWH']['konstanta']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Tegangan Arus</label>
                                                                            <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{$decoded['KWH']['teganganarus']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
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
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Ratio</label>
                                                                            <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{$decoded['TA']['ratioct']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Burden (VA)</label>
                                                                            <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TA']['burdenct']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="content" id="trafotegangan">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">Trafo Tegangan (PT)</h4>
                                                                {{--<p class="category">Data KWH Meter</p>--}}
                                                            </div>
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Ratio</label>
                                                                            <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{$decoded['TT']['ratiopt']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Burden (VA)</label>
                                                                            <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TT']['burdenpt']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="content" id="faktorkalimeter">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">Faktor Kali Meter</h4>
                                                                {{--<p class="category">Data KWH Meter</p>--}}
                                                            </div>
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Faktor Kali Meter</label>
                                                                            <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{$decoded['FK']['faktorkali']}}" disabled>
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

                                <div class="tab-pane" id="pemakaian-sendiri">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="content" id="kwhmeter">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">KWH Meter</h4>
                                                            </div>
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Merk</label>
                                                                            <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{$decoded['KWH']['merk']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Nomor Seri</label>
                                                                            <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{$decoded['KWH']['nomorseri']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Konstanta</label>
                                                                            <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{$decoded['KWH']['konstanta']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Tegangan Arus</label>
                                                                            <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{$decoded['KWH']['teganganarus']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
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
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Ratio</label>
                                                                            <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{$decoded['TA']['ratioct']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Burden (VA)</label>
                                                                            <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TA']['burdenct']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="content" id="trafotegangan">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">Trafo Tegangan (PT)</h4>
                                                                {{--<p class="category">Data KWH Meter</p>--}}
                                                            </div>
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Ratio</label>
                                                                            <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{$decoded['TT']['ratiopt']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Burden (VA)</label>
                                                                            <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TT']['burdenpt']}}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="content" id="faktorkalimeter">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h4 class="title">Faktor Kali Meter</h4>
                                                                {{--<p class="category">Data KWH Meter</p>--}}
                                                            </div>
                                                            <div class="content">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Faktor Kali Meter</label>
                                                                            <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{$decoded['FK']['faktorkali']}}" disabled>
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

                            </div> <!-- end tab content -->

                        </div> <!-- end col-md-8 -->

                    </div>
                    @elseif($unit == "gi")

                    <div class="row">
                        <div class="col-md-12">
                            <div class="content" id="kwhmeter">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>APP</label>
                                                            <input type="text" name="app" class="form-control" placeholder="Merk" value="{{$decoded['KWH']['merk']}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Kapasitas</label>
                                                            <input type="text" name="kapasitas" class="form-control" placeholder="Nomor Seri" value="{{$decoded['KWH']['nomorseri']}}" disabled>
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
                    @else

                    <div class="row">
                        <div class="col-md-3">
                            <div class="content" id="kwhmeter">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="header">
                                                <h4 class="title">KWH Meter</h4>
                                            </div>
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Merk</label>
                                                            <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{$decoded['KWH']['merk']}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Nomor Seri</label>
                                                            <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{$decoded['KWH']['nomorseri']}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Konstanta</label>
                                                            <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{$decoded['KWH']['konstanta']}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Tegangan Arus</label>
                                                            <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{$decoded['KWH']['teganganarus']}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Ratio</label>
                                                            <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{$decoded['TA']['ratioct']}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Burden (VA)</label>
                                                            <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TA']['burdenct']}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="content" id="trafotegangan">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="header">
                                                <h4 class="title">Trafo Tegangan (PT)</h4>
                                                {{--<p class="category">Data KWH Meter</p>--}}
                                            </div>
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Ratio</label>
                                                            <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{$decoded['TT']['ratiopt']}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Burden (VA)</label>
                                                            <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{$decoded['TT']['burdenpt']}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="content" id="faktorkalimeter">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="header">
                                                <h4 class="title">Faktor Kali Meter</h4>
                                                {{--<p class="category">Data KWH Meter</p>--}}
                                            </div>
                                            <div class="content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Faktor Kali Meter</label>
                                                            <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{$decoded['FK']['faktorkali']}}" disabled>
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

            @include('admin.master.footer')

        </div>
    </div>
@endsection