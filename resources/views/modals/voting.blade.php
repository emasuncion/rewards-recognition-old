<div class="modal" id="modal-settings-vote">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">
        {{ auth()->user()->name }}, do you want to open or close the voting?
        <button class="delete" aria-label="close" onclick="var el = document.getElementById('modal-settings-vote');
        el.className = 'modal'"></button>
      </p>
    </header>
    <section class="modal-card-body">
      <div class="card-content">
        <div class="content">
          Select <i>On</i> to open the nominations, <i>Off</i> to close the nominations.
        </div>
      </div>
      <footer class="card-footer">
        @if(!auth()->user()->votingOpen())
          <a id="vote-on" class="card-footer-item">Open</a>
        @else
          <a id="vote-off" class="card-footer-item">Close</a>
        @endif
      </footer>
    </section>
  </div>
</div>
