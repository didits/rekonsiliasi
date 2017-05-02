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
                                        	<td><a href="{{url('/input_dummy')}}">Input Transaksi Beli Gardu</a></td>
                                        </tr>
                                        <tr>
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
                                        <th>ID</th>
                                    	<th>Nama Trafo</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<td>1</td>
                                        	<td><a href="{{url('/input_dummy')}}">Penyulang 1</a></td>

                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><a href="{{url('/input_dummy')}}">Penyulang 2</a></td>

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