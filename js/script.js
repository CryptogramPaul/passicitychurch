$(document).ready(function () {
  $("#FormContactUs").on("submit", function (e) {
    e.preventDefault();
    SaveContactUs();
    return false;
  });
});

function SaveWeddingForm() {
  let groom_firstname = $("#groom_firstname").val();
  let groom_middlename = $("#groom_middlename").val();
  let groom_lastname = $("#groom_lastname").val();
  let bride_firstname = $("#bride_firstname").val();
  let bride_middlename = $("#bride_middlename").val();
  let bride_lastname = $("#bride_lastname").val();
  let wedding_date = $("#wedding_date").val();
  let timeOfWedding = $("#timeOfWedding").val();


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

  // $.post(
  //   "actions/save-wedding-form.php",
  //   {
  //     groom_firstname: groom_firstname,
  //     groom_middlename: groom_middlename,
  //     groom_lastname: groom_lastname,
  //     bride_firstname: bride_firstname,
  //     bride_middlename: bride_middlename,
  //     bride_lastname: bride_lastname,
  //     wedding_date: wedding_date,
  //     timeOfWedding: timeOfWedding,
  //     SponsorJson: SponsorJson,
  //   },
  //   function (data) {
  //     if (jQuery.trim(data) == "success") {
  //       $("#show_wedding").modal("hide");
  //       toastAlert("success", "Appointment created successfully.");
  //       ShowTransactionCanvas();
  //     } else {
  //       toastAlert("warning", data);
  //     }
  //   }
  // );
}

// function UpdateWeddingForm(wedding_id) {
//   let groom_firstname = $("#groom_firstname").val();
//   let groom_middlename = $("#groom_middlename").val();
//   let groom_lastname = $("#groom_lastname").val();
//   let bride_firstname = $("#bride_firstname").val();
//   let bride_middlename = $("#bride_middlename").val();
//   let bride_lastname = $("#bride_lastname").val();
//   let wedding_date = $("#wedding_date").val();
//   let timeOfWedding = $("#timeOfWedding").val();

//   let sponsor_arr = [];

//   $(".sponsor").each(function (data) {
//     let id = $(this).attr("counter");
//     let lastname = $("#sponsors_lastname" + id).val();
//     let firstname = $("#sponsors_firstname" + id).val();
//     let middlename = $("#sponsors_middlename" + id).val();

//     sponsor_arr.push({
//       id: id,
//       lastname: lastname,
//       firstname: firstname,
//       middlename: middlename,
//     });
//   });

//   let SponsorJson = JSON.stringify(sponsor_arr);

//   var baptismal = $("#baptismal")[0].files[0];
//   var confirmation_cert = $("#confirmation_cert")[0].files[0];
//   var marriage_license = $("#marriage_license")[0].files[0];
//   var marriage_cont = $("#marriage_cont")[0].files[0];

//   // console.log(baptismal);
//   // console.log(confirmation_cert);
//   // console.log(marriage_license);
//   // console.log(marriage_cont);

//   $.post(
//     "actions/update-wedding-form.php",
//     {
//       groom_firstname: groom_firstname,
//       groom_middlename: groom_middlename,
//       groom_lastname: groom_lastname,
//       bride_firstname: bride_firstname,
//       bride_middlename: bride_middlename,
//       bride_lastname: bride_lastname,
//       wedding_date: wedding_date,
//       timeOfWedding: timeOfWedding,
//       SponsorJson: SponsorJson,
//       wedding_id: wedding_id,
//       baptismal: baptismal,
//       confirmation_cert: confirmation_cert,
//       marriage_license: marriage_license,
//       marriage_cont: marriage_cont,
//     },
//     function (data) {
//       if (jQuery.trim(data) == "success") {
//         $("#show_wedding").modal("hide");
//         toastAlert("success", "Appointment updated successfully.");
//         ShowTransactionCanvas();
//       } else {
//         toastAlert("warning", data);
//       }
//     }
//   );
// }

function UpdateWeddingForm(wedding_id) {
  var formData = new FormData();
  
  formData.append("groom_firstname", $("#groom_firstname").val());
  formData.append("groom_middlename", $("#groom_middlename").val());
  formData.append("groom_lastname", $("#groom_lastname").val());
  formData.append("bride_firstname", $("#bride_firstname").val());
  formData.append("bride_middlename", $("#bride_middlename").val());
  formData.append("bride_lastname", $("#bride_lastname").val());
  formData.append("wedding_date", $("#wedding_date").val());
  formData.append("timeOfWedding", $("#timeOfWedding").val());

  let sponsor_arr = [];

  $(".sponsor").each(function () {
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
  formData.append("SponsorJson", SponsorJson);
  formData.append("wedding_id", wedding_id);

  formData.append("baptismal", $("#baptismal")[0].files[0]);
  formData.append("confirmation_cert", $("#confirmation_cert")[0].files[0]);
  formData.append("marriage_license", $("#marriage_license")[0].files[0]);
  formData.append("marriage_cont", $("#marriage_cont")[0].files[0]);

  $.ajax({
    url: "actions/update-wedding-form.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      if (jQuery.trim(data) == "success") {
        $("#show_wedding").modal("hide");
        toastAlert("success", "Appointment updated successfully.");
        ShowTransactionCanvas();
      } else {
        toastAlert("warning", data);
      }
    },
  });
}



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
function ShowBaptismModal(baptism_id, operation) {
  // console.log(baptism_id, operation);
  $.post(
    "modals/baptism-form.php",
    {
      baptism_id: baptism_id,
      operation: operation,
    },
    function (data) {
      $("#LoadBaptismModal").html("");
      $("#LoadBaptismModal").html(data);
    }
  );
}
function ShowBurialModal(id, operation) {
  $.post(
    "modals/burial-form.php",
    {
      id: id,
      operation: operation,
    },
    function (data) {
      $("#LoadBurialModal").html("");
      $("#LoadBurialModal").html(data);
    }
  );
}
function ShowWeddingModal(wedding_id, operation) {
  $.post(
    "modals/wedding-form.php",
    {
      wedding_id: wedding_id,
      operation: operation,
    },
    function (data) {
      $("#LoadWeddingModal").html("");
      $("#LoadWeddingModal").html(data);
    }
  );
}

function EditTransaction(transaction_id, type) {
  var myModal = new bootstrap.Modal(document.getElementById(type), {
    keyboard: false,
  });
  myModal.show();

  // ShowBaptismModal(transaction_id, 1);
  if (type == "show_baptism") {
    ShowBaptismModal(transaction_id, 1);
  } else if (type == "show_burial") {
    ShowBurialModal(transaction_id, 1);
  } else if (type == "show_wedding") {
    ShowWeddingModal(transaction_id, 1);
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
function AddSponsors() {
  sponsor++;
  $("#sponsor_row").before(`
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
                  onclick="RemoveSponsor('${sponsor}',0)" title="Remove">
                  <i class="fa fa-times p-1"></i>
              </a>
          </div>
      </div>

  `);
}

function RemoveSponsor(sacrament_type,sacrament_id,id, type) {
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
