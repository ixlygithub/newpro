@extends('layouts.app', ['pageSlug' => 'test'])
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

         @if ($message = Session::get('success'))
            <div class="btn btn-success btn-block btn-sm custom_message text-left">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
          @endif
          @if ($message = Session::get('error'))
            <div class="btn btn-danger btn-block btn-sm custom_message text-left">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
          @endif
          <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Test List</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('addtest') }}" class="btn btn-sm btn-primary">Add Test</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Test Name</th>
                                <th scope="col">No. Of Questions</th>
                                <th scope="col">User Limit</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($tests as $test)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $test->test_name }}</td>
                            <td>{{ $test->no_of_question }}</td>
                            <td>{{ $test->user_limit }}</td>
                            <td>
                            <!-- <a href="{{route('deletetest',['id' => $test->id])}}" class="btn btn-sm btn-outline-danger py-0">Delete</a></td> -->
                            <a style="margin-left: 10px;" href="deletetest/{{ $test->id }}" class="btn btn-sm btn-outline-danger py-0 testdel{{ $test->id }}"  onclick="confirmpage('testdel<?php echo $test->id;?>');return false;">Delete</a>
                        </tr>
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
@endsection