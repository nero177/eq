//Global let
let LESTRO = {};

(function ($) {
  // USE STRICT
  "use strict";

  //----------------------------------------------------/
  // Predefined letiables
  //----------------------------------------------------/
  let $document = $(document);
  LESTRO.stickyHeaderInit = () => {
    // Sticky header
    function onScroll() {
      const $$header = document.querySelector(".js-header");
      if (window.scrollY) {
        $$header.classList.add("is-active");
      } else {
        $$header.classList.remove("is-active");
      }
    }

    window.addEventListener("scroll", onScroll);
  };

  //menu for mobile devices, which is located in the header of the site

  LESTRO.mobileMenuInit = () => {
    const mobileMenuInHeader = "#mobileMenu";
    $("#menuPopup").click(function () {
      $(this).toggleClass("active");

      if ($(mobileMenuInHeader).hasClass("active")) {
        $(mobileMenuInHeader).removeClass("animate");
        setTimeout(function () {
          $(mobileMenuInHeader).removeClass("active");
          $("body").css("overflow", "auto");
        }, 500);
      } else {
        $(mobileMenuInHeader).addClass("active");
        $("body").css("overflow", "hidden");
        setTimeout(function () {
          $(mobileMenuInHeader).addClass("animate");
        }, 10);
      }
    });
  };
  LESTRO.owlMasterClassesInit = () => {
    //index page slider
    const owlIndex = $(".index .banner-carousel");
    const owlmasterClasses = $(".master-classes .banner-carousel");

    const paramsCarousel = {
      // autoWidth: true,
      items: 1,
      loop: true,
      nav: false,
      autoplay: true,
      autoplayTimeout: 8000,
      autoplayHoverPause: true,
      smartSpeed: 2000, // slide flipping speed
      dots: true,
    };
    $(owlmasterClasses).owlCarousel(paramsCarousel);
    $(owlIndex).owlCarousel(paramsCarousel);
  };

  LESTRO.initCreatorsSlider = () => {
    const creatorsSliders = $(".creators-slider");

    if (creatorsSliders) {
      creatorsSliders.each(function (ind, elem) {
        $(elem).owlCarousel({
          margin: 17,
          items: 2,
          autoplay: true,
          loop: true,
          nav: true,
          responsive: {
            0: {
              items: 1,
            },
            768: {
              items: 1,
            },
            1024: {
              items: 2,
            },
            1600: {
              items: 2,
            },
          },
        });
      });
    }
  };

  LESTRO.initTheorySlider = () => {
    const theorySliders = $(".theory-slider");

    if (theorySliders) {
      theorySliders.each(function (ind, elem) {
        $(elem).owlCarousel({
          autoWidth: false,
          margin: 0,
          items: 2,
          autoplay: false,
          loop: true,
          nav: true,
          responsive: {
            0: {
              items: 1,
            },
            1024: {
              items: 2,
            },
          },
        });
      });
    }
  };

  LESTRO.initAddToCartFormEvent = () => {
    $('.add-master-class').each(function () {
      $(this).on('submit', function (event) {
        event.preventDefault();

        const form = $(this)[0];
        const formData = new FormData(form);

        fetch(form.getAttribute('action'), {
          method: 'POST',
          body: formData,
          headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
          }
        })
          .then(response => {
            if (response.status == 200) {
              $(document.body).addClass('modal-open')
              $('#product-added-notice').addClass('show');
              $('.counter').html(parseInt($('.counter').html()) + 1)
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
      });
    })
  }

  LESTRO.initChoiceCourseSlider = () => {
    const choiceCourseSliders = $(".choice-course-slide");

    if (choiceCourseSliders) {
      choiceCourseSliders.each(function (ind, elem) {
        $(elem).owlCarousel({
          autoWidth: true,
          margin: 17,
          items: 4,
          autoplay: false,
          nav: true,
          responsive: {
            0: {
              items: 1,
            },
            768: {
              items: 1,
            },
            1024: {
              items: 3,
            },
            1600: {
              items: 4,
            },
          },
        });
      });
    }
  };

  LESTRO.likeBtnInit = () => {
    //like lessons
    $(".like-btn").click(function () {
      $(this).toggleClass("liked");
    });
  };

  LESTRO.videoCourseImgsInit = () => {
    //video-course banner animation

    const images = $(".video-course .banner .banner-img").toArray();
    const imagesLength = images.length - 1;
    let currentSlide = imagesLength;
    if (imagesLength > 0) {
      function showSlide() {
        if (currentSlide > 0) {
          $(images[currentSlide]).addClass("hidden");
          currentSlide--;
        } else {
          currentSlide = imagesLength;
          $(images[imagesLength]).removeClass("hidden");

          setTimeout(() => {
            $(images).removeClass("hidden");
          }, 700);
        }
        $(images[currentSlide]).removeClass("hidden");
      }
      setInterval(showSlide, 5000);
    }
  };

  LESTRO.smothScrollInit = () => {
    //smoth scroll to 3d stage

    $(".anchor-js").click(function (e) {
      e.preventDefault();
      const id = $(this).attr("href");
      const top = $(id).offset().top;
      $("body, html").animate({ scrollTop: top }, 800);
    });
  };

  LESTRO.languageSwitcherInit = () => {
    // Multiple options dropdown
    let isLS = $(".select-menu");
    if (isLS.length) {
      isLS.each(function (ind, elem) {
        const optionMenu = $(elem);
        const selectBtn = optionMenu.find(".select-btn");
        const options = optionMenu.find(".option");
        const sBtn_text = optionMenu.find(".sBtn-text");

        function showOptionMenu() {
          optionMenu.addClass("active");
        }

        function hideOptionMenu() {
          optionMenu.removeClass("active");
        }

        function handleOptionClick(option) {
          let selectedOption = $(option).find(".option-text").text();
          sBtn_text.text(selectedOption);
          optionMenu.removeClass("active");
        }

        // Change event from 'click' to 'mouseenter'
        optionMenu.on("mouseenter", showOptionMenu);

        // Add event listener to hide dropdown on mouseleave from both button and menu
        optionMenu.on("mouseleave", hideOptionMenu);
        optionMenu.on("mouseleave", hideOptionMenu);

        options.each(function () {
          $(this).on("click", function () {
            handleOptionClick(this);
          });
        });
      });
    }
  };

  LESTRO.marqueeInit = () => {
    //MARQUEE
    const $marquee = $(".marquee");
    let $marqueeContainer = $(".marquee-container");
    const $marqueeItems = $(".marquee-item");
    let itemWidth = $marqueeItems.eq(0).outerWidth(true);
    let totalWidth = $marqueeItems.length * itemWidth;
    const calcItemWidth = () => {
      itemWidth = $marqueeItems.eq(0).outerWidth(true);
      totalWidth = $marqueeItems.length * itemWidth;
    };
    let distance = 0;
    let speed = 2; // Швидкість прокрутки

    function cloneItems() {
      $marqueeContainer.children(".marquee-item:not(:first-child)").remove();
      let copiesNeeded = Math.ceil($marquee.outerWidth() / totalWidth);
      console.log(":", copiesNeeded);
      for (let i = 0; i < copiesNeeded + 1; i++) {
        $marqueeItems.clone().appendTo($marqueeContainer);
      }
    }
    function move() {
      distance -= speed;
      $marqueeContainer.css("transform", `translateX(${distance}px)`);
      if (distance <= -totalWidth) {
        distance += totalWidth;
      }
      requestAnimationFrame(move);
    }
    calcItemWidth();
    cloneItems();
    move();
    let timeoutMarquee;
    window.addEventListener("resize", function () {
      clearTimeout(timeoutMarquee);

      timeoutMarquee = setTimeout(() => {
        calcItemWidth();
        cloneItems();
        // move()
      }, 700);
    });
  };

  LESTRO.initAccordeon = () => {
    //BEGIN
    $(".accordion__title").on("click", function (e) {
      e.preventDefault();
      let $this = $(this);

      if (!$this.hasClass("accordion-active")) {
        $(".accordion__content").slideUp(400);
        $(".accordion__title").removeClass("accordion-active");
        $(".accordion__arrow").removeClass("accordion__rotate");
      }

      $this.toggleClass("accordion-active");
      $this.next().slideToggle(function () {
        // Проверка, видна ли верхняя часть открытого элемента аккордеона
        if ($this.hasClass("accordion-active")) {
          const elementTop = $this.offset().top;
          const windowHeight = $(window).height();
          const scrollTop = $(window).scrollTop();

          if (elementTop < scrollTop || elementTop > scrollTop + windowHeight) {
            $this[0].scrollIntoView({ behavior: "smooth", block: "start" });
          }
        }
      });

      $(".accordion__arrow", this).toggleClass("accordion__rotate");
    });
    //END
  };

  LESTRO.initModals = () => {
    function controlVideo(modal, action) {
      const iframe = modal.querySelector("iframe");
      if (iframe) {
        const player = new Vimeo.Player(iframe);
        if (action === "play") {
          player.play();
        } else if (action === "pause") {
          player.pause();
        }
      }
    }

    $(window).click(function (e) {
      if ($(e.target).hasClass("modal")) {
        $(e.target).removeClass("show");
        $("body").removeClass("modal-open");
        controlVideo(e.target, "pause");
      }
    });

    $(".modal-trigger").click(function () {
      let modal_id = $(this).attr("data-modal-id");
      let modal_video_url = $(this).attr("data-modal-video-url");
      let modal = $("#" + modal_id);
      modal.addClass("show");
      modal.find("#video-iframe").attr('src', modal_video_url);

      $("body").addClass("modal-open");
      controlVideo(modal[0], "play");
    });

    $(".close-icon").click(function () {
      let modal = $(this).closest(".modal");
      modal.removeClass("show");

      $("body").removeClass("modal-open");
      controlVideo(modal[0], "pause");
    });

    $(".close").click(function () {
      let modal = $(this).closest(".modal");
      modal.removeClass("show");

      $("body").removeClass("modal-open");
      controlVideo(modal[0], "pause");
    });
  };

  LESTRO.initQuantity = () => {
    let $qtyInputs = $(".qty-input");

    if (!$qtyInputs.length) {
      return;
    }

    let $inputs = $qtyInputs.find(".product-qty");
    let $countBtn = $qtyInputs.find(".qty-count");
    let qtyMin = parseInt($inputs.attr("min"));
    let qtyMax = parseInt($inputs.attr("max"));

    $inputs.change(function () {
      let $this = $(this);
      let $minusBtn = $this.siblings(".qty-count--minus");
      let $addBtn = $this.siblings(".qty-count--add");
      let qty = parseInt($this.val());

      if (isNaN(qty) || qty <= qtyMin) {
        $this.val(qtyMin);
        $minusBtn.attr("disabled", true);
      } else {
        $minusBtn.attr("disabled", false);

        if (qty >= qtyMax) {
          $this.val(qtyMax);
          $addBtn.attr("disabled", true);
        } else {
          $this.val(qty);
          $addBtn.attr("disabled", false);
        }
      }
    });

    $countBtn.click(function () {
      let operator = this.dataset.action;
      let $this = $(this);
      let $input = $this.siblings(".product-qty");
      let qty = parseInt($input.val());

      if (operator == "add") {
        qty += 1;
        if (qty >= qtyMin + 1) {
          $this.siblings(".qty-count--minus").attr("disabled", false);
        }

        if (qty >= qtyMax) {
          $this.attr("disabled", true);
        }
      } else {
        qty = qty <= qtyMin ? qtyMin : (qty -= 1);

        if (qty == qtyMin) {
          $this.attr("disabled", true);
        }

        if (qty < qtyMax) {
          $this.siblings(".qty-count--add").attr("disabled", false);
        }
      }

      $input.val(qty);
    });
  };

  LESTRO.floatLabelInit = () => {
    let items = $(".fl-label-form");
    if (items) {
      items.each(function (index, item) {
        var floatLabels = new FloatLabels(item, {
          style: 1,
          customPlaceholder: function (placeholderText, el, labelEl) {
            if (el.required) return placeholderText + " *";
            else return placeholderText;
          },
        });
      });
    }
  };

  LESTRO.initSimpleTabs = () => {
    const tabs = document.querySelectorAll(".js-tabs-simple");

    function tabify(tab) {
      const tabList = tab.querySelector(".tabs-wrapper");

      if (tabList) {
        const tabItems = [...tabList.children];
        const tabContent = tab.querySelector(".tabs-content-wrapper");
        const tabContentItems = [...tabContent.children];
        let tabIndex = 0;

        tabIndex = tabItems.findIndex((item, index) => {
          return [...item.classList].indexOf("active") > -1;
        });

        tabIndex > -1 ? (tabIndex = tabIndex) : (tabIndex = 0);

        function setTab(index) {
          tabItems.forEach((x, index) => x.classList.remove("active"));
          tabContentItems.forEach((x, index) => x.classList.remove("active"));

          tabItems[index].classList.add("active");
          tabContentItems[index].classList.add("active");
        }

        tabItems.forEach((x, index) =>
          x.addEventListener("click", () => setTab(index))
        );
        setTab(tabIndex);
        tab
          .querySelectorAll(".js-tabs-simple")
          .forEach((tabContent) => tabify(tabContent));
      }
    }

    tabs.forEach(tabify);
  };

  LESTRO.initVideos = () => {
    $('video.bg').each(function (index) {
      $(this)[0].play();
    })
  }

  LESTRO.initFbqEvents = () => {
    $('.fbq-add-event').off('click').on('click', function () {
      let params = {
        content_ids: [$(this).attr('fbq-id')],
        content_type: $(this).attr('fbq-type'),
        content_name: $(this).attr('fbq-name'),
        content_category: $(this).attr('fbq-category'),
        value: $(this).attr('fbq-price'),
        currency: 'UAH'
      }

      console.log(params)

      fbq('track', 'AddToCart', params);
    })
  }

  $document.ready(function () {
    LESTRO.initTheorySlider();
    LESTRO.stickyHeaderInit();
    LESTRO.mobileMenuInit();
    LESTRO.owlMasterClassesInit();
    LESTRO.likeBtnInit();
    LESTRO.videoCourseImgsInit();
    LESTRO.smothScrollInit();
    LESTRO.marqueeInit();
    LESTRO.languageSwitcherInit();
    LESTRO.initAccordeon();
    LESTRO.initCreatorsSlider();
    LESTRO.initModals();
    LESTRO.initChoiceCourseSlider();
    LESTRO.initQuantity();
    LESTRO.floatLabelInit();
    LESTRO.initSimpleTabs();
    LESTRO.initVideos();
    LESTRO.initAddToCartFormEvent();
    LESTRO.initFbqEvents();
  });
})(jQuery);
