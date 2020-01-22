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
      <!-- <a href="{{route('news.create')}}" class="btn btn-primary">Add New</a> -->
      <div class="card-body">
            <form action="{{route('send_message')}}" method="post">
            @csrf 
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" cols="30" rows="3" placeholder="Message"></textarea>
            </div>
            @forelse($students as $key=>$student)


            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" name="student_id[]" id="student_id{{$student->id}}" class="form-check-input student" value="{{$student->id}}">{{$student->name}}
                </label>
            </div>
            @empty 
            @endforelse
            <br>
            <button type="submit" class="btn btn-primary">Send</button>
            <button type="button" onclick="select_all()" class="btn btn-primary">Select All</button>
            </form>        
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
   function select_all(){
    $('.student').prop('checked', true);
   }
</script>

@endpush