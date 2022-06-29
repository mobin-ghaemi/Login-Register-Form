const loginForm = $("form#login"),
  registerLink = $("a#forgetPassword");

console.log(loginForm);

loginForm.submit((e) => {
  e.preventDefault();

  console.log("yes");
  const info = JSON.stringify(loginForm.serializeArray());
  const url = `../server/login.php?login=${info}`;

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

registerLink.click((_) => {
  location.assign("../index.html");
});
