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
                        <p>Input Data
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="inputarea">
                        <ul class="nav">
                            <li><a href="{{route('input_listrik.tambah','jual')}}">Jual</a></li>
                            <li><a href="{{route('input_listrik.tambah','beli')}}">Beli</a></li>
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->tipe_organisasi==2)
                <li>
                    <a href="{{url('/list_datamaster')}}">
                        <i class="pe-7s-gleam"></i>
                        <p>Data Master</p>
                    </a>
                </li>
                @endif

                @if(Auth::user()->tipe_organisasi==3)
                <li>
                    <a href="{{route('listrik.list_data')}}">
                        <i class="pe-7s-home"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{url('/profil')}}">
                        <i class="pe-7s-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>