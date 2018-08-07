<div id="modal-value-creator-{{ $name }}" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">{{ $name }}</p>
      <button class="delete" aria-label="close" onclick="var el = document.getElementById('modal-value-creator-{{ $name }}');
        el.className = 'modal'"></button>
    </header>
    <section class="modal-card-body">
      <ul>
        @foreach($valueCreatorExplanations as $vce)
          @if($vce->nominee === $name)
            <li>{{ $vce->explanation_value_creator }}</li>
          @endif
        @endforeach
      </ul>
    </section>
  </div>
</div>
