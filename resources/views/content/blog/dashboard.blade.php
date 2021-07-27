@extends ('layout')

@section('title', 'Blog')

@section('content')
<a href="{{ route('blog.create') }}"><button type="button" class="btn btn-primary mb-3">{{ __('Create post') }}</button></a>

    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Status</th>
        <th scope="col">Categories</th>
        <th scope="col" class="col-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($blog as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->status }}</td>
            <td>{{ $post->categories }}</td>
            <td>
            <form method="POST" action="{{ route('blog.destroy', $post) }}">
            <a href="{{ route('blog.edit', $post) }}"><button type="button" class="btn-sm btn-secondary">Edit</button></a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm btn-danger">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    {{ $blog->links() }}
@endsection
