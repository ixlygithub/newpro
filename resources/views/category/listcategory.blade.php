@extends('layouts.app', ['pageSlug' => 'category'])
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
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
                        <h4 class="card-title">Category List</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('addcategory') }}" class="btn btn-sm btn-primary">Add Category</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                <div class="">
                    <table class="table tablesorter datatable" id="">
                        <thead class=" text-primary">
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">COMPREHENSIVE</th>
                            <th scope="col">PERCENTAGE</th>
                            <th scope="col">ACTION</th>
                        </tr></thead>
                        <tbody>
                         @forelse ($category as $cat)
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td>{{ $cat->category_name }}</td>
                          <td>{{ $cat->comprehensive }}</td>
                          <td>{{ $cat->comprehensive_test_percentage }}</td>
                          <td><a href="{{ route('category.editcategory',$cat->id) }}" class="btn btn-sm btn-outline-primary py-0">Edit</a>
                         <!--  <a style="margin-left: 10px;" href="deletecategory/{{ $cat->id }}" class="btn btn-sm btn-outline-danger py-0">Delete</a></td> -->
                          <a style="margin-left: 10px;" href="deletecategory/{{ $cat->id }}" class="btn btn-sm btn-outline-danger py-0 catdel{{ $cat->id }}"  onclick="confirmpage('catdel<?php echo $cat->id;?>');return false;">Delete</a>
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