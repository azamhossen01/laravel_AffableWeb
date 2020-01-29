@extends('backend.layouts.app')

@section('title','Certificate Create')

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
      <a href="{{route('certificates.index')}}" class="btn btn-primary" >Back</a >
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <form action="{{route('certificates.store')}}" method="post" enctype="multipart/form-data">
          @csrf 
            <tr>
              <th>Serial Number : </th>
              <td><input type="text" required  name="serial_number" id="serial_number" class="form-control" value=""></td>
            </tr>
              <tr>
                  <th>Student : </th>
                  <td>
                      <select name="student_id" id="student_id" class="form-control"  onchange="get_student_info(this.value)" required>
                        <option value="" selected disabled>Select Student</option>
                        @forelse($students as $student) 
                          <option value="{{$student->id}}">{{$student->name}}</option>
                        @empty 
                        @endforelse
                      </select>
                  </td>
              </tr>

              <tr>
                        <th width="20%">Email : </th>
                        <td><input required readonly type="email" name="email" id="email" class="form-control"
                                placeholder="Email"></td>
                    </tr>

                    <tr>
                        <th width="20%">Cell : </th>
                        <td><input required readonly type="number" name="cell" id="cell" class="form-control"
                                placeholder="Cell"></td>
                    </tr>

                    <tr>
                        <th width="20%">Course Name : </th>
                        <td><input required readonly type="text" name="course_name" id="course_name"
                                class="form-control" placeholder="Course Name"></td>
                    </tr>

                    <tr>
                        <th width="20%">Course Code : </th>
                        <td><input required readonly type="text" name="course_code" id="course_code"
                                class="form-control" placeholder="Course Code"></td>
                    </tr>
                    <tr>
                        <th width="20%">Batch No : </th>
                        <td><input required readonly type="text" name="batch_no" id="batch_no" class="form-control"
                                placeholder="Batch No"></td>
                    </tr>

                    <tr>
                  <th>Image : </th>
                  <td><input type="file" required name="certificate_image" id="certificate_image"></td>
              </tr>

               <tr>
                  <td colspan=2><button type="submit"
                     id="save_news"     class="btn btn-primary btn-block">Save</button></td>
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
//       var d = new Date();

// var month = d.getMonth()+1;
// var day = d.getDate();

// var output = d.getFullYear() + '/' +
//     (month<10 ? '0' : '') + month + '/' +
//     (day<10 ? '0' : '') + day;

//     var from = output.replace(/\//g, '')
//     $('#serial_number').val(from);
    });

    function get_student_info(student_id) {
        if (student_id) {
            $.ajax({
                type: 'get',
                data: {
                    student_id: student_id
                },
                // url : "http://localhost/affable/AffableWeb/admin/payments/add_payment.php",
                url: li + "students/get_student/" + student_id,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data) {
                        $('#email').val(data.email);
                        $('#cell').val(data.cell);
                        $('#course_name').val(data.course_name);
                        $('#course_code').val(data.course_code);
                        $('#batch_no').val(data.batch_no);
                    }
                }
            });
        }
    }


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