@extends('backend.layouts.app')

@section('title','Students Details')

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
      <a href="{{route('news.index')}}" class="btn btn-primary" >Back</a >
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <form action="{{route('news.update',$news->id)}}" method="post">
          @csrf 
          @method('put')
             
              <tr>
                  <th>Title : </th>
                  <td><input type="text" value="<?= $news->title ?>" name="title"
                          id="title" class="form-control" placeholder="Title"></td>
              </tr>

              <tr>
                  <th>Description : </th>
                  <td><textarea name="description" class="form-control" id="description"
                          cols="30" rows="3"
                          placeholder="Description"><?= $news->description ?></textarea>
                  </td>
              </tr>

              <tr>
                  <th>Link : </th>
                  <td><input type="text" value="<?= $news->link ?>" name="link" id="link"
                          class="form-control" placeholder="Link"></td>
              </tr>
              <tr>
                  <th>Status : </th>
                  <td>
                  <div class="row">   
                      <div class="col-lg-6">
                          <div class="form-check">
                              <label class="form-check-label">
                                  <input type="radio" class="form-check-input"
                                      name="mode" <?= $news->mode==0?'checked':'' ?> value="0">Pending
                              </label>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="form-check">
                              <label class="form-check-label">
                                  <input type="radio" class="form-check-input"
                                      name="mode" <?= $news->mode==1?'checked':'' ?> value="1">Active
                              </label>
                          </div>
                      </div>
                  </div>
                      
                      
                  </td>
              </tr>
              <tr>
                  <td colspan=2><button type="submit"
                      id="update_news"    class="btn btn-warning btn-block">Update</button></td>
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