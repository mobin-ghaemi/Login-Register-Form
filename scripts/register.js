const registerForm = $("form#register"),
  loginLink = $("a#forgetPassword");

registerForm.submit((e) => {
  e.preventDefault();

  const info = JSON.stringify(registerForm.serializeArray());
  const url = `server/register.php?register=${info}`;

  fetch(url)
    .then((response) => response.json())
    .then((response) => {
      var notification = alertify.notify(
        response.data,
        "error",
        2,
        function () {
          console.log("dismissed");
        }
      );
    });
});

loginLink.click((_) => {
  location.assign("./pages/login.html");
});
