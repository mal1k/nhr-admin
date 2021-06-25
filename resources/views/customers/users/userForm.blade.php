@extends ('layout')

@section('title', isset($user) ?  'Update '.$user->name : 'User create')

@section('content')
<div class="my-3">
<a class="text-decoration-none text-dark" href="{{ route('users.index') }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: -3px;margin-right: -3px;"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg>
    Back
</a>
</div>
<form method="POST"
    @if ( isset($user) )
        action="{{ route('users.update', $user) }}"
    @else
        action="{{ route('users.store') }}"
    @endif

    class="row row-cols-lg-auto g-3 align-items-center">
  @csrf
  @isset($user)
    @method('PUT')
  @endisset
  <div class="col-12">
    <label class="visually-hidden" for="inlineFormInputGroupUsername">Login</label>
    <div class="input-group">
      <div class="input-group-text">Login</div>
      <input name="name" type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Login" value="{{ isset( $user ) ? $user->name : '' }}">
    </div>
  </div>
  <div class="col-12">
    <label class="visually-hidden" for="inlineFormInputGroupEmail">Email</label>
    <div class="input-group">
      <div class="input-group-text">Email</div>
      <input name="email" type="text" class="form-control" id="inlineFormInputGroupEmail" placeholder="Email" value="{{ isset( $user ) ? $user->email : '' }}">
    </div>
  </div>

  <div class="col-12">
    <label class="visually-hidden" for="inlineFormSelectPref">Choose role</label>
    <select name="role" class="form-select" id="inlineFormSelectPref">
      <option @if ( isset( $user ) ) @if ($user->role === 'User' ) selected @endif @endif @if (empty($user->role) ) selected @endif value="User">User</option>
      <option @if ( isset( $user ) ) @if ($user->role === 'Moderator' ) selected @endif @endif value="Moderator">Moderator</option>
      <option @if ( isset( $user ) ) @if ($user->role === 'Admin' ) selected @endif @endif value="Admin">Administrator</option>
    </select>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">{{ isset( $user ) ? 'Update user' : 'Create user' }}</button>
    <form method="POST" action="{{ route('users.destroy', $user) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
  </div>
</form>
@endsection
