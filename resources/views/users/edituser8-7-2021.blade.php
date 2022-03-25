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

          <form action="{{ route('updateuser',$user->id) }}" method="post">
             @csrf
            @method('patch')
             <div class="row">
            <div class="col-md-6">
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" value="{{ $user->name}}" placeholder="Enter name" required>
              <input type="hidden" class="form-control" name="id" value="{{ $user->id}}" placeholder="">
              <font style="color:red"> {{ $errors->has('name') ?  $errors->first('name') : '' }} </font>
            </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
              <label for="">Email</label>
              <input type="email" class="form-control" name="email" value="{{ $user->email}}" placeholder="Enter Email">
              <font style="color:red"> {{ $errors->has('email') ?  $errors->first('email') : '' }} </font>
            </div>
            </div>
            
            <div class="col-md-6">
            <div class="form-group">
              <label for="">Role</label>
             <select  class="form-control role" name="role"  placeholder="Enter Role" onchange="privilege(this.value)">
              
               <option value='adminuser' {{ ($user->role=="adminuser") ? 'selected' : '' }}>Admin User</option>
               <option value='admin' {{ ($user->role=="admin") ? 'selected' : '' }}>Admin</option>
             </select>
              <font style="color:red"> {{ $errors->has('role') ?  $errors->first('role') : '' }} </font>
            </div>
            </div>
            </div>

            <div class="privilege" style=" border: 2px solid pink; border-radius: 12px;">
             <label>Add Privilege</label>
            All<input type="checkbox" id="checkAll">
            <?php $privileges=explode(',',$user->privileges)?>;
            <div class="row">
            <div class="col-md-6">
            <ul><li><label>Questions</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="questions" name="privileges[]" <?php echo (in_array("questions", $privileges))?'checked':'';?>> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addquestion" name="privileges[]" <?php echo (in_array("addquestion", $privileges))?'checked':'';?>> Add 
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="editquestion" name="privileges[]" <?php echo (in_array("editquestion", $privileges))?'checked':'';?>> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deletequestion" name="privileges[]" <?php echo (in_array("deletequestion", $privileges))?'checked':'';?>> Delete
            </label>
             
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <ul><li><label>Test</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="listtest" name="privileges[]" <?php echo (in_array("listtest", $privileges))?'checked':'';?>> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addtest" name="privileges[]" <?php echo (in_array("addtest", $privileges))?'checked':'';?>> Add 
            </label>
           
            <label class="checkbox-inline">
              <input type="checkbox" value="deletetest" name="privileges[]" <?php echo (in_array("deletetest", $privileges))?'checked':'';?>> Delete
            </label>
            </div>
            </div>
             <div class="row">
            <div class="col-md-6">
            <ul><li><label>User</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="user" name="privileges[]" <?php echo (in_array("user", $privileges))?'checked':'';?>> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="adduser" name="privileges[]" <?php echo (in_array("adduser", $privileges))?'checked':'';?>> Add 
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="edituser" name="privileges[]" <?php echo (in_array("edituser", $privileges))?'checked':'';?>> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deleteuser" name="privileges[]" <?php echo (in_array("deleteuser", $privileges))?'checked':'';?>> Delete
            </label>
            </div>
            </div>
             <div class="row">
            <div class="col-md-6">
            <ul><li><label>Category</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="category" name="privileges[]" <?php echo (in_array("category", $privileges))?'checked':'';?>> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addcategory" name="privileges[]" <?php echo (in_array("addcategory", $privileges))?'checked':'';?>> Add 
            </label>
           <label class="checkbox-inline">
              <input type="checkbox" value="editcategory" name="privileges[]" <?php echo (in_array("editcategory", $privileges))?'checked':'';?>> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deletecategory" name="privileges[]" <?php echo (in_array("deletecategory", $privileges))?'checked':'';?>> Delete
            </label>
            </div>
            </div>
             <div class="row">
            <div class="col-md-6">
            <ul><li><label>Weightage</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="weightage" name="privileges[]" <?php echo (in_array("weightage", $privileges))?'checked':'';?>> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addweightage" name="privileges[]" <?php echo (in_array("addweightage", $privileges))?'checked':'';?>> Add 
            </label>
           <label class="checkbox-inline">
              <input type="checkbox" value="editweightage" name="privileges[]" <?php echo (in_array("editweightage", $privileges))?'checked':'';?>> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deleteweightage" name="privileges[]" <?php echo (in_array("deleteweightage", $privileges))?'checked':'';?>> Delete
            </label>
            </div>
            </div>
             <div class="row">
            <div class="col-md-6">
            <ul><li><label>Question Category</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="listquestioncategory" name="privileges[]" <?php echo (in_array("listquestioncategory", $privileges))?'checked':'';?>> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addquestioncategory" name="privileges[]" <?php echo (in_array("addquestioncategory", $privileges))?'checked':'';?>> Add 
            </label>
           <label class="checkbox-inline">
              <input type="checkbox" value="editquestioncategory" name="privileges[]" <?php echo (in_array("editquestioncategory", $privileges))?'checked':'';?>> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deletequestioncategory" name="privileges[]" <?php echo (in_array("deletequestioncategory", $privileges))?'checked':'';?>> Delete
            </label>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <ul><li><label>Tags</label></li></ul>
            </div>
            <div class="col-md-6">
            <label class="checkbox-inline">
              <input type="checkbox" value="listtag" name="privileges[]" <?php echo (in_array("listtag", $privileges))?'checked':'';?>> List
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="addtag" name="privileges[]" <?php echo (in_array("addtag", $privileges))?'checked':'';?>> Add 
            </label>
           <label class="checkbox-inline">
              <input type="checkbox" value="edittag" name="privileges[]" <?php echo (in_array("edittag", $privileges))?'checked':'';?>> Edit
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="deletetag" name="privileges[]" <?php echo (in_array("deletetag", $privileges))?'checked':'';?>> Delete
            </label>
            <input type="hidden" value="updateuser" name="privileges[]" class="checkbox">
              <input type="hidden" value="updatetag" name="privileges[]" class="checkbox">
               <input type="hidden" value="updatequestion" name="privileges[]" class="checkbox">
            </div>
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
@endsection