@extends ('layout')

@section('title', 'Refered By')

@section('content')
    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Referring User</th>
        <th scope="col">Referred User</th>
        <!-- <th scope="col" class="col-2">Actions</th> -->
        </tr>
    </thead>
    <tbody>
    @foreach($users as $info)
        <tr>
            <th scope="row">{{ $info->id }}</th>
            <td>{{ $info->email }}</td>
            <td>{{ $info->refered_by }}</td>
            <!-- <td>
            <form method="POST" action="{{ route('faq.destroy', $info) }}">
            <a href="{{ route('faq.edit', $info) }}"><button type="button" class="btn-sm btn-secondary">Edit</button></a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm btn-danger">Delete</button>
            </form>
            </td> -->
        </tr>
    @endforeach
    </tbody>
    </table>

    {{ $users->links() }}
@endsection
