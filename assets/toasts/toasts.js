// $(function () {
//   var Toast = Swal.mixin({
//     toast: true,
//     position: "top-end",
//     showConfirmButton: false,
//     timer: 3000,
//   });

//   $(".swalDefaultSuccess").click(function () {
//     Toast.fire({
//       icon: "success",
//       title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
//     });
//   });
//   $(".swalDefaultInfo").click(function () {
//     Toast.fire({
//       icon: "info",
//       title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
//     });
//   });
//   $(".swalDefaultError").click(function () {
//     Toast.fire({
//       icon: "error",
//       // position: 'bottomRight',
//       title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
//     });
//   });
//   $(".swalDefaultWarning").click(function () {
//     Toast.fire({
//       icon: "warning",
//       title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
//     });
//   });
//   $(".swalDefaultQuestion").click(function () {
//     Toast.fire({
//       icon: "question",
//       title: "Lorem ipsum dolor sit amet, consetetur sadipscing elitr.",
//     });
//   });
// });

function toastAlert(Status, Title) {
  // var title_message = "";

  var success_audio = new Audio("assets/audios/success.mp3");
  var warning_audio = new Audio("assets/audios/warning.mp3");
  var info_audio = new Audio("assets/audios/info.mp3");

  var Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 5000,
  });

  switch (Status) {
    case "success":
      Toast.fire({
        icon: "success",
        title: Title,
      });
      success_audio.play();
      break;
    case "warning":
      Toast.fire({
        icon: "warning",
        title: Title,
      });
      warning_audio.play();
      break;
    case "info":
      Toast.fire({
        icon: "info",
        title: Title,
      });
      info_audio.play();
      break;

    default:
      break;
  }
}

function confirmation(delete_function, id, type, type_title, type_text) {
  var _title = "Are you sure you want to delete this record?";
  var _text = "You won't be able to undone this.";
  var _icon = "warning";
  var _btnText = "Confirm";

  if (type == "post") {
    _title = type_title;
    _text = type_text;
    _icon = "question";
    _btnText = "Post";
  } 

  if (type == "delete") {
    _title = type_title;
    _text = type_text;
    _icon = "warning";
    _btnText = "Delete";
  } 

  if(type == "confirm"){
    _title = type_title;
    _text = type_text;
    _icon = "question";
    _btnText = "Confirm";
  }

  if(type == "update"){
    _title = type_title;
    _text = type_text;
    _icon = "question";
    _btnText = "Update";
  }

  // if (type == "cancel") {
  //   _btnText = "Proceed";
   
  // }else{
  //   _title = type_title;
  //   _text = type_text;
  //   _icon = "question";
  //   _btnText = "Yes";
  // }


  Swal.fire({
    title: _title,
    text: _text,
    icon: _icon,
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: _btnText,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      delete_function(id);
    }
  });
}

function PrintConfirmation(id, type, devname, print_func) {
  Swal.fire({
    title: "Printing Confirmation!",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Print",
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      print_func(type, id);
    }
  });
}
