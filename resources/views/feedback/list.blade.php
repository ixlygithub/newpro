@extends('layouts.app', ['pageSlug' => 'reports'])
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

         @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
          @endif
          <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-9">
                        <h4 class="card-title">Feedback Details</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table tablesorter datatable" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Update Staus</th>
                                <th scope="col" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                            @forelse ($feedbacks as $feedback)
                            <?php $i++; ?>
                                <tr class="tab_row">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $feedback['username'] }}</td>
                                    <td>{{ $feedback['status'] }}</td>
                                    <td><select style="width: 300px;" id="status<?php echo $i; ?>"><option value="">Select Status</option><option value="Process">Process</option><option value="Sent Report">Sent Report</option></select></td>
                                    <td style="text-align: center;"><a style="cursor: pointer;" data-toggle="modal" data-target="#myModal<?php echo $feedback['id']; ?>"><i class="fas fa-eye"></i></a></td>
                                    <input type="hidden" value="<?php echo $feedback['id']; ?>" id="sid<?php echo $i; ?>">
                                </tr>
                            <!-- The Modal -->
                            <div class="modal" id="myModal<?php echo $feedback['id']; ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">

                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">FEEDBACK</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <?php echo $feedback['feed_back']; ?>
                                    <?php if($feedback['reply_message']==""){ ?>
                                      <form action="{{ route('feedback-reply') }}" method="POST">
                                      @csrf
                                        <textarea name="reply_message" style="border: 1px solid darkgray;margin-top: 5px;margin-bottom: 6px;border-radius: 5px;padding-left: 10px;" class="form-control" id="reply_message"></textarea>
                                        <input type="hidden" name="feed_id" value="<?php echo $feedback['id']; ?>">
                                        <button type="submit">send</button>
                                      </form>
                                    <?php }else{ ?>
                                    <h5 style="text-transform: uppercase;margin-top: 19px;font-size: 15px;font-weight: bold;">Reply Message</h5>
                                    <p><?php echo $feedback['reply_message']; ?></p>
                                  <?php } ?>
                                  </div>

                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                  </div>

                                </div>
                              </div>
                            </div>
                            @empty
                                <tr><td colspan="5" class="text-center"> No Tests found!</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
  var i =0;
$( ".tab_row" ).each(function() {
      var sid = $('#sid'+i+'').val();
  $(document).on('change', '#status'+i+'',function(){
      var val = $(this).val();
      $.ajax({
          type:'GET',
          url:"{{ route('get-data') }}",
          data:{'val':val,'sid':sid},
          success:function(data){
              alert("Status Updated successfully!!");
              location.reload();
          }
      });
  });
  i++;
});
</script>
<style type="text/css">
  .tab_row select {
    border-radius: 3px;
    border-color: #ddd;
    height: 35px;
    padding-left: 5px;
}
</style>
@endsection
