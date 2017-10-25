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
                                <div class="row text-center">
                                    <div class="col-md-6">
                                        <h5 class="title">Impor Excel Data Organisasi</h5>
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
                                    <div class="col-md-6">
                                        <h5 class="title">Tambah Data Organisasi</h5>
                                        <hr>

                                        <button class="btn btn-fill btn-primary"
                                                onclick="add_org.showSwal()">Tambah Data Organisasi</button>
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-6">--}}
                                                {{--<p>Tambah Data Organisasi</p>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-6">--}}
                                                {{--<button class="btn btn-fill btn-primary"--}}
                                                        {{--onclick="edit_datamaster.showSwal()">Tambah Data Organisasi</button>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="toolbar">
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="bootstrap-table" class="table table-hover table-striped">
                                    <thead>
                                        <th data-field="no" data-sortable="true" class="text-center">No</th>
                                        <th data-field="idorg" data-sortable="true">ID ORGANISASI</th>
                                        <th data-field="namaorg" data-sortable="true">NAMA ORGANISASI</th>
                                        <th data-field="tipeorg" data-sortable="true">TIPE ORGANISASI</th>
                                        <th data-field="alamat">ALAMAT</th>
                                        <th></th>
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
                                            <td class="td-actions text-right">
                                                <a href="#" rel="tooltip" title="" class="btn btn-primary btn-fill " data-original-title="Edit Password"
                                                   onclick="edit_pass.showSwal({{$list->id}})">
                                                    <i class="fa fa-key"></i>
                                                </a>

                                                @if ( $list->tipe_organisasi == 2 || $list->tipe_organisasi == 3)

                                                <a href="#" rel="tooltip" title="" class="btn btn-success btn-fill" data-original-title="Edit Organisasi"
                                                   onclick="edit_org.showSwal({{$list->id}}, '{{$list->id_organisasi}}', '{{$list->nama_organisasi}}', {{$list->tipe_organisasi}}, '{{$list->alamat}}')">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" rel="tooltip" title="" class="btn btn-danger btn-fill " data-original-title="Hapus Organisasi"
                                                   onclick="hapus_org.showSwal({{$list->id}}, '{{$list->nama_organisasi}}', {{$list->tipe_organisasi}})">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                                @endif

                                            </td>
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

@section('extra_plugin')

    <!--  Notifications Plugin    -->
    <script src="{{ URL::asset('dashboard/js/bootstrap-notify.js') }}"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="{{ URL::asset('dashboard/js/sweetalert2.js') }}"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="{{ URL::asset('dashboard/js/edit_remove_org.js') }}"></script>

@endsection

@section('extra_script')
    <script type="text/javascript">
        url_add = "{{route('admin.add_org')}}";
        url_edit = "{{route('admin.edit_org')}}";
        url_delete = "{{route('admin.delete_org')}}";
    </script>
@endsection