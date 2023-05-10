//config input password to show
$(document).ready(function(){
    $('.showPass').on('click', function(){
        let passInput=$(".passI");
        if(passInput.attr('type')==='password')
        {
            passInput.attr('type','text');
        }else{
            passInput.attr('type','password');
        }
    })
})

// Ajax creating new user
$('#btnAddUser').click(function (){
    $.ajax({
        url: '/usuarios',
        type: 'POST',
        data: $('#addForm').serialize(),
        success: function(response) {
            //console.log(response);

            // Alert for empty field
            if(response.status === '412'){
                alert(response.message);
                return false;
            }

            if(response[1].status === '406'){
                alert('Error');
            }
            else{
                $('#tbodyAdd').append(
                    '<tr>' +
                    '<td>' + response[0].id + '</td>' +
                    '<td>' + response[0].name + '</td>' +
                    '<td>' + response[0].email + '</td>' +
                    '<td>' + response[0].cpf + '</td>' +
                    '<td>' + response[0].phone + '</td>' +
                    '<td>' + response[0].registration + '</td>' +
                    '<td>' + response[0].role + '</td>' +
                    '<td class="products-icon">' +
                    '<button type="button" value="'+response[0].id+'" class="btnEdit btn btn-success" data-toggle="modal"\n' + 'data-target="#editUsersModalLabel">' +
                    '<i class="ti-pencil"></i><span class="ml-1">Edit</span>' +
                    '</button>' +

                    '<button type="button" value="-'+response[0].id+'" class="btnDelete btn btn-danger" data-toggle="modal"\n' + 'data-target="#">' +
                    '<i class="ti-trash"></i><span class="ml-1">Delete</span>' +
                    '</button>' +
                    '</td>' +
                    '</tr>'
                );

                $('#addUsersModalLabel').modal('hide');
            }
        }
    });
});

// Ajax showing edit user
$('.btnEdit').click(function () {
    let id = $(this).val();

    $.ajax({
        url: '/usuarios/' + id,
        type: 'GET',
        data: id,
        success: function(response) {
            //console.log(response);

            if(response[1].status === '404'){
                alert('Error, User not exist');
            }
            else{
                $('#id').val(response[0].id)
                $('#nameEdit').val(response[0].name);
                $('#emailEdit').val(response[0].email);
                $('#cpfEdit').val(response[0].cpf);
                $('#phoneEdit').val(response[0].phone);
                $('#registrationEdit').val(response[0].registration);
                $('#roleEdit').val(response[0].role);
            }
        }
    });
});
// Ajax editing user

$('#btnEditUser').click(function (){
    let id = $('#id').val();
    console.log(id);

    $.ajax({
        url: '/usuarios/' + id,
        type: 'POST',
        data: $('#editForm').serialize(),
        success: function(response) {
            //console.log(response);
            alert(response.message);
            $('#editUsersModalLabel').modal('hide');
        }
    });
});
