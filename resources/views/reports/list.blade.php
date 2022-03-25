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
                        <h4 class="card-title">User List</h4>
                    </div>
                    <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table tablesorter datatable" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">User Name</th>
                                <th scope="col">No. Of Tests</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $report->user_name }}</td>
                                    <td>{{ $report->testcount }}</td>
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