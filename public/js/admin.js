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
        $('#description').text('Description: ' + res.name);
        $('#content').text('content: ' + res.name);
        let active = res.active == '1' ? true : false;
        $('#active').text('active: ' + active);
    })
}

function editItem(url){
    window.location.href = url;
}

function deleteItem(id,url){
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

$(document).ready(function (){
     $(document).on('submit','#editform', function (e){
         var id = $('#editid').val();
         var name = $('#editname').val();
         var description = $('#editdescription').val();
         var content = $('#editcontent').val();

         var active_check = document.getElementsByName('active_edit');
         if(active_check[0].checked){
             var active = $('#editactive1').val();
         }else if(active_check[1].checked){
             var active = $('#editactive0').val();
         }
         const editdata = {name,description,content,active}
         $.ajax({
             method: 'POST',
             dataType: "JSON",
             url: `/admin/category/${id}`,
             data:{
                 _token: $('#token').val(),
                 data: editdata,
             },
         });
     })
})

