@foreach($tools as $tool)
<div class="col-sm">
  <div class="card">
    <div class="card-content">
      <p class="title admin-cards-header">
        {{ $tool }}
        @php
          $view = strtolower($tool);
        @endphp
        @if($view === 'voters')
          <i class="far fa-check-square"></i>
        @elseif($view === 'results')
          <i class="fas fa-clipboard-list"></i>
        @else
          <i class="far fa-chart-bar"></i> <i class="soon">(Soon)</i>
        @endif
      </p>
    </div>
    <footer class="card-footer">
      <div class="control">
        @if($view === 'graph')
          <a class="button is-success" disabled>
            View {{ $view }}
          </a>
        @else
          <a class="button is-success" href="/{{ $view }}">
            View {{ $view }}
          </a>
        @endif
      </div>
    </footer>
  </div>
</div>
@endforeach
