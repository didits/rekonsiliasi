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
                                <h4 class="title">Gardu {{$gardu->nama_gardu}}</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    	<th>Input Gardu</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            {{--{{dd(json_encode($gardu))}}--}}
                                        	<td><a href="{{url("/rayon/input_data/$gardu->id/gi")}}">Input Transaksi Beli Gardu</a></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Trafo Gardu {{$gardu->nama_gardu}}</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Nama Trafo</th>
                                    </thead>
                                    <tbody>
                                    {{--{{dd($data)}}--}}
                                    @if($data)
                                        @foreach($data as $list)
                                            <tr>
                                                <td><a href="{{url("/rayon/input_data/$list->id/penyulang")}}"> {{$list->nama_penyulang}}</a></td>
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