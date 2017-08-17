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
                                <h4 class="title">Gardu Induk {{$gardu->nama_gi}}</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    	<th>Input Gardu Induk</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            {{--{{dd(json_encode($gardu))}}--}}
                                        	<td><a href="{{url("/rayon/input_data/$gardu->id/gi")}}">Input Transaksi Beli Gardu Induk</a></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">List Trafo GI pada Gardu Induk {{$gardu->nama_gi}}</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                        <th>Nama Trafo GI</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                    {{--{{dd($data)}}--}}
                                    @if($data)
                                        @foreach($data as $list)
                                            <tr>
                                                <td>{{ $list->id }}</td>
                                                {{--<td><a href="{{url("/rayon/input_data/$list->id/trafo_gi")}}">{{$list->nama_trafo_gi}}</a></td>--}}
                                                <td>{{$list->nama_trafo_gi}}</td>
                                                <td><a href="{{route('input.list_penyulang', $list->id)}}">Lihat List Penyulang</a></td>
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