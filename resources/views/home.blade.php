@extends('default.default')

@section('default-body')
<div class="row justify-content-center">
  <div class="col-md-10">
    <div class="welcome-message">
      <div class="mb-4">
        <p class="h3">A chance to be acknowledged; a chance to commend fellow colleagues.</p>
        <p style="text-align: center;">Recognize efforts by participating on our online nomination and voting board.</p>
        <br/>

      <div style="text-align: center">
        <p><u>You may:</u></p>
        <p>Nominate to count as one vote.</p>
        <p>Nominate to add more points of recognition.</p>
        <p>Vote for a colleague whom is already nominated for you. </p>
      </div>

        <p class="mb-2"><strong>Categories:</strong></p>
        <ol>
          <li>
            <strong>People Developer</strong>
            <ul>
              <li>Individual that exemplify leadership skill of developing other people to do better job as well as continuously improving oneself technically and functionally in the organization.</li>
              <li>Being able to recognize achievements and contributions within the team.</li>
            </ul>
          </li>

          <li>
            <strong>Value Creator</strong>
            <ul>
              <li>Individual that exemplify improvements to delivery outcomes and continuously achieving higher client satisfaction on the delivery.</li>
              <li>Being able to provide continuous improvement and sustainable process changes within the team.</li>
            </ul>
          </li>

          <li>
            <strong>Business Operator</strong>
            <ul>
              <li>Individual that exemplify Delivery Excellence and meet schedule and budget on time.</li>
            </ul>
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
  <div class="row justify-content-center">
    <div class="default-card-vote card vote-card col-md-6">
      <div class="card-header">
        <p class="title vote-title">
          @if(!auth()->user()->voted())
            Actions
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
                <a href="/nominate" class="button is-primary">
                  Nominate
                </a>
                <a href="/vote" class="button is-link">
                  Vote
                </a>
              @else
                <p>Thank you for voting!</p>
              @endif
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
