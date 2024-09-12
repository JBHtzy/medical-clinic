$(document).ready(function () {
  $("#userdropdown").click(function () {
    if ($(".usermodal").slideToggle()) {
      $(this).addClass("display", "none");
    } else {
      $(this).addClass("display", "block");
    }
  });
  $("#notif-dropdown").click(function () {
    if ($(".notifbell").slideToggle()) {
      $(this).addClass("display", "none");
    } else {
      $(this).addClass("display", "block");
    }
  });
});
