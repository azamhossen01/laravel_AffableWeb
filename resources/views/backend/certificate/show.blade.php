@extends('backend.layouts.app')

@section('title','Print Certificate')

@section('content')
<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
    </ol>

    <!-- <span class="float-right">
        <img src="{{asset('images/certificate/'.$certificate->certificate_image)}}" alt="">
       </span> -->

    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
        <a href="{{route('certificates.index')}}" class="btn btn-primary">Back</a>
        <button class="btn btn-success" onclick="printDiv()">Print</button>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12" id="print_id">
                    <img src="{{asset('images/certificate/'.$certificate->certificate_image)}}" style="width:1000px; height:500px" alt="">
                </div>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

</div>



@endsection

@push('js')

<script>
    var li = "http://localhost:8000/admin/";

    $(document).ready(function () {
        //    get_all_students();
    });







    function printDiv() {
        var divContents = document.getElementById("print_id").innerHTML;
        var a = window.open('', '', 'height=900, width=1500');
        a.document.write('<html>');
        a.document.write('<body >');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }

</script>

@endpush
