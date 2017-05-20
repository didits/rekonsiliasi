 @extends('admin.master.app')
 @section('title', 'Si-Oneng, Rekonsiliasi Energi')

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
                                <h4 class="title" align="center">Laporan bulan Maret 2017</h4>
                                <div class="clearfix"></div>

                            </div>
                            <hr>
                            <div class="content table-responsive table-full-width">
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th rowspan="2" style="text-align: center;">URAIAN</th>
                                        <th colspan="2" style="text-align: center;">KWH METER UTAMA</th>
                                        <th colspan="2" style="text-align: center;">KWH METER PEMBANDING</th>
                                        <th rowspan="2" style="text-align: center;">PEMAKAIAN SENDIRI</th>
                                        <th colspan="2" style="text-align: center;">TOTAL PENYULANG</th>
                                    </tr>
                                    <tr>
                                    	<th style="text-align: center;">VISUAL</th>
                                    	<th style="text-align: center;">DOWNLOAD</th>
                                        <th style="text-align: center;">VISUAL</th>
                                        <th style="text-align: center;">DOWNLOAD</th>
                                        <th style="text-align: center;">VISUAL</th>
                                        <th style="text-align: center;">DOWNLOAD</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<td>1. KWH METER:</td>
                                        	<td></td>
                                        	<td></td>
                                        	<td></td>
                                        	<td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>MEREK</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>NOMOR SERI</td>
                                            <td>35001335</td>
                                            <td>35001335</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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