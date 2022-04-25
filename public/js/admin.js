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

$(document).ready(function () {});
