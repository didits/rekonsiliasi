@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

<div class="wrapper">
    @include('admin.master.navbar')

    <div class="main-panel">
        @include('admin.master.top_navbar', ['navbartitle' => "RAYON " .    Auth::user()->nama_organisasi])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Input Awal</h4>
                                <p class="category">Rayon {{Auth::user()->nama_organisasi}}</p>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <legend>Download Format</legend>
                                        <a href="" rel="tooltip" title="" data-original-title="">
                                            <button class="btn btn-info btn-fill btn-wd">
                                                <i class="pe-7s-diskette"></i><br/>Download Format
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <legend>Upload Format</legend>
                                        <form method="POST" action="{{url('admin/import_organisasi')}}" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div id="form-soal" class="form-group label-floating">
                                                <div>
                                                <span class="btn btn-info btn-round btn-file">
                                                    <input type="file" name="excel" required/>
                                                </span>
                                                    <button type="submit" class="btn btn-fill btn-info">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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