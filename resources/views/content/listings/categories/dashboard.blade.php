@extends ('layout')

@section('title', 'Listing Categories')

@section('content')
<a href="{{ route('listing-categories.create') }}"><button type="button" class="btn btn-primary mb-3">{{ __('Create category') }}</button></a>

    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Parent category</th>
        <th scope="col" class="col-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <th scope="row">{{ $category->id }}</th>
            <td>{{ $category->title }}</td>
            <td>
              @foreach ($categories as $categoryName)
                @if( $categoryName->id == $category->main_category )
                    {{ $categoryName->title }}
                @endif
              @endforeach
            </td>
            <td>
            <form method="POST" action="{{ route('listing-categories.destroy', $category) }}">
            <a href="{{ route('listing-categories.edit', $category) }}"><button type="button" class="btn-sm btn-secondary">Edit</button></a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm btn-danger">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    {{ $categories->links() }}
@endsection
