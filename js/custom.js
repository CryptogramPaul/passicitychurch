// // Get Current Year
// function getCurrentYear() {
//   var d = new Date();
//   var year = d.getFullYear();
//   document.querySelector("#displayDateYear").innerText = year;
// }
// getCurrentYear();

//client section owl carousel
// $(".owl-carousel").owlCarousel({
//   loop: true,
//   margin: 10,
//   nav: true,
//   dots: false,
//   navText: [
//     '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
//     '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>',
//   ],
//   autoplay: true,
//   autoplayHoverPause: true,
//   responsive: {
//     0: {
//       items: 1,
//     },
//     768: {
//       items: 2,
//     },
//     1000: {
//       items: 2,
//     },
//   },
// });

/** google_map js **/

// function myMap() {
//   var mapProp = {
//     center: new google.maps.LatLng(40.712775, -74.005973),
//     zoom: 18,
//   };
//   var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
// }

document.addEventListener("DOMContentLoaded", function () {
  const sections = document.querySelectorAll(".section");
  const options = {
    threshold: 0.5,
  };

  const observer = new IntersectionObserver(function (entries, observer) {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) {
        return;
      }
      entry.target.classList.add("visible");
      observer.unobserve(entry.target);
    });
  }, options);

  sections.forEach((section) => {
    observer.observe(section);
  });

  document.querySelectorAll(".menu-link").forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("target_id");
      document.querySelector(targetId).scrollIntoView({
        behavior: "smooth",
      });
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var scrollToTopBtn = document.getElementById("scroll-to-top");

  // Show or hide the button based on scroll position
  window.addEventListener("scroll", function () {
    // Show button when user scrolls down 200 pixels
    if (window.scrollY > 200) {
      scrollToTopBtn.style.display = "block";
    } else {
      scrollToTopBtn.style.display = "none";
    }
  });

  // Smooth scroll to top when button is clicked
  scrollToTopBtn.addEventListener("click", function (e) {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });
});
