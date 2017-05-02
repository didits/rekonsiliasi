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
                                        <a href="#KWH_utama" role="tab" data-toggle="tab" aria-expanded="true">
                                            <i class="fa fa-info-circle"></i><br>
                                            KWH Meter Utama
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#KWH_pembanding" role="tab" data-toggle="tab" aria-expanded="false">
                                            <i class="fa fa-map-marker"></i><br>
                                            KWH Pembanding
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#sisi-jual" role="tab" data-toggle="tab" aria-expanded="true">
                                            <i class="fa fa-info-circle"></i><br>
                                            Pemakaian Sendiri
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="sisi-jual">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{--<h4 class="title text-center">Edit Pemakaian Sendir</h4>--}}
                                                {{--<br>--}}
                                                <form action="{{route('input_datamaster.create')}}" method="post">
                                                    <input type="hidden" name="_method" value="POST">
                                                    <input type="hidden" name="tipe" value="{{--{{$tipe}}--}}">
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
                                                                        <input type="text" name="lwbp1_visual" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir LWBP2</label>
                                                                        <input type="text" name="lwbp2_visual" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir WBP</label>
                                                                        <input type="text" name="wbp_visual" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir KVARH</label>
                                                                        <input type="text" name="kvarh_visual" class="form-control" placeholder="" value="">
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
                                                                        <input type="text" name="lwbp1_download" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir LWBP2</label>
                                                                        <input type="text" name="lwbp2_download" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir WBP</label>
                                                                        <input type="text" name="wbp_download" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir KVARH</label>
                                                                        <input type="text" name="kvarh_download" class="form-control" placeholder="" value="">
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


                                <div class="tab-pane" id="sisi-beli">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="title text-center">Edit Pemakaian Sendiri Sisi Beli</h4>
                                                <br>
                                                <form action="{{route('input_listrik.store')}}" method="post">
                                                    <input type="hidden" name="_method" value="POST">
                                                    <input type="hidden" name="tipe" value="{{--{{$tipe}}--}}">
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
                                                                        <input type="text" name="lwbp1_visual" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir LWBP2</label>
                                                                        <input type="text" name="lwbp2_visual" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir WBP</label>
                                                                        <input type="text" name="wbp_visual" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir KVARH</label>
                                                                        <input type="text" name="kvarh_visual" class="form-control" placeholder="" value="">
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
                                                                        <input type="text" name="lwbp1_download" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir LWBP2</label>
                                                                        <input type="text" name="lwbp2_download" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir WBP</label>
                                                                        <input type="text" name="wbp_download" class="form-control" placeholder="" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Stand Akhir KVARH</label>
                                                                        <input type="text" name="kvarh_download" class="form-control" placeholder="" value="">
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

                            </div> <!-- end tab content -->

                        </div> <!-- end col-md-8 -->

                    </div>
                </div>
            </div>

            @include('admin.master.footer')

        </div>
    </div>
@endsection