$('#btnAddUser').click(function (){

    $.ajax({
        url: '/usuarios',
        type: 'POST',
        data: $('#addForm').serialize(),
        success: function(response) {
            alert(response.message);
        }
    });
});
