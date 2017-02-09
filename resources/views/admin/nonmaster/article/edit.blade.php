@extends('admin.master.app')
@section('title', 'Page Title')

@section('content')
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
                                <h4 class="title">Edit Article</h4>
                                <hr>
                            </div>
                            <div class="content">
                                <form role="form" method="POST" action="{{ url('/admin/article/'.$article->id) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="PATCH">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input name="title" type="text" class="form-control" value="{{ $article->title}}">
                                            </div>
                                        </div>                                                                               
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category</label>
                                                <input name="category" type="text" class="form-control" value="{{ $article->category}}">
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tag</label>
                                                <input name="tag" type="text" class="form-control" value="{{ $article->tag}}">
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
                                                <textarea name="short_description" rows="2" class="form-control" >{{ $article->short_description}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Content</label>
                                                <textarea name="description" rows="5" class="form-control" placeholder="Tambahkan informasi mengenai pohon" >{{ $article->description}}</textarea>
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
@include('admin.master.footer')
    </div>
</div>
@endsection