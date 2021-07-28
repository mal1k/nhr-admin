@extends ('layout')

@section('title', 'FAQ')

@section('content')
<a href="{{ route('faq.create') }}"><button type="button" class="btn btn-primary mb-3">{{ __('Create FAQ') }}</button></a>

    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Question</th>
        <th scope="col">Answer</th>
        <th scope="col" class="col-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($faq as $post)
        <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->question }}</td>
            <td>{{ $post->answer }}</td>
            <td>
            <form method="POST" action="{{ route('faq.destroy', $post) }}">
            <a href="{{ route('faq.edit', $post) }}"><button type="button" class="btn-sm btn-secondary">Edit</button></a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm btn-danger">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    {{ $faq->links() }}
@endsection
