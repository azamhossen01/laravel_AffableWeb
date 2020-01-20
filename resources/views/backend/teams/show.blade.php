@extends('backend.layouts.app')

@section('title','TM Details')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Data Table Example</div>
      <a href="{{route('teams.index')}}" class="btn btn-primary" >Back</a >
      <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <td colspan=2>
                <img src="{{asset('images/'.$team->image)}}" class="float-center img-responsive" width="20%" alt="">
                </td>
            </tr>
            <tr>
                <th>ID</th>
                <td><?= $team->id; ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?= $team->name; ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?= $team->gender; ?></td>
            </tr>
            <tr>
                <th>Position</th>
                <td><?= $team->position; ?></td>
            </tr>
            <tr>
                <th>Cell</th>
                <td><?= $team->cell; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= $team->email; ?></td>
            </tr>
            <tr>
                <th>Facebook</th>
                <td><?= $team->fb; ?></td>
            </tr>
            <tr>
                <th>Degree</th>
                <td><?= $team->degree; ?></td>
            </tr>

            <tr>
                <th>Status</th>
                <td><span class="badge badge-<?= $team->mode == 0 ? 'warning' : 'success' ?>"><?= $team->mode == 0 ? 'Pending' : 'Active' ?></span></td>
            </tr>
            <tr>
                <th>Resgister on</th>
                <td><?= $team->created_at->format('F d Y'); ?></td>
            </tr>
            
        </table>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

  </div>


  {{-- add student modal start here --}}
  <div id="open_add_student_model" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title">Add New Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="common_body">
            <table class="table table-bordered table-striped">
                <form action="add_student.php" method="post" id="add_student_form">
                    @csrf
                    <tr>
                        <th>Name : </th>
                        <td><input type="text" name="name" id="name" class="form-control"
                                placeholder="Name" required></td>
                    </tr>
                    <tr>
                        <th>Father's Name : </th>
                        <td><input type="text" required name="fathers_name" id="fathers_name"
                                class="form-control" placeholder="Father's Name"></td>
                    </tr>
                    <tr>
                        <th>Mother's Name : </th>
                        <td><input type="text" required name="mothers_name" id="mothers_name"
                                class="form-control" placeholder="Mother's Name"></td>
                    </tr>
                    <tr>
                        <th>Gender : </th>
                        <td>
                            <select name="gender" required id="gender" class="form-control">
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Institution : </th>
                        <td><input type="text" required name="institution" id="institution"
                                class="form-control" placeholder="Institution"></td>
                    </tr>
                    <tr>
                        <th>Cell : </th>
                        <td><input type="text" required name="cell" id="cell"
                                class="form-control" placeholder="Cell"></td>
                    </tr>
                    <tr>
                        <th>Email : </th>
                        <td><input type="email" required name="email" id="email"
                                class="form-control" placeholder="Email"></td>
                    </tr>
                    <tr>
                        <th>Address : </th>
                        <td><textarea name="address" required class="form-control" id="address"
                                cols="30" rows="3" placeholder="Address"></textarea></td>
                    </tr>
                    <tr>
                        <th>Course Name : </th>
                        <td><input type="text" required name="course_name" id="course_name"
                                class="form-control" placeholder="Course Name"></td>
                    </tr>
                    <tr>
                        <th>Course Code : </th>
                        <td><input type="text" required name="course_code" id="course_code"
                                class="form-control" placeholder="Course Code"></td>
                    </tr>
                    <tr>
                        <th>Batch No : </th>
                        <td><input type="text" required name="batch_no" id="batch_no"
                                class="form-control" placeholder="Batch No"></td>
                    </tr>
                    <tr>
                        <th>Password : </th>
                        <td><input type="password" required name="password" id="password"
                                class="form-control" placeholder="Password"></td>
                    </tr>
                    {{-- <tr>
                        <td colspan=2><button type="submit"
                            id="add_student"    class="btn btn-primary btn-block">Save</button></td>
                    </tr> --}}
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" id="add_student"    class="btn btn-primary">Save</button>
            <button type="button" id="update_student"    class="btn btn-primary">Save</button>
          <button type="reset" id="reset" class="btn btn-danger">Reset</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
        </div>
      </div>
    </div>
  </div>
  {{-- add student modal end here --}}
@endsection

@push('js')

<script>
    var li = "http://localhost:8000/admin/";

    $(document).ready(function(){
    //    get_all_students();
    });


    function get_all_students(){
        $.ajax({
            type : 'get',
            url: "{{ url('admin/students/get_students') }}",
            success : function(students){
                var student_count = students.length;
                var html = ``;
                for(var i = 0; i < student_count; i++){
                    html += `
                        <tr>
                            <td>${i+1}</td>
                            <td>${students[i].name}</td>
                            <td>${students[i].fathers_name}</td>
                            <td>${students[i].cell}</td>
                            ${students[i].mode == 0 ?'<td><span class="badge badge-warning">Pending</span></td>' : '<td><span class="badge badge-success">Active</span></td>'}
                            <td>
                                <button onclick="view_student_details(${students[i].id})" type="button" class="btn btn-success btn-sm">Details</button>
                                <button type="button" class="btn btn-warning btn-sm">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    `;
                }
                $('#all_students').html(html);
            }
        });
    }
    
   
    function open_add_student_model(){

        $('#name').val("");
        $('#fathers_name').val("");
        $('#mothers_name').val("");
        $('#gender').val("");
        $('#institution').val("");
        $('#cell').val("");
        $('#email').val("");
        $('#address').val("");
        $('#course_name').val("");
        $('#course_code').val("");
        $('#batch_no').val("");
        $('#modal_title').text('Add New Student');
        $('#add_student').css('display','block');
        $('#update_student').css('display','none');
        $('#reset').css('display','block');
        $('#open_add_student_model').modal('show');
    }

    $('#add_student').click(function(e){
        e.preventDefault();
        var name = $('#name').val();
            var fathers_name = $('#fathers_name').val();
            var mothers_name = $('#mothers_name').val();
            var cell = $('#cell').val();
            var email = $('#email').val();
            var gender = $('#gender').val();
            var address = $('#address').val();
            var institution = $('#institution').val();
            var course_name = $('#course_name').val();
            var course_code = $('#course_code').val();
            var batch_no = $('#batch_no').val();
            var password = $('#password').val();
            if(name != "" && fathers_name != "" && mothers_name != "" && cell != "" && email != "" && gender != "" && address != "" && institution != "" && course_name != "" && course_code != "" && batch_no != "" && password != ""){
                // var formData = new FormData(this);
                var _token = "{{ csrf_token() }}";
                var data = {name,fathers_name,mothers_name,cell,email,gender,address,institution,course_name,course_code,batch_no,password,_token};
                
                
                $.ajax({
                    type : 'post',
                    data : data,
                    url : "http://localhost:8000/admin/students",
                    success : function(data){
                        console.log(data);
                        if(data == 1){
                            Swal.fire(
                                'Success!',
                                'Student created successfully.',
                                'success'
                            ).then(function(){
                                window.location.href="http://localhost:8000/admin/students";
                            });
                        }else if(data == 2){
                            $('#email').val("");
                            Swal.fire(
                                'Failed!',
                                'Email has already been exists.',
                                'error'
                            );
                        }else{
                            
                        }
                    }
                });
            }else{
                Swal.fire(
                    'Error!',
                    'Insufficient Data.',
                    'error'
                );
            }
    });

    function view_student_details(id){
        $('#add_student_form').trigger('reset');
        $('#add_student').css('display','none');
        $('#update_student').css('display','none');
        $('#reset').css('display','none');
        $('#modal_title').text('Student Details');
        if(id){
            $.ajax({
                type : 'get',
                url: "{{ url('admin/students') }}/"+id,
                dataType : 'json',
                success : function(data){
                    $('#name').val(data.name);
                    $('#fathers_name').val(data.fathers_name);
                    $('#mothers_name').val(data.mothers_name);
                    $('#gender').val(data.gender);
                    $('#institution').val(data.institution);
                    $('#cell').val(data.cell);
                    $('#email').val(data.email);
                    $('#address').val(data.address);
                    $('#course_name').val(data.course_name);
                    $('#course_code').val(data.course_code);
                    $('#batch_no').val(data.batch_no);
                    $('#open_add_student_model').modal('show');
                }
            });
        }
        
    }
</script>

@endpush