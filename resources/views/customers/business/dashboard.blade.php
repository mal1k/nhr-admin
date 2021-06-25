@extends ('layout')

@section('title', 'Business')

@section('content')
    <a href="{{ route('business.create') }}"><button type="button" class="btn btn-primary mb-3">Create business user</button></a>
    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Business</th>
        <th scope="col" class="col-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        @isset ( $user->business )
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->business }}</td>
            <td>
            <form method="POST" action="{{ route('business.destroy', $user) }}">
                <a href="{{ route('business.edit', $user) }}"><button type="button" class="btn-sm btn-secondary">Edit</button></a>
                @csrf
                @method('DELETE')
                @if ($user->role !== 'Super-admin' )
                    <button type="submit" class="btn-sm btn-danger">Delete</button>
                @endif
            </form>
            </td>
        </tr>
        @endempty
    @endforeach
    </tbody>
    </table>

    {{-- {{ $users->links() }} --}}
@endsection
