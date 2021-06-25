@extends ('layout')

@section('title', 'User create')

@section('content')
<form method="POST" action="{{ route('users.store') }}" class="row row-cols-lg-auto g-3 align-items-center">
  @csrf
  <div class="col-12">
    <label class="visually-hidden" for="inlineFormInputGroupUsername">Login</label>
    <div class="input-group">
      <div class="input-group-text">Login</div>
      <input name="name" type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Login">
    </div>
  </div>
  <div class="col-12">
    <label class="visually-hidden" for="inlineFormInputGroupEmail">Email</label>
    <div class="input-group">
      <div class="input-group-text">Email</div>
      <input name="email" type="text" class="form-control" id="inlineFormInputGroupEmail" placeholder="Email">
    </div>
  </div>

  <div class="col-12">
    <label class="visually-hidden" for="inlineFormSelectPref">Choose role</label>
    <select name="role" class="form-select" id="inlineFormSelectPref">
      <option selected value="User">User</option>
      <option value="Moderator">Moderator</option>
      <option value="Admin">Administrator</option>
    </select>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Create user</button>
  </div>
</form>
@endsection
