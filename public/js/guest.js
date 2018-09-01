$(document).ready(function() {
  $('.change-guest').change(function (e) {
    e.preventDefault();
    $this = $(this);
    let checker = $this.parent().parent().prev().find('.change-role').is(':checked');
    let active = $this.is(':checked');
    let userId = $this.parent().parent().prev().prev().attr('id');

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/admin/changeGuest/',
      data: {
        userId: userId,
        active: active,
        checker: checker
      },
      success: function (result) {
        if (result.success === 'true') {
          swal({
            title: "Successfully changed the role to Guest!",
            icon: "success",
            button: "Yahoooo!",
          })
          .then(results => {
            $('.modal').removeClass('is-active');
            location.reload();
          });
        } else {
          swal({
            title: "There seems to be a problem changing the user type right now.",
            icon: "error",
            button: "Oh nooo",
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
