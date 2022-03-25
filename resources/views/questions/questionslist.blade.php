@extends('layouts.app', ['pageSlug' => 'questions'])
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<script type="text/javascript">
//alert();
$(document).ready(function(){
//  alert('sus');   
      // DataTable
      // var  category= $('#searchBycategory').val();
      // alert(category);
      var questable=$('#questions').DataTable({
         processing: true,
         serverSide: true,
       
         //ajax: "{{route('getQues')}}",
           // Read values
         ajax: {
       'url':"{{route('getQues')}}",
       
       'data': function(d){
          // Read values
          d.category = $('#searchBycategory').val();
         // var name = $('#searchByName').val();
 
        
       }
    }, 
         columns: [
             { data: 'id' },
            { data: 'question' },
             { data: 'category_name' },
             { data: 'weightage_title' },
             { data: 'question_category' },
            { data: 'action' },
            
         ]
      });
   
    $('#searchBycategory').change(function(){
 // alert();
    questable.draw();
  });
  
    });


</script>
<div class="container">
    <div class="row ">
        <div class="col-md-12">

          @if(session()->has('message'))
            <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
          @endif

          <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Questions List</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('addquestion') }}" class="btn btn-sm btn-primary">Add Questions</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                    <select id="searchBycategory" class="form-control">
                    <?php ?>
            <option value=''>search category</option>
            <?php foreach ($categories as $key => $value) {?>
               <option value="<?php echo $value->id;?>"><?php echo $value->category_name;?></option>
            <?php }?>
             
            </select>
                    </div>
                    </div>
            
                <div class="">
                <table class="table table-bordered" id="questions">
    <thead>
       <tr>
                            <th >No</th>
                            <th >Question</th>
                            <th >category Name</th>
                            <th >Weightage Title</th>
                            <th >Question Category</th>
                            
                            <th >ACTION</th>
                        </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
                  
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection