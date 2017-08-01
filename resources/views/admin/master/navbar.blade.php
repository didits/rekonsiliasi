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
                    <a data-toggle="collapse" href="#inputarea">
                        <i class="pe-7s-server"></i>
                        <p>Data Transaksi
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="inputarea">
                        <ul class="nav">
                            <li>
                                <a href="{{route('input.list_gardu',Auth::user()->id_organisasi)}}">Beli</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#">
                        <i class="pe-7s-info"></i>
                        <p>Master</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('listrik.list_data')}}">
                        <i class="pe-7s-notebook"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('listrik.hasil_pengolahan')}}">
                        <i class="pe-7s-notebook"></i>
                        <p>Hasil Pengolahan</p>
                    </a>
                </li>
                <li>
                    <a href="{{route('rayon.profil')}}">
                        <i class="pe-7s-id"></i>
                        <p>Profile</p>
                    </a>
                </li>
                @endif

                @if(Auth::user()->tipe_organisasi==2)

                <li>
                    <a href="{{ url('/') }}">
                        <i class="pe-7s-gleam"></i>
                        <p>Data Master</p>
                    </a>
                </li>

                <li>
                    <a href="{{route('listrik.list_data')}}">
                        <i class="pe-7s-notebook"></i>
                        <p>Laporan</p>
                    </a>
                </li>

                {{--<li>--}}
                    {{--<a href="{{route('area.list_rayon')}}">--}}
                        {{--<i class="pe-7s-photo-gallery"></i>--}}
                        {{--<p>List Rayon</p>--}}
                    {{--</a>--}}
                {{--</li>--}}

                <li>
                    <a href="{{route('area.profil')}}">
                        <i class="pe-7s-id"></i>
                        <p>Profile</p>
                    </a>
                </li>
                @endif

                @if(Auth::user()->tipe_organisasi==0)
                <li>
                    <a href="{{route('admin.management_rayon')}}">
                        <i class="pe-7s-user"></i>
                        <p>Manajemen Organisasi</p>
                    </a>
                </li>
                @endif

            </ul>



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
            <ul class="nav">
                <li>
                    <a data-toggle="collapse" href="#listGI1">
                        <i class="pe-7s-server"></i>
                        <p>GI 1
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="listGI1">
                        <ul class="nav">
                            <li>
                                <a data-toggle="collapse" href="#listGI11">
                                    <i class="pe-7s-server"></i>
                                    <p>Trafo GI 1
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <div class="collapse" id="listGI11">
                                    <ul class="nav">
                                        <li>
                                            <a href="#">
                                                <p>Penyulang</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#listGI2">
                        <i class="pe-7s-server"></i>
                        <p>GI 1
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="listGI2">
                        <ul class="nav">
                            <li>
                                <a href="#">GD</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#listGI3">
                        <i class="pe-7s-server"></i>
                        <p>GI 1
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="listGI3">
                        <ul class="nav">
                            <li>
                                <a href="#">GD</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a data-toggle="collapse" href="#listGI4">
                        <i class="pe-7s-server"></i>
                        <p>GI 1
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="listGI4">
                        <ul class="nav">
                            <li>
                                <a href="#">GD</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li routerlinkactive="active">
                    <a data-toggle="collapse" href="#formsExamples">
                        <i class="pe-7s-note2"></i>
                        <p>Forms
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="formsExamples">
                        <ul class="nav">
                            <li routerlinkactive="active">
                                <a data-toggle="collapse" href="#formsExampless">
                                    <i class="pe-7s-note2"></i>
                                    <p>Forms
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <div class="collapse" id="formsExampless">
                                    <ul class="nav" style="margin-left: 20px">
                                        <li routerlinkactive="active">
                                            <a href="#/forms/regular">
                                                Regular Forms
                                            </a>
                                        </li>
                                        <li routerlinkactive="active">
                                            <a href="#/forms/extended">
                                                Extended Forms
                                            </a>
                                        </li>
                                        <li routerlinkactive="active">
                                            <a href="#/forms/validation">
                                                Validation Forms
                                            </a>
                                        </li>
                                        <li routerlinkactive="active">
                                            <a href="#/forms/wizard">
                                                Wizard
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li routerlinkactive="active">
                                <a href="#/forms/extended">
                                    Extended Forms
                                </a>
                            </li>
                            <li routerlinkactive="active">
                                <a href="#/forms/validation">
                                    Validation Forms
                                </a>
                            </li>
                            <li routerlinkactive="active">
                                <a href="#/forms/wizard">
                                    Wizard
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>