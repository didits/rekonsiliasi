@extends('admin.master.app')
@section('title', 'Page Title')

@section('content')
<div class="wrapper">
    @include('admin.master.navbar')
    <div class="main-panel">
        @include('admin.master.top_navbar', ['navbartitle' => ''])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="overflow-x: auto;">
                            <div class="header">
                                <h4 class="title">Hasil Pengolahan</h4>
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
                                        @foreach($data as $m=>$list)
                                        <tr>
                                        	<td>$m+1</td>
                                            <td>{{substr($list->tahun_bulan, 0,4)}}</td>
                                            <td>{{substr($list->tahun_bulan, 4,6)}}</td>
                                            <?php $m = json_decode($list->hasil, true) ?>
                                            <td>{{ $m['jual']['visual']['lwbp1_visual'] }}</td>
                                            <td>{{ $m['jual']['visual']['lwbp2_visual'] }}</td>
                                            <td>{{ $m['jual']['visual']['wbp_visual'] }}</td>
                                            <td>{{ $m['jual']['visual']['kvarh_visual'] }}</td>
                                            <td>{{ $m['jual']['download']['lwbp1_download'] }}</td>
                                            <td>{{ $m['jual']['download']['lwbp2_download'] }}</td>
                                            <td>{{ $m['jual']['download']['wbp_download'] }}</td>
                                            <td>{{ $m['jual']['download']['kvarh_download'] }}</td>
                                            <td>{{ $m['beli']['visual']['lwbp1_visual'] }}</td>
                                            <td>{{ $m['beli']['visual']['lwbp2_visual'] }}</td>
                                            <td>{{ $m['beli']['visual']['wbp_visual'] }}</td>
                                            <td>{{ $m['beli']['visual']['kvarh_visual'] }}</td>
                                            <td>{{ $m['beli']['download']['lwbp1_download'] }}</td>
                                            <td>{{ $m['beli']['download']['lwbp2_download'] }}</td>
                                            <td>{{ $m['beli']['download']['wbp_download'] }}</td>
                                            <td>{{ $m['beli']['download']['kvarh_download'] }}</td>
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