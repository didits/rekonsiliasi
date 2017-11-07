@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
    <div class="wrapper">
        @include('admin.master.navbar')
        <div class="main-panel">
            @include('admin.master.top_navbar', ['navbartitle' => "AREA " .    Auth::user()->nama_organisasi])
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Daftar Area</h4>
                                    <p class="category">{{Auth::user()->nama_organisasi}}</p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID AREA</th>
                                            <th>AREA</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $list)

                                            <tr>
                                                <td>{{$list->id_organisasi}}</td>
                                                <td>{{$list->nama_organisasi}}</td>
                                                <td>
                                                    @if($master)

                                                    <a href="{{route('distribusi.laporan_master', $list->id_organisasi)}}" rel="tooltip" title="" data-original-title="List Rayon" class="btn btn-info btn-fill pull-right" >
                                                        <i class="fa fa-th-list"></i>
                                                    </a>
                                                    @else

                                                    <a href="{{route('distribusi.laporan_beli', $list->id_organisasi)}}" rel="tooltip" title="" data-original-title="List Rayon" class="btn btn-info btn-fill pull-right" >
                                                        <i class="fa fa-th-list"></i>
                                                    </a>
                                                    @endif

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
            </div>

            @include('admin.master.footer')

        </div>
    </div>
@endsection