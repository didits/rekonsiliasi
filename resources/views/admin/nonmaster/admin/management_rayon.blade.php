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
                                                onclick="add_org.showSwal()">Tambah Data Organisasi
                                        </button>
                                        <button type="button" class="btn btn-primary btn-fill" data-toggle="modal" data-target="#addOrgModal" title="Tambah Organisasi">
                                            <i class="pe-7s-add-user"></i>
                                        </button>
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
                                                <button type="button" class="btn btn-primary btn-fill" data-toggle="modal" data-target="#editPassModal" title="Edit Password"
                                                        data-idd = "{{$list->id}}">
                                                    <i class="fa fa-key"></i>
                                                </button>
                                                <button type="button" class="btn btn-success btn-fill" data-toggle="modal" data-target="#editOrgModal" title="Edit Organisasi"
                                                        data-idd        = "{{$list->id}}"
                                                        data-idOrg      = "{{$list->id_organisasi}}"
                                                        data-namaOrg    = "{{$list->nama_organisasi}}"
                                                        data-tipeOrg    = "{{$list->tipe_organisasi}}"
                                                        data-alamatOrg  = "{{$list->alamat}}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-fill" data-toggle="modal" data-target="#deleteOrgModal" title="Hapus Organisasi"
                                                        data-idd        = "{{$list->id}}"
                                                        data-namaOrg    = "{{$list->nama_organisasi}}"
                                                        data-tipeOrg    = "{{$list->tipe_organisasi}}">
                                                    <i class="fa fa-times"></i>
                                                </button>

                                            </td>
                                        </tr>

                                        @include('admin.nonmaster.modal.admin')

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

    <!--  Forms Validations Plugin -->
    <script src="{{ URL::asset('dashboard/js/jquery.validate.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ URL::asset('dashboard/js/bootstrap-notify.js') }}"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="{{ URL::asset('dashboard/js/sweetalert2.js') }}"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="{{ URL::asset('dashboard/js/edit_remove_org.js') }}"></script>

@endsection

@section('extra_script')
    <script type="text/javascript">
        $().ready(function(){
            $('#valPass').validate();
        });
    </script>

    <script type="text/javascript">
        $('#editPassModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var idd = button.data('idd');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            $('#id_').val(idd);
        });

        $('#editOrgModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var idd = button.data('idd');
            var idOrg = button.data('idorg');
            var namaOrg = button.data('namaorg');
            var tipeOrg = button.data('tipeorg');
            var alamatOrg = button.data('alamatorg');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            $('#id_').val(idd);
            $('#idOrg').val(idOrg);
            $('#namaOrg').val(namaOrg);
            $('#tipeOrg').val(tipeOrg);
            $('#alamatOrg').val(alamatOrg);
        });

        $('#deleteOrgModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var idd = button.data('idd');
            var namaOrg = button.data('namaorg');
            var tipeOrg = button.data('tipeorg');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            $('#id_').val(idd);
            if(tipeOrg===2)
                $('#toDelete').text("Area " + namaOrg + " akan dihapus!");
            else if(tipeOrg===3)
                $('#toDelete').text("Rayon " + namaOrg + " akan dihapus!");
        });
    </script>

    <script type="text/javascript">
        url_add = "{{route('admin.add_org')}}";
        url_edit = "{{route('admin.edit_org')}}";
        url_delete = "{{route('admin.delete_org')}}";
    </script>

    <script>
        notif ={
            statusPassword: function () {
                status_ = "{{isset($status)?$status[0]:""}}";
                if(status_ === "success")
                    icon_ = "pe-7s-check";
                else if (status_ === "warning")
                    icon_ = "pe-7s-close-circle";
                else
                    icon_ = "";

                $.notify({
                    icon: icon_,
                    message: "<b>{{isset($status)?$status[1]:""}}</b>"

                }, {
                    type: status_,
                    timer: 4000
                });
            }
        }
    </script>

    <script type="text/javascript">
        $().ready(function(){
            $('#editPass').validate();
            @if($status)
                notif.statusPassword();
            @endif
        });
    </script>

@endsection