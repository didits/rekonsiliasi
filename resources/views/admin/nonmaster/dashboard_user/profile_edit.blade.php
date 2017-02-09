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
                    <div class="col-md-10">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">EDIT PROFIL</h4>
                                <hr>
                            </div>
                            <div class="content">
                                <form role="form" method="POST" action="{{ url('/account/profile_edit') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_user" value="{{Auth::id()}}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kode Organisasi</label>
                                                <input name="name" type="text" class="form-control" value="1000" disabled="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tipe Tingkatan</label>
                                                <input name="email" type="email" disabled class="form-control" value="Kantor Distribusi">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Daerah</label>
                                                <input name="phone" type="text" class="form-control" value="Jawa Timur" disabled="">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea name="address" rows="3" class="form-control" placeholder="" >Jalan Menur Pumpungan No. 68, Menur Pumpungan, Sukolilo, Menur Pumpungan, Sukolilo, Kota SBY, Jawa Timur 60132</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input name="name" type="password" class="form-control" value="1000">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Konfirmasi Password</label>
                                                <input name="email" type="password"  class="form-control" value="1000">
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