/**
 * Custom JavaScript file for the Rewards and Recognition app
 * @author Eleirold Asuncion <emasuncion.dev@gmail.com>
 */

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

  // Add vote
  // Value Creator
  $('.add-vote-vc').click(function (e) {
    e.preventDefault();
    var nominee = $(this).parent().prev().prev().attr('data-id');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/addVote/',
      data: {
        nominee: nominee,
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
          window.location.reload();
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
    var nominee = $(this).parent().prev().prev().attr('data-id');
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
          window.location.reload();
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
    var nominee = $(this).parent().prev().prev().attr('data-id');
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
          window.location.reload();
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

  $('.admin-delete-icon').click(function (e) {
    e.preventDefault();
    $this = $(this);
    let id = $this.parent().prev().prev().prev().attr('id');
    let user = $this.parent().prev().prev().prev().text();

    swal({
      title: 'Are you sure?',
      text: user + ' will be permanently deleted in our record.',
      icon: 'warning',
      buttons: {
        cancel: 'No, don\'t delete!',
        submit: {
          text: 'Yes please!',
          value: 'delete',
        }
      },
    })
    .then((value) => {
      switch (value) {
        case 'delete':
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/deleteUser/',
            data: {
              userId: id
            },
            success: function (result) {
              swal({
                title: "Awwwww!",
                text: user + ' successfully deleted in our records.',
                icon: "success",
                button: "Okay",
              })
              .then(results => {
                $('.modal').removeClass('is-active');
                location.reload();
              });
            },
            error: function (result) {
              swal("Ooops!", "Sorry, something went wrong deleting user", "error");
            }
          });
          break;
        default:
          swal('Oh yiiis!', user + ' is not deleted!', 'success');
      }
    });
  });

  $('.admin-voting').click(function(e) {
    e.preventDefault();
    $this = $(this);
    let id = $this.attr('id');
    let stat = id === "0" ? 'on' : 'off';
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/admin/turnVote',
      data: {
        id: id
      },
      success: function (result) {
        swal({
          title: "Successfully turned " + stat + " the voting!",
          text: "Users can now start to vote.",
          icon: "success",
          button: "Yisss.",
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

  // Award forward add
  $('.award-forward-add').click(function(e) {
    e.preventDefault();
    $this = $(this);
    $('#modal-award-forward').addClass('is-active');
  });

  if ($('#modal-award-forward').hasClass('is-active')) {
    $('.award-forward-add').click(function(e) {
      e.preventDefault();
      $this = $(this);
      $('#modal-award-forward').removeClass('is-active');
    });
  }
});
