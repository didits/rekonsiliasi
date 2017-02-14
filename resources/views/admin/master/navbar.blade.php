    <div class="sidebar" data-color="purple" data-image="{{ URL::asset('dashboard/img/sidebar-5.jpg') }}">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{url('/')}}" class="simple-text">
                    SI-ONENG
                </a>
            </div>

            <ul class="nav">
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