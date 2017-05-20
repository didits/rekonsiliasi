@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
<div class="wrapper">
@include('admin.master.navbar')
    <div class="main-panel">
@include('admin.master.top_navbar', ['navbartitle' => Auth::user()->nama_organisasi])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header"> 
                                <h4 class="title">Daftar Rayon</h4>
                                <p class="category">Rayon {{Auth::user()->nama_organisasi}}</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID RAYON</th>
                                        <th>RAYON</th>
                                        <th>DAERAH</th>
                                        <th>TINDAKAN</th>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $list)
                                        <tr>
                                            <td>{{$list->id_organisasi}}</td>
                                            <td><a href="{{url('/laporan_rayon')}}">{{$list->nama_organisasi}}</a></td>
                                            <td>{{$list->nama_daerah}}</td>
                                            <td>
                                                <a href="{{route('area.datamaster')}}" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Data Master">
                                                    <i class="fa fa-bolt"></i>
                                                </a>
                                                <a href="{{route('area.pemakaiansendiri')}}" rel="tooltip" title="" class="btn btn-success btn-simple btn-xs" data-original-title="Edit Pemakaian Sendiri">
                                                    <i class="fa fa-edit"></i>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Daftar GI</h4>
                                <p class="category">Daftar GI {{Auth::user()->nama_organisasi}}</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <th>ID</th>
                                    <th>Nama GI</th>
                                    <th>Tindakan</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>GI 114</td>
                                        <td>
                                            <a href="{{url('/area/datamaster')}}" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="Edit Data Master">
                                                <i class="fa fa-bolt"></i>
                                            </a>
                                            <a href="{{url('/pemakaiansendiri')}}" rel="tooltip" title="" class="btn btn-success btn-simple btn-xs" data-original-title="Edit Pemakaian Sendiri">
                                                <i class="fa fa-edit"></i>
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
        </div>

        @include('admin.master.footer')

    </div>
</div>
@endsection