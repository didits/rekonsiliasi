@extends('admin.master.app')
@section('title', 'Page Title')

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
                                <form method="POST" action="{{url('admin/import_organisasi')}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div id="form-soal" class="form-group label-floating">
                                            <div>
                                                <span class="btn btn-info btn-round btn-file">
                                                    <input type="file" name="excel" required />
                                                </span>
                                                <button type="submit" class="btn btn-fill btn-primary">Submit</button>
                                            </div>
                                        </div>

                                        
                                    </form>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>No</th>
                                        <th>ID ORGANISASI</th>
                                        <th>NAMA ORGANISASI</th>
                                        <th>TIPE ORGANISASI</th>
                                        <th>ALAMAT</th>
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