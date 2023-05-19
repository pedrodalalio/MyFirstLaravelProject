$(document).ready(function(){
    $('.showPass').on('click', function(){
        let passInput=$(".passI");
        if(passInput.attr('type')==='password') {
            passInput.attr('type','text');
        }else{
            passInput.attr('type','password');
        }
    })
})

// ========== USER ==========

// Ajax to get roles name
$('.newUserBtn').click(function (){
    $.ajax({
        url: '/usuarios/role',
        type: 'GET',
        success: function (response) {
            $('.rolesDiv').html("");

            for (let i = 0; i < response.length; i++) {
                $('.rolesDiv').append('' +
                    '<div class="w-4 m-2">' +
                        '<input name="roles[]" type="checkbox" id="role-' + response[i].id + '" value="' + response[i].name + '">' +
                        '<label class="ml-1" for="role-' + response[i].id + '">' + response[i].name + '</label>' +
                    '</div>'
                );
            }
        }
    });
});

// Ajax creating new user
$('#btnAddUser').click(function (){
    $.ajax({
        url: '/usuarios',
        type: 'POST',
        data: $('#addForm').serialize(),
        success: function(response) {

            console.log(response);
            // Alert for empty field
            if(response.status === '412'){
                alert(response.message);
                return false;
            }

            if(response.status === '406'){
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
                    '<td>' + response[0].strRole + '</td>' +
                    '<td class="products-icon">' +
                    '<button type="button" value="'+response[0].id+'" class="btnEdit btn btn-success" data-toggle="modal"\n' + 'data-target="#editUsersModalLabel">' +
                    '<i class="ti-pencil"></i>' +
                    '</button>' +

                    '<button type="button" value="'+response[0].id+'" class="btnDelete btn btn-danger" data-toggle="modal"\n' + 'data-target="#">' +
                    '<i class="ti-trash"></i>' +
                    '</button>' +
                    '</td>' +
                    '</tr>'
                );

                $('#addUsersModalLabel').modal('hide');
            }
        }
    });
});

// Ajax showing edit use
$(document).on('click', '.btnEdit', function (){
    let id = $(this).val();

    $.ajax({
        url: '/usuarios/' + id,
        type: 'GET',
        data: id,
        success: function(response) {
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

                $('.rolesDiv').html("");

                for(let i = 0; i < response[2].length; i++){
                    if(response[3].includes(response[2][i])){
                        $('.rolesDiv').append('' +
                            '<div class="w-4 m-2">' +
                            '<input name="roles[]" type="checkbox" id="role-' + response[3][i] + '" value="' + response[4][i] + '" checked>' +
                            '<label class="ml-1" for="role-' + response[3][i] + '">' + response[4][i] + '</label>' +
                            '</div>'
                        );
                    }
                    else{
                        $('.rolesDiv').append('' +
                            '<div class="w-4 m-2">' +
                            '<input name="roles[]" type="checkbox" id="role-' + response[3][i] + '" value="' + response[4][i] + '">' +
                            '<label class="ml-1" for="role-' + response[3][i] + '">' + response[4][i] + '</label>' +
                            '</div>'
                        );
                    }
                }
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
                '<td>' + response[0].roles + '</td>' +
                '            <td class="products-icon">\n' +
                '                <button type="button" value="'+ response[0].id + '" class="btnEdit btn btn-success" data-toggle="modal"\n' +
                '                        data-target="#editUsersModalLabel">\n' +
                '                    <i class="ti-pencil"></i>\n' +
                '                </button>\n' +
                '                <button type="button" value="'+ response[0].id +'" class="btnDelete btn btn-danger" data-toggle="modal"\n' +
                '                        data-target="#">\n' +
                '                    <i class="ti-trash"></i>\n' +
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

//Ajax for user role information


// ========== PRODUCT ==========

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
                '<tr id="tre-'+ response[0].id + '">' +
                    '<th scope="row">'+ response[0].id +'</th>' +
                    '<td>'+ response[0].product_code +'</td>' +
                    '<td>'+ response[0].name +'</td>' +
                    '<td>'+ response[0].description +'</td>' +
                    '<td>'+ response[0].category +'</td>' +
                    '<td class="products-icon">' +
                        '<button type="button" value="'+ response[0].id +'" class="btnEditProduct btn btn-success" data-toggle="modal" data-target="#editProductsModalLabel">' +
                            '<i class="ti-pencil"></i>' +
                        '</button>' +

                        '<button type="button" value="'+ response[0].id +'" class="btnDeleteProduct btn btn-danger" data-toggle="modal" data-target="#">' +
                            '<i class="ti-trash"></i>' +
                        '</button>' +
                    '</td>' +
                '</tr>'
            );
            $('#addProductsModalLabel').modal('hide');
        }
    });
});

// Ajax showing edit product
$(document).on('click', '.btnEditProduct', function (){
    let id = $(this).val();

    $.ajax({
        url: "/produtos/" + id,
        type: "GET",
        data: id,
        success: function (response) {
            console.log(response[0].id);

            if(response[1].status === '404'){
                alert('Error, Product not exist');
            }

            $('#idEditP').val(response[0].id)
            $('#nameEditP').val(response[0].name);
            $('#product_codeEditP').val(response[0].product_code);
            $('#descriptionEditP').val(response[0].description);
            $('#categoryEditP').val(response[0].category);
        }
    });
});

// Ajax editing product
$('#btnFormEditProduct').click(function (){
    let id = $('#idEditP').val();

    $.ajax({
        url: '/produtos/' + id,
        type: 'POST',
        data: $('#editFormProduct').serialize(),
        success: function(response) {

            console.log(response);
            if(response.status === '406'){
                alert(response.message);
                return false;
            }

            $('#tre-' + response[0].id).html('');
            $('#tre-' + response[0].id).append(
                //'<tr id="tre-' + response[0].id + '">' +
                    '<th scope="row">'+ response[0].id +'</th>' +
                    '<td>'+ response[0].product_code +'</td>' +
                    '<td>'+ response[0].name +'</td>' +
                    '<td>'+ response[0].description +'</td>' +
                    '<td>'+ response[0].category +'</td>' +
                    '<td class="products-icon">' +
                        '<button type="button" value="'+ response[0].id +'" class="btnEditProduct btn btn-success" data-toggle="modal" data-target="#editProductsModalLabel">' +
                            '<i class="ti-pencil"></i>' +
                        '</button>' +

                        '<button type="button" value="'+ response[0].id +'" class="btnDeleteProduct btn btn-danger" data-toggle="modal" data-target="#">' +
                            '<i class="ti-trash"></i>' +
                        '</button>' +
                    '</td>' +
                '</tr>'
            );

            $('#editProductsModalLabel').modal('hide');
        }
    });
});

// Ajax deleting product
$(document).on('click', '.btnDeleteProduct ', function () {

    let id = $(this).val();
    let confirmation;
    confirmation = confirm("You want to delete the product id: " + id);

    if(confirmation){
        $.ajax({
            url: "/produtos/delete/" + id,
            type: "GET",
            data: id,
            success: function (response) {
                console.log(response);

                if(response.status === '404'){
                    alert('Error, Product not exist');
                }

                $('#tre-' + response[0]).html("");
            }
        });
    }
});

// ========== DATA TABLE ===========
$(document).ready( function () {
    $('#userTable').DataTable();
    $('#manageTable').DataTable();
} );
