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
                                    <h4 class="title">Edit Data Master</h4>
                                </div>
                                <div class="content">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Penyulang</label>
                                                    <input type="text" class="form-control" disabled="" placeholder="Penyulang" value="Penyulang XXX">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Penyulang</label>
                                                    <input type="text" class="form-control" disabled="" placeholder="Area" value="Area XXX">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Penyulang</label>
                                                    <input type="text" class="form-control" disabled="" placeholder="Rayon" value="Rayon XXX">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Merk</label>
                                                    <input type="text" name="merk" class="form-control" placeholder="Merk" value="Merk XXX">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nomor Seri</label>
                                                    <input type="number" name="no_seri" class="form-control" placeholder="Nomor Seri" value="000">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Faktor Kali</label>
                                                    <input type="number" name="faktor_kali" class="form-control" placeholder="Faktor Kali" value="000">
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Data Master</button>
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