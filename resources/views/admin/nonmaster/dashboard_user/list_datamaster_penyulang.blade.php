@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
    <div class="wrapper">
        @include('admin.master.navbar')
        <div class="main-panel">
            @include('admin.master.top_navbar', ['navbartitle' => "LIST PENYULANG, TRAFO GARDU INDUK " . $nama_rayon])
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Daftar Penyulang</h4>
                                    <p class="category">Daftar Penyulang {{$nama_rayon}} </p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Nama Penyulang</th>
                                            <th>Alamat Penyulang</th>
                                            <th></th>
                                        </thead>
                                        <tbody>

                                            {{--<tr>--}}
                                                {{--<td><a href="#">Penyulang 1</a></td>--}}
                                                {{--<td>Sukolilo</td>--}}
                                                {{--<td><a href="#">Lihat List Trafo Penyulang</a></td>--}}
                                            {{--</tr>--}}

                                        @foreach($data as $list)

                                            <tr>
                                                <td><a href="{{url('/area/list_datamaster_trafo/'.$id_organisasi.'/'.$list->id)}}"> {{$list->nama_penyulang}} </a></td>
                                                <td> {{$list->alamat_penyulang}} </td>
                                                <td><a href="#">Lihat List Trafo Penyulang</a></td>
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