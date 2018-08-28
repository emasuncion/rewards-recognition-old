<div class="modal" id="modal-settings-reset">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">
        {{ auth()->user()->first_name }}, do you want to reset all votes?
      </p>
      <button class="delete" aria-label="close" onclick="var el = document.getElementById('modal-settings-reset');
      el.className = 'modal'"></button>
    </header>
    <section class="modal-card-body">
      <div class="card-content">
        <div class="content">
          Resetting the votes will let users to vote again.
        </div>
      </div>
      <footer class="card-footer">
        <a id="reset-votes" class="card-footer-item">Reset</a>
      </footer>
  </section>
  </div>
</div>
