@extends ('layout')

@section('title', 'Banners')

@section('content')
<a href="{{ route('banners.create') }}"><button type="button" class="btn btn-primary mb-3">{{ __('Create banner') }}</button></a>

    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Caption</th>
        <th scope="col">Banner type</th>
        <th scope="col" class="col-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($banners as $banner)
        <tr>
            <th scope="row">{{ $banner->id }}</th>
            <td>{{ $banner->caption }}</td>

            @php ( $bannerNames = array(0 => 'Leaderboard', 1 => 'Sponsored Links') )
            <td>{{ $bannerNames[$banner->banner_type] }}</td>
            <td>
            <form method="POST" action="{{ route('banners.destroy', $banner) }}">
            <a href="{{ route('banners.edit', $banner) }}"><button type="button" class="btn-sm btn-secondary">Edit</button></a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-sm btn-danger">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    {{ $banners->links() }}
@endsection
