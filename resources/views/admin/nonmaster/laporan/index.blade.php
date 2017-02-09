 @extends('admin.master.app')
@section('title', 'Page Title')

@section('content')
<div class="wrapper">
@include('admin.master.navbar')
        <div class="main-panel">
@include('admin.master.top_navbar')
        <div class="content"> 
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Laporan</h4>
                                <p class="category">Laporan per tahun</p>
                                <div class="clearfix"></div>

                            </div>
                            <hr>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Id</th>
                                    	<th>Tahun</th>
                                    	<th>Bulan</th>
                                    	<th>Jumlah Deviasi</th>
                                    	<th>Lihat Data</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<td>1</td>
                                        	<td>2017</td>
                                        	<td>Januari</td>
                                        	<td>10%</td>
                                        	<td><a href="{{url('/admin/article/')}}"><button type="button" rel="tooltip" title="Edit Article" class="btn btn-primary btn-xs">
                                                Lihat
                                            </button></a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2017</td>
                                            <td>Januari</td>
                                            <td>10%</td>
                                            <td><a href="{{url('/admin/article/')}}"><button type="button" rel="tooltip" title="Edit Article" class="btn btn-primary btn-xs">
                                                Lihat
                                            </button></a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2017</td>
                                            <td>Januari</td>
                                            <td>10%</td>
                                            <td><a href="{{url('/admin/article/')}}"><button type="button" rel="tooltip" title="Edit Article" class="btn btn-primary btn-xs">
                                                Lihat
                                            </button></a></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>2017</td>
                                            <td>Januari</td>
                                            <td>10%</td>
                                            <td><a href="{{url('/admin/article/')}}"><button type="button" rel="tooltip" title="Edit Article" class="btn btn-primary btn-xs">
                                                Lihat
                                            </button></a></td>
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