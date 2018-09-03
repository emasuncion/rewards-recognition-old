<div class="modal" id="modal-award-forward">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">
        {{ auth()->user()->first_name }}, please enter the details.
      </p>
      <button class="delete" aria-label="close" onclick="var el = document.getElementById('modal-award-forward');
      el.className = 'modal'"></button>
    </header>
    <section class="modal-card-body">
      <div class="card-content">
        <div class="content">
          <form action="awardForward/add" method="POST">
            @csrf
            <div class="form-group row">
              <label for="nominee" class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>

              <div class="col-md-6">
                <select class="award-forward-users" name="nominee">
                  <option disabled id="default" selected>--- Please select ---</option>
                  @foreach($users as $user)
                    <option id="{{ $user->id }}">{{$user->first_name . ' ' . $user->last_name }} </option>
                  @endforeach
                </select>
                @if ($errors->has('nominee'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nominee') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

              <div class="col-md-6">
                <textarea id="description" rows="15" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required></textarea>

                @if ($errors->has('description'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('description') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
  </section>
  </div>
</div>
