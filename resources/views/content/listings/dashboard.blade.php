@extends ('layout')

@section('title', 'Listings')

@section('content')
<a href="{{ route('listings.create') }}"><button type="button" class="btn btn-primary mb-3">{{ __('Create listing') }}</button></a>
      @isset ($path)
        <img src="{{ asset('/storage/' . $path) }}"
      @endisset
    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Level</th>
        <th scope="col">Status</th>
        <th scope="col" class="col-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($listings as $listing)
        <tr>
            <th scope="row">{{ $listing->id }}</th>
            <td>{{ $listing->title }}</td>
            <td>{{ $listing->level }}</td>
            <td>{{ $listing->basic_status }}</td>
            <td>
            <form method="POST" action="{{ route('listings.destroy', $listing) }}">
            <a href="{{ route('listings.edit', $listing) }}"><button type="button" class="btn-sm btn-secondary">Edit</button></a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm btn-danger">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    {{ $listings->links() }}
@endsection
