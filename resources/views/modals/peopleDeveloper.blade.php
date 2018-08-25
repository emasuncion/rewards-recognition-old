<div id="modal-people-developer-{{ $name }}" class="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">{{ $name }}</p>
      <button class="delete" aria-label="close" onclick="var el = document.getElementById('modal-people-developer-{{ $name }}');
        el.className = 'modal'"></button>
    </header>
    <section class="modal-card-body">
      <ul>
        @foreach($peopleDeveloperNominations as $pde)
          @if($pde->nominee === $name)
            <li>{{ $pde->explanation_people_developer }}</li>
          @endif
        @endforeach
      </ul>
    </section>
  </div>
</div>
