@extends('admin.master.app')
@section('title', 'Page Title')

@section('content')
<div class="wrapper">
@include('admin.master.navbar')
    <div class="main-panel">
@include('admin.master.top_navbar', ['navbartitle' => 'Area XXX'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Gardu XXX</h4>
                                <p class="category">Rayon Area XXX</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    	<th>Input Gardu</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<td><a href="{{route('input.input_gardu', $data[0]->id)}}">Input Transaksi Beli Gardu</a></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Trafo Gardu XXX</h4>
                                <p class="category">Daftar Trafo Gardu XXX</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Nama Trafo</th>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $list)
                                        <tr>
                                            <td><a href="{{route('input.input_data', $list->id)}}"> {{$list->nama_penyulang}}</a></td>
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