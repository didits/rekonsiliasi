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
                                <h4 class="title">Tambah Komoditas</h4>
                            </div>
                            <div class="content">
                                <form role="form" method="POST" action="{{ url('/admin/commodity') }}">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input name="name" type="text" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Latin</label>
                                                <input name="latin" type="text" class="form-control">
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Harga (dollar)</label>
                                                <input name="price" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Kontrak (dlm tahun)</label>
                                                <input name="contract" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Profit (dlm %)</label>
                                                <input name="profit" type="number" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Gambar Pohon</label>
                                                <input type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">                                    
                                        <div class="col-md-12">
                                        <h5>Keterangan Tambahan</h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Informasi Pohon (BHS. INDONESIA)</label>
                                                <textarea name="information_indonesia" rows="5" class="form-control" placeholder="Tambahkan informasi mengenai pohon" ></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Informasi Pohon (BHS. INGGRIS)</label>
                                                <textarea name="information_english" rows="5" class="form-control" placeholder="Tambahkan informasi mengenai pohon" ></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Tambah Pohon</button>
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