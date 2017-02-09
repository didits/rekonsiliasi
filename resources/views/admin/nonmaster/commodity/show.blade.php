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
                                <h4 class="title">Striped Table with Hover</h4>
                                <p class="category">Here is a subtitle for this table</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Name</th>
                                    	<th>latin</th>
                                    	<th>price</th>
                                    	<th>contract</th>
                                    	<th>Profit</th>
                                    	<th>Coming Soon</th>
                                    	<th>Recommended</th>
                                    	<th>Status View</th>
                                    </thead>
                                    <tbody>
                                    @foreach($commodity as $key => $value)
                                        <tr>
                                        	<td>{{ $value->name }}</td>
                                        	<td>{{ $value->latin }}</td>
                                        	<td>{{ $value->price }}</td>
                                        	<td>{{ $value->contract }}</td>
                                        	<td>{{ $value->profit }}</td>
                                        	<td>{{ $value->coming_soon }}</td>
                                        	<td>{{ $value->recommended }}</td>
                                        	<td>{{ $value->status_view }}</td>
                                        	<td><button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button></td>
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