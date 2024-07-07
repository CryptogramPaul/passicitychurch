$(document).ready( function () {
    $("#loginForm").on("submit", function (e) {
      e.preventDefault();
      Login();
      return false;
    });

   $("#signUpForm").on("submit", function (e) {
      e.preventDefault();
      SignUp();
      return false;
  });

});
function SignUp() {
  let firstname = $("#firstname").val();
  let middlename = $("#middlename").val();
  let lastname = $("#lastname").val();
  let contact_no = $("#contact_no").val();
  let email = $("#email_add").val();
  let barangay = $("#barangay").val();
  let municipality = $("#municipality").val();
  let province = $("#province").val();
  let username = $("#username").val();
  let password = $("#password").val();

  $.post(
    "actions/save-signup.php",
    {
      firstname: firstname,
      middlename: middlename,
      lastname: lastname,
      contact_no: contact_no,
      email: email,
      barangay: barangay,
      municipality: municipality,
      province: province,
      username: username,
      password: password,
    },
    function (data) {
      if (jQuery.trim(data) == "success") {
        $("#sign_up_modal").modal("hide");
        toastAlert("success", "Successfully Saved");
      } else {
        toastAlert("warning", data);
      }
    }
  );
}

function Login() {
  const username = $("#login_username").val();
  const password = $("#login_password").val();

  $.post(
    "actions/login-action.php",
    {
      username: username,
      password: password,
    },
    function (data) {
      if (jQuery.trim(data) == "success") {
        toastAlert("success", data);
        window.location.href = "index.php";
      } else {
        toastAlert("warning", data);
      }
    }
  );
}

function Logout() {
  $.post("actions/logout.php", {}, function (data) {
    if (jQuery.trim(data) == "success") {
      window.location.href = "index.php";
    } else {
      toastAlert("warning", data);
    }
  });
}
