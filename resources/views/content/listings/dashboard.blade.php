@extends ('layout')

@section('title', 'Listings')

@section('content')
    <a href="{{ route('listings.create') }}"><button type="button" class="btn btn-primary mb-3">{{ __('Create listing') }}</button></a>
@endsection
