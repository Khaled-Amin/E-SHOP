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

    function loadCart(){
        $.ajax({
            type:"GET",
            url:"/load-cart-data",
            success:function(response){
                $(".cart-count").html('');
                $('.cart-count').html(response.count);

            }
        });
    }
    function loadWishList(){
        $.ajax({
            type:"GET",
            url:"/load-wishlist-data",
            success:function(response){
                $(".wishlist-count").html('');
                $('.wishlist-count').html(response.count);
                // console.log(response.count)
            }
        });
    }


    // Here for get id product and quantity value
    $('.addToCartBtn').click(function (e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajax({
            type: "POST",
            url:"/add-to-cart",
            data:{
                "product_id" :product_id,
                "product_qty" :product_qty,
            },
            success:function(response) {
                swal(response.status);
                loadCart();
            }
        });
    });
    // Wishlists
    $('.addToWishlist').click(function (e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            type: "POST",
            url:"/add-to-wishlist",
            data:{
                "product_id" :product_id,
            },
            success:function(response) {
                swal(response.status);
                loadWishList();
            }
        });
    });

    // Here for Button increment(+) Product
    $('.increment-btn').click(function (e){
        e.preventDefault();

        // var inc_val = $('.qty-input').val();
        var inc_val = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(inc_val , 10);
        value = isNaN(value) ? 0 : value;

        if(value < 10){
            value++;
            // $('.qty-input').val(value);
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });
    // Here for Button discrement(-) Product
    $('.decrement-btn').click(function (e){
        e.preventDefault();

        // var inc_val = $('.qty-input').val();
        var dec_val = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_val , 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1){
            value--;
            // $('.qty-input').val(value);
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    // Remove Item in Shopping Cart
    $('.delete-cart-item').click(function (e){
        e.preventDefault();
        var prod_id =  $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            type: "POST",
            url:"/delete-cart-item",
            data:{
                "prod_id" :prod_id,
            },
            success:function(response) {
                window.location.reload();
                swal("",response.status , "success");
            }
        });
    });

    // Remove Wishlist
    $('.rempve-wishlist-item').click(function (e){
        e.preventDefault();
        var prod_id =  $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            type: "POST",
            url:"delete-wishlist-item",
            data:{
                "prod_id" :prod_id,
            },
            success:function(response) {
                window.location.reload();
                swal("",response.status , "success");
            }
        });
    });

    $('.changeQuantity').click(function(e){
        e.preventDefault();

        var prod_id =  $(this).closest('.product_data').find('.prod_id').val();
        var qty =  $(this).closest('.product_data').find('.qty-input').val();
        data ={
            "prod_id" :prod_id,
            "prod_qty" : qty,
        }
        $.ajax({
            type: "POST",
            url:"update-cart",
            data: data,
            success:function(response) {
                window.location.reload();
            }
        });
    });
});
