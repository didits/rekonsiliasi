        <div class="sidebar" data-color="azure" data-image="{{ URL::asset('dashboard/img/sidebar-5.jpg') }}">
            <div class="logo">
                <a href="{{url('/')}}" class="logo-text">
                    SI-ONENG
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="{{url('/')}}" class="logo-text">
                    SI-O
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                @if(Auth::user()->tipe_organisasi==3)

                    @if(Request::is('rayon/laporan_master/*'))
                    <li class="active">

                    @else
                    <li>

                    @endif
                        @if(Request::is('rayon/laporan_master/*'))
                        <a data-toggle="collapse" href="#dataMaster" aria-expanded="true">

                        @else
                        <a data-toggle="collapse" href="#dataMaster">

                        @endif

                            <i class="pe-7s-gleam"></i>
                            <p>Data Master
                                <b class="caret"></b>
                            </p>
                        </a>
                    @if(Request::is('rayon/laporan_master/*'))
                        <div class="collapse in" id="dataMaster">

                    @else
                        <div class="collapse" id="dataMaster">

                    @endif

                            <ul class="nav">
                                <li @if(Request::is('rayon/laporan_master/*'))class="active"@endif>
                                    <a href="{{route('rayon.list_master_gi', Auth::user()->id_organisasi)}}">Laporan Data Master</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    @if(Request::is('rayon/entry_transaksi/*', 'rayon', 'rayon/laporan_transaksi', 'rayon/laporan_transaksi/*'))
                    <li class="active">

                    @else
                    <li>

                    @endif
                        @if(Request::is('rayon/entry_transaksi/*', 'rayon', 'rayon/laporan_transaksi', 'rayon/laporan_transaksi/*'))
                        <a data-toggle="collapse" href="#dataTransaksiBeli" aria-expanded="true">

                        @else
                        <a data-toggle="collapse" href="#dataTransaksiBeli">

                        @endif
                            <i class="pe-7s-upload"></i>
                            <p>Data Transaksi Beli
                                <b class="caret"></b>
                            </p>
                        </a>
                        @if(Request::is('rayon/entry_transaksi/*', 'rayon', 'rayon/laporan_transaksi', 'rayon/laporan_transaksi/*'))
                        <div class="collapse in" id="dataTransaksiBeli">

                        @else
                        <div class="collapse" id="dataTransaksiBeli">

                        @endif
                            <ul class="nav">
                                <li @if(Request::is('rayon/entry_transaksi/*', 'rayon'))class="active"@endif>
                                    <a href="{{ url('/') }}">Entry Data Transaksi Beli</a>
                                </li>
                                {{--<li>--}}
                                    {{--<a href="{{route('listrik.list_data')}}">Laporan Transaksi Beli</a>--}}
                                {{--</li>--}}
                                <li @if(Request::is('rayon/laporan_transaksi', 'rayon/laporan_transaksi/*'))class="active"@endif>
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

                    {{--<li>--}}
                        {{--<a data-toggle="collapse" href="#histori">--}}
                            {{--<i class="pe-7s-timer"></i>--}}
                            {{--<p>Histori--}}
                                {{--<b class="caret"></b>--}}
                            {{--</p>--}}
                        {{--</a>--}}
                        {{--<div class="collapse" id="histori">--}}
                            {{--<ul class="nav">--}}
                                {{--<li>--}}
                                    {{--<a href="#">Rekap</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</li>--}}

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

                    <li @if(Request::is('area/dashboard'))class="active"@endif>
                        <a href="{{route('area.dashboard')}}">
                            <i class="pe-7s-display1"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    @if(Request::is('area/entry_master/*', 'area', 'area/laporan_master', 'area/tabel_master', 'area/laporan_master/*'))
                    <li class="active">

                    @else
                    <li>

                    @endif
                        @if(Request::is('area/entry_master/*', 'area', 'area/laporan_master', 'area/tabel_master', 'area/laporan_master/*'))
                        <a data-toggle="collapse" href="#dataMaster" aria-expanded="true">

                        @else
                        <a data-toggle="collapse" href="#dataMaster">

                        @endif
                            <i class="pe-7s-gleam"></i>
                            <p>Data Master
                                <b class="caret"></b>
                            </p>
                        </a>
                        @if(Request::is('area/entry_master/*', 'area', 'area/laporan_master', 'area/tabel_master', 'area/laporan_master/*'))
                        <div class="collapse in" id="dataMaster">

                        @else
                        <div class="collapse" id="dataMaster">

                        @endif
                            <ul class="nav">
                                <li @if(Request::is('area/entry_master/*', 'area'))class="active"@endif>
                                    <a href="{{ url('/area') }}">Entry Data Master</a>
                                </li>
                                {{--<li @if(Request::is('area/tabel_master'))class="active"@endif>--}}
                                    {{--<a href="{{route('area.tabel_master')}}">Laporan Data Master</a>--}}
                                {{--</li>--}}
                                <li @if(Request::is('area/laporan_master', 'area/laporan_master/*'))class="active"@endif>
                                    <a href="{{route('area.laporan_master')}}">Laporan Data Master</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                @if(Request::is('area/laporan_transaksi', 'area/laporan_transaksi/*'))
                    <li class="active">

                @else
                    <li>

                @endif
                        @if(Request::is('area/laporan_transaksi', 'area/laporan_transaksi/*'))
                        <a data-toggle="collapse" href="#dataTransaksiEnergi" aria-expanded="true">

                        @else
                        <a data-toggle="collapse" href="#dataTransaksiEnergi">

                        @endif
                            <i class="pe-7s-notebook"></i>
                            <p>Data Transaksi Energi
                                <b class="caret"></b>
                            </p>
                        </a>
                        @if(Request::is('area/laporan_transaksi', 'area/laporan_transaksi/*'))
                        <div class="collapse in" id="dataTransaksiEnergi">

                        @else
                        <div class="collapse" id="dataTransaksiEnergi">

                        @endif
                            <ul class="nav">
                                <li @if(Request::is('area/laporan_transaksi', 'area/laporan_transaksi/*'))class="active"@endif>
                                    <a href="{{route('area.laporan_beli')}}">Laporan Transaksi Energi</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{--<li>--}}
                        {{--<a data-toggle="collapse" href="#histori">--}}
                            {{--<i class="pe-7s-timer"></i>--}}
                            {{--<p>Histori--}}
                                {{--<b class="caret"></b>--}}
                            {{--</p>--}}
                        {{--</a>--}}
                        {{--<div class="collapse" id="histori">--}}
                            {{--<ul class="nav">--}}
                                {{--<li>--}}
                                    {{--<a href="#">Rekap</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</li>--}}

                    <li @if(Request::is('area/profil'))class="active"@endif>
                        <a href="{{route('area.profil')}}">
                            <i class="pe-7s-id"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->tipe_organisasi==0)

                    <li @if(Request::is('admin'))class="active"@endif>
                        <a href="{{url('/')}}">
                            <i class="pe-7s-user"></i>
                            <p>Manajemen User</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->tipe_organisasi==1)
                    <li @if(Request::is('distribusi/dashboard')) class="active" @endif>
                        <a href="{{route('distribusi.dashboard')}}">
                            <i class="pe-7s-display1"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    @if(Request::is('distribusi', 'distribusi/laporan_master', 'distribusi/laporan_master/*'))
                    <li class="active">

                    @else
                    <li>

                    @endif
                        @if(Request::is('distribusi', 'distribusi/laporan_master', 'distribusi/laporan_master/*'))
                        <a data-toggle="collapse" href="#dataMaster" aria-expanded="true">

                        @else

                        <a data-toggle="collapse" href="#dataMaster">
                        @endif

                            <i class="pe-7s-gleam"></i>
                            <p>Data Master
                                <b class="caret"></b>
                            </p>
                        </a>
                        @if(Request::is('distribusi', 'distribusi/laporan_master', 'distribusi/laporan_master/*'))

                        <div class="collapse in" id="dataMaster">
                        @else

                        <div class="collapse" id="dataMaster">
                        @endif

                            <ul class="nav">
                                <li @if(Request::is('distribusi', 'distribusi/laporan_master', 'distribusi/laporan_master/*'))class="active"@endif>
                                    <a href="{{route('distribusi.indexLaporanMaster')}}">Laporan Data Master</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    @if(Request::is('distribusi/laporan_transaksi', 'distribusi/laporan_transaksi/*'))
                    <li class="active">

                    @else
                    <li>

                    @endif
                        @if(Request::is('distribusi/laporan_transaksi', 'distribusi/laporan_transaksi/*'))
                        <a data-toggle="collapse" href="#dataTransaksiEnergi" aria-expanded="true">

                        @else
                        <a data-toggle="collapse" href="#dataTransaksiEnergi">

                        @endif

                            <i class="pe-7s-notebook"></i>
                            <p>Data Transaksi Energi
                                <b class="caret"></b>
                            </p>
                        </a>
                        @if(Request::is('distribusi/laporan_transaksi', 'distribusi/laporan_transaksi/*'))
                        <div class="collapse in" id="dataTransaksiEnergi">

                        @else
                        <div class="collapse" id="dataTransaksiEnergi">

                        @endif

                            <ul class="nav">
                                <li @if(Request::is('distribusi/laporan_transaksi', 'distribusi/laporan_transaksi/*'))class="active"@endif>
                                    <a href="{{route('distribusi.indexLaporanTransaksi')}}">Laporan Transaksi Beli</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{--<li>--}}
                        {{--<a data-toggle="collapse" href="#histori">--}}
                            {{--<i class="pe-7s-timer"></i>--}}
                            {{--<p>Histori--}}
                                {{--<b class="caret"></b>--}}
                            {{--</p>--}}
                        {{--</a>--}}
                        {{--<div class="collapse" id="histori">--}}
                            {{--<ul class="nav">--}}
                                {{--<li>--}}
                                    {{--<a href="#">Rekap</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</li>--}}
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