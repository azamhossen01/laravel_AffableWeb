@extends('backend.layouts.app')

@section('title','Payment Details')

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
      
      <a href="{{route('payments.index')}}" class="btn btn-primary" >Back</a >
      <div class="card-header text-center">
        <p class="mb-0"><i><b>Name : </b></i>{{$payment->student->name}}</p>
        <p class="mb-0"><i><b>Course Name : </b></i>{{$payment->student->course_name}}</p>
        <p class="mb-0"><i><b>Batch No : </b></i>{{$payment->student->batch_no}}</p>
        <p class="mb-0"><i><b>Month : </b></i><b>{{date('F d Y',strtotime($payment->date))}}</b></p>
        <p class="mb-0"><i><b>Total Fees : </b></i><b>{{$payment->course_fee}}</b></p>
        <button class="btn btn-primary btn-block"<?= $payment->status=='1'?"style='display:none'":'' ?> onclick="make_new_payment_modal()">New Payment</button>
    </div>
      <div class="card-body">

      <table class="table table-bordered table-striped text-center">
                                   
                                        <tr class="text-center">
                                            <th colspan=3>Payments</th>
                                        </tr>
                                        <tr>    
                                            <th>Date</th>
                                            <th>Taken By</th>
                                            <th>Amount</th>
                                        </tr>
                                    <?php $total=0; foreach($payment_details as $pd){ ?>
                                        <tr>
                                            <td><?= date('F d Y',strtotime($pd->date)) ?></td>
                                            <td><?= $pd->user->name ?></td>
                                            <td><?= $pd->amount ?></td>
                                            <?php $total+=$pd->amount ?>
                                        </tr>
                                    <?php } ?>
                                        <tr>
                                            <th colspan=2>Total Paid</th>
                                            <td><?= $total ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan=2>Total Fee</th>
                                            <td><?= $payment->course_fee ?></td>
                                        </tr>
                                        <tr>
                                            <th colspan=2>Total Due</th>
                                            <td><?= ($payment->course_fee - $total) ?></td>
                                        </tr>
                                        
                                    </table>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

  </div>


  <!-- payment modal start here -->
  <div id="make_new_payment_modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-striped">
            <form action="{{route('payment_details.store')}}" id="add_payment_form" method="post">
            @csrf 
            <input type="hidden" name="payment_id" value="{{$payment->id}}">
            <tr>
             <td>Amount : </td>
             <td><input required type="number" id="amount" name="amount" class="form-control"></td>
            </tr>
            <tr>
            <td>Date : </td>
            <td><input required type="date" class="form-control" name="date" id="date" ></td>
            </tr>
           

        </table>
      </div>
      <div class="modal-footer">
        <button type="submit"  class="btn btn-primary">Save changes</button>
        <button type="reset" class="btn btn-danger">Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>


        <!-- payment modal end here -->
@endsection

@push('js')

<script>
    function make_new_payment_modal(payment_id){
            $('#add_payment_form').trigger('reset');
            $('#make_new_payment_modal').modal('show');
        }

        $('#add_payment').click(function(e){
            e.preventDefault();
            var payment_id = $('#payment_id').val();
            var student_id = $('#student_id').val();
            var date = $('#date').val();
            var amount = $('#amount').val();
            if(payment_id!="" && student_id!="" && date!="" && amount!=""){
                var data = {payment_id,student_id,date,amount};
                $.ajax({
                    type : 'post',
                    data : data,
                    url : "http://localhost/affable/AffableWeb/admin/payments/payment_details.php",
                    success : function(data){
                        console.log(data);
                        if(data == 1){
                            Swal.fire(
                                'Success!',
                                'Payment created successfully.',
                                'success'
                            ).then(function(){
                                 window.location.href="http://localhost/affable/AffableWeb/admin/payments/payment_details.php?id="+payment_id;
                            });
                            
                           
                        }else if(data == 2){
                            Swal.fire(
                                'Error!',
                                'Please don\'t cross your limit.',
                                'error'
                            );
                        }else{
                            Swal.fire(
                                'Error!',
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
</script>

@endpush