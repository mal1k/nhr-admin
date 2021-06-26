@extends ('layout')

@section('title', 'Users')

@section('content')
    <a href="{{ route('users.create') }}"><button type="button" class="btn btn-primary mb-3">Create user</button></a>
    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col" class="col-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
            <form method="POST" action="{{ route('users.destroy', $user) }}">
                <a href="{{ route('users.edit', $user) }}"><button type="button" class="btn-sm btn-secondary">Edit</button></a>
                @csrf
                @method('DELETE')
                @if ($user->role !== 'super-admin' )
                    <button type="submit" class="btn-sm btn-danger">Delete</button>
                @endif
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    {{ $users->links() }}
@endsection
