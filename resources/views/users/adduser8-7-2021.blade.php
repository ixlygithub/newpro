@extends('layouts.app', ['pageSlug' => 'weightage'])
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
  
  .privilege{border-style: ridge;}
  .privilege {
  border: 2px solid red;
  border-radius: 12px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $('#checkAll').click(function() {
      alert();
        var checked = this.checked;
        $('input[type="checkbox"]').each(function() {
        this.checked = checked;
    });
    })
});

</script>
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

          @if(session()->has('message'))
            <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
          @endif
        <div class="card">  
            <div class="card-header">
                    <h5 class="title">Add Users</h5>
                </div>
            <div class="card-body">

          <form action="{{ route('adduser') }}" method="post">
            @csrf
             <div class="row">
            <div class="col-md-6">
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter name" required>
              <font style="color:red"> {{ $errors->has('name') ?  $errors->first('name') : '' }} </font>
            </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
              <label for="">Email</label>
              <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email">
              <input type="hidden" class="form-control" name="id" value="" placeholder="">
              <font style="color:red"> {{ $errors->has('email') ?  $errors->first('email') : '' }} </font>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
              <label for="">Password</label>
              <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Enter password">
             
              <font style="color:red"> {{ $errors->has('password') ?  $errors->first('password') : '' }} </font>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
              <label for="">Role</label>
             <select  class="form-control role" name="role" value="{{ old('role') }}"  placeholder="Enter Role">
              
               <option value='adminuser'>Admin User</option>
               <option value='admin'>Admin</option>
             </select>
              <font style="color:red"> {{ $errors->has('role') ?  $errors->first('role') : '' }} </font>
            </div>
            </div>
            </div>
            
            <div class="privilege" style=" border: 2px solid pink;
  border-radius: 12px;">
            <label>Add Privilege</label>     
            All<input type="checkbox" id="checkAll">
            <div class="row">
            <div class="col-md-6">
            <ul><li><label>Questions</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="questions" name="privileges[]" class="checkbox"> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addquestion" name="privileges[]" class="checkbox"> Add 
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="editquestion" name="privileges[]" class="checkbox"> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deletequestion" name="privileges[]" class="checkbox"> Delete
            </label>
             
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <ul><li><label>Test</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="listtest" name="privileges[]" class="checkbox"> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addtest" name="privileges[]" class="checkbox"> Add 
            </label>
           
            <label class="checkbox-inline">
              <input type="checkbox" value="deletetest" name="privileges[]" class="checkbox"> Delete
            </label>
            </div>
            </div>
             <div class="row">
            <div class="col-md-6">
            <ul><li><label>User</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="user" name="privileges[]" class="checkbox"> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="adduser" name="privileges[]" class="checkbox"> Add 
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="edituser" name="privileges[]" class="checkbox"> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deleteuser" name="privileges[]" class="checkbox"> Delete
            </label>
            </div>
            </div>
             <div class="row">
            <div class="col-md-6">
            <ul><li><label>Category</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="category" name="privileges[]" class="checkbox"> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addcategory" name="privileges[]" class="checkbox"> Add 
            </label>
           <label class="checkbox-inline">
              <input type="checkbox" value="editcategory" name="privileges[]" class="checkbox"> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deletecategory" name="privileges[]" class="checkbox"> Delete
            </label>
            </div>
            </div>
             <div class="row">
            <div class="col-md-6">
            <ul><li><label>Weightage</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="weightage" name="privileges[]" class="checkbox"> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addweightage" name="privileges[]" class="checkbox"> Add 
            </label>
           <label class="checkbox-inline">
              <input type="checkbox" value="editweightage" name="privileges[]" class="checkbox"> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deleteweightage" name="privileges[]" class="checkbox"> Delete
            </label>
            </div>
            </div>
             <div class="row">
            <div class="col-md-6">
            <ul><li><label>Question Category</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="listquestioncategory" name="privileges[]" class="checkbox"> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addquestioncategory" name="privileges[]" class="checkbox"> Add 
            </label>
           <label class="checkbox-inline">
              <input type="checkbox" value="editquestioncategory" name="privileges[]" class="checkbox"> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deletequestioncategory" name="privileges[]" class="checkbox"> Delete
            </label>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <ul><li><label>Tags</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="listtag" name="privileges[]" class="checkbox"> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addtag" name="privileges[]" class="checkbox"> Add 
            </label>
           <label class="checkbox-inline">
              <input type="checkbox" value="edittag" name="privileges[]" class="checkbox"> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deletetag" name="privileges[]" class="checkbox"> Delete
            </label>
            </div>
            </div>
            <div class="form-group" style="margin-top: 24px;">
             <center> <input type="submit" class="btn btn-primary" value="Submit"></center>
            </div>

          </form>
          </div>
          </div>
        </div>
    </div>
</div>
@endsection