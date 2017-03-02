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
                <li>
                    <a data-toggle="collapse" href="#inputarea">
                        <i class="pe-7s-user"></i>
                        <p>Input Data
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="inputarea">
                        <ul class="nav">
                            <li><a href="{{url('/input_area')}}">Jual</a></li>
                            <li><a href="{{url('/input_area')}}">Beli</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="{{url('/input_area')}}">
                        <i class="pe-7s-user"></i>
                        <p>Input Data</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/laporan_area')}}">
                        <i class="pe-7s-user"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('/profil')}}">
                        <i class="pe-7s-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>