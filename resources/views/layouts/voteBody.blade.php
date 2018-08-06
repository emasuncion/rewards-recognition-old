<div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Nominee</label>
  </div>
  <div class="field-body">
    <div class="field is-narrow">
      <div class="control">
        <div class="select is-fullwidth">
          <select name="nominee_{{ $shorthand }}">
            <option disabled id="default" selected>--- Please select ---</option>
            @foreach($employees as $employee)
              <option id="{{ $employee->id }}">{{$employee->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Explanation</label>
  </div>
  <div class="field-body">
    <div class="field">
      <div class="control">
        <textarea name="explanation_{{ $shorthand }}" class="textarea" placeholder="Give a brief description for your nominee for the position {{ $position }}"></textarea>
      </div>
    </div>
  </div>
</div>
