$(document).ready(function() {
  $('select.select-nomination').change(function (e) {
    e.preventDefault();
    $this = $(this);
    let $id = $this.attr('id');
    let $name = $this.attr('name');
    let explanation = 'explanation';

    if ($id !== 'default') {
      let replaced = $name.replace('nominee', explanation);
      $('textarea[name="' + replaced + '"]').attr('required', true);
    }
  });
});
