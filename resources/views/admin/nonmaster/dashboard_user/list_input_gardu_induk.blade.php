@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')

<div class="wrapper">
    @include('admin.master.top_navbar', ['navbartitle' => "RAYON " .    Auth::user()->nama_organisasi])

    @include('admin.master.navbar')

    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Daftar Gardu Induk</h4>
                                <p class="category">Daftar Gardu Induk Rayon {{Auth::user()->nama_organisasi}} </p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        {{--<th>ID</th>--}}
                                        <th>Nama Gardu Induk</th>
                                        <th>Alamat Gardu Induk</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                    @if($data)
                                        @foreach($data as $list)

                                        <tr>
                                            {{--<td>{{$list->id}}</td>--}}
                                            <td>{{$list->nama_gi}}</td>
                                            <td>{{$list->alamat_gi}}</td>
                                            <td>
                                                <a href="{{route('input.list_trafo_gi', $list->id)}}" class="btn btn-info btn-fill pull-right">Lihat GI</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif

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