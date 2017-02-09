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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Article</h4>
                                <p class="category">create interesting article</p>
                                <a href="{{url('/admin/article/create')}}"><button class="btn btn-info btn-fill pull-right">Add Article</button></a>
                                <div class="clearfix"></div>

                            </div>
                            <hr>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Id</th>
                                    	<th>title</th>
                                    	<th>tag</th>
                                    	<th>category</th>
                                    	<th>id_autor</th>
                                    	<th>View</th>
                                    </thead>
                                    <tbody>
                                    @foreach($article as $key => $value)
                                        <tr>
                                        	<td>{{ $value->id }}</td>
                                        	<td>{{ $value->title }}</td>
                                        	<td>{{ $value->tag }}</td>
                                        	<td>{{ $value->category }}</td>
                                        	<td>{{ $value->id_author }}</td>
                                        	<td>{{ $value->status_view }}</td>
                                        	<td><a href="{{url('/admin/article/'.$value->id.'/edit')}}"><button type="button" rel="tooltip" title="Edit Article" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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