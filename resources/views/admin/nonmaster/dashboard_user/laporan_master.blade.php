@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
    <div class="wrapper">
        @include('admin.master.top_navbar', ['navbartitle' => "Laporan Master"])

        @include('admin.master.navbar')

        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Laporan Master</h4>
                                    <p class="category">Laporan Master</p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <div class="toolbar">
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>

                                    <table id="bootstrap-table" class="table">
                                        <thead>
                                            <th data-field="state" data-checkbox="true"></th>
                                            <th data-field="jenis" data-sortable="true">Jenis</th>
                                            <th data-field="id_org" data-sortable="true">Rayon</th>
                                            <th data-field="nama" data-sortable="true">Nama</th>
                                            <th data-field="id" data-checkbox="false" data-sortable="true">Data Master</th>
                                        </thead>
                                        <tbody>
                                        @foreach($list_distribusi as $rayon)
                                        @foreach($rayon as $gi)

                                            <tr>
                                                <td></td>
                                                <td>GI</td>
                                                <td>{{ $gi->nama_organisasi }}</td>
                                                <td>{{ $gi->nama_gi }}</td>
                                                <td>{{ $gi->data_master }}</td>
                                            </tr>
                                        @foreach($gi['trafo_gi'] as $trafo_gi)

                                            <tr>
                                                <td></td>
                                                <td>Trafo GI</td>
                                                <td>{{ $trafo_gi->nama_trafo_gi }}</td>
                                                <td>{{ $trafo_gi->nama_organisasi }}</td>
                                                <td>{{ $trafo_gi->data_master }}</td>
                                            </tr>
                                        @foreach($trafo_gi['penyulang'] as $penyulang)

                                            <tr>
                                                <td></td>
                                                <td>Penyulang</td>
                                                <td>{{ $penyulang->nama_organisasi }}</td>
                                                <td>{{ $penyulang->nama_penyulang }}</td>
                                                <td>{{ $penyulang->data_master }}</td>
                                            </tr>
                                        @endforeach
                                        @endforeach
                                        @endforeach
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