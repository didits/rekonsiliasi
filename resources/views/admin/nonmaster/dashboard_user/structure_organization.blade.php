@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('extra_style')

    <style type="text/css">
        .card .content{
            padding: 0 
        }
    </style>
    <link href="{{ URL::asset('orgchart/css/jquery.orgchart.css') }}" rel="stylesheet"/>
@endsection

@section('content')

    <div class="wrapper">
        @if(Auth::user()->tipe_organisasi == 2)
            @include('admin.master.top_navbar', ['navbartitle' => "AREA " . Auth::user()->nama_organisasi])

        @else(Auth::user()->tipe_organisasi == 3)
            @include('admin.master.top_navbar', ['navbartitle' => "RAYON " . Auth::user()->nama_organisasi])

        @endif

        @include('admin.master.navbar')
        <style type="text/css">
            .orgchart { background: #fff; }
            .orgchart td.left, .orgchart td.right, .orgchart td.top { border-color: #aaa; }
            .orgchart td>.down { background-color: #aaa; }
            .orgchart .middle-level .title { background-color: #006699; }
            .orgchart .middle-level .content { border-color: #006699; }
            .orgchart .product-dept .title { background-color: #009933; }
            .orgchart .product-dept .content { border-color: #009933; }
            .orgchart .rd-dept .title { background-color: #993366; }
            .orgchart .rd-dept .content { border-color: #993366; }
            .orgchart .pipeline1 .title { background-color: #996633; }
            .orgchart .pipeline1 .content { border-color: #996633; }
            .orgchart .frontend1 .title { background-color: #cc0066; }
            .orgchart .frontend1 .content { border-color: #cc0066; }
          </style>


        <div class="main-panel">
            <div style="display: none">{{Auth::user()->tipe_organisasi == 2 ? $go = "AREA ": $go = "RAYON "}}</div>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <div class="content table-responsive table-full-width">
                                    <div id="chart-container"></div>
                                    <div style="display: block; width: 100%;  padding: 10px">
                                        <span> <span style="float:left; display: block; width: 10px; height: 10px; background-color: rgba(217, 83, 79, 0.8); border-radius: 100%; margin-right: 5px" class="product-dept"></span> Belum terinput <br> <span style="float:left; display: block; width: 10px; height: 10px; background-color:#009933; border-radius: 100%; margin-right: 5px" class="product-dept"></span>Sudah terinput</span>
                                    </div>
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

@section('extra_script')

    <!-- orgchart -->
    <script type="text/javascript" src="{{ URL::asset('orgchart/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('orgchart/js/jquery.orgchart.js') }}"></script>
    <script type="text/javascript">
        (function($){

            $(function() {

                var datascource = {!! $data !!};
                var nodeTemplate = function(data) {
                    return `<span class="office">${data.office}</span> <div class="title">${data.name}</div><div class="content">${data.title}</div>`;
                };

                var oc = $('#chart-container').orgchart({
                    'data' : datascource,
                    'nodeTemplate': nodeTemplate
                });

            });

        })(jQuery);
    </script>
@endsection