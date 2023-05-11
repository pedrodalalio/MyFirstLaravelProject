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
                    '<tr id="tr-' + response[0].id + '">' +
                    '<th scope="row">' + response[0].id + '</th>' +
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

                    '<button type="button" value="'+response[0].id+'" class="btnDelete btn btn-danger" data-toggle="modal"\n' + 'data-target="#">' +
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

    $.ajax({
        url: '/usuarios/' + id,
        type: 'POST',
        data: $('#editForm').serialize(),
        success: function(response) {

            // if(response.status === '401'){
            //     alert(response.message);
            //     return false;
            // }

            if(response[1].status === '406'){
                alert(this.message);
            }

            $('#tr-' + response[0].id).html('');
            $('#tr-' + response[0].id).append('' +
                '<th scope="row">' + response[0].id + '</th>' +
                '<td>' + response[0].name + '</td>' +
                '<td>' + response[0].email + '</td>' +
                '<td>' + response[0].cpf + '</td>' +
                '<td>' + response[0].phone + '</td>' +
                '<td>' + response[0].registration + '</td>' +
                '<td>' + response[0].role + '</td>' +
                '            <td class="products-icon">\n' +
                '                <button type="button" value="'+ response[0].id + '" class="btnEdit btn btn-success" data-toggle="modal"\n' +
                '                        data-target="#editUsersModalLabel">\n' +
                '                    <i class="ti-pencil"></i><span class="ml-1">Edit</span>\n' +
                '                </button>\n' +
                '                <button type="button" value="'+ response[0].id +'" class="btnDelete btn btn-danger" data-toggle="modal"\n' +
                '                        data-target="#">\n' +
                '                    <i class="ti-trash"></i><span class="ml-1">Delete</span>\n' +
                '                </button>\n' +
                '            </td>');
            $('#editUsersModalLabel').modal('hide');
        }
    });
});

// Ajax deleting user
$(document).on('click', '.btnDelete', function (){

   let id = $(this).val();
   let res = confirm('You want to delete user for id: ' + id);

   if(res){
       $.ajax({
           url: '/usuarios/delete/' + id,
           type: 'GET',
           data: id,
           success: function(response) {
               console.log(response);

               if(response[1].status === '404'){
                   alert('Error, User not exist');
               }

               $('#tr-' + response[0]).html("");
           }
       });
   }
});

// Ajax creating new product
$('#btnAddProduct').click(function (){
    $.ajax({
        url: '/produtos',
        type: 'POST',
        data: $('#addFormProduct').serialize(),
        success: function(response) {
            console.log(response);

            // Alert for empty field
            if(response.status === '412'){
                alert(response.message);
                return false;
            }
            else if(response[1].status === '406'){
                alert('Error');
            }

            $('#tbodyEdit').append('' +
                'ok');
            $('#addProductsModalLabel').modal('hide');
        }
    });
});
// Ajax showing edit product

// Ajax editing product

// Ajax deleting product
