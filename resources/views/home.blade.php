  @extends('default.default')

@section('default-body')
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="welcome-message">
        <div class="mb-4">
          <p class="h3">A chance to be acknowledged; a chance to commend fellow colleagues.</p>
          <div class="body">
            <h1 class="h5" style="text-align: center;">What is Rewards vs. Recognition (R&R)</h1>
            <p class="mb-2">
              <strong>Rewards</strong> are items such as: gift cards, cash, or perks such as time off or discounts earned through receiving recognition or achieving your goals within an incentive program while <strong>Recognition</strong> is a discretionary act to recognize something great that might come in the form of a social posting, an e-card, a physical note or greeting card, a verbal "thank you," etc.
            </p>

            <p class="mt-2">
              Rewards is also called Monetary award while Recognition is not.
            </p>

            <p class="mt-2 mb-4">
              In the Education platform, both Rewards and Recognition are practiced as one a means to promote people engagement and appreciation to one's contribution to the group.
            </p>
          </div>

        <div style="text-align: center">
          <p><u>You may:</u></p>
          <p>Nominate anyone as much as you want during nomination period.</p>
          <p>Run through all explanations and cast 3 votes per category during voting period.</p>
        </div>

          <p class="mb-2"><strong>Categories:</strong></p>
          <ol>
            <li>
              <strong>Value Creator</strong>
              <ul>
                <li>Individual that exemplify improvements to delivery outcomes and continuously achieving higher client satisfaction on the delivery.</li>
                <li>Being able to provide continuous improvement and sustainable process changes within the team.</li>
              </ul>
            </li>

            <li>
              <strong>People Developer</strong>
              <ul>
                <li>Individual that exemplify leadership skill of developing other people to do better job as well as continuously improving oneself technically and functionally in the organization.</li>
                <li>Being able to recognize achievements and contributions within the team.</li>
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
    <div class="default-card-vote card col-md-5 mr-4">
      <div class="card-header">
        <p class="title award-forward-title">Recognize others</p>
      </div>
      <footer class="card-content">
        <p class="card-footer-item">
          <span>
            <a href="/awardForward" class="button is-link">Award it forward!</a>
          </span>
        </p>
      </footer>
    </div>

    @if(auth()->user()->quarterOpen())
    <div class="default-card-vote card vote-card col-md-5">
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
            @if(auth()->user()->nominationOpen() && (auth()->user()->type !== 3))
              <a href="/nominate" class="button is-primary">
                Nominate
              </a>
            @elseif(auth()->user()->votingOpen())
              @if(!auth()->user()->voted() && (auth()->user()->type !== 3))
                <a href="/vote" class="button is-warning">
                  Vote
                </a>
              @else
              <a href="/results/partial" class="button is-dark">
                See partial results
              </a>
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

    {{-- Nominations Card --}}
      @if(auth()->user()->nominationOpen())
        <div class="default-card-vote card vote-card col-md-5 mt-4">
          <div class="card-header">
            <p class="title vote-title">
              My Nominations
            </p>
          </div>
          <footer class="card-content">
            <p class="card-footer-item">
              <span>
                <a href="/myNominations" class="button is-warning">
                  View
                </a>
              </span>
            </p>
          </footer>
        </div>
      @endif
    @endif
  </div>
@endsection
