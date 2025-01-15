$(document).ready(function () {
  // SAVE CONTACTS
  $("#FormContactUs").on("submit", function (e) {
    e.preventDefault();
    SaveContactUs();
    return false;
  });

  // SAVE BAPTISM FORM
  $("#BaptismForm").on("submit", function (e) {
    e.preventDefault();

    if ($("#BaptismModal").attr("operation") == 0) {
      SaveBaptismForm();
    } else {
      let baptism_id = $("#BaptismModal").attr("baptism_id");
      UpdateBaptismForm(baptism_id);
    }
    return false;
  });

  // SAVE SACRAMENTS FORM
  $("#SacramentsForm").on("submit", function (e) {
    e.preventDefault();

    if ($("#BurialModal").attr("operation") == 0) {
      SaveBurialForm();
    } else {
      let burial_id = $("#BurialModal").attr("burial_id");
      UpdateBurialForm(burial_id);
    }
    return false;
  });

  // SAVE WEDDING FORM
  $("#WeddingForm").on("submit", function (e) {
    e.preventDefault();

    if ($("#WeddingModal").attr("operation") == 0) {
      SaveWeddingForm();
    } else {
      let wedding_id = $("#WeddingModal").attr("wedding_id");
      UpdateWedding(wedding_id);
    }
    return false;
  });

  $("#IntentionsForm").on("submit", function (e) {
    e.preventDefault();

    if ($("#IntentionsModal").attr("operation") == 0) {
      SaveIntentionsForm();
    } else {
      let intentions_id = $("#IntentionsModal").attr("intentions_id");
      UpdateIntentionsForm(intentions_id);
    }
    return false;
  });
});

function SaveBaptismForm() {
  let child_firstname = $("#child_firstname").val();
  let child_middlename = $("#child_middlename").val();
  let child_lastname = $("#child_lastname").val();
  let placeOfBirth = $("#placeOfBirth").val();
  let dateOfBirth = $("#dateOfBirth").val();
  let father_firstname = $("#father_firstname").val();
  let father_middlename = $("#father_middlename").val();
  let father_lastname = $("#father_lastname").val();
  let mother_firstname = $("#mother_firstname").val();
  let mother_middlename = $("#mother_middlename").val();
  let mother_lastname = $("#mother_lastname").val();
  let baptism_date = $("#baptism_date").val();
  let timeOfBaptism = $("#timeOfBaptism").val();

  let sponsor_arr = [];

  $(".sponsor").each(function (data) {
    let id = $(this).attr("counter");
    let lastname = $("#sponsors_lastname" + id).val();
    let firstname = $("#sponsors_firstname" + id).val();
    let middlename = $("#sponsors_middlename" + id).val();

    sponsor_arr.push({
      id: id,
      lastname: lastname,
      firstname: firstname,
      middlename: middlename,
    });
  });

  let SponsorJson = JSON.stringify(sponsor_arr);

  $.post(
    "actions/save-baptism-form.php",
    {
      child_firstname: child_firstname,
      child_middlename: child_middlename,
      child_lastname: child_lastname,
      dateOfBirth: dateOfBirth,
      placeOfBirth: placeOfBirth,
      father_firstname: father_firstname,
      father_middlename: father_middlename,
      father_lastname: father_lastname,
      mother_firstname: mother_firstname,
      mother_middlename: mother_middlename,
      mother_lastname: mother_lastname,
      baptism_date: baptism_date,
      timeOfBaptism: timeOfBaptism,
      SponsorJson: SponsorJson,
    },
    function (data) {
      if (jQuery.trim(data) == "success") {
        $("#show_baptism").modal("hide");
        toastAlert("success", "Appointment created successfully.");
        ShowTransactionCanvas();
      } else {
        toastAlert("warning", data);
      }
    }
  );
}
function UpdateBaptismForm(id) {
  let child_firstname = $("#child_firstname").val();
  let child_middlename = $("#child_middlename").val();
  let child_lastname = $("#child_lastname").val();
  let placeOfBirth = $("#placeOfBirth").val();
  let dateOfBirth = $("#dateOfBirth").val();
  let father_firstname = $("#father_firstname").val();
  let father_middlename = $("#father_middlename").val();
  let father_lastname = $("#father_lastname").val();
  let mother_firstname = $("#mother_firstname").val();
  let mother_middlename = $("#mother_middlename").val();
  let mother_lastname = $("#mother_lastname").val();
  let baptism_date = $("#baptism_date").val();
  let timeOfBaptism = $("#timeOfBaptism").val();

  let sponsor_arr = [];

  $(".sponsor").each(function (data) {
    let id = $(this).attr("counter");
    let lastname = $("#sponsors_lastname" + id).val();
    let firstname = $("#sponsors_firstname" + id).val();
    let middlename = $("#sponsors_middlename" + id).val();

    sponsor_arr.push({
      id: id,
      lastname: lastname,
      firstname: firstname,
      middlename: middlename,
    });
  });

  let SponsorJson = JSON.stringify(sponsor_arr);

  $.post(
    "actions/update-baptism-form.php",
    {
      child_firstname: child_firstname,
      child_middlename: child_middlename,
      child_lastname: child_lastname,
      dateOfBirth: dateOfBirth,
      placeOfBirth: placeOfBirth,
      father_firstname: father_firstname,
      father_middlename: father_middlename,
      father_lastname: father_lastname,
      mother_firstname: mother_firstname,
      mother_middlename: mother_middlename,
      mother_lastname: mother_lastname,
      baptism_date: baptism_date,
      timeOfBaptism: timeOfBaptism,
      SponsorJson: SponsorJson,
      id: id,
    },
    function (data) {
      if (jQuery.trim(data) == "success") {
        $("#show_baptism").modal("hide");
        toastAlert("success", "Appointment updated successfully.");
        ShowTransactionCanvas();
      } else {
        toastAlert("warning", data);
      }
    }
  );
}

function SaveBurialForm() {
  let dateApplied = $("#dateApplied").val();
  let contactNo = $("#contactNo").val();
  let burial_firstname = $("#burial_firstname").val();
  let burial_middlename = $("#burial_middlename").val();
  let burial_lastname = $("#burial_lastname").val();
  let dateOfBirth = $("#dateOfBirth").val();
  let age = $("#age").val();
  // let gender = $("#gender").val();
  var gender = $('input[name="gender"]:checked').val();
  let address = $("#address").val();
  // let maritalStatus = $("#maritalStatus").val();
  var maritalStatus = $('input[name="maritalStatus"]:checked').val();
  let father = $("#father").val();
  let mother = $("#mother").val();
  let spouse = $("#spouse").val();
  let noOfChildren = $("#noOfChildren").val();
  let childrenAlive = $("#childrenAlive").val();
  let childrenDead = $("#childrenDead").val();
  let personResponsible = $("#personResponsible").val();
  let relationship = $("#relationship").val();
  let membership = $("#membership").val();
  let lastRites = $("#lastRites").val();
  let causeOfDeath = $("#causeOfDeath").val();
  let dateOfDeath = $("#dateOfDeath").val();
  let deathCertNo = $("#deathCertNo").val();
  let burialPermitNo = $("#burialPermitNo").val();
  let cemetery = $("#cemetery").val();
  let dateOfBurial = $("#dateOfBurial").val();
  let timeOfBurial = $("#timeOfBurial").val();
  $.post(
    "actions/save-burial-form.php",
    {
      dateApplied: dateApplied,
      contactNo: contactNo,
      burial_firstname: burial_firstname,
      burial_middlename: burial_middlename,
      burial_lastname: burial_lastname,
      dateOfBirth: dateOfBirth,
      age: age,
      gender: gender,
      address: address,
      maritalStatus: maritalStatus,
      father: father,
      mother: mother,
      spouse: spouse,
      noOfChildren: noOfChildren,
      childrenAlive: childrenAlive,
      childrenDead: childrenDead,
      personResponsible: personResponsible,
      relationship: relationship,
      membership: membership,
      lastRites: lastRites,
      causeOfDeath: causeOfDeath,
      dateOfDeath: dateOfDeath,
      deathCertNo: deathCertNo,
      burialPermitNo: burialPermitNo,
      cemetery: cemetery,
      dateOfBurial: dateOfBurial,
      timeOfBurial: timeOfBurial,
    },
    function (data) {
      if (jQuery.trim(data) == "success") {
        $("#show_burial").modal("hide");
        toastAlert("success", "Appointment created successfully.");
        ShowTransactionCanvas();
      } else {
        toastAlert("warning", data);
      }
    }
  );
}

function UpdateBurialForm(burial_id) {
  let dateApplied = $("#dateApplied").val();
  let contactNo = $("#contactNo").val();
  let burial_firstname = $("#burial_firstname").val();
  let burial_middlename = $("#burial_middlename").val();
  let burial_lastname = $("#burial_lastname").val();
  let dateOfBirth = $("#dateOfBirth").val();
  let age = $("#age").val();
  // let gender = $("#gender").val();
  var gender = $('input[name="gender"]:checked').val();
  let address = $("#address").val();
  // let maritalStatus = $("#maritalStatus").val();
  var maritalStatus = $('input[name="maritalStatus"]:checked').val();
  let father = $("#father").val();
  let mother = $("#mother").val();
  let spouse = $("#spouse").val();
  let noOfChildren = $("#noOfChildren").val();
  let childrenAlive = $("#childrenAlive").val();
  let childrenDead = $("#childrenDead").val();
  let personResponsible = $("#personResponsible").val();
  let relationship = $("#relationship").val();
  let membership = $("#membership").val();
  let lastRites = $("#lastRites").val();
  let causeOfDeath = $("#causeOfDeath").val();
  let dateOfDeath = $("#dateOfDeath").val();
  let deathCertNo = $("#deathCertNo").val();
  let burialPermitNo = $("#burialPermitNo").val();
  let cemetery = $("#cemetery").val();
  let dateOfBurial = $("#dateOfBurial").val();
  let timeOfBurial = $("#timeOfBurial").val();
  $.post(
    "actions/update-burial-form.php",
    {
      dateApplied: dateApplied,
      contactNo: contactNo,
      burial_firstname: burial_firstname,
      burial_middlename: burial_middlename,
      burial_lastname: burial_lastname,
      dateOfBirth: dateOfBirth,
      age: age,
      gender: gender,
      address: address,
      maritalStatus: maritalStatus,
      father: father,
      mother: mother,
      spouse: spouse,
      noOfChildren: noOfChildren,
      childrenAlive: childrenAlive,
      childrenDead: childrenDead,
      personResponsible: personResponsible,
      relationship: relationship,
      membership: membership,
      lastRites: lastRites,
      causeOfDeath: causeOfDeath,
      dateOfDeath: dateOfDeath,
      deathCertNo: deathCertNo,
      burialPermitNo: burialPermitNo,
      cemetery: cemetery,
      dateOfBurial: dateOfBurial,
      timeOfBurial: timeOfBurial,
      burial_id: burial_id,
    },
    function (data) {
      if (jQuery.trim(data) == "success") {
        $("#show_burial").modal("hide");
        toastAlert("success", "Appointment updated successfully.");
        ShowTransactionCanvas();
      } else {
        toastAlert("warning", data);
      }
    }
  );
}
function ShowIntentionsModal(intention_id, booking_id, operation) {
  // console.log(baptism_id, operation);
  $.post(
    "modals/intentions-form.php",
    {
      intention_id: intention_id,
      booking_id: booking_id,
      operation: operation,
    },
    function (data) {
      $("#LoadIntentionsModal").html("");
      $("#LoadIntentionsModal").html(data);
    }
  );
}
function ShowBaptismModal(baptism_id, booking_id, operation) {
  // console.log(baptism_id, operation);
  $.post(
    "modals/baptism-form.php",
    {
      baptism_id: baptism_id,
      booking_id: booking_id,
      operation: operation,
    },
    function (data) {
      $("#LoadBaptismModal").html("");
      $("#LoadBaptismModal").html(data);
    }
  );
}
function ShowBurialModal(id, booking_id, operation) {
  $.post(
    "modals/burial-form.php",
    {
      id: id,
      booking_id: booking_id,
      operation: operation,
    },
    function (data) {
      $("#LoadBurialModal").html("");
      $("#LoadBurialModal").html(data);
    }
  );
}
function ShowWeddingModal(wedding_id, booking_id, operation) {
  $.post(
    "modals/wedding-form.php",
    {
      wedding_id: wedding_id,
      booking_id: booking_id,
      operation: operation,
    },
    function (data) {
      $("#LoadWeddingModal").html("");
      $("#LoadWeddingModal").html(data);
    }
  );
}

function EditTransaction(transaction_id, booking_id, type) {
  var myModal = new bootstrap.Modal(document.getElementById(type), {
    keyboard: false,
  });
  myModal.show();

  // ShowBaptismModal(transaction_id, 1);
  if (type == "show_baptism") {
    ShowBaptismModal(transaction_id, booking_id, 1);
  } else if (type == "show_burial") {
    ShowBurialModal(transaction_id, booking_id, 1);
  } else if (type == "show_wedding") {
    ShowWeddingModal(transaction_id, booking_id, 1);
  } else if (type == "show_intentions") {
    ShowIntentionsModal(transaction_id, booking_id, 1);
  }
  //
}
function SaveContactUs() {
  let name = $("#contact_name").val();
  let contact_no = $("#contact_number").val();
  let email_address = $("#email_address").val();
  let message = $("#message").val();
  $.post(
    "actions/contact-us.php",
    {
      name: name,
      contact_no: contact_no,
      email_address: email_address,
      message: message,
    },
    function (data) {
      if (jQuery.trim(data) == "success") {
        toastAlert("success", "Message sent successfully.");
        $("#message").val("");
      } else {
        toastAlert("warning", data);
      }
    }
  );
}

var sponsor = 101001;
function AddSponsors(sacrament_type) {
  if (sacrament_type == "Baptism") {
    sacrament_type = "baptism_sponsor_row";
  } else {
    sacrament_type = "wedding_sponsor_row";
  }
  sponsor++;
  $("#" + sacrament_type).before(`
       <div class="row sponsor" id="Sponsor${sponsor}" counter="${sponsor}"> 
          <div class="form-group col-4">
              <label for="sponsors_firstname"></label>
              <input type="text" class="form-control-plaintext" id="sponsors_firstname${sponsor}" placeholder="Firstname" required>
          </div>
          <div class="form-group col-4">
              <label for="sponsors_middlename"></label>
              <input type="text" class="form-control-plaintext" id="sponsors_middlename${sponsor}" placeholder="Middlename">
          </div>
          <div class="form-group col-4 d-flex justify-content-between align-items-end">
              <label for="sponsors_lastname"></label>
              <input type="text" class="form-control-plaintext" id="sponsors_lastname${sponsor}" placeholder="Lastname" required>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a class="badge bg-danger text-white text-decoration-none badge-danger "
                  onclick="RemoveSponsor('','','${sponsor}',0)" title="Remove">
                  <i class="fa fa-times p-1"></i>
              </a>
          </div>
      </div>

  `);
}

function RemoveSponsor(sacrament_type, sacrament_id, id, type) {
  if (type == 0) {
    $("#Sponsor" + id).remove();
  } else {
    $.post(
      "actions/delete-sponsor.php",
      {
        id: id,
        sacrament_id: sacrament_id,
        sacrament_type: sacrament_type,
      },
      function (data) {
        if (jQuery.trim(data) == "success") {
          $("#Sponsor" + id).remove();
          ShowTransactionCanvas();
          toastAlert("success", "Sponsor deleted successfully.");
        } else {
          toastAlert("warning", data);
        }
      }
    );
  }
}

function DeleteTransaction(id, type) {
  $.post(
    "actions/delete-transaction.php",
    {
      id: id,
      type: type,
    },
    function (data) {
      if (jQuery.trim(data) == "success") {
        ShowTransactionCanvas();
        toastAlert("success", "Transaction deleted successfully.");
      } else {
        toastAlert("warning", data);
      }
    }
  );
}

function SignUpModal(id, operation) {
  $.post(
    "login/signup-modal.php",
    {
      id: id,
      operation: operation,
    },
    function (data) {
      $("#LoadSignUpModal").html("");
      $("#LoadSignUpModal").html(data);
    }
  );
}

function ShowSacramentRate(SacramentRate) {
  $.post(
    "modals/sacrament-rate.php",
    {
      SacramentRate: SacramentRate,
    },
    function (data) {
      $("#LoadSacramentRate").html("");
      $("#LoadSacramentRate").html(data);
    }
  );
}

// function ShowVerificationModal() {
//   $.post(
//     "modals/verification-modal.php",
//     {
//       // SacramentRate: SacramentRate,
//     },
//     function (data) {
//       $("#LoadVerificationCode").html("");
//       $("#LoadVerificationCode").html(data);
//     }
//   );
// }
function btnSpinner(type, btnName, btnTextLabel) {
  const loginBtn = document.getElementById(btnName);
  const spinner = document.getElementById("spinner");

  if (type == true) {
    const btnText = document.getElementById("btnText");
    loginBtn.disabled = true;
    spinner.style.display = "inline-block"; // Show spinner
    btnText.textContent = btnTextLabel;
  } else {
    const btnText = document.getElementById("btnText");
    setTimeout(() => {
      loginBtn.disabled = false;
      spinner.style.display = "none"; // Hide spinner
      btnText.textContent = btnTextLabel;
    }, 3000);
  }
}

function BlessingsReceived() {
  var isChecked = $("#blessings_received").prop("checked");
  if (isChecked == true) {
    $("#BlessingsRemarksDiv").html(`
        <textarea class="form-control form-control-sm" name="" id="blessings_remarks" cols="30" rows="3" placeholder="Remarks"></textarea>
      `);
  } else {
    $("#BlessingsRemarksDiv").html("");
  }
}
function ThanksGivingOther() {
  var isChecked = $("#t_others").prop("checked");
  if (isChecked == true) {
    $("#ThanksGivingRemarksDiv").html(`
          <textarea class="form-control form-control-sm" name="" id="tg_remarks" cols="30" rows="3" placeholder="Remarks"></textarea>
      `);
  } else {
    $("#ThanksGivingRemarksDiv").html("");
  }
}

function GuidanceForTheExam() {
  var isChecked = $("#exam_guidance").prop("checked");
  if (isChecked == true) {
    $("#ExamRemarksDiv").html(`
          <textarea class="form-control form-control-sm" name="" id="exam_guidance_remarks" cols="30" rows="3" placeholder="Remarks"></textarea>
      `);
  } else {
    $("#ExamRemarksDiv").html("");
  }
}

function PetitionOther() {
  var isChecked = $("#p_others").prop("checked");
  if (isChecked == true) {
    $("#PetitionGivingRemarksDiv").html(`
          <textarea class="form-control form-control-sm" name="" id="petition_remarks" cols="30" rows="3" placeholder="Remarks"></textarea>
      `);
  } else {
    $("#PetitionGivingRemarksDiv").html("");
  }
}

function SaveIntentionsForm() {
  let date = $("#date").val();
  let time = $("#time").val();
  let offered_by = $("#offered_by").val();
  let offered_for = $("#offered_for").val();
  let amount = $('input[name="amount"]:checked').val();

  let Intentions_arr = [];
  // THANKS GIVING
  if ($("#birthday").is(":checked") == true) {
    Intentions_arr.push({
      type: "Thanksgiving",
      name: "Birthday",
      remarks: "-",
    });
  }

  if ($("#wedding_anniversary").is(":checked") == true) {
    Intentions_arr.push({
      type: "Thanksgiving",
      name: "Wedding Anniversary",
      remarks: "-",
    });
  }

  if ($("#blessings_received").is(":checked") == true) {
    Intentions_arr.push({
      type: "Thanksgiving",
      name: "Blessings received",
      remarks: $("#blessings_remarks").val() || "",
    });
  }

  if ($("#t_others").is(":checked") == true) {
    Intentions_arr.push({
      type: "Thanksgiving",
      name: "Others",
      remarks: $("#tg_remarks").val() || "",
    });
  }

  // SOULS
  if ($("#soul").val() !== "") {
    Intentions_arr.push({
      type: "Soul",
      name: "Soul",
      remarks: $("#soul").val(),
    });
  }

  // PETITIONS
  if ($("#good_health").is(":checked") == true) {
    Intentions_arr.push({
      type: "Petition",
      name: "Good Health",
      remarks: "-",
    });
  }

  if ($("#fast_recovery").is(":checked") == true) {
    Intentions_arr.push({
      type: "Petition",
      name: "Fast Recovery",
      remarks: "-",
    });
  }

  if ($("#exam_guidance").is(":checked") == true) {
    Intentions_arr.push({
      type: "Petition",
      name: "Guidance for the Exam",
      remarks: $("#exam_guidance_remarks").val(),
    });
  }

  if ($("#p_others").is(":checked") == true) {
    Intentions_arr.push({
      type: "Petition",
      name: "Others",
      remarks: $("#petition_remarks").val(),
    });
  }

  if ($("#others").val() !== "") {
    Intentions_arr.push({
      type: "Other",
      name: "Other",
      remarks: $("#others").val(),
    });
  }

  let IntentionsJSON = JSON.stringify(Intentions_arr);

  $.post(
    "actions/save-intentions-form.php",
    {
      date: date,
      time: time,
      offered_for: offered_for,
      offered_by: offered_by,
      IntentionsJSON: IntentionsJSON,
      amount: amount,
    },
    function (data) {
      if (jQuery.trim(data) == "success") {
        $("#show_intentions").modal("hide");
        toastAlert("success", "Intentions created successfully.");
      } else {
        toastAlert("warning", data);
      }
    }
  );
}

function UpdateIntentionsForm(intentions_id) {
  let date = $("#date").val();
  let time = $("#time").val();
  let offered_by = $("#offered_by").val();
  let offered_for = $("#offered_for").val();
  let amount = $('input[name="amount"]:checked').val();

  let Intentions_arr = [];
  // THANKS GIVING
  if ($("#birthday").is(":checked") == true) {
    Intentions_arr.push({
      id: $("#birthday").attr("detail_id"),
      type: "Thanksgiving",
      name: "Birthday",
      remarks: "-",
    });
  }

  if ($("#wedding_anniversary").is(":checked") == true) {
    Intentions_arr.push({
      id: $("#wedding_anniversary").attr("detail_id"),
      type: "Thanksgiving",
      name: "Wedding Anniversary",
      remarks: "-",
    });
  }

  if ($("#blessings_received").is(":checked") == true) {
    Intentions_arr.push({
      id: $("#blessings_received").attr("detail_id"),
      type: "Thanksgiving",
      name: "Blessings received",
      remarks: $("#blessings_remarks").val() || "",
    });
  }

  if ($("#t_others").is(":checked") == true) {
    Intentions_arr.push({
      id: $("#t_others").attr("detail_id"),
      type: "Thanksgiving",
      name: "Others",
      remarks: $("#tg_remarks").val() || "",
    });
  }

  // SOULS
  if ($("#soul").val() !== "") {
    Intentions_arr.push({
      id: $("#soul").attr("detail_id"),
      type: "Soul",
      name: "Soul",
      remarks: $("#soul").val(),
    });
  }

  // PETITIONS
  if ($("#good_health").is(":checked") == true) {
    Intentions_arr.push({
      id: $("#good_health").attr("detail_id"),
      type: "Petition",
      name: "Good Health",
      remarks: "-",
    });
  }

  if ($("#fast_recovery").is(":checked") == true) {
    Intentions_arr.push({
      id: $("#fast_recovery").attr("detail_id"),
      type: "Petition",
      name: "Fast Recovery",
      remarks: "-",
    });
  }

  if ($("#exam_guidance").is(":checked") == true) {
    Intentions_arr.push({
      id: $("#exam_guidance").attr("detail_id"),
      type: "Petition",
      name: "Guidance for the Exam",
      remarks: $("#exam_guidance_remarks").val(),
    });
  }

  if ($("#p_others").is(":checked") == true) {
    Intentions_arr.push({
      id: $("#p_others").attr("detail_id"),
      type: "Petition",
      name: "Others",
      remarks: $("#petition_remarks").val(),
    });
  }

  if ($("#others").val() !== "") {
    Intentions_arr.push({
      id: $("#others").attr("detail_id"),
      type: "Other",
      name: "Other",
      remarks: $("#others").val(),
    });
  }

  let IntentionsJSON = JSON.stringify(Intentions_arr);

  $.post(
    "actions/update-intentions-form.php",
    {
      intentions_id: intentions_id,
      date: date,
      time: time,
      offered_for: offered_for,
      offered_by: offered_by,
      IntentionsJSON: IntentionsJSON,
      amount: amount,
    },
    function (data) {
      if (jQuery.trim(data) == "success") {
        $("#show_intentions").modal("hide");
        toastAlert("success", "Intentions updated successfully.");
      } else {
        toastAlert("warning", data);
      }
    }
  );
}
