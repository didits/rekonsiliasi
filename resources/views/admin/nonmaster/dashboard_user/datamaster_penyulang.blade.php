@extends('admin.master.app')

@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

    <div class="wrapper">
        @include('admin.master.navbar')

        <div class="main-panel">
            @include('admin.master.top_navbar', ['navbartitle' => "DATAMASTER PENYULANG: " . $penyulang->nama_penyulang])

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
                                            Penyulang {{$penyulang->nama_penyulang}}
                                        </a>
                                    </li>
                                    @foreach($data as $list => $key)

                                    <li class="">
                                        <a href="#map-logo{{$list+1}}" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-map-marker"></i><br>
                                            Gardu {{$key->nama_gardu}}
                                        </a>
                                    </li>
                                    @endforeach

                                    <li class="">
                                        <a href="#legal-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-legal"></i><br>
                                            Edit GD
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
                                                        <h4 class="title">PENYULANG {{$penyulang->nama_penyulang}}</h4>
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
                                                            <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                            <input type="hidden" name="form_penyulang" value="{{$penyulang->id}}">
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
                                                            <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                            <input type="hidden" name="form_penyulang" value="{{$penyulang->id}}">
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
                                                            <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                            <input type="hidden" name="form_penyulang" value="{{$penyulang->id}}">
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
                                                            <input type="hidden" name="idpenyulang" value={{$penyulang->id}}>
                                                            <input type="hidden" name="form_penyulang" value="{{$penyulang->id}}">
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
                                @foreach($data as $list => $key)

                                <div class="tab-pane" id="map-logo{{$list+1}}">
                                    <div class="content" id="trafoheader">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">GARDU {{$key->nama_gardu}}</h4>
                                                        {{--<p class="category">Data KWH Meter</p>--}}
                                                    </div>
                                                    <div class="content">
                                                        <form action="{{route('input_datamaster.store')}}" method="post">
                                                            <input type="hidden" name="_method" value="POST">
                                                            <input type="hidden" name="tipe" value="KWH">
                                                            <input type="hidden" name="form_gardu" value="{{$key->id}}">
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
                                                                        <input type="text" class="form-control" disabled="" placeholder="Kapasitas" value="{{json_decode($key->data_master, true)['TT']['ratiopt']}}">
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
                                                            <input type="hidden" name="form_gardu" value="{{$key->id}}">
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Merk</label>
                                                                        <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{json_decode($key->data_master, true)['KWH']['merk']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Nomor Seri</label>
                                                                        <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{json_decode($key->data_master, true)['KWH']['nomorseri']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Konstanta</label>
                                                                        <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{json_decode($key->data_master, true)['KWH']['konstanta']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Tegangan Arus</label>
                                                                        <input type="text" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{json_decode($key->data_master, true)['KWH']['teganganarus']}}">
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
                                                            <input type="hidden" name="form_gardu" value="{{$key->id}}">
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Ratio</label>
                                                                        <input type="text" name="ratioct" class="form-control" placeholder="Ratio" value="{{json_decode($key->data_master, true)['TA']['ratioct']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Burden (VA)</label>
                                                                        <input type="text" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{json_decode($key->data_master, true)['TA']['burdenct']}}">
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
                                                            <input type="hidden" name="form_gardu" value="{{$key->id}}">
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Ratio</label>
                                                                        <input type="text" name="ratiopt" class="form-control" placeholder="Ratio" value="{{json_decode($key->data_master, true)['TT']['ratiopt']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Burden (VA)</label>
                                                                        <input type="text" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{json_decode($key->data_master, true)['TT']['burdenpt']}}">
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
                                                            <input type="hidden" name="form_gardu" value="{{$key->id}}">
                                                            {{--form--}}
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Faktor Kali Meter</label>
                                                                        <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{json_decode($key->data_master, true)['FK']['faktorkali']}}">
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
                                @endforeach

                                <div class="tab-pane" id="legal-logo">
                                    <div class="content" id="trafoheader">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">PENYULANG {{$penyulang->nama_penyulang}}</h4>
                                                        {{--<p class="category">Data KWH Meter</p>--}}
                                                    </div>
                                                    <div class="content">
                                                        <form action="{{route('input_datamaster.store')}}" method="post">
                                                            <input type="hidden" name="_method" value="POST">
                                                            <input type="hidden" name="tipe" value="KWH">
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
                                                        <h4 class="title">PENYULANG {{$penyulang->nama_penyulang}}</h4>
                                                        <p class="category">Daftar Gardu</p>
                                                    </div>
                                                    <div class="content table-responsive table-full-width">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th>Nama</th>
                                                                <th>Rayon</th>
                                                                <th>Tipe Gardu</th>
                                                                <th class="text-right">Tindakan</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($data as $list => $key)                                                            <tr>
                                                                <td class="text-center">{{$list+1}}</td>
                                                                <td>{{$key->nama_gardu}}</td>
                                                                <td>{{$rayon->nama_organisasi}}</td>
                                                                @if($key->tipe_gardu==0)

                                                                <td>GD</td>
                                                                @elseif($key->tipe_gardu==1)

                                                                <td>PCT</td>
                                                                @elseif($key->tipe_gardu==2)

                                                                <td>PELANGGAN TM</td>
                                                                @endif

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

                                                            {{--<div class="form-group">--}}
                                                                {{--<div class="row">--}}
                                                                    {{--<div class="col-md-6">--}}
                                                                        {{--<div class="btn-group bootstrap-select">--}}
                                                                            {{--<div class="btn-group bootstrap-select">--}}
                                                                                {{--<select name="selectrayonsingle" class="selectpicker" data-title="Single Select" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">--}}
                                                                                    {{--<option class="bs-title-option" value="">Single Select</option>--}}
                                                                                    {{--<option value="010101">Rayon Sukolilo</option>--}}
                                                                                    {{--<option value="010102">Rayon Gubeng</option>--}}
                                                                                {{--</select>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                    {{--<div class="col-md-6">--}}
                                                                        {{--<div class="btn-group bootstrap-select show-tick">--}}
                                                                            {{--<div class="btn-group bootstrap-select show-tick">--}}
                                                                                {{--<select multiple="" data-title="Multiple Select" name="selectrayonmultiple" class="selectpicker" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue" tabindex="-98">--}}
                                                                                    {{--<option value="010101">Rayon Sukolilo</option>--}}
                                                                                    {{--<option value="010102">Rayon Gubeng</option>--}}
                                                                                {{--</select>--}}
                                                                            {{--</div>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}

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