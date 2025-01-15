$(document).ready(function () {
  $("#loginForm").on("submit", function (e) {
    e.preventDefault();
    Login();
    return false;
  });

  $("#signUpForm").on("submit", function (e) {
    e.preventDefault();
    if ($("#UserModal").attr("operation") == 0) {
      SignUp();
    } else {
      Update();
    }
    return false;
  });

  $("#verificationForm").on("submit", function (e) {
    e.preventDefault();
    VerifyEmail();
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

  btnSpinner(true, 'signUpBtn', 'Please Wait...');
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
        toastAlert(
          "success",
          "Successfully Saved. <br/> Register Successfully, OTP sent to " +
            email
        );
        $("#verification_modal").modal("show");
        // setTimeout(function () {
          //   location.reload();
          // }, 2000);
        } else {
          toastAlert("warning", data);
        }
        btnSpinner(false, 'signUpBtn', 'Sign Up');
    }
  );
  // $("#sign_up_modal").modal("hide");
  // $("#verification_modal").modal("show");
}

function VerifyEmail(){
  const verification_code = $("#verification_code").val();

  btnSpinner(true, 'verifyBtn', 'Please Wait...');
  $.post(
    "actions/verification-action.php",
    {
       verification_code:  verification_code,
    },
    function (data) {
      if (jQuery.trim(data) == "success") {
        $("#verification_modal").modal("hide");
        toastAlert("success", 'Email successfully verified.');
        $("#login_modal").modal("show");
      } else {
        toastAlert("warning", data);
      }
      btnSpinner(false, 'verifyBtn', 'Verify');
    }
  );
}

function Update() {
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
    "actions/update-profile.php",
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
        setTimeout(function () {
          location.reload();
        }, 2000);
      } else {
        toastAlert("warning", data);
      }
    }
  );
}
function Login() {
  const username = $("#login_username").val();
  const password = $("#login_password").val();
  
  // const loginBtn = document.getElementById('loginBtn');
  // const spinner = document.getElementById('spinner');
  // const btnText = document.getElementById('btnText');

  // loginBtn.disabled = true;
  // spinner.style.display = 'inline-block'; // Show spinner
  // btnText.textContent = 'Login...';

  btnSpinner(true, 'loginBtn', 'Login...');

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
      btnSpinner(false, 'loginBtn', 'Login');
      // setTimeout(() => {
      //   loginBtn.disabled = false;
      //   spinner.style.display = 'none'; // Hide spinner
      //   btnText.textContent = 'Login';
      // }, 3000);
    
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
