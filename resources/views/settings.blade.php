@extends('admin.settings')

@section('settings-voting')
  <table>
    <tr>
      <td><h6>Quarter</h6></td>
      <td><h6>Active</h6></td>
    </tr>
    @foreach($quarter as $item)
      <tr>
        <td>{{ $item->id }}</td>
        @php
        $checked = $item->active === 1 ? 'checked' : '';
        @endphp
        <td>
          <label class="switch">
            <input id="{{ $item->id }}" class="change-quarter" type="checkbox" {{ $checked }}>
            <span class="slider round"></span>
          </label>
        </td>
      </tr>
    @endforeach
  </table>
@endsection

@section('settings-reset-voters')
  <table>
    <tr>
      <td class="admin-options">
        @php
          $stat = $voting->nominationOpen === 0 ? 'on' : 'off';
        @endphp
        <a id="{{ $voting->nominationOpen }}" href="/admin/turnNomination" class="button is-success admin-nomination">Turn {{ $stat }} nomination</a>
      </td>
      <td class="admin-options">
        @php
          $stat = $voting->votingOpen === 0 ? 'on' : 'off';
        @endphp
        <a id="{{ $voting->votingOpen }}" href="/admin/turnVote" class="button is-success admin-voting">Turn {{ $stat }} voting</a>
      </td>
    </tr>
    <tr>
      <td class="admin-options">
        <a href="/admin/tieBreaker" class="button is-warning admin-tie-breaker">Tie breaker</a>
      </td>
      <td class="admin-options">
        <a disabled href="#" class="button is-info admin-export">Export winners to excel file</a>
      </td>
    </tr>
  </table>
@endsection

@section('settings-manage-users')
  <table>
    <tr>
        <td><h6>Active Member/s</h6></td>
        <td><h6>Admin</h6></td>
        <td><h6>Guest</h6></td>
        <td style="text-align: center;"><h6>Delete</h6></td>
    </tr>
    @foreach($users as $user)
    <tr>
      <td id="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</td>
      @php
        $checkedRole = $user->type === 1 ? 'checked' : '';
        $checkedGuest = $user->type === 3 ? 'checked' : '';
      @endphp
      <td>
        <label class="switch">
          <input class="change-role" type="checkbox" {{ $checkedRole }}>
          <span class="slider round"></span>
        </label>
      </td>
      <td>
        <label class="switch">
          <input class="change-guest" type="checkbox" {{ $checkedGuest }}>
          <span class="slider round"></span>
        </label>
      </td>
      <td class="admin-delete-user">
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
                    <input id="firstName" type="text" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName" value="{{ old('firstName') }}" required>

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
                    <input id="lastName" type="text" class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName" value="{{ old('lastName') }}" required>

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
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

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
