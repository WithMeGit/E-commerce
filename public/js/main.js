$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function incrementValue(quantity) {
    var value = parseInt(document.getElementById("quantity").value, 10);
    value = isNaN(value) ? 0 : value;
    if (value >= quantity) {
        toastr.warning(
            "Please enter less than product " + quantity + " in stock "
        );
    } else {
        value++;
    }
    document.getElementById("quantity").value = value;
}
function decreaseValue() {
    var value = parseInt(document.getElementById("quantity").value, 10);
    value = isNaN(value) ? 0 : value;
    if (value <= 1) {
        return;
    } else {
        value--;
    }
    document.getElementById("quantity").value = value;
}

function incrementQuantityCart(id, quantity) {
    var value = parseInt(document.getElementById(`quantity_${id}`).value, 10);
    value = isNaN(value) ? 0 : value;
    if (value >= quantity) {
        toastr.warning(
            "Please enter less than product " + quantity + " in stock "
        );
    } else {
        value++;
        $.ajax({
            method: "POST",
            dataType: "JSON",
            url: `/carts/${id}`,
            data: {
                quantity: value,
            },
        });
    }
    document.getElementById(`quantity_${id}`).value = value;
}

function decreaseQuantityCart(id) {
    var value = parseInt(document.getElementById(`quantity_${id}`).value, 10);
    value = isNaN(value) ? 0 : value;
    if (value <= 1) {
        return;
    } else {
        value--;
        $.ajax({
            method: "POST",
            dataType: "JSON",
            url: `/carts/${id}`,
            data: {
                quantity: value,
            },
        });
    }
    document.getElementById(`quantity_${id}`).value = value;
}

function addtowishlist(id) {
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "/wishlist",
        data: {
            product_id: id,
        },
    });
    window.location.href = "/wishlist";
}

$(document).ready(function () {
    $("#search_name").keyup(function () {
        var search_name = $(this).val();
        if (search_name != "") {
            $.ajax({
                url: "/home",
                method: "POST",
                data: { search_name: search_name },
                success: function (res) {
                    $("#nameProductList").fadeIn();
                    $("#nameProductList").html(res);
                },
            });
        }
    });
    $(document).on("click", "li", function () {
        $("#search_name").val($(this).text());
        $("#nameProductList").fadeOut();
    });
});
