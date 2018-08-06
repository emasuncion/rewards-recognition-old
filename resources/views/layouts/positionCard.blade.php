@foreach($positions as $position)
<div class="col-sm">
  <div class="card">
    <div class="card-content">
      <p class="title admin-cards-header">
        {{ $position }}
      </p>
    </div>
    <footer class="card-footer">
      <p class="card-footer-item">
        <span>
          View <a href="#">results</a>
        </span>
      </p>
    </footer>
  </div>
</div>
@endforeach
