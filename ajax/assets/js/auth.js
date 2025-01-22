jQuery(function ($) {
  $("form#profile-form").on("submit", function (e) {
    e.preventDefault();

    var button = $(this).find('button[type="submit"]');
    button.attr("disabled", "disabled");

    $.post(
      simpleAuthAjax.ajax_url,
      $(this).serialize() + "&_wpnonce=" + simpleAuthAjax.nonce,
      function (response) {
        if (response.success) {
          $("#profile-update-mesasage")
            .html(response.data.message)
            .removeClass("hidden");

          setTimeout(function () {
            $("#profile-update-mesasage").addClass("hidden");
          }, 4000);

          button.removeAttr("disabled");
        }
      }
    );
  });
  $("form#simple-auth-login-form").on("submit", function (e) {
    e.preventDefault();

    var button = $(this).find('button[type="submit"]');
    button.attr("disabled", "disabled");

    wp.ajax.post("simple-auth-login-form", $(this).serialize())
      .done(function (response) {
        $("#login-message")
          .html(response.message)
          .removeClass("hidden")
          .removeClass("error-message")
          .addClass("success-message");

        setTimeout(function () {
          window.location.reload();
        }, 2000);
      })
      .fail(function (error) {
        $("#login-message")
          .html(error.message)
          .removeClass("hidden")
          .addClass("error-message");

        button.removeAttr("disabled");
      });
  });
});
