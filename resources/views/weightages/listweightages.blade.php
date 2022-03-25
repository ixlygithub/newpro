@extends('layouts.app', ['pageSlug' => 'weightage'])
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

@endpush
@section('content')
<script type="text/javascript">
$(document).ready(function(){
    $('#weightages').DataTable();
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">

          @if(session()->has('message'))
            <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
          @endif

          <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Weightage List</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('addweightage') }}" class="btn btn-sm btn-primary">Add Weightage</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                <div class="">
                    <table class="table tablesorter " id="weightages">
                        <thead class=" text-primary">
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Weightage</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Action</th>
                        </tr></thead>
                        <tbody>
                         @forelse ($weightages as $weight)
                        <tr>
                          <td>{{ $loop->index + 1 }}</td>
                          <td>{{ $weight->weightage_title }}</td>
                          <td>{{ $weight->rating }}</td>
                          <td><a href="{{ route('weightage.editweightage',$weight->id) }}" class="btn btn-sm btn-outline-primary py-0">Edit</a>
                          <!-- <a style="margin-left: 10px;" href="deleteweightage/{{ $weight->id }}" class="btn btn-sm btn-outline-danger py-0" >Delete</a> -->
                          <a style="margin-left: 10px;" href="deleteweightage/{{ $weight->id }}" class="btn btn-sm btn-outline-danger py-0 weightagedel{{ $weight->id }}"  onclick="confirmpage('weightagedel<?php echo $weight->id;?>');return false;">Delete</a>
                          </td>
                        </tr>
                         @empty
                        <tr><td colspan="4" class="text-center"> No Weightage found!</td></tr>
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
