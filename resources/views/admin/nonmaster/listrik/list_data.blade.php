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
                                <h4 class="title">Daftar Rayon</h4>
                                <p class="category">Rayon Area XXX</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th rowspan="3">No</th>
                                            <th rowspan="3">Tahun</th>
                                            <th rowspan="3">Bulan</th>
                                            <th colspan="8">Jual</th>
                                            <th colspan="8">Beli</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4">Visual</th>
                                            <th colspan="4">Download</th>
                                            <th colspan="4">Visual</th>
                                            <th colspan="4">Download</th>
                                        </tr>
                                        <tr>
                                            <th>LWBP1</th>
                                            <th>LWBP2</th>
                                            <th>WBP</th>
                                            <th>KVARH</th>
                                            <th>LWBP1</th>
                                            <th>LWBP2</th>
                                            <th>WBP</th>
                                            <th>KVARH</th>
                                            <th>LWBP1</th>
                                            <th>LWBP2</th>
                                            <th>WBP</th>
                                            <th>KVARH</th>
                                            <th>LWBP1</th>
                                            <th>LWBP2</th>
                                            <th>WBP</th>
                                            <th>KVARH</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $list)
                                        <tr>
                                        	<td>{{$list->id}}</td>
                                            <td>{{substr($list->tahun_bulan, 0,4)}}</td>
                                            <td>{{substr($list->tahun_bulan, 4,6)}}</td>
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