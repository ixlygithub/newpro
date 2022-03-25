@extends('layouts.app', ['pageSlug' => 'category'])
@push('style')
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

          @if(session()->has('message'))
            <p class="btn btn-success btn-block btn-sm custom_message text-left">{{ session()->get('message') }}</p>
          @endif

         <div class="card">  
            <div class="card-header">
                    <h5 class="title">Edit Category</h5>
                </div>
            <div class="card-body">

          <form action="{{ route('category.updatecategory',$category->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
              <label for="">Category name</label>
              <input type="text" class="form-control" name="category_name" value="{{ $category->category_name}}">
              <font style="color:red"> {{ $errors->has('category_name') ?  $errors->first('category_name') : '' }} </font>
            </div>
            
           
             <div class="form-group">
              <label for="">Comprehensive </label>
              <input type="radio" id="contactChoice1"  name="comprehensive" value="YES" {{ ($category->comprehensive=="YES") ? 'Checked' : '' }}>
             <label for="contactChoice1">YES</label>
            <input type="radio" id="contactChoice2" name="comprehensive" value="NO" {{ ($category->comprehensive=="NO") ? 'Checked' : '' }}>
             <label for="contactChoice2">NO</label>
            <font style="color:red"> {{ $errors->has('comprehensive') ?  $errors->first('comprehensive') : '' }} </font>
            </div>
            <div class="form-group">
              <label for="">Comprehensive Test Percentage</label>
              <input type="text" class="form-control" name="comprehensive_test_percentage" value="{{ $category->comprehensive_test_percentage}}" placeholder="Enter comprehensive_test_percentage">
              <font style="color:red"> {{ $errors->has('comprehensive_test_percentage') ?  $errors->first('comprehensive_test_percentage') : '' }} </font>
            </div>
            <div class="form-group">
              <label for="">Maximum Questions</label>
              <input type="text" class="form-control" name="max_questions" value="{{ $category->max_questions}}" placeholder="Enter max questions number">
              <font style="color:red"> {{ $errors->has('max_questions') ?  $errors->first('max_questions') : '' }} </font>
            </div>
            <div class="form-group">
              <label for="">Tag Questions
               <?php $tag_questions=explode(',',$category->tag_questions);
               //print_r($tag_questions);
               ?>

              </label>
              <select  class="form-control select2" name="tag_questions[]" multiple required="">
              @if(!empty($tagquestions))
                                    @forelse($tagquestions as $tagques)
            <option value="{{ $tagques->id }}" <?php echo (in_array($tagques->id, $tag_questions))?'selected':'';?>>{{ $tagques->name }}</option>
                                    

                                    @empty
                                        <option value="">No data found</option>
                                    @endforelse
                                @endif
                
              </select>
              <font style="color:red"> {{ $errors->has('tag_questions') ?  $errors->first('tag_questions') : '' }} </font>
              </div>
            <div class="form-group" style="margin-top: 24px;">
              <input type="submit" class="btn btn-primary" value="Update">
            </div>

          </form>
          </div>
          </div>
        </div>
    </div>
</div>
@endsection