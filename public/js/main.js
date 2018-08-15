/**
 * Custom JavaScript file for the Rewards and Recognition app
 * @author Eleirold Asuncion <emasuncion.dev@gmail.com>
 */

function checkIfDoneVoting() {
  if ($('.add-vote-vc').is(':hidden') && $('.add-vote-pd').is(':hidden') && $('.add-vote-bo').is(':hidden')) {
    return true;
  }
}

$(document).ready(function () {
  // Turn on the voting AJAX request
  $('#vote-on').click(function (e) {
    e.preventDefault();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/settings/on/',
      data: {
        isvotingOpen: 1
      },
      success: function (result) {
        swal({
          title: "Voting is now open!",
          text: "Users can now start voting",
          icon: "success",
          button: "Aww yiss!",
        })
        .then(results => {
          $('.modal').removeClass('is-active');
          location.reload();
        });

      },
      error: function (result) {
        swal("Ooops!", "Sorry, something went wrong", "error");
      }
    })
  });

  // Turn off the voting AJAX request
  $('#vote-off').click(function (e) {
    e.preventDefault();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/settings/off/',
      data: {
        isvotingOpen: 0
      },
      success: function (result) {
        swal({
          title: "Voting is now closed!",
          text: "Users can't access voting now",
          icon: "success",
          button: "Ok",
        })
        .then(results => {
          $('.modal').removeClass('is-active');
          location.reload();
        });
      },
      error: function (result) {
        swal("Ooops!", "Sorry, something went wrong", "error");
      }
    })
  });

  // Reset the votes
  $('#reset-votes').click(function (e) {
    e.preventDefault();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/settings/reset/',
      data: {
        voted: 0
      },
      success: function (result) {
        swal({
          title: "Votes are now reset!",
          text: "Users can vote again!",
          icon: "success",
          button: "Aww yiss!",
        })
        .then(results => {
          $('.modal').removeClass('is-active');
          location.reload();
        });
      },
      error: function (result) {
        swal("Ooops!", "Sorry, something went wrong", "error");
      }
    });
  });

  // Add vote
  // Value Creator
  $('.add-vote-vc').click(function (e) {
    e.preventDefault();
    var voted = $(this).parent().prev().text();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/addVote/',
      data: {
        nominee: voted,
        data: null,
        position: 'value-creator'
      },
      success: function (result) {
        swal({
          title: "Voted!",
          icon: "success",
          button: "Aww yiss!",
        })
        .then(results => {
          $('.modal').removeClass('is-active');
          $('.add-vote-vc').hide();
          let done = checkIfDoneVoting();
          if (done) {
            window.location.href = '/admin';
          }
        });
      },
      error: function (result) {
        swal("Ooops!", "Sorry, something went wrong", "error");
      }
    });
  });
  // People Developer
  $('.add-vote-pd').click(function (e) {
    e.preventDefault();
    var voted = $(this).parent().prev().text();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/addVote/',
      data: {
        nominee: voted,
        data: null,
        position: 'people-developer'
      },
      success: function (result) {
        swal({
          title: "Voted!",
          icon: "success",
          button: "Aww yiss!",
        })
        .then(results => {
          $('.modal').removeClass('is-active');
          $('.add-vote-pd').hide();
          let done = checkIfDoneVoting();
          if (done) {
            window.location.href = '/admin';
          }
        });
      },
      error: function (result) {
        swal("Ooops!", "Sorry, something went wrong", "error");
      }
    });
  });
// Business Operator
  $('.add-vote-bo').click(function (e) {
    e.preventDefault();
    var voted = $(this).parent().prev().text();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/addVote/',
      data: {
        nominee: voted,
        data: null,
        position: 'business-operator'
      },
      success: function (result) {
        swal({
          title: "Voted!",
          icon: "success",
          button: "Aww yiss!",
        })
        .then(results => {
          $('.modal').removeClass('is-active');
          $('.add-vote-bo').hide();
          let done = checkIfDoneVoting();
          if (done) {
            window.location.href = '/admin';
          }
        });
      },
      error: function (result) {
        swal("Ooops!", "Sorry, something went wrong", "error");
      }
    });
  });

<<<<<<< HEAD
  // Add ajax call here
  $('.admin-checkbox').change(function () {
    // todo code for ajax call
  });
=======
>>>>>>> 77a4a0ad9620b3f82210a6b5f37cabe80a07990d
});
