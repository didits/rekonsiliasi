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

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('input_listrik.store')}}" method="post">
                                    <input type="hidden" name="_method" value="POST">
                                        {{ csrf_field() }}
                                        <div class="card">
                                            <div class="header">
                                                <h4 class="title">VISUAL</h4>
                                            </div>
                                            <div class="content">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Stand Akhir LWBP1</label>
                                                            <input type="text" name="lwbp1_visual" class="form-control" placeholder="" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Stand Akhir LWBP2</label>
                                                            <input type="text" name="lwbp2_visual" class="form-control" placeholder="" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Stand Akhir WBP</label>
                                                            <input type="text" name="wbp_visual" class="form-control" placeholder="" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Stand Akhir KVARH</label>
                                                            <input type="text" name="kvarh_visual" class="form-control" placeholder="" value="">
                                                        </div>
                                                        <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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