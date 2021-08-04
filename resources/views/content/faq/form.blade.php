@extends ('layout')

@section('title', isset($faq) ?  'Update '.$faq->title : 'Create FAQ')

@section('content')
<div class="my-3">
  <a class="text-decoration-none text-dark" href="{{ route('faq.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: -3px;margin-right: -3px;"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
    Back
  </a>
</div>

<div id="mainForm">

  <form method="POST" enctype="multipart/form-data"
    @if ( isset($faq) )
        action="{{ route('faq.update', $faq) }}"
    @else
        action="{{ route('faq.store') }}"
    @endif
    class="row row-cols-lg-auto g-3 align-items-center">
    @csrf
    @isset($faq)
        @method('PUT')
    @endisset

    <div class="col-8">
    <div class="row">
      <div class="mb-2 col-12">
        <label for="question" class="form-label mt-2 mb-1">Question</label>
        <input name="question" type="text" class="form-control" id="question" value="{{ old('question', isset( $faq->question ) ? $faq->question : '') }}">
        @error('question')
            <div class="alert alert-danger mb-0">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-2 col-12">
        <label for="answer" class="form-label mt-2 mb-1">Answer</label>
        <textarea name="answer" class="form-control" id="answer">{{ isset( $faq->answer ) ? $faq->answer : '' }}</textarea>
        @error('answer')
            <div class="alert alert-danger mb-0">{{ $message }}</div>
        @enderror
      </div>
    <div class="col-12">
      <label><input type="checkbox" name="front" id="front" {{ isset($faq->front) ? 'checked' : '' }}>Front</label>
      <label><input type="checkbox" name="sponsors" id="sponsors" {{ isset($faq->sponsors) ? 'checked' : '' }}>Sponsors</label>
    </div>
      <div class="mb-2 col-12">
        <button type="submit" class="btn btn-primary">{{ isset($faq) ?  'Update' : 'Create' }}</button>
      </div>

    </div>
</div>
</form>

  @isset ($faq)
    <form class="col" method="POST" action="{{ route('faq.destroy', $faq) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mb-3">Delete</button>
    </form>
  @endisset
</div>
@endsection
