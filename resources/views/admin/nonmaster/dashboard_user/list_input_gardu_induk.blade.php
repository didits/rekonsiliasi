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
                                <h4 class="title">Daftar Gardu Induk</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        {{--<th>ID</th>--}}
                                        <th>Nama Gardu Induk</th>
                                        <th>Alamat Gardu Induk</th>
                                    </thead>
                                    <tbody>
                                    @if($data)
                                        @foreach($data as $list)
                                            <tr>
                                                {{--<td>{{$list->id}}</td>--}}
                                                <td><a href="{{route('input.list_trafo_gi', $list->id)}}">{{$list->nama_gi}}</a></td>
                                                <td>{{$list->alamat_gi}}</td>
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