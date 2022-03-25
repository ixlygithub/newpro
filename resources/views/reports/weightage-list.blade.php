@extends('layouts.app', ['pageSlug' => 'weightagereports'])
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
                        <h4 class="card-title">Weightage Report</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table tablesorter datatable" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Weightage</th>
                                <th scope="col">Weightage Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($weightage_reports as $weightage_report)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $weightage_report->weightage_title }}</td>
                                    <td>{{ $weightage_report->wetcount }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center"> No Record found!</td></tr>
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