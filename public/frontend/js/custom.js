$(document).ready(function () {

  // Mobile Nav
  $("#menu1").metisMenu();
  // MObile Nav End

  // Side menubar
  $("#close-btn, .toggle-btn").click(function () {
    $("#mySidenav, .body-bg").toggleClass("active");
  });


  // Portfolio 
  $(document).ready(function () {
    $('.subject-carousel').slick({
      slidesToShow: 6,
      slidesToScroll: 1,
      arrows: true,
      dots: false,
      infinite: true,
      focusOnSelect: true,
      touchMove: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
      ]
    });

  });
  // Portfolio End 


  // Teachers 
  $(document).ready(function () {
    $('.teacher-carousel').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      dots: false,
      infinite: true,
      focusOnSelect: true,
      touchMove: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });

  });
  // Teachers End 


});