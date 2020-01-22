@extends('backend.layouts.app')

@section('title','User Profile')

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
      <div class="card-body">
        <table class="table table-bordered table-striped">
        <form action="{{route('update_user',$user->id)}}" method="post">
          @csrf 
          @method('put')
             
              <tr>
                  <th>Name : </th>
                  <td><input required type="text" value="<?= $user->name ?>" name="name"
                          id="name" class="form-control" placeholder="Name"><small class="text-danger">{{$errors->first('name')}}</small>        
                          </td>
              </tr>

              
              <tr>
                  <th>Email : </th>
                  <td><input required type="email" value="<?= $user->email ?>" name="email" id="email"
                          class="form-control" placeholder="Email"><small class="text-danger">{{$errors->first('email')}}</small>        
                          </td>
              </tr>
              
              <tr>
                  <th>Cell : </th>
                  <td><input required type="text" value="<?= $user->cell ?>" name="cell" id="cell"
                          class="form-control" placeholder="Cell">
                    <small class="text-danger">{{$errors->first('cell')}}</small>                
                  </td>
              </tr>
              
              <tr>
                  <th>Password : </th>
                  <td><input type="text" name="password" id="password"
                          class="form-control" placeholder="Password">
                  <small class="text-danger">{{$errors->first('password')}}</small>        
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

</script>

@endpush