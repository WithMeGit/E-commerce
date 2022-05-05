$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function detailBrand(id, url) {
    $.ajax({
        method: "GET",
        dataType: "JSON",
        url: url,
        data: id,
    }).done(function (res) {
        $("#name").text("Name: " + res.name);
        $("#description").text("Description: " + res.description);
        let active = res.active == "1" ? true : false;
        $("#active").text("active: " + active);
    });
}

function detailCategory(id, url) {
    $.ajax({
        method: "GET",
        dataType: "JSON",
        url: url,
        data: id,
    }).done(function (res) {
        $("#name").text("Name: " + res.name);
        $("#description").text("Description: " + res.description);
        $("#image").attr("src", res.image);
        let active = res.active == "1" ? true : false;
        $("#active").text("active: " + active);
    });
}

function detailCoupon(id, url) {
    $.ajax({
        method: "GET",
        dataType: "JSON",
        url: url,
        data: id,
    }).done(function (res) {
        $("#code").text("Code: " + res.code);
        $("#value").text("Value: " + res.value + "%");
        $("#quantity").text("Quantity: " + res.quantity);
    });
}

function editItem(url) {
    window.location.href = url;
}

function deleteItem(url) {
    $.ajax({
        method: "DELETE",
        dataType: "JSON",
        url: url,
        success: function (res) {
            location.reload();
            toastr.success("Deleted Successfully!");
        },
    });
}

function shipping(value, ok, url) {
    $.ajax({
        type: "POST",
        dataType: "JSON",
        data: { value, ok },
        url: url,
        success: function (res) {
            if (res === 1) {
                location.reload();
            }
        },
    });
}

function viewOrder(url) {
    window.location.href = url;
}

$(document).ready(function () {});
