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
                        <h4 class="card-title">Audio List</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('addaudio') }}" class="btn btn-sm btn-primary">Add Audio</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Wrong Answer Audio</th>
                                <th scope="col">Right Answer Audio</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($get_tests_audio as $get_test_audio)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $get_test_audio->wrongques_song }}</td>
                            <td>{{ $get_test_audio->rightques_song }}</td>
                            <td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center"> No Audios found!</td></tr>
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