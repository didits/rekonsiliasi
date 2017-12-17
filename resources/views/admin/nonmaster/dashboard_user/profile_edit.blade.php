@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
<div class="wrapper">
    @include('admin.master.top_navbar', ['navbartitle' => 'EDIT PROFIL'])

    @include('admin.master.navbar')

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">EDIT PROFIL</h4>
                                <hr>
                            </div>
                            <div class="content">
                                <form id="editProfile" novalidate="" role="form" method="POST" action="{{route('editProfile')}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_user" value="{{Auth::id()}}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kode Organisasi</label>
                                                <input name="kode" type="text" class="form-control" value="@if (Auth::guest())kode
                                                @else{{ Auth::user()->id_organisasi }}@endif" disabled="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tipe Tingkatan</label>
                                                <input name="tipe" type="text" disabled class="form-control" value="@if (Auth::guest())tipe
                                                @else{{ Auth::user()->tipe_organisasi }}@endif">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Daerah</label>
                                                <input name="daerah" type="text" class="form-control" value="@if (Auth::guest())nama
                                                @else{{ Auth::user()->nama_organisasi }}@endif" disabled="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea name="alamat" rows="3" class="form-control" placeholder="" >@if (Auth::guest())alamat
                                                    @else{{ Auth::user()->alamat }}@endif</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">UBAH PASSWORD</h4>
                                <hr>
                            </div>
                            <div class="content">
                                <form id="editPassword" novalidate="" role="form" method="POST" action="{{route('ubahPassword')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id_user" value="{{Auth::id()}}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Password Sekarang</label>
                                                <input class="form-control"
                                                       name="password_old"
                                                       id="password_old"
                                                       type="password"
                                                       minLength="4"
                                                       required
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Password Baru</label>
                                                <input class="form-control"
                                                       name="password_new"
                                                       id="password_new"
                                                       type="password"
                                                       minLength="4"
                                                       required
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Konfirmasi Password</label>
                                                <input class="form-control"
                                                       name="password_confirmation"
                                                       id="password_confirmation"
                                                       type="password"
                                                       equalTo="#password_new"
                                                       required
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Ubah Password</button>
                                    <div class="clearfix"></div>
                                </form>
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

{{--<!--  Forms Validations Plugin -->--}}
<script src="{{ URL::asset('dashboard/js/jquery.validate.min.js') }}"></script>

{{--<!--  Notifications Plugin    -->--}}
<script src="{{ URL::asset('dashboard/js/bootstrap-notify.js') }}"></script>
@endsection

@section('extra_script')

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
        $('#editProfile').validate();
        $('#editPassword').validate();
        @if($status)
        notif.statusPassword();

        @endif
    });
</script>

@endsection