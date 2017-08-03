@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
    <div class="wrapper">
        @include('admin.master.navbar')
        <div class="main-panel">
            @include('admin.master.top_navbar', ['navbartitle' => "LIST TRAFO GARDU INDUK, GARDU INDUK " . $nama_rayon])
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Daftar Trafo Gardu Induk</h4>
                                    <p class="category">Daftar Trafo Gardu Induk {{$nama_rayon}} </p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Nama Trafo Gardu Induk</th>
                                            <th>Alamat Trafo Gardu Induk</th>
                                            <th></th>
                                        </thead>
                                        <tbody>

                                        @foreach($data as $list)

                                            <tr>
                                                <td><a href="{{url('/area/list_datamaster_trafo_gi/'.$id_organisasi.'/'.$list->id)}}"> {{$list->nama_trafo_gi}} </a></td>
                                                <td> {{$list->alamat_trafo_gi}} </td>
                                                <td><a href="{{url('/area/list_datamaster_penyulang/'.$id_organisasi.'/'.$list->id)}}">Lihat List Penyulang</a></td>
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