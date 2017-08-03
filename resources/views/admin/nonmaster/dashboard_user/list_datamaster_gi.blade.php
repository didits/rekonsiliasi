@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
    <div class="wrapper">
        @include('admin.master.navbar')
        <div class="main-panel">
            @include('admin.master.top_navbar', ['navbartitle' => "LIST GARDU INDUK RAYON " . $nama_rayon])
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Daftar Gardu Induk</h4>
                                    <p class="category">Daftar Gardu Induk {{$nama_rayon}} </p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Nama Gardu Induk</th>
                                            <th>Alamat Gardu Induk</th>
                                            <th></th>
                                        </thead>
                                        <tbody>

                                            {{--<tr>--}}
                                                {{--<td><a href="#">Gardu Induk 1</a></td>--}}
                                                {{--<td>Sukolilo</td>--}}
                                                {{--<td><a href="#">Liat List Trafo Gardu Induk</a></td>--}}
                                            {{--</tr>--}}

                                        @foreach($data as $list)

                                            <tr>
                                                <td><a href="{{url('/area/list_datamaster_trafo/'.$id_organisasi.'/'.$list->id)}}"> {{$list->nama_gi}} </a></td>
                                                <td> {{$list->alamat_gi}} </td>
                                                <td><a href="{{url('/area/list_datamaster_trafo_gi/'.$id_organisasi.'/'.$list->id)}}">Liat List Trafo Gardu</a></td>
                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form action="{{route('input_datamaster.store')}}" method="post">
                                    <input type="hidden" name="_method" value="POST">
                                    <input type="hidden" name="id_organisasi" value="{{$id_organisasi}}">
                                    {{ csrf_field() }}
                                    {{--<form id="registerFormValidation" action="{{route('input_datamaster.create')}}" method="post" method="" novalidate="novalidate">--}}
                                    {{--{{ csrf_field() }}--}}
                                    <div class="header">Tambah Gardu Induk</div>
                                    <div class="content">
                                        <div class="form-group">
                                            <label class="control-label">Nama Gardu Induk<star>*</star></label>
                                            <input class="form-control" name="tambahnamagardu" type="text" required="required" aria-required="true">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Alamat Gardu Induk<star>*</star></label>
                                            <input class="form-control" name="tambahalamatgardu" type="text" required="required" aria-required="true">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Rayon <star>*</star></label>
                                            <input class="form-control" name="tambahnamarayon" type="text" disabled="" value="{{$nama_rayon}}" required="required" aria-required="true">
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

            @include('admin.master.footer')

        </div>
    </div>
@endsection