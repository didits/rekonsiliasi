        <div class="sidebar" data-color="azure" data-image="{{ URL::asset('dashboard/img/sidebar-5.jpg') }}">
            <div class="logo">
                <a href="{{url('/')}}" class="logo-text">
                    SI-ONENG
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="{{url('/')}}" class="logo-text">
                    SO
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                @if(Auth::user()->tipe_organisasi==3)

                    <li>
                        <a data-toggle="collapse" href="#dataMaster">
                            <i class="pe-7s-gleam"></i>
                            <p>Data Master
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="dataMaster">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('rayon.laporan_master')}}">Laporan Data Master</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    @if(Request::is('rayon/list_gardu_induk/*', 'rayon/list_trafo_gi/*','rayon/list_penyulang/*','rayon/list_gd/*', 'rayon', 'rayon/input_data/*'))
                    <li class="active">

                    @else
                    <li>

                    @endif
                        @if(Request::is('rayon/list_gardu_induk/*', 'rayon/list_trafo_gi/*','rayon/list_penyulang/*','rayon/list_gd/*', 'rayon', 'rayon/input_data/*'))
                        <a data-toggle="collapse" href="#dataTransaksiBeli" aria-expanded="true">

                        @else
                        <a data-toggle="collapse" href="#dataTransaksiBeli">

                        @endif
                            <i class="pe-7s-upload"></i>
                            <p>Data Transaksi Beli
                                <b class="caret"></b>
                            </p>
                        </a>
                        @if(Request::is('rayon/list_gardu_induk/*', 'rayon/list_trafo_gi/*','rayon/list_penyulang/*','rayon/list_gd/*', 'rayon', 'rayon/input_data/*'))
                        <div class="collapse in" id="dataTransaksiBeli">

                        @else
                        <div class="collapse" id="dataTransaksiBeli">

                        @endif
                            <ul class="nav">
                                <li @if(Request::is('rayon/list_gardu_induk/*', 'rayon/list_trafo_gi/*','rayon/list_penyulang/*','rayon/list_gd/*', 'rayon', 'rayon/input_data/*'))class="active"@endif>
                                    <a href="{{route('input.list_gardu_induk',Auth::user()->id_organisasi)}}">Entry Data Transaksi Beli</a>
                                </li>
                                {{--<li>--}}
                                    {{--<a href="{{route('listrik.list_data')}}">Laporan Transaksi Beli</a>--}}
                                {{--</li>--}}
                                <li>
                                    <a href="{{route('rayon.list_beli_gi', Auth::user()->id_organisasi)}}">Laporan Transaksi Beli</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a data-toggle="collapse" href="#dataTransaksiJual">
                            <i class="pe-7s-download"></i>
                            <p>Data Transaksi Jual
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="dataTransaksiJual">
                            <ul class="nav">
                                <li>
                                    <a href="#">GD</a>
                                </li>
                                <li>
                                    <a href="#">TM</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a data-toggle="collapse" href="#histori">
                            <i class="pe-7s-timer"></i>
                            <p>Histori
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="histori">
                            <ul class="nav">
                                <li>
                                    <a href="#">Rekap</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{--<li>--}}
                        {{--<a href="{{route('listrik.hasil_pengolahan')}}">--}}
                            {{--<i class="pe-7s-notebook"></i>--}}
                            {{--<p>Hasil Pengolahan</p>--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    <li @if(Request::is('rayon/profil'))class="active"@endif>
                        <a href="{{route('rayon.profil')}}">
                            <i class="pe-7s-id"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->tipe_organisasi==2)
                    @if(Request::is('area/list_datamaster_rayon/*', 'area/list_datamaster_gi/*', 'area/list_datamaster_trafo_gi/*', 'area/list_datamaster_penyulang/*', 'area/list_datamaster_gardu/*', 'area', 'area/laporan_master', 'area/tabel_master'))
                    <li class="active">

                    @else
                    <li>

                    @endif
                        @if(Request::is('area/list_datamaster_rayon/*', 'area/list_datamaster_gi/*', 'area/list_datamaster_trafo_gi/*', 'area/list_datamaster_penyulang/*', 'area/list_datamaster_gardu/*', 'area', 'area/laporan_master', 'area/tabel_master'))
                        <a data-toggle="collapse" href="#dataMaster" aria-expanded="true">

                        @else
                        <a data-toggle="collapse" href="#dataMaster">

                        @endif
                            <i class="pe-7s-gleam"></i>
                            <p>Data Master
                                <b class="caret"></b>
                            </p>
                        </a>
                        @if(Request::is('area/list_datamaster_rayon/*', 'area/list_datamaster_gi/*', 'area/list_datamaster_trafo_gi/*', 'area/list_datamaster_penyulang/*', 'area/list_datamaster_gardu/*', 'area', 'area/laporan_master', 'area/tabel_master'))
                        <div class="collapse in" id="dataMaster">

                        @else
                        <div class="collapse" id="dataMaster">

                        @endif
                            <ul class="nav">
                                <li @if(Request::is('area/list_datamaster_rayon/*', 'area/list_datamaster_gi/*', 'area/list_datamaster_trafo_gi/*', 'area/list_datamaster_penyulang/*', 'area/list_datamaster_gardu/*', 'area'))class="active"@endif>
                                    <a href="{{ url('/') }}">Entry Data Master</a>
                                </li>
                                {{--<li @if(Request::is('area/tabel_master'))class="active"@endif>--}}
                                    {{--<a href="{{route('area.tabel_master')}}">Laporan Data Master</a>--}}
                                {{--</li>--}}
                                <li @if(Request::is('area/laporan_master'))class="active"@endif>
                                    <a href="{{route('area.laporan_master')}}">Laporan Data Master</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a data-toggle="collapse" href="#dataTransaksiEnergi">
                            <i class="pe-7s-notebook"></i>
                            <p>Data Transaksi Energi
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="dataTransaksiEnergi">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('area.laporan_beli')}}">Laporan Transaksi Energi</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a data-toggle="collapse" href="#histori">
                            <i class="pe-7s-timer"></i>
                            <p>Histori
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="histori">
                            <ul class="nav">
                                <li>
                                    <a href="#">Rekap</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{--<li @if(Request::is('area/profil'))class="active"@endif>--}}
                        {{--<a href="{{route('area.profil')}}">--}}
                            {{--<i class="pe-7s-id"></i>--}}
                            {{--<p>Profile</p>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    @endif
                    @if(Auth::user()->tipe_organisasi==0)

                    <li @if(Request::is('admin/management_rayon'))class="active"@endif>
                        <a href="{{route('admin.management_rayon')}}">
                            <i class="pe-7s-user"></i>
                            <p>Manajemen Organisasi</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->tipe_organisasi==1)

                    <li>
                        <a data-toggle="collapse" href="#dataMaster">
                            <i class="pe-7s-gleam"></i>
                            <p>Data Master
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="dataMaster">
                            <ul class="nav">
                                <li>
                                    <a href="#">Laporan Data Master</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a data-toggle="collapse" href="#dataTransaksiEnergi">
                            <i class="pe-7s-notebook"></i>
                            <p>Data Transaksi Energi
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="dataTransaksiEnergi">
                            <ul class="nav">
                                <li>
                                    <a href="#">Laporan Data Master</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a data-toggle="collapse" href="#histori">
                            <i class="pe-7s-timer"></i>
                            <p>Histori
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="histori">
                            <ul class="nav">
                                <li>
                                    <a href="#">Rekap</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                </ul>

                @if(isset($list_distribusi))

                @if(Auth::user()->tipe_organisasi==2)
                    <div class="user">
                    </div>
                    <div class="logo">
                        <a href="{{url('/')}}" class="logo-text">
                            LIST GI
                        </a>
                    </div>
                    <div class="logo logo-mini">
                        <a href="{{url('/')}}" class="logo-text">
                            LIST GI
                        </a>
                    </div>

                    <ul class="nav nav1">
                        @foreach($list_distribusi as $keyr => $rayon)
                        @foreach($rayon as $key => $gi)

                        <li>
                            <a data-toggle="collapse" href="#listGI{{ $keyr+1 }}{{ $key+1 }}">
                                <p>{{ $gi->nama_gi }}
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="listGI{{ $keyr+1 }}{{ $key+1 }}">
                                @foreach($gi['trafo_gi'] as $key2 => $trafo_gi)

                                <ul class="nav nav2">
                                    <li>
                                        <a data-toggle="collapse" href="#listGI{{ $keyr+1 }}{{ $key+1 }}{{ $key2+1 }}">
                                            <p>{{ $trafo_gi->nama_trafo_gi }}
                                                <b class="caret"></b>
                                            </p>
                                        </a>
                                        <div class="collapse" id="listGI{{ $keyr+1 }}{{ $key+1 }}{{ $key2+1 }}">
                                            @foreach($trafo_gi['penyulang'] as $penyulang)

                                            <ul class="nav">
                                                <li>
                                                    <a href="#">
                                                        <p>{{ $penyulang->nama_penyulang }}</p>
                                                    </a>
                                                </li>
                                            </ul>
                                            @endforeach

                                        </div>
                                    </li>
                                </ul>
                                @endforeach

                            </div>
                        </li>
                        @endforeach
                        @endforeach

                    </ul>

                @endif
                @endif

            </div>
        </div>