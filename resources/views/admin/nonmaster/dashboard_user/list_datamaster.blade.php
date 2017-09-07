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
                                    <h4 class="title">Daftar Rayon</h4>
                                    <p class="category">Area {{Auth::user()->nama_organisasi}}</p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                        <th>RAYON</th>
                                        <th>ALAMAT RAYON</th>
                                        <th>SINGLE LINE</th>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $list)
                                        <tr>
                                            {{--<td><a href="{{route('area.list_gardu_induk', $list->id_organisasi)}}">{{$list->nama_organisasi}}</a></td>--}}
                                            <td>{{$list->nama_organisasi}}</td>
                                            <td>{{$list->alamat}}</td>
                                            <td>
                                                <a href="{{route('area.get_structure', $list->id)}}" class="btn btn-info btn-fill pull-right" style="margin-left:5pt">Single line</a>
                                                <a href="{{route('area.list_datamaster', $list->id_organisasi)}}" class="btn btn-info btn-fill pull-right" >List GI</a>
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