@extends('admin.settings')

@section('settings-voting')
  @php
    $value = auth()->user()->votingOpen() ? 'open': 'closed';
  @endphp
  <span class="voting-status-text">Voting is currently {{ $value }}</span>
  <a class="button is-success is-rounded" href="/" onclick="event.preventDefault();
    var el = document.getElementById('modal-settings-vote');
    el.className += ' is-active'">
    Change
  </a>
  @include('modals.voting')
@endsection

@section('settings-reset-voters')
  <a class="button is-danger is-rounded" href="/" onclick="event.preventDefault();
    var el = document.getElementById('modal-settings-reset');
    el.className += ' is-active'">
    Reset all votes
  </a>
  @include('modals.reset')
@endsection

@section('settings-manage-users')
  <table>
    <tr>
        <td><h6>Active Member/s</h6></td>
        <td><h6>Admin</h6></td>
        <td style="text-align: center;"><h6>Delete</h6></td>
    </tr>
    @foreach($users as $user)
    <tr>
      <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
      @php
        $checked = $user->type === 1 ? 'checked' : '';
      @endphp
      <td>
        <label class="switch">
          <input class="admin-checkbox" type="checkbox" {{ $checked }}>
          <span class="slider round"></span>
        </label>
      </td>
      <td class="admin-delete-td">
        <i class="far fa-trash-alt admin-delete-icon"></i>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $users->links() }}
@endsection

@section('settings-add-member')
  <div class="container">
    <div class="row">
      <div class="col-md-8">
            <form method="POST" action="addMember">
                @csrf

              <div class="form-group row">
                <label for="firstName" class="col-md-2 col-form-label">{{ __('First name') }}</label>

                <div class="col-md-6">
                    <input id="firstName" type="text" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName" value="{{ old('firstName') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('firstName') }}</strong>
                        </span>
                    @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="lastName" class="col-md-2 col-form-label">{{ __('Last name') }}</label>

                <div class="col-md-6">
                    <input id="lastName" type="text" class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName" value="{{ old('lastName') }}" required autofocus>

                    @if ($errors->has('lastName'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('lastName') }}</strong>
                        </span>
                    @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="username" class="col-md-2 col-form-label">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                    @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-2 col-form-label">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-2 col-form-label">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="password-confirm" class="col-md-2 col-form-label">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
              </div>

              <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                          {{ __('Register') }}
                      </button>
                  </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
