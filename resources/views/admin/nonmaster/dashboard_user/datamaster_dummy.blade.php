@extends('admin.master.app')
@section('title', 'Data Master')

@section('content')
    <div class="wrapper">
        @include('admin.master.navbar')
        <div class="main-panel">
            @include('admin.master.top_navbar', ['navbartitle' => 'Data Master'])
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
                                            Trafo
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#map-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-map-marker"></i><br>
                                            Penyulang 01
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#map-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-map-marker"></i><br>
                                            Penyulang 02
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#legal-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-legal"></i><br>
                                            Edit Penyulang
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
                                                        <h4 class="title">TRAFO 1010101</h4>
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
                                                                        <label>Penyulang</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Penyulang" value="Penyulang XXX">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Area</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Area" value="Area XXX">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Rayon</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Rayon" value="Rayon XXX">
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
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Merk</label>
                                                                        <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{--{{$data['KWH']['merk']}}--}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Nomor Seri</label>
                                                                        <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{--{{$data['KWH']['nomorseri']}}--}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Konstanta</label>
                                                                        <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{--{{$data['KWH']['konstanta']}}--}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Tegangan Arus</label>
                                                                        <input type="number" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{--{{$data['KWH']['teganganarus']}}--}}">
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
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Ratio</label>
                                                                        <input type="number" name="ratioct" class="form-control" placeholder="Ratio" value="{{--{{$data['TA']['ratioct']}}--}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Burden (VA)</label>
                                                                        <input type="number" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{--{{$data['TA']['burdenct']}}--}}">
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
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Ratio</label>
                                                                        <input type="number" name="ratiopt" class="form-control" placeholder="Ratio" value="{{--{{$data['TT']['ratiopt']}}--}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Burden (VA)</label>
                                                                        <input type="number" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{--{{$data['TT']['burdenpt']}}--}}">
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
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Faktor Kali Meter</label>
                                                                        <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{--{{$data['FK']['faktorkali']}}--}}">
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

                                <div class="tab-pane" id="map-logo">
                                    <div class="content" id="trafoheader">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">PENYULANG 101010101</h4>
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
                                                                        <label>Penyulang</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Penyulang" value="Penyulang XXX">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Area</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Area" value="Area XXX">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Rayon</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Rayon" value="Rayon XXX">
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
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Merk</label>
                                                                        <input type="text" name="merk" class="form-control" placeholder="Merk" value="{{--{{$data['KWH']['merk']}}--}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Nomor Seri</label>
                                                                        <input type="text" name="noseri" class="form-control" placeholder="Nomor Seri" value="{{--{{$data['KWH']['nomorseri']}}--}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Konstanta</label>
                                                                        <input type="text" name="konstanta" class="form-control" placeholder="Konstanta" value="{{--{{$data['KWH']['konstanta']}}--}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Tegangan Arus</label>
                                                                        <input type="number" name="teganganarus" class="form-control" placeholder="Tegangan Arus" value="{{--{{$data['KWH']['teganganarus']}}--}}">
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
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Ratio</label>
                                                                        <input type="number" name="ratioct" class="form-control" placeholder="Ratio" value="{{--{{$data['TA']['ratioct']}}--}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Burden (VA)</label>
                                                                        <input type="number" name="burdenct" class="form-control" placeholder="Burden (VA)" value="{{--{{$data['TA']['burdenct']}}--}}">
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
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Ratio</label>
                                                                        <input type="number" name="ratiopt" class="form-control" placeholder="Ratio" value="{{--{{$data['TT']['ratiopt']}}--}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Burden (VA)</label>
                                                                        <input type="number" name="burdenpt" class="form-control" placeholder="Burden (VA)" value="{{--{{$data['TT']['burdenpt']}}--}}">
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
                                                            {{ csrf_field() }}

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Faktor Kali Meter</label>
                                                                        <input type="number" name="faktorkali" class="form-control" placeholder="Faktor Kali" value="{{--{{$data['FK']['faktorkali']}}--}}">
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

                                <div class="tab-pane" id="legal-logo">
                                    <div class="content" id="trafoheader">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h4 class="title">TRAFO 1010101</h4>
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
                                                                        <label>Penyulang</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Penyulang" value="Penyulang XXX">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Area</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Area" value="Area XXX">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Rayon</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Rayon" value="Rayon XXX">
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
                                                        <h4 class="title">TRAFO 1010101</h4>
                                                        <p class="category">Daftar Penyulang</p>
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
                                                            <tr>
                                                                <td class="text-center">1</td>
                                                                <td>Penyulang 01</td>
                                                                <td>Sukolilo</td>
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
                                                            <tr>

                                                                <td class="text-center">2</td>
                                                                <td>Penyulang 02</td>
                                                                <td>Gubeng</td>
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
                                                    <form id="registerFormValidation" action="" method="" novalidate="novalidate">
                                                        <div class="header">Tambah Penyulang</div>
                                                        <div class="content">


                                                            <div class="form-group">
                                                                <label class="control-label">Nama Penyulang <star>*</star></label>
                                                                <input class="form-control" name="tambahnamapenyulang" type="text" required="required" aria-required="true">
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Rayon <star>*</star></label>
                                                                <input class="form-control" name="tambahnamarayon" type="text" required="required" aria-required="true">
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="btn-group bootstrap-select">
                                                                            <div class="btn-group bootstrap-select">
                                                                                <select name="selectrayonsingle" class="selectpicker" data-title="Single Select" data-style="btn-default btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                                                                                    <option class="bs-title-option" value="">Single Select</option>
                                                                                    <option value="010101">Rayon Sukolilo</option>
                                                                                    <option value="010102">Rayon Gubeng</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="btn-group bootstrap-select show-tick">
                                                                            <div class="btn-group bootstrap-select show-tick">
                                                                                <select multiple="" data-title="Multiple Select" name="selectrayonmultiple" class="selectpicker" data-style="btn-info btn-fill btn-block" data-menu-style="dropdown-blue" tabindex="-98">
                                                                                    <option value="010101">Rayon Sukolilo</option>
                                                                                    <option value="010102">Rayon Gubeng</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Jenis Penyulang</label>
                                                                <label class="radio checked">
                                                                    <span class="icons"><span class="first-icon fa fa-circle-o"></span>
                                                                    <span class="second-icon fa fa-dot-circle-o"></span></span>
                                                                    <input type="radio" data-toggle="radio" name="optionsRadios" value="option1">GD
                                                                </label>
                                                                <div class="clearfix"></div>
                                                                <label class="radio">
                                                                    <span class="icons"><span class="first-icon fa fa-circle-o"></span>
                                                                    <span class="second-icon fa fa-dot-circle-o"></span></span>
                                                                    <input type="radio" data-toggle="radio" name="optionsRadios" value="option2">PCT
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