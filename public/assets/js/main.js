$(document).ready(function () {


    $.fn.stars = function () {
        return $(this).each(function () {
            var rating = $(this).data("star");
            if (rating > 5) {
                rating = 5;
            }
            var star_append = `
            <div class="star-rating" title="${rating} star">
            <div class="back-stars">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>

            <div class="front-stars" style="width: ${(rating * 10) * 2}%">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            </div>
            </div>
            </div>
            `;

            $(this).empty();
            $(this).append(star_append);
        });
    }
    $('.append_star').stars();

    $('.btn-compare-price').click(function(){
        $(this).next().addClass("active_2");
        $(this).addClass("display_none");
    });
    $('.btn_collapse').click(function(){
        $(this).parent().removeClass("active_2");
        $(this).parent().prev().removeClass("display_none");
    });

    $('.readmore1').click(function(){
        $(".detail_wrapper_content").addClass("active_visible");
        $(".show-more1").addClass("display_none");
        $(".hide_content1").removeClass("display_none");
    });
    $('.hide_content1').click(function(){
        $(".detail_wrapper_content").removeClass("active_visible");
        $(".show-more1").removeClass("display_none");
        $(".hide_content1").addClass("display_none");
    });


    $('.readmore2').click(function(){
        $(".detail_info_wrapper").addClass("active_visible");
        $(".show-more2").addClass("display_none");
        $(".hide_content2").removeClass("display_none");
    });
    $('.hide_content2').click(function(){
        $(".detail_info_wrapper").removeClass("active_visible");
        $(".show-more2").removeClass("display_none");
        $(".hide_content2").addClass("display_none");
    });

    

});

$(document).ready(function() {
    $('.slide.owl-carousel').owlCarousel({
        autoplay: true,
        margin: 35,
        stopOnHover: true,
        items: 2,
        responsive: {
            1170: {
                items: 8
            },
            770: {
                items: 5
            },
            600: {
                items: 4
            }
        }
    })
    $('.ds.owl-carousel.owl-loaded.owl-drag').owlCarousel({
        autoplay: true,
        margin: 35,
        stopOnHover: true,
        items: 1,
        responsive: {
            1170: {
                items: 4
            },
            770: {
                items: 3
            },
            600: {
                items: 2
            }
        }
    })

    $('.ga_detail.owl-carousel.owl-loaded.owl-drag').owlCarousel({
        autoplay: true,
        margin: 20,
        stopOnHover: true,
        items: 1,
        responsive: {
            1170: {
                items: 3
            },
            770: {
                items: 2
            },
            768: {
                items: 2
            },
            600: {
                items: 1
            }
        }
    })

    $('.first_tab_pane.owl-carousel.owl-loaded.owl-drag').owlCarousel({
        autoplay: true,
        margin: 20,
        stopOnHover: true,
        items: 2,
        responsive: {
            1170: {
                items: 4
            },
            770: {
                items: 3
            },
            768: {
                items: 3
            },
            600: {
                items: 2
            },
            414: {
                items: 2
            }
        }
    })

    $('.list-category ul.owl-carousel.owl-loaded.owl-drag').owlCarousel({
        autoplay: true,
        margin: 20,
        stopOnHover: true,
        items: 2,
        responsive: {
            1170: {
                items: 5
            },
            770: {
                items: 4
            },
            768: {
                items: 4
            },
            600: {
                items: 2
            }
        }
    })

    $('.banner.owl-carousel.owl-loaded.owl-drag').owlCarousel({
        // autoplay: true,
        margin: 20,
        stopOnHover: true,
        items: 1,
    })

    $('.topbar-item').click(function(){
        $(".popover-account").toggleClass("active");
    });

    $('.main_nav').click(function(){
        $(".list_pro").toggleClass("active");
    });
    //header
    $('.dropdown-toggle').click(function(){
        $(".dropdown-menu").toggleClass("active");
    });


    //reponsive
    $('.btn_respon').click(function(){
        $(".topbar").addClass("active_respon");
    });

    $('.fa-times').click(function(){
        $(".topbar").removeClass("active_respon");
    });


    //active
    // $('.control--radio').click(function(){
    //     $(this).children(".control__indicator").addClass("checked");
    //
    // });



    $(window).scroll(function() {
        var $height = $(window).scrollTop();

        if($height > 0) {
            $('#header').addClass('active_header');
            $('#header').addClass('active_header2');
            $('.row_header').addClass('logo_respon');
        } else {
            $('#header').removeClass('active_header');
            $('#header').removeClass('active_header2');
            $('.row_header').removeClass('logo_respon');
        }
    });



});

