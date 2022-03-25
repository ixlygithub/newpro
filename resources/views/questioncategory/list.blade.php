@extends('layouts.app', ['pageSlug' => 'questionscategory'])
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
                    <div class="col-8">
                        <h4 class="card-title">Category List</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('addquestioncategory') }}" class="btn btn-sm btn-primary">Add Category</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table tablesorter datatable" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Category</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $category->question_category }}</td>
                            <td>{{ $category->input_option }}</td>
                            <td><?php if($category->status==1){echo 'Active';}else{echo "Inactive";} ?></td>
                            <td><a href="{{route('editquestioncategory',['id' => $category->id])}}" class="btn btn-sm btn-outline-primary py-0">Edit</a>
                            <!-- <a style="margin-left: 10px;" href="{{route('deletequestioncategory',['id' => $category->id])}}" class="btn btn-sm btn-outline-danger py-0">Delete</a> -->
                             <a style="margin-left: 10px;" href="{{route('deletequestioncategory',['id' => $category->id])}}" class="btn btn-sm btn-outline-danger py-0 qcatdel{{ $category->id }}"  onclick="confirmpage('qcatdel<?php echo $category->id;?>');return false;">Delete</a>
                            
                            </td>
                        </tr>
                         @empty
                        <tr><td colspan="4" class="text-center"> No categories found!</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection