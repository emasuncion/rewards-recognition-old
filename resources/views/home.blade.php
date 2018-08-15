@extends('default.default')

@section('default-body')
<div class="row justify-content-center">
  <div class="col-md-10">
    <div class="welcome-message">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac mauris porttitor, cursus nibh a, blandit enim. Curabitur non augue libero. Nullam a ex lacinia, volutpat nunc ut, blandit diam. Morbi et ex luctus, lacinia velit at, bibendum ligula. Fusce convallis ullamcorper libero vitae mattis. Aliquam aliquet commodo mauris, et ornare ipsum auctor quis. In non nisi quis odio pellentesque interdum quis ut ex. Pellentesque egestas pharetra dui vel volutpat. Donec rhoncus malesuada dictum. Maecenas a orci ex. Suspendisse suscipit velit tellus, nec imperdiet mauris bibendum eget. Pellentesque id diam quis odio elementum fringilla. Suspendisse ut posuere dolor, nec tempor dolor. Nulla facilisi.</p>

      <p>Quisque malesuada sit amet mauris sed sagittis. Donec tempor nulla vel nulla mattis, non tincidunt mauris pellentesque. Cras tempus lorem et dignissim semper. Aenean iaculis, ex sed facilisis facilisis, quam purus imperdiet urna, eget eleifend justo magna et risus. Donec eu porta odio. In gravida placerat erat, non varius sem rutrum vel. Pellentesque maximus ullamcorper velit sed ornare. Mauris efficitur rutrum ante eget cursus. Fusce consequat est in massa egestas auctor. Vestibulum magna velit, dignissim sed erat nec, pharetra viverra nibh. Ut suscipit sem non egestas venenatis. Ut vulputate, mauris quis lacinia rutrum, felis lectus pharetra turpis, in euismod elit augue sed leo.</p>

      <p>Phasellus interdum tellus erat, eu luctus ipsum suscipit posuere. In vel suscipit libero. Integer tincidunt convallis velit, nec porttitor est pretium non. Sed volutpat viverra iaculis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque ornare mattis viverra. Mauris varius vel libero ac commodo. Nulla ut feugiat tellus, a luctus ipsum.</p>
    </div>
  </div>
</div>
  <div class="row justify-content-center">
    <div class="default-card-vote card vote-card col-md-6">
      <div class="card-header">
        <p class="title vote-title">
          @if(!auth()->user()->voted())
            Vote now
          @else
            Thank you for voting
          @endif
        </p>
      </div>
      <footer class="card-content">
        <p class="card-footer-item">
          <span>
            @if(auth()->user()->votingOpen())
              @if(!auth()->user()->voted())
              <a href="/vote" class="button is-link">
                Start voting
              </a>
              <a href="/nominate" class="button is-primary">
                Nominate
              </a>
              @endif
              <a href="/results/partial" class="button is-warning">
                See partial results
              </a>
            @else
              <a href="/results/submitted" class="button is-success">
                See results
              </a>
            @endif
          </span>
        </p>
      </footer>
    </div>
  </div>
@endsection
