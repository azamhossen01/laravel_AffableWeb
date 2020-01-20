@extends('backend.layouts.app')

@section('title','News')

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
        {{-- <button class="btn btn-primary" onclick="open_add_news_model()">Add New</button> --}}
      <a href="{{route('news.create')}}" class="btn btn-primary">Add New</a>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Link</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Link</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody id="all_news">
              @forelse($all_news as $key=>$news)
                <tr>
                <td>{{$key+1}}</td>
                <td>{{$news->title}}</td>
                <td>{{$news->link}}</td>
                <td>{{$news->mode==0?'Pending':'Active'}}</td>
                <td>
                <a href="{{route('news.show',$news->id)}}" class="btn btn-success btn-sm">Details</a>
                <a href="{{route('news.edit',$news->id)}}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{route('news.destroy',$news->id)}}" method="post" class="d-inline-block">
                    <button type="submit"  class="btn btn-danger btn-sm">Delete</button>
                </form>
                </td>
                </tr>
              @empty 

              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

  </div>


  {{-- add news modal start here --}}
  <div id="open_add_news_model" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title">Add New News</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="common_body">
          <table class="table table-bordered table-striped">
            <form action="add_news.php" method="post">
                <tr>
                    <th>Title : </th>
                    <td><input required type="text" name="title" id="title" class="form-control"
                            placeholder="Title"></td>
                </tr>

                <tr>
                    <th>Description : </th>
                    <td><textarea required name="description" class="form-control" id="description"
                            cols="30" rows="3" placeholder="Description"></textarea></td>
                </tr>

                <tr>
                    <th>Link : </th>
                    <td><input required type="text" name="link" id="link" class="form-control"
                            placeholder="Link"></td>
                </tr>

                {{-- <tr>
                    <td colspan=2><button type="submit"
                       id="save_news"     class="btn btn-primary btn-block">Save</button></td>
                </tr> --}}
            </form>
        </table>
        </div>
        <div class="modal-footer">
            <button type="button" id="add_news"    class="btn btn-primary">Save</button>
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
    
   
    function open_add_news_model(){

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
        $('#add_news').css('display','block');
        $('#update_student').css('display','none');
        $('#reset').css('display','block');
        $('#open_add_news_model').modal('show');
    }

    $('#add_news').click(function(e){
        e.preventDefault();
        var title = $('#title').val();
            var description = $('#description').val();
            var link = $('#link').val();
            if(title!="" && description!="" && link!=""){
              var _token = "{{ csrf_token() }}";
                var data = {_token,title,description,link};
                $.ajax({
                    type : 'post',
                    data : data,
                    url : "http://localhost:8000/admin/news",
                    success : function(data){
                        console.log(data);
                        if(data == 1){
                            Swal.fire(
                                'Success!',
                                'News created successfully.',
                                'success'
                            ).then(function(){
                              window.location.href="http://localhost:8000/admin/news";
                            });
                            
                        }else{
                            Swal.fire(
                                'Deleted!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    }
                });
            }else{
                Swal.fire(
                    'Failed!',
                    'Insufficient Data.',
                    'error'
                );
            }
    });

    function view_student_details(id){
        $('#add_news_form').trigger('reset');
        $('#add_news').css('display','none');
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
                    $('#open_add_news_model').modal('show');
                }
            });
        }
        
    }
</script>

@endpush