// const { data } = require("autoprefixer");

$(document).ready(function () {
    loadCart();
    loadWishList();
    // Here CSRF Token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadCart() {
        $.ajax({
            type: "GET",
            url: "/load-cart-data",
            success: function (response) {
                $(".cart-count").html('');
                $('.cart-count').html(response.count);

            }
        });
    }
    function loadWishList() {
        $.ajax({
            type: "GET",
            url: "/load-wishlist-data",
            success: function (response) {
                $(".wishlist-count").html('');
                $('.wishlist-count').html(response.count);
                // console.log(response.count)
            }
        });
    }


    // Here for get id product and quantity value
    $('.addToCartBtn').click(function (e) {
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();
        var colorName = $(this).closest('.product_data').find('.colorName').val();
        var sizeValue = $(this).closest('.product_data').find('.sizeValue').val();

        $.ajax({
            type: "POST",
            url: "/add-to-cart",
            data: {
                "product_id": product_id,
                "product_qty": product_qty,
                "colorName": colorName,
                "sizeValue": sizeValue
            },
            success: function (response) {
                swal(response.status);
                loadCart();
            }
        });
    });
    // Wishlists
    $('.addToWishlist').click(function (e) {
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            type: "POST",
            url: "/add-to-wishlist",
            data: {
                "product_id": product_id,
            },
            success: function (response) {
                swal(response.status);
                loadWishList();
            }
        });
    });

    // Here for Button increment(+) Product
    $('.increment-btn').click(function (e) {
        e.preventDefault();

        // var inc_val = $('.qty-input').val();
        var inc_val = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_val, 10);
        value = isNaN(value) ? 0 : value;

        if (value < 10) {
            value++;
            // $('.qty-input').val(value);
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });
    // Here for Button discrement(-) Product
    $('.decrement-btn').click(function (e) {
        e.preventDefault();

        // var inc_val = $('.qty-input').val();
        var dec_val = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_val, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            // $('.qty-input').val(value);
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    // Remove Item in Shopping Cart
    $('.delete-cart-item').click(function (e) {
        e.preventDefault();
        var prod_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            type: "POST",
            url: "/delete-cart-item",
            data: {
                "prod_id": prod_id,
            },
            success: function (response) {
                window.location.reload();
                swal("", response.status, "success");
            }
        });
    });

    // Remove Wishlist
    $('.rempve-wishlist-item').click(function (e) {
        e.preventDefault();
        var prod_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            type: "POST",
            url: "delete-wishlist-item",
            data: {
                "prod_id": prod_id,
            },
            success: function (response) {
                window.location.reload();
                swal("", response.status, "success");
            }
        });
    });

    $('.changeQuantity').click(function (e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.prod_id').val();
        var qty = $(this).closest('.product_data').find('.qty-input').val();
        data = {
            "prod_id": prod_id,
            "prod_qty": qty,
        }
        $.ajax({
            type: "POST",
            url: "update-cart",
            data: data,
            success: function (response) {
                window.location.reload();
            }
        });
    });
});

// For Slider owl-carousel in details Product
$(document).ready(function () {
    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    var slidesPerPage = 4; //globaly define number of elements per page
    var syncedSecondary = true;

    sync1.owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: true,
        autoplay: false,
        dots: true,
        loop: true,
        responsiveRefreshRate: 200,
        navText: [
            '<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
            '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'
        ],
    }).on('changed.owl.carousel', syncPosition);

    sync2
        .on('initialized.owl.carousel', function () {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: slidesPerPage,
            dots: true,
            nav: true,
            smartSpeed: 200,
            slideSpeed: 500,
            slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
            responsiveRefreshRate: 100
        }).on('changed.owl.carousel', syncPosition2);

    function syncPosition(el) {
        //if you set loop to false, you have to restore this next line
        //var current = el.item.index;

        //if you disable loop you have to comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }

        //end block

        sync2
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = sync2.find('.owl-item.active').length - 1;
        var start = sync2.find('.owl-item.active').first().index();
        var end = sync2.find('.owl-item.active').last().index();

        if (current > end) {
            sync2.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
            sync2.data('owl.carousel').to(current - onscreen, 100, true);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data('owl.carousel').to(number, 100, true);
        }
    }

    sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data('owl.carousel').to(number, 300, true);
    });
});
