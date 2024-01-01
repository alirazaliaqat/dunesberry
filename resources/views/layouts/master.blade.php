@php $locale = app()->getLocale() @endphp

<!DOCTYPE html>

<html lang="{{$locale}}" dir="{{$locale == 'en' ? 'ltr' : 'rtl'}}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Dunesberry Portfolio</title>
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/DB-favicon.png')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

  @yield('styles')
  @if($locale == 'ar')
    <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet" type="text/css" />
    @endif
</head>
<body>
    
@include('inc.header')
<main class="">
    @yield('content')
</main>
@include('inc.footer')

<button id="goToTopBtn" onclick="scrollToTop()"><i class="bi bi-chevron-up"></i></button>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
crossorigin="anonymous"></script>  
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>


$(document).ready(function() {
    var slider = $('.slider-container');
    
    // Initialize the slider with navigation arrows
    slider.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true, // Show navigation arrows
      prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="bi bi-chevron-left"></i></button>',
      nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="bi bi-chevron-right"></i></button>',
      rtl: @if($locale == 'ar') true @else false @endif,
      dots: false,
      responsive: [
        {
          breakpoint: 992,  // Mobile breakpoint
          settings: {
            slidesToShow: 5,
            slidesToScroll: 3,
            infinite: false
          }
        },
        {
          breakpoint: 767,  // Mobile breakpoint
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
            infinite: false
          }
        },
        {
          breakpoint: 567,  // Mobile breakpoint
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: false
          }
        }
      ]
    });

    // Check if the slider should be "unslick" after the mobile breakpoint
    function checkUnslick() {
      if (window.innerWidth >= 992) {
        slider.slick('unslick');
      } else {
        slider.slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
          nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
          dots: false
        });
      }
    }

    // Call the checkUnslick function when the window is resized
    $(window).on('resize', checkUnslick);

    // Call checkUnslick on page load
    checkUnslick();
  });


  var prevScrollpos = window.pageYOffset;
    var navbar = document.querySelector(".navbar");
    var btn = document.getElementById("goToTopBtn");

    window.onscroll = function() {
      var currentScrollPos = window.pageYOffset;

      // Scroll to Top button logic
      if (currentScrollPos > 20) {
        btn.style.display = "flex";
      } else {
        btn.style.display = "none";
      }

      // Show/hide navbar logic
      if (currentScrollPos > 80) {
        navbar.style.top = "-200px";
      } else {
        navbar.style.top = "0";
      }

      prevScrollpos = currentScrollPos;
    };

    // Function to scroll to the top
    function scrollToTop() {
      document.body.scrollTop = 0; // For Safari
      document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
    }

</script>


@yield('scripts')
</body>
</html>
