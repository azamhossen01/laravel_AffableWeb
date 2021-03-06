@extends('backend.layouts.app')

@section('title','Home')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- Icon Cards-->
    <div class="row">
      <div class="col-xl-2 col-sm-4 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-comments"></i>
            </div>
            <div class="mr-5">{{$students}} Students</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{route('students.index')}}">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-2 col-sm-4 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-list"></i>
            </div>
            <div class="mr-5">{{$news}} News</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{route('news.index')}}">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-2 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-shopping-cart"></i>
            </div>
            <div class="mr-5">{{$teams}} Team Members</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{route('teams.index')}}">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-2 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-life-ring"></i>
            </div>
            <div class="mr-5">Income {{$incomes}}</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{route('payments.index')}}">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-2 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-life-ring"></i>
            </div>
            <div class="mr-5">Due {{$due}}</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="{{route('payments.index')}}">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-xl-2 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-life-ring"></i>
            </div>
            <div class="mr-5">13 New Tickets!</div>
          </div>
          <a class="card-footer text-white clearfix small z-1" href="#">
            <span class="float-left">View Details</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
    </div>

    <!-- Area Chart Example-->
    <!-- <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-chart-area"></i>
        Area Chart Example</div>
      <div class="card-body">
        <canvas id="myAreaChart" width="100%" height="30"></canvas>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div> -->

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Recent Payments</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
              <th>SL</th>
                <th>Name</th>
                <th>Course Name</th>
                <th>Batch</th>
                <th>Cell</th>
                <th>Date</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
              <th>SL</th>
                <th>Name</th>
                <th>Course Name</th>
                <th>Batch</th>
                <th>Cell</th>
                <th>Date</th>
                <th>Amount</th>
              </tr>
            </tfoot>
            <tbody>
              @forelse($recent_payments as $key=>$rp)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$rp->payment->student->name}}</td>
                <td>{{$rp->payment->student->course_name}}</td>
                <td>{{$rp->payment->student->batch_no}}</td>
                <td>{{$rp->payment->student->cell}}</td>
                <td>{{$rp->date}}</td>
                <td>{{$rp->amount}}</td>

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
  <!-- /.container-fluid -->
@endsection