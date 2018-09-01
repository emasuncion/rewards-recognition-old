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
  $('tr.nominees > td').click(function(e) {
    e.preventDefault();
    let up = $('.fa-caret-up');
    let down = $('.fa-caret-down');

    if (down.is(':visible')) {
      down.hide();
      down.next('.fa-caret-up').show();
    } else {
      up.hide();
      up.prev('.fa-caret-down').show();
    }
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
    var voted = $(this).parent().prev().prev().text();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/addVote/',
      data: {
        nominee: voted,
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
    var nominee = $(this).parent().prev().prev().text();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/addVote/',
      data: {
        nominee: nominee,
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
    var nominee = $(this).parent().prev().prev().text();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/addVote/',
      data: {
        nominee: nominee,
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

  $('.change-role').change(function (e) {
    e.preventDefault();
    let userId = $(this).parent().parent().prev().attr('id');
    let checked = $(this).is(':checked');

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/admin/changeRole/',
      data: {
        isAdmin: checked,
        userId: userId
      },
      success: function (result) {
        swal({
          title: "Successfully changed the Role!",
          icon: "success",
          button: "Okay",
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

  $('.change-quarter').change(function (e) {
    e.preventDefault();
    let checkCounter = $('.change-quarter:checked').length;
    let active = $(this).is(':checked');
    let quarter = $(this).attr('id');

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/admin/changeQuarter/',
      data: {
        quarter: quarter,
        active: active,
        checkCounter: checkCounter
      },
      success: function (result) {
        if (result.success === 'true') {
          swal({
            title: "Successfully turned on/off the Quarter!",
            icon: "success",
            button: "Okay",
          })
          .then(results => {
            $('.modal').removeClass('is-active');
            // location.reload();
          });
        } else {
          swal({
            title: "Sorry, you cannot select two quarters at the same time.",
            icon: "error",
            button: "Awww",
          })
          .then(results => {
            $('.modal').removeClass('is-active');
            $('.switch > #' + quarter).prop('checked', false);
          });
        }
      },
      error: function (result) {
        swal("Ooops!", "Sorry, something went wrong", "error");
      }
    });
  });

});
