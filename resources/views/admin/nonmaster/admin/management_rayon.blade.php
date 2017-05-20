@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
<div class="wrapper">
@include('admin.master.navbar')
    <div class="main-panel">
@include('admin.master.top_navbar', ['navbartitle' => Auth::user()->nama_organisasi])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Daftar Organisasi</h4>
                                <hr>
                                <form method="POST" action="{{url('admin/import_organisasi')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div id="form-soal" class="form-group label-floating">
                                        <div>
                                                <span class="btn btn-info btn-round btn-file">
                                                    <input type="file" name="excel" required/>
                                                </span>
                                            <button type="submit" class="btn btn-fill btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="bootstrap-table" class="table table-hover table-striped">
                                    <thead>
                                        <th data-field="no" data-sortable="true" class="text-center">No</th>
                                        <th data-field="idorg" data-sortable="true">ID ORGANISASI</th>
                                        <th data-field="namaorg" data-sortable="true">NAMA ORGANISASI</th>
                                        <th data-field="tipeorg" data-sortable="true">TIPE ORGANISASI</th>
                                        <th data-field="alamat">ALAMAT</th>

                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $list)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$list->id_organisasi}}</td>
                                            <td>{{$list->nama_organisasi}}</td>
                                            <td>
                                            @if ( $list->tipe_organisasi == 0)
                                                Admin
                                            @elseif ($list->tipe_organisasi == 1)
                                                Kantor Distribusi
                                            @elseif ($list->tipe_organisasi == 2)
                                                Area
                                            @elseif ($list->tipe_organisasi == 3)
                                                Rayon
                                            @endif
                                            </td>
                                            <td>{{$list->alamat}}</td>
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