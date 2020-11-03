<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
    <link rel="stylesheet" href="assets/fonts/css/all.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

<br>
	<div class="wrap-table">
        <a class="btn btn-primary btn-sm" data-toggle="modal" href="#add_student_modal">Add new student</a>
		<div class="card shadow">
			<div class="card-body">
                <div class="mess"></div>
				<h2>All Data</h2>
				<table id="table_student" class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Roll</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="student_tbody">

                        @foreach($all_data as $data)
                            <tr>
                                <td>{{ $loop -> index + 1 }}</td>
                                <td>{{ $data -> name }}</td>
                                <td>{{ $data -> roll }}</td>
                                <td>{{ $data -> email }}</td>
                                <td>{{ $data -> cell }}</td>
                                <td><img src="media/students/{{ $data -> photo }}" alt=""></td>
                                <td>
                                    <a id="single_student" student_id="{{ $data -> id }}" class="btn btn-sm btn-info" data-toggle="modal" href="#show_student_modal">View</a>
                                    <a id="edit_student" student_id="{{ $data -> id }}" class="btn btn-sm btn-warning" data-toggle="modal" href="#edit_student_modal">Edit</a>
                                    <form id="single_student_delete" student_id="{{ $data -> id }}" class="d-inline" action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
<br>
<br>



{{--Student Create Modal Content--}}
<div id="add_student_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">Add new student</div>
            <div class="modal-body">
                <div class="mess"></div>
                <form id="add_student_form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input name="name" class="form-control" type="text" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input name="roll" class="form-control" type="text" placeholder="Roll">
                    </div>
                    <div class="form-group">
                        <input name="email" class="form-control" type="text" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input name="cell" class="form-control" type="text" placeholder="Cell">
                    </div>
                    <div class="form-group" style="font-size: 20px; cursor: pointer">
                        <img style="display: block; width: 200px;" id="student_photo_load" src="" alt="">
                        <input name="photo" style="display: none;" type="file" id="student_photo">
                        <label for="student_photo" class="text-primary"><i class="fas fa-camera-retro"></i></label>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success form-control" type="submit" value="Add new">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{--Update Content--}}
<div id="edit_student_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">Update Student Data</div>
            <div class="modal-body">
                <div class="mess"></div>
                <form id="edit_student_form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <input name="id" type="hidden" >
                        <input name="name" class="form-control" type="text" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input name="roll" class="form-control" type="text" placeholder="Roll">
                    </div>
                    <div class="form-group">
                        <input name="email" class="form-control" type="text" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input name="cell" class="form-control" type="text" placeholder="Cell">
                    </div>
                    <div class="form-group" style="font-size: 20px; cursor: pointer">
                        <img style="display: block; width: 200px;" id="student_photo_load" src="" alt="">
                        <input name="photo" style="display: none;" type="file" id="student_photo">
                        <label for="student_photo" class="text-primary"><i class="fas fa-camera-retro"></i></label>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success form-control" type="submit" value="Update Student">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



{{--Single data show--}}
<div id="show_student_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header single_name"></div>
            <div class="modal-body">
                <img style="width: 200px; height: 200px; margin: auto; display: block; border: 2px solid #fff; border-radius: 50%;" class="shadow-lg" id="single_sut" src="" alt="">
                <hr>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>Name</td>
                        <td id="t1"></td>
                    </tr>
                    <tr>
                        <td>Roll</td>
                        <td id="t2"></td>
                    </tr>
                    <tr>
                        <td>E-Mail</td>
                        <td id="t3"></td>
                    </tr>
                    <tr>
                        <td>Cell</td>
                        <td id="t4"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>



	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/datatables.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/all.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>
