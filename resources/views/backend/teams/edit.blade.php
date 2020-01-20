@extends('backend.layouts.app')

@section('title','Edit TM')

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
        <form action="{{route('teams.update',$team->id)}}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('put')
                <tr>
                    <th>Name : </th>
                    <td><input required type="text" value="<?= $team['name'] ?>" name="name" id="name"
                            class="form-control" placeholder="Name"></td>
                </tr>

                <tr>
                    <th>Gender : </th>
                    <td>
                        <select required name="gender" id="gender" class="form-control">
                            <option value="" selected disabled>Select Gender</option>
                            <option <?= $team['gender'] == 'Male' ? 'selected' : '' ?>
                                value="Male">Male</option>
                            <option <?= $team['gender'] == 'Female' ? 'selected' : '' ?>
                                value="Female">Female</option>
                        </select>
                        </option>
                </tr>
                <tr>
                    <th>Position : </th>
                    <td><input required type="text" name="position" id="position"
                            value="<?= $team['position'] ?>" class="form-control"
                            placeholder="Position"></td>
                </tr>
                <tr>
                    <th>Cell : </th>
                    <td><input required type="text" name="cell" id="cell" class="form-control"
                            value="<?= $team['cell'] ?>" placeholder="Cell"></td>
                </tr>
                <tr>
                    <th>Email : </th>
                    <td><input required type="email" name="email" id="email" class="form-control"
                            value="<?= $team['email'] ?>" placeholder="Email"></td>
                </tr>

                <tr>
                    <th>Facebook : </th>
                    <td><input required type="text" name="fb" id="fb" class="form-control"
                            value="<?= $team['fb'] ?>" placeholder="Facebook"></td>
                </tr>
                <tr>
                    <th>Degree : </th>
                    <td><input required type="text" value="<?= $team['degree'] ?>" name="degree" id="degree" class="form-control"
                            placeholder="Degree"></td>
                </tr>
                <tr>
                    <th>Image : </th>
                    <td><input type="file" name="member_image" id="member_image">
                    <img src="{{asset('images/'.$team->image)}}" width="10%" alt="">
                    </td>
                </tr>
                <tr>
                    <th>Status : </th>
                    <td>
                    <div class="row">   
                        <div class="col-lg-6">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input"
                                        name="mode" <?= $team['mode']==0?'checked':'' ?> value="0">Pending
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input"
                                        name="mode" <?= $team['mode']==1?'checked':'' ?> value="1">Active
                                </label>
                            </div>
                        </div>
                    </div>
                        
                        
                    </td>
                </tr>
                <tr>
                    <td colspan=2><button type="submit"
                            class="btn btn-warning btn-block">update</button></td>
                </tr>
            </form>
        </table>

      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

  </div>


@endsection

@push('js')

<script>
    var li = "http://localhost:8000/admin/";

    $(document).ready(function(){
    //    get_all_students();
    });


    // function get_all_students(){
    //     $.ajax({
    //         type : 'get',
    //         url: "{{ url('admin/students/get_students') }}",
    //         success : function(students){
    //             var student_count = students.length;
    //             var html = ``;
    //             for(var i = 0; i < student_count; i++){
    //                 html += `
    //                     <tr>
    //                         <td>${i+1}</td>
    //                         <td>${students[i].name}</td>
    //                         <td>${students[i].fathers_name}</td>
    //                         <td>${students[i].cell}</td>
    //                         ${students[i].mode == 0 ?'<td><span class="badge badge-warning">Pending</span></td>' : '<td><span class="badge badge-success">Active</span></td>'}
    //                         <td>
    //                             <button onclick="view_student_details(${students[i].id})" type="button" class="btn btn-success btn-sm">Details</button>
    //                             <button type="button" class="btn btn-warning btn-sm">Edit</button>
    //                             <button type="button" class="btn btn-danger btn-sm">Delete</button>
    //                         </td>
    //                     </tr>
    //                 `;
    //             }
    //             $('#all_students').html(html);
    //         }
    //     });
    // }
    
   
    // function open_add_student_model(){

    //     $('#name').val("");
    //     $('#fathers_name').val("");
    //     $('#mothers_name').val("");
    //     $('#gender').val("");
    //     $('#institution').val("");
    //     $('#cell').val("");
    //     $('#email').val("");
    //     $('#address').val("");
    //     $('#course_name').val("");
    //     $('#course_code').val("");
    //     $('#batch_no').val("");
    //     $('#modal_title').text('Add New Student');
    //     $('#add_student').css('display','block');
    //     $('#update_student').css('display','none');
    //     $('#reset').css('display','block');
    //     $('#open_add_student_model').modal('show');
    // }

    // $('#add_student').click(function(e){
    //     e.preventDefault();
    //     var name = $('#name').val();
    //         var fathers_name = $('#fathers_name').val();
    //         var mothers_name = $('#mothers_name').val();
    //         var cell = $('#cell').val();
    //         var email = $('#email').val();
    //         var gender = $('#gender').val();
    //         var address = $('#address').val();
    //         var institution = $('#institution').val();
    //         var course_name = $('#course_name').val();
    //         var course_code = $('#course_code').val();
    //         var batch_no = $('#batch_no').val();
    //         var password = $('#password').val();
    //         if(name != "" && fathers_name != "" && mothers_name != "" && cell != "" && email != "" && gender != "" && address != "" && institution != "" && course_name != "" && course_code != "" && batch_no != "" && password != ""){
    //             // var formData = new FormData(this);
    //             var _token = "{{ csrf_token() }}";
    //             var data = {name,fathers_name,mothers_name,cell,email,gender,address,institution,course_name,course_code,batch_no,password,_token};
                
                
    //             $.ajax({
    //                 type : 'post',
    //                 data : data,
    //                 url : "http://localhost:8000/admin/students",
    //                 success : function(data){
    //                     console.log(data);
    //                     if(data == 1){
    //                         Swal.fire(
    //                             'Success!',
    //                             'Student created successfully.',
    //                             'success'
    //                         ).then(function(){
    //                             window.location.href="http://localhost:8000/admin/students";
    //                         });
    //                     }else if(data == 2){
    //                         $('#email').val("");
    //                         Swal.fire(
    //                             'Failed!',
    //                             'Email has already been exists.',
    //                             'error'
    //                         );
    //                     }else{
                            
    //                     }
    //                 }
    //             });
    //         }else{
    //             Swal.fire(
    //                 'Error!',
    //                 'Insufficient Data.',
    //                 'error'
    //             );
    //         }
    // });

    // function view_student_details(id){
    //     $('#add_student_form').trigger('reset');
    //     $('#add_student').css('display','none');
    //     $('#update_student').css('display','none');
    //     $('#reset').css('display','none');
    //     $('#modal_title').text('Student Details');
    //     if(id){
    //         $.ajax({
    //             type : 'get',
    //             url: "{{ url('admin/students') }}/"+id,
    //             dataType : 'json',
    //             success : function(data){
    //                 $('#name').val(data.name);
    //                 $('#fathers_name').val(data.fathers_name);
    //                 $('#mothers_name').val(data.mothers_name);
    //                 $('#gender').val(data.gender);
    //                 $('#institution').val(data.institution);
    //                 $('#cell').val(data.cell);
    //                 $('#email').val(data.email);
    //                 $('#address').val(data.address);
    //                 $('#course_name').val(data.course_name);
    //                 $('#course_code').val(data.course_code);
    //                 $('#batch_no').val(data.batch_no);
    //                 $('#open_add_student_model').modal('show');
    //             }
    //         });
    //     }
        
    // }
</script>

@endpush