@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

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
                                            KWH Meter
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#map-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-map-marker"></i><br>
                                            Trafo Arus (CT)
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#legal-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-legal"></i><br>
                                            Trafo Tegangan (PT)
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#help-logo" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-life-ring"></i><br>
                                            Faktor Kali Meter
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="description-logo">
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
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Penyulang</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Penyulang" value="Penyulang XXX">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Area</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Area" value="{{Auth::user()->nama_organisasi}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Rayon</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Rayon" value="Rayon XXX">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Merk</label>
                                                                        <input type="text" name="merk" class="form-control"disabled="" placeholder="Merk" value="{{$data['KWH']['merk']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Nomor Seri</label>
                                                                        <input type="text" name="noseri" class="form-control"disabled="" placeholder="Nomor Seri" value="{{$data['KWH']['nomorseri']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Konstanta</label>
                                                                        <input type="text" name="konstanta" class="form-control"disabled="" placeholder="Konstanta" value="{{$data['KWH']['konstanta']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Tegangan Arus</label>
                                                                        <input type="number" name="teganganarus" class="form-control"disabled="" placeholder="Tegangan Arus" value="{{$data['KWH']['teganganarus']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{--<button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>--}}
                                                            <div class="clearfix"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane" id="map-logo">
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
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Penyulang</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Penyulang" value="Penyulang XXX">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Area</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Area" value="{{Auth::user()->nama_organisasi}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Rayon</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Rayon" value="Rayon XXX">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Ratio</label>
                                                                        <input type="number" name="ratioct" class="form-control"disabled="" placeholder="Ratio" value="{{$data['TA']['ratioct']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Burden (VA)</label>
                                                                        <input type="number" name="burdenct" class="form-control"disabled="" placeholder="Burden (VA)" value="{{$data['TA']['burdenct']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{--<button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>--}}
                                                            <div class="clearfix"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane" id="legal-logo">
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
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Penyulang</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Penyulang" value="Penyulang XXX">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Area</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Area" value="{{Auth::user()->nama_organisasi}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Rayon</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Rayon" value="Rayon XXX">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Ratio</label>
                                                                        <input type="number" name="ratiopt" class="form-control"disabled="" placeholder="Ratio" value="{{$data['TT']['ratiopt']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Burden (VA)</label>
                                                                        <input type="number" name="burdenpt" class="form-control"disabled="" placeholder="Burden (VA)" value="{{$data['TT']['burdenpt']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{--<button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>--}}
                                                            <div class="clearfix"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="help-logo">
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
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Penyulang</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Penyulang" value="Penyulang XXX">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Area</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Area" value="{{Auth::user()->nama_organisasi}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Rayon</label>
                                                                        <input type="text" class="form-control" disabled="" placeholder="Rayon" value="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Faktor Kali Meter</label>
                                                                        <input type="number" name="faktorkali" class="form-control"disabled="" placeholder="Faktor Kali" value="{{$data['FK']['faktorkali']}}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{--<button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>--}}
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
            </div>

            @include('admin.master.footer')

        </div>
    </div>
@endsection