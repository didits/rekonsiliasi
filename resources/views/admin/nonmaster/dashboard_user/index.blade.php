@extends('admin.master.app')
@section('title', 'Page Title')

@section('content')
<div class="wrapper">
@include('admin.master.navbar')

    <div class="main-panel">
@include('admin.master.top_navbar', ['navbartitle' => 'Dashboard'])

        <div class="content">
            <div class="container-fluid">
                            <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" align="center">Carbon Emission</h4>
                                <h1 align="center">20</h1>
                            </div>
                            <div class="content">

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Data is updated every month
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" align="center">Total Harvest</h4>
                                <h1 align="center">12x</h1>
                            </div>
                            <div class="content">

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Data is updated every month
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" align="center">Plant Age (years)</h4>
                                <h1 align="center">5</h1>
                            </div>
                            <div class="content">

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Data is updated every month
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" align="center">Total Fertilization</h4>
                                <h1 align="center">30x</h1>
                            </div>
                            <div class="content">

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Data is updated every month
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Total Tree</h4>
                                <p class="category">You have 100 tree</p>
                            </div>
                            <div class="content">
                                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Live: 98
                                        <i class="fa fa-circle text-danger"></i> Dead: 2
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Data is updated every week
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Temperature</h4>
                                <p class="category">Every 24 Hours</p>
                            </div>
                            <div class="content">
                                <div id="chartHours" class="ct-chart"></div>
                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Value of temperature (Celcius)
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sunlight</h4>
                                <p class="category">Every 24 Hours</p>
                            </div>
                            <div class="content">
                                <div id="chartSunlight" class="ct-chart"></div>
                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Outdoor Light Levels (lux)
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Updated 3 minutes ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">2014 Sales</h4>
                                <p class="category">All products including Taxes</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart"></div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-danger"></i> BMW 5 Series
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check"></i> Data information certified
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
@include('admin.master.footer')
    </div>
</div>
@endsection