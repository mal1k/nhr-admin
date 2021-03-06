@extends ('new-layout')

@section('title', 'Users')

@section('content')

<div class="my-3">
    <a class="text-decoration-none text-dark" href="{{ route('users.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: -3px;margin-right: -3px;"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
        Back
    </a>
</div>

<div class="card mb-5 mb-xl-8 p-10">
    <!--begin::Body-->

    <form method="POST"
        @if ( isset($user) )
            action="{{ route('users.update', $user) }}"
        @else
            action="{{ route('users.store') }}"
        @endif>
    @csrf
    @isset($user)
        @method('PUT')
    @endisset
    <div class="mb-2">
        <label class="form-label">Login</label>
        <input name="name" type="text" class="form-control" value="{{ old('name', isset( $user ) ? $user->name : '') }}">
        @error('name')
            <div class="alert alert-danger mb-0">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-2">
        <label class="form-label">Email</label>
        <input name="email" type="email" class="form-control" value="{{ old('email', isset( $user ) ? $user->email : '') }}">
        @error('email')
            <div class="alert alert-danger mb-0">{{ $message }}</div>
        @enderror
    </div>

    @if ( isset( $user ) && $user->role == 'super-admin' )
        <input name="role" type="hidden" value="{{ $user->role }}">
    @else
        <label class="form-label" for="ChooseRole">Choose role</label>
        <select name="role" class="form-select" id="ChooseRole">
            <option @if ( isset( $user ) )
                    @if ($user->role === 'user' )
                        selected
                    @endif
                    @endif
                    @if (empty($user->role) )
                    selected
                    @endif
                value="user">User</option>

            <option @if ( isset( $user ) )
                    @if ($user->role === 'moderator' )
                        selected
                    @endif
                    @endif
                value="moderator">Moderator</option>

            <option @if ( isset( $user ) )
                    @if ($user->role === 'admin' )
                        selected
                    @endif
                    @endif
                value="admin">Administrator</option>
        </select>
      @endif

    <div class="card-toolbar pt-3">
        <button type="submit" class="btn btn-sm btn-light-primary">
            {{ isset( $user ) ? 'Update user' : 'Create user' }}
        </button>
    </div>
</form>

    @isset ($user)
    <form method="POST" action="{{ route('users.destroy', $user) }}" class="pt-3">
        @csrf
        @method('DELETE')
        @if ( isset( $user ) )
            @if ($user->role !== 'super-admin' )
                <button type="submit" class="btn btn-sm btn-light-danger">
                    Delete
                </button>
            @endif
        @endif
    </form>
    @endisset
    <!--begin::Body-->
</div>

@endsection
