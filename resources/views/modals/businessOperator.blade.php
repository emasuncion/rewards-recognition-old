<div id="modal-business-operator-{{ $name }}" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">{{ $name }}</p>
      <button class="delete" aria-label="close" onclick="var el = document.getElementById('modal-business-operator-{{ $name }}');
        el.className = 'modal'"></button>
    </header>
    <section class="modal-card-body">
      <ul>
        @foreach($businessOperatorExplanations as $boe)
          @if($boe->nominee === $name)
            <li>{{ $boe->explanation_business_operator }}</li>
          @endif
        @endforeach
      </ul>
    </section>
  </div>
</div>
