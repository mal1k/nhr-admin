@extends ('layout')

@section('title', 'Deals')

@section('content')
<a href="{{ route('deals.create') }}"><button type="button" class="btn btn-primary mb-3">{{ __('Create deal') }}</button></a>

    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Owner</th>
        <th scope="col">Associate</th>
        <th scope="col" class="col-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($deals as $deal)
        <tr>
            <th scope="row">{{ $deal->id }}</th>
            <td>{{ $deal->title }}</td>
            <td>{{ $deal->basic_account }}</td>
            <td>{{ $deal->basic_listing }}</td>
            <td>
            <form method="POST" action="{{ route('deals.destroy', $deal) }}">
            <a href="{{ route('deals.edit', $deal) }}"><button type="button" class="btn-sm btn-secondary">Edit</button></a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm btn-danger">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    {{ $deals->links() }}
@endsection
