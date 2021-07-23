@extends ('layout')

@section('title', 'Events')

@section('content')
<a href="{{ route('events.create') }}"><button type="button" class="btn btn-primary mb-3">{{ __('Create event') }}</button></a>
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
    @foreach($events as $event)
        <tr>
            <th scope="row">{{ $event->id }}</th>
            <td>{{ $event->title }}</td>
            <td>{{ $event->level }}</td>
            <td>{{ $event->basic_status }}</td>
            <td>
            <form method="POST" action="{{ route('events.destroy', $event) }}">
            <a href="{{ route('events.edit', $event) }}"><button type="button" class="btn-sm btn-secondary">Edit</button></a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm btn-danger">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    {{ $events->links() }}
@endsection
