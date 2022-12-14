$(document).ready(function () { 
$('.closefirstmodal').click(function () {
      $('#WarningModal').on('show.bs.modal', function () {
            $('.confirmclosed').click(function () {
                  $('#WarningModal').modal('hide');
                  $('#exampleModal').modal('hide');
                  window.location = window.location;
            });
      }).modal('show');

});

});