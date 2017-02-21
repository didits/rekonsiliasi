@extends('admin.master.app')
@section('title', 'Page Title')

@section('content')
<div class="wrapper">
@include('admin.master.navbar')
    <div class="main-panel">
@include('admin.master.top_navbar', ['navbartitle' => 'Input Data'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                        
                    <form>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">LWBP1</h4>
                                        </div>
                                        <div class="content">
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Stand Akhir</label>
                                                        <input type="text" class="form-control" placeholder="LWBP1tandAkhir" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Faktor Kali</label>
                                                        <input type="text" class="form-control" placeholder="LWBP1StandAkhir" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">LWBP2</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Stand Akhir</label>
                                                        <input type="text" class="form-control" placeholder="LWBP2StandAkhir" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Faktor Kali</label>
                                                        <input type="text" class="form-control" placeholder="LWBP2StandAkhir" value="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">WBP</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Stand Akhir</label>
                                                        <input type="text" class="form-control" placeholder="WBPStandAkhir" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Faktor Kali</label>
                                                        <input type="text" class="form-control" placeholder="WBPStandAkhir" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">KVARH</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Stand Akhir</label>
                                                        <input type="text" class="form-control" placeholder="KVARHStandAkhir" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Faktor Kali</label>
                                                        <input type="text" class="form-control" placeholder="KVARHStandAkhir" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h4 class="title">KW</h4>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Stand Akhir</label>
                                                        <input type="text" class="form-control" placeholder="KWStandAkhir" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Faktor Kali</label>
                                                        <input type="text" class="form-control" placeholder="KWStandAkhir" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-12" style="position: fixed;padding-right : 20px">
                            <div class="row">
                                    <!-- Profil -->
                                <div class="col-md-12">
                                    <div class="card card-user">
                                        <div class="image">
                                            <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                                        </div>
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Nama GI / GD</label>
                                                        <input type="text" class="form-control" disabled placeholder="Company" value="GI 147">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Area</label>
                                                        <input type="text" class="form-control" disabled placeholder="Company" value="Surabaya">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Rayon</label>
                                                        <input type="text" class="form-control" disabled placeholder="Company" value="Sukolilo">
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="submit" class="btn btn-info btn-fill pull-right">Input Listrik</button>
                                            <div class="clearfix"></div>
                                        </div>
                                        <hr>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@include('admin.master.footer')
    </div>
</div>
@endsection