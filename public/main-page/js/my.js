$(document).ready(function () {
  /* enable transition */
  $("body").removeClass("transition-off");

  /* range slider */
  $(".subscribers-count").ionRangeSlider({
    onStart: function (data) {
      $(".subscribers-slider .count").text(data.from_pretty);
    },

    onChange: function (data) {
      $(".subscribers-slider .count").text(data.from_pretty);
      let category_price = 120;
      let final_num = parseFloat(data.from * 30) * (category_price / 1000);
      console.log(
        String(final_num).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, "$1 ")
      );
      $(".price span.text-nowrap").text(
        String(final_num).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, "$1 ")
      );
    },
  });

  /* marquee sliders */
  const marquee = document.querySelectorAll(".swiper-marquee");

  if (marquee) {
    marquee.forEach(function (slider, sliderIndex) {
      args = {
        slidesPerView: "auto",
        spaceBetween: 0,
        loop: true,
        speed: 3000,
        autoplay: {
          disableOnInteraction: true,
          delay: 0,
        },
        noSwipingClass: "swiper-marquee",
        allowTouchMove: false,
        breakpoints: {
          0: {
            spaceBetween: 33,
          },
          768: {
            spaceBetween: 45,
          },
          1200: {
            spaceBetween: 60,
          },
        },
      };

      new Swiper(slider, args);
    });
  }

  /* packets slider */
  const packets = document.querySelector(".swiper-packets");

  if (packets && window.innerWidth < 992) {
    const packetSlider = new Swiper(packets, {
      slidesPerView: "auto",
      spaceBetween: 20,
      centeredSlides: true,

      navigation: {
        nextEl: ".packets-next",
        prevEl: ".packets-prev",
      },
    });

    packetSlider.slideTo(1);
  }

  /* brands slider */
  const brands = document.querySelector(".swiper-brands");

  if (brands) {
    new Swiper(brands, {
      slidesPerView: "auto",
      loop: true,
      autoplay: true,

      breakpoints: {
        0: {
          spaceBetween: 10,
        },
        768: {
          spaceBetween: 20,
        },
      },

      navigation: {
        nextEl: ".brands-next",
        prevEl: ".brands-prev",
      },
    });
  }

  /* close/open menu */
  $(".humb").click(function () {
    $(".main-menu").toggleClass("active");
  });

  $(".close-menu").click(function () {
    $(".main-menu").removeClass("active");
  });
});
