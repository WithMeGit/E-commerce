$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function incrementValue(quantity) {
    var value = parseInt(document.getElementById("quantity").value, 10);
    value = isNaN(value) ? 0 : value;
    console.log(value);
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
    console.log(value);
    if (value >= quantity) {
        toastr.warning(
            "Please enter less than product " + quantity + " in stock "
        );
    } else {
        value++;
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
