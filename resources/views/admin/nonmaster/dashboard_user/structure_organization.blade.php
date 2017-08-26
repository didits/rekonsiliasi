@extends('admin.master.app')
@section('title', 'Si-Oneng, Rekonsiliasi Energi')

@section('content')
<style type="text/css">
    .card .content{
        padding: 0
    }
</style>
<link href="{{ URL::asset('orgchart/css/jquery.orgchart.css') }}" rel="stylesheet"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <div class="wrapper">
        @include('admin.master.navbar')
        <div class="main-panel">
            @include('admin.master.top_navbar', ['navbartitle' => "AREA " .    Auth::user()->nama_organisasi])
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <div class="content table-responsive table-full-width">
                                    <div id="chart-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.master.footer')

        </div>
    </div>
    
    <!-- orgchart -->
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