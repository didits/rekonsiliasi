@extends('admin.master.app')
@section('title', 'Page Title')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/summernote.css') }}">
<div class="wrapper">
@include('admin.master.navbar')
        <div class="main-panel">
@include('admin.master.top_navbar')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add Article</h4>
                                <hr>
                            </div>
                            <div class="content">
                                <form role="form" method="POST" action="{{ url('/admin/article') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input name="title" type="text" class="form-control" >
                                            </div>
                                        </div>                                                                               
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category</label>
                                                <input name="category" type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tag</label>
                                                <input name="tag" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Picture</label>
                                                <input type="file" class="form-control" id="path" style="" name="path" required=""/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">                                    
                                        <div class="col-md-12">
                                        <h5>Keterangan Tambahan</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Short Description</label>
                                                <textarea name="short_description" rows="2" class="form-control" ></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Content</label>
                                                <textarea class="summernote" name="description" rows="5" class="form-control" ></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>
@include('admin.master.footer')
    </div>
</div>
@endsection