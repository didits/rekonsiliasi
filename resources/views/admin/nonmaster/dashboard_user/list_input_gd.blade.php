@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
<div class="wrapper">
@include('admin.master.navbar')
    <div class="main-panel">
        @include('admin.master.top_navbar', ['navbartitle' => "RAYON " .    Auth::user()->nama_organisasi])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Penyulang {{$penyulang->nama_penyulang}}</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    	<th>Input Penyulang</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            {{--{{dd(json_encode($gardu))}}--}}
                                        	<td><a href="{{url("/rayon/input_data/$penyulang->id/penyulang")}}">Input Transaksi Beli Penyulang</a></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">List GD pada Penyulang {{$penyulang->nama_penyulang}}</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                        <th>Nama Penyulang</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                    {{--{{dd($data)}}--}}
                                    @if($data)
                                        @foreach($data as $list)
                                            <tr>
                                                <td>{{ $list->id }}</td>
                                                <td>{{$list->nama_gardu}}</td>
                                                <td><a href="{{url("/rayon/input_data_keluar/$list->id/gd")}}">Input Transaksi</a></td>
                                                <td><a href="{{route('input.list_gd', $list->id)}}">Lihat List GD</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
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