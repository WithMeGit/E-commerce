$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function detailItem(id,url){
    $.ajax({
        method: 'GET',
        dataType: 'JSON',
        url: url,
        data: id,
    }).done(function (res){
        $('#name').text('Name: ' + res.name);
        $('#description').text('Description: ' + res.description);
        $('#content').text('content: ' + res.content);
        let active = res.active == '1' ? true : false;
        $('#active').text('active: ' + active);
    })
}

function editItem(url){
    window.location.href = url;
}

function deleteItem(url){
    var result = confirm('Do you want to delete');
    if(result)  {
        $.ajax({
            method: "DELETE",
            dataType: "JSON",
            url: url,
            success: function (res){
                if(res == 1){
                    toastr.success('Deleted Successfully');
                    location.reload();
                }
            }
        })
    }
}

function detailProduct(id,url){
    console.log(id);
    console.log(url);
}

$(document).ready(function (){
     $(document).on('submit','#editform', function (e){

     })
})

