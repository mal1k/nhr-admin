@extends ('layout')

@section('title', 'Listing Types')

@section('content')
<a href="{{ route('listing-types.create') }}"><button type="button" class="btn btn-primary mb-3">{{ __('Create listing type') }}</button></a>

    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col" class="col-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($listingTypes as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>
            <form method="POST" action="{{ route('listing-types.destroy', $post) }}">
            <a href="{{ route('listing-types.edit', $post) }}"><button type="button" class="btn-sm btn-secondary">Edit</button></a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm btn-danger">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    {{ $listingTypes->links() }}
@endsection
