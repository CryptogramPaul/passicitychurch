function print_preview(div_name) {
  var printContents = document.getElementById(div_name).innerHTML;
  var originalTitle = document.title;
  var printWindow = window.open("", "", "height=1000,width=2000");

  printWindow.document.write(
    "<html><head><title>" + "Print Assement" + "</title>"
  );
  printWindow.document.write(
    '<link rel="stylesheet" href = "https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" / >'
  );
  printWindow.document.write(
    '<link rel = "stylesheet" href = "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" / >'
  );
  printWindow.document.write(
    '<link rel = "stylesheet" href = "dist/css/adminlte.min.css">'
  );
  printWindow.document.write(
    ' <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />'
  );
  printWindow.document.write(
    ' <link rel="stylesheet" href="view/transaction/payments/css/payment.css" />'
  );
  printWindow.document.write(
    "<style>body{font-family: Arial, sans-serif;}</style>"
  );
  printWindow.document.write("</head><body>");
  printWindow.document.write(printContents);
  printWindow.document.write("</body></html>");
  printWindow.document.close();
  printWindow.onload = function () {
    printWindow.print();
    printWindow.close();
  };
}
