@extends ('layout')

@section('title', 'Users')

@section('content')
    <a href="{{ route('users.create') }}"><button type="button" class="btn btn-primary">Create user</button></a>
    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>Edit</td>
        </tr>
    @endforeach
    </tbody>
    </table>
@endsection
