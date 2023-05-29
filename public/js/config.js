// Show password in inputs
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
        '<td>'+ response[0].measurement_units +'</td>' +
        '<td>'+ response[0].unit_quantity +'</td>' +
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
  confirmation = confirm("You want to delete the product id: " + id + " and dependencies");

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
  $('#stockTable').DataTable();
} );

// ========== Movements ===========
// Ajax gets batch automatically from DB in NewMovement Modal
$(document).on('blur', '#batchMoviment', function (){
  let id = $('#batchMoviment').val();
  $('#divText').html('');

  if(id){
    $.ajax({
      url: "/manage/batches/" + id,
      type: "GET",
      data: id,
      success: function (response) {
        console.log(response);
        if(response.status === "404"){
          Swal.fire('This batch does not exist yet, a new one will be created');

          $('#batchValidity').val('');
          $('#batchValidity').css("pointer-events", "auto");

          $('#batchActive').val('');
          $('#batchActive').css("pointer-events", "auto");
        }
        else {
          $('#batchValidity').val(response.dt_validity);
          $('#batchValidity').css("pointer-events", "none");
          $('#batchValidity').css("background-color", "#E9ECEF");

          $('#batchActive').val(response.active);
          $('#batchActive').css("pointer-events", "none");
          $('#batchActive').css("background-color", "#E9ECEF");
        }
      }
    });
  }
});

// Ajax gets product code automatically from DB in NewMovement Modal
$(document).on('blur', '#movementProductCode', function(){
  let id = $(this).val();

  if(id){
    $.ajax({
      url: "/manage/products/" + id,
      type: "GET",
      data: id,
      success: function (response) {
        if(response.status === "404"){
          Swal.fire(response.message);

          $('#movementProductName').val('');
        }
        else {
          $('#alertText').html('');
          $('#movementProductName').val(response.name);
        }
      }
    });
  }
});

// Change the option in origin select in Add Modal
$('.selectPickerAdd').change(function () {
  let selectedItem = $('.selectPickerAdd').val();
  $('#originMovement').html('');
  if(selectedItem === 'entry'){
    $('#originMovement').css("pointer-events", "auto");
    $('#originMovement').css("background-color", "#fff");
    $('#originMovement').append('' +
      '<option value="unifae">Unifae</option>' +
      '<option value="prefeitura">Prefeitura</option>'
    );
  }
  else if(selectedItem === 'output'){
    $('#originMovement').append('' +
      '<option value="none">None</option>'
    );
    $('#originMovement').css("pointer-events", "none");
    $('#originMovement').css("background-color", "#E9ECEF");
  }
  else{
    $('#originMovement').css("pointer-events", "none");
    $('#originMovement').css("background-color", "#E9ECEF");
  }
});

// JQuery for open modal
$(document).on('click', '.btnAddMovementModal', function (){
  $('#addMovementModal').modal('show');
  $('#movementProductName').css("pointer-events", "none");
  $('#movementProductName').css("background-color", "#E9ECEF");
})

// Ajax is creating a New Movement
$(document).on('click', '#btnAddMovement', function (){
  $.ajax({
    url: '/manage',
    type: 'POST',
    data: $('#addFormProduct').serialize(),
    success: function(response) {
      console.log(response);

      if(response.status === '400'){
        Swal.fire(response.message);
      }
      $('#tbodyStock').append('' +
        '<tr id="stock_id-'+ response.id + '">' +
          '<th scope="row">'+ response.id +'</th>' +
          '<td>'+ response.product_code +'</td>' +
          '<td>'+ response[0].num_batch +'</td>' +
          '<td>'+ response[1].type +'</td>' +
          '<td>'+ response[1].origin +'</td>' +
          '<td>'+ response[1].qt_product +'</td>' +
          '<td>'+ response[1].dt_movimentation +'</td>' +
          '<td class="d-flex justify-content-around">' +
            '<button type="button" value="'+ response.id +'" id="btnEditMovement" class="btn btn-success"' +
            '<i class="ti-pencil"></i>' +
            '</button>' +
          '</td>' +
        '</tr>');
      $('#addMovementModal').modal('hide');
    }
  });
})

// Change the option in origin select in Edit Modal
$('.selectTypeEdit').change(function () {
  let selectedItem = $('.selectpicker').val();
  $('#originMovementEdit').html('');
  if(selectedItem === 'entry'){
    $('#originMovementEdit').css("pointer-events", "auto");
    $('#originMovementEdit').css("background-color", "#fff");
    $('#originMovementEdit').append('' +
      '<option value="unifae">Unifae</option>' +
      '<option value="prefeitura">Prefeitura</option>'
    );
  }
  else if(selectedItem === 'output'){
    $('#originMovementEdit').append('' +
      '<option value="none">None</option>'
    );
    $('#originMovementEdit').css("pointer-events", "none");
    $('#originMovementEdit').css("background-color", "#E9ECEF");
  }
  else{
    $('#originMovementEdit').css("pointer-events", "none");
    $('#originMovementEdit').css("background-color", "#E9ECEF");
  }
});

// Ajax is getting info from a Movement
$(document).on('click', '.btnEditMovement', function (){
  let id = $(this).val()
  $.ajax({
    url: '/manage/' + id,
    type: 'GET',
    data: id,
    success: function(response) {
      $('#idMovementEdit').val(response.id);
      $('#movementProductCodeEdit').val(response.product_code);
      $('#movementProductNameEdit').val(response.name);
      $('#movementProductNameEdit').css("pointer-events", "none");
      $('#batchMovimentEdit').val(response.num_batch);
      $('#batchValidityEdit').val(response.dt_validity);
      $('#batchActiveEdit').val(response.active);
      $('#qtMovementEdit').val(response.qt_product);
      $('#dateMovementEdit').val(response.dt_movimentation);
      $('#movementTypeEdit').val(response.type);
      $('.selectpicker').selectpicker('refresh');

      if(response.type === "entry"){
        $('#originMovementEdit').html('');
        $('#originMovementEdit').css("pointer-events", "auto");
        $('#originMovementEdit').css("background-color", "#fff");
        $('#originMovementEdit').append('' +
          '<option value="unifae">Unifae</option>' +
          '<option value="prefeitura">Prefeitura</option>'
        );

        $('#originMovementEdit').val(response.origin);
      }
      else if(response.type === "output"){
        $('#originMovementEdit').html('');
        $('#originMovementEdit').css("pointer-events", "none");
        $('#originMovementEdit').css("background-color", "#E9ECEF");
        $('#originMovementEdit').append('' +
          '<option value="none">None</option>'
        );

        $('#originMovementEdit').val(response.origin);
      }
      $('#editMovementModal').modal('show');
    }
  })
})

// Ajax is editing a Movement
$(document).on('click', '#btnFormEditMovement', function (){
  let id = $('#idMovementEdit').val();
  $.ajax({
    url: '/manage/' + id,
    type: 'POST',
    data: $('#editFormMovement').serialize(), id,
    success: function(response) {
      if(response.status === '400'){
        Swal.fire(response.message);
        return false;
      }

      $('#stock_id-' + response['movement'].id_movement).html('');
      $('#stock_id-' + response['movement'].id_movement).append(
        '<th scope="row">'+ response['movement'].id_movement +'</th>' +
        '<td>'+ response.product_code +'</td>' +
        '<td>'+ response['batch'].num_batch +'</td>' +
        '<td>'+ response.type +'</td>' +
        '<td>'+ response.origin +'</td>' +
        '<td>'+ response['movement'].qt_product +'</td>' +
        '<td>'+ response['movement'].dt_movimentation +'</td>' +
        '<td class="products-icon">' +
        '<button type="button" value="'+ response['batch'].id +'" class="btnEditMovement btn btn-success" data-toggle="modal" data-target="#editMovementModal">' +
        '<i class="ti-pencil"></i>' +
        '</button>' +
        '</td>'
      );
      $('.editModalTest').modal('hide');
    }
  });
})

// Ajax gets batch automatically from DB in EditMovement Modal
$(document).on('blur', '#batchMovimentEdit', function (){
  let id = $('#batchMovimentEdit').val();
  $('#divTextEdit').html('');

  if(id){
    $.ajax({
      url: "/manage/batches/" + id,
      type: "GET",
      data: id,
      success: function (response) {
        console.log(response);
        if(response.status === "404"){
          Swal.fire('This batch does not exist yet, a new one will be created');
          //$('#divText').html('<p>'+ response.message + '</p>');

          $('#batchValidityEdit').val('');
          $('#batchValidityEdit').css("pointer-events", "auto");

          $('#batchActiveEdit').val('');
          $('#batchActiveEdit').css("pointer-events", "auto");
        }
        else {
          $('#batchValidityEdit').val(response.dt_validity);
          $('#batchValidityEdit').css("pointer-events", "none");

          $('#batchActiveEdit').val(response.active);
          $('#batchActiveEdit').css("pointer-events", "none");
        }
      }
    });
  }
});

// Ajax gets product code automatically from DB in EditMovement Modal
$(document).on('blur', '#movementProductCodeEdit', function(){
  let id = $(this).val();

  if(id){
    $.ajax({
      url: "/manage/products/" + id,
      type: "GET",
      data: id,
      success: function (response) {
        console.log(response);
        if(response.status === "404"){
          Swal.fire(response.message);

          $('#movementProductNameEdit').val('');
        }
        else {
          $('#alertText').html('');
          $('#movementProductNameEdit').val(response.name);
        }
      }
    });
  }
});
