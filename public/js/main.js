/**
 * Custom JavaScript file for the Rewards and Recognition app
 * @author Eleirold Asuncion <emasuncion.dev@gmail.com>
 */
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
});
