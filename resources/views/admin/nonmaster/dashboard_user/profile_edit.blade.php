@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
<div class="wrapper">
@include('admin.master.navbar')
    <div class="main-panel">
        @include('admin.master.top_navbar', ['navbartitle' => 'EDIT PROFIL'])
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
                                <form id="registerFormValidation" novalidate="" role="form" method="POST" action="{{ url('/profil') }}">
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
                                                <input name="nama" type="text" class="form-control" value="@if (Auth::guest())nama
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Password</label>
                                                <input class="form-control"
                                                       name="password"
                                                       id="registerPassword"
                                                       type="password"
                                                       required="true"
                                                       minLength="4"
                                                       value="1234"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Konfirmasi Password</label>
                                                <input class="form-control"
                                                       name="password_confirmation"
                                                       id="registerPasswordConfirmation"
                                                       type="password"
                                                       required="true"
                                                       value="1234"
                                                       equalTo="#registerPassword"
                                                />
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
            </div>
        </div>

        @include('admin.master.footer')

    </div>
</div>
@endsection