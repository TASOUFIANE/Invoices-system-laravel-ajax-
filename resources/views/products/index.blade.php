@extends('layouts.master')
@section('title') Sections @endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Products</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ settings</span>
						</div>
					</div>
				
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
			
				<div class="row">
						<!--div-->
						@if ($errors->any())
								@foreach ($errors->all() as $error)
										<div class="alert alert-danger">
													{{$error}}
										</div>
								@endforeach
						@elseif(session()->has('success'))
								<div class="alert alert-success">
										{{session()->get('success')}}
								</div>
			 			@endif	
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Products Table</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
							</div>
							<div class="card-body">
								<a class="modal-effect btn btn-outline-primary btn-block"  style="width:15%;margin-bottom:1em;" data-effect="effect-scale" data-toggle="modal" href="#modaldemo1">Add Section</a>
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">Product Name</th>
                                                <th class="border-bottom-0">Section Name</th>
												<th class="border-bottom-0">Description</th>
												<th class="border-bottom-0">Action</th>
											
											</tr>
										</thead>
										<tbody>
											@foreach ($products as $product)
											<tr>
												<td>{{$loop->iteration}}</td>
												<td>{{$product->name}}</td>
                                                <td>{{$product->section->name}}</td>
												<td>{{$product->description}}</td>
												<td>
													<a type="button" class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                       data-description="{{ $product->description }}" data-toggle="modal" href="#exampleModal2"
                                                       title="تعديل">
													   Edit
											    	</a>
													<a type="button" class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                       data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-toggle="modal"
                                                       href="#modaldemo9" title="حذف">
													   Delete
													</a>
												</td>
											</tr>
											@endforeach
											
										</tbody>
									</table>
								</div>
								
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- Basic modal -->
								<div class="modal" id="modaldemo1">
									<div class="modal-dialog" role="document">
										<div class="modal-content modal-content-demo">
										
											<div class="modal-header">
												<h6 class="modal-title">Add Product</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
											</div>
											<form action="{{route('products.store')}}" method="post" >
                                                @csrf
											<div class="modal-body">
												
												
												<div class="form-group">
													<label for="exampleInputEmail1">Product Name</label>
													<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Section Name" name="name">
												</div>
                                                 <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label"> Section name:</label>
													<select class="form-control" name="section_id" id="section_id">
                                                        @foreach ($sections as $section)
                                                        <option value="{{$section->id}}">{{$section->name}}</option>
                                                        @endforeach
                                                    </select>
												</div>
												<div class="form-group">
													<label for="exampleInputPassword1">Description</label>
													<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Description" name="desc">
												</div>
												
											</div>
											<div class="modal-footer">
												<button class="btn ripple btn-primary" type="submit">Save</button>
												<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
											</div>
											</form>
										</div>
									</div>
								</div>
				<!-- End Basic modal -->
				<!-- row closed -->
						<!-- edit -->
							<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
								aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel"> Edit Product</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">

											<form action="products/update" method="post" autocomplete="off">
												{{method_field('patch')}}
												@csrf
												<div class="form-group">
													<input type="hidden" name="id" id="id" value="">
													<label for="recipient-name" class="col-form-label"> Product name:</label>
													<input class="form-control" name="name" id="section_name" type="text">
												</div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label"> Section name:</label>
													<select class="form-control" name="section_id" id="section_id">
                                                        @foreach ($sections as $section)
                                                        <option value="{{$section->id}}">{{$section->name}}</option>
                                                        @endforeach
                                                    </select>
												</div>
												<div class="form-group">
													<label for="message-text" class="col-form-label">Description:</label>
													<textarea class="form-control" id="description" name="desc"></textarea>
												</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary">Save</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
										</div>
										</form>
									</div>
								</div>
							</div>
					<!-- delete -->
							<div class="modal" id="modaldemo9">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content modal-content-demo">
										<div class="modal-header">
											<h6 class="modal-title">Delete </h6><button aria-label="Close" class="close" data-dismiss="modal"
																						type="button"><span aria-hidden="true">&times;</span></button>
										</div>
										<form action="sections/destroy" method="post">
											@method('delete')
											@csrf
											<div class="modal-body">
												<p>  Are you sure you want to delete this product?</p><br>
												<input type="hidden" name="id" id="id" value="">
												<input class="form-control" name="name" id="section_name" type="text" readonly>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
												<button type="submit" class="btn btn-danger">Confirm</button>
											</div>
										</form>
									</div>
									
								</div>
							</div>
			</div>			
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
 <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('name')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
        })
		$('#modaldemo9').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget)
			var id = button.data('id')
			var section_name = button.data('name')
			var modal = $(this)
			modal.find('.modal-body #id').val(id);
			modal.find('.modal-body #section_name').val(section_name);
		})
    </script>

@endsection