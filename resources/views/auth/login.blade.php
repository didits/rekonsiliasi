@extends('admin.master.login')

@section('content')

    <body>
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/login')}}">Si-Oneng</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a {{--href="register.html"--}}>
                            Rekonsiliasi Energi
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" data-color="azure" data-image="{{ URL::asset('dashboard/img/full-screen-image-2.jpg') }}">

            <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form method="post" action=""  >
                                {{ csrf_field() }}
                                <!--   if you want to have the card without animation please remove the ".card-hidden" class   -->
                                <div class="card card-hidden">
                                    <div class="header text-center">Login</div>
                                    <div class="content">
                                        <div class="form-group{{ $errors->has('id_organisasi') ? ' has-error' : '' }}">
                                            <label for="id_organisasi">Username</label>
                                            <input id="id_organisasi" type="id_organisasi" class="form-control" name="id_organisasi" value="{{ old('id_organisasi') }}" required autofocus>
                                            @if ($errors->has('id_organisasi'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('id_organisasi') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password </label>
                                            <input id="password" type="password" class="form-control" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-fill btn-info btn-wd">Login</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>

@endsection