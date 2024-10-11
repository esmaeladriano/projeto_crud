$(document).ready(function() {
    var currentPage = 1;
    var usersPerPage = 4;

    function loadUsers(page, search = '') {
        $.ajax({
            url: '../controllers/UserController.php',
            method: 'POST',
            data: { action: 'getUsers', offset: (page - 1) * usersPerPage, limit: usersPerPage, search: search },
            dataType: 'json',
            success: function(data) {
                $('#userTable tbody').empty();
                $.each(data.users, function(index, user) {
                    $('#userTable tbody').append(`
                        <tr>
                            <td>${user.nome}</td>
                            <td>${user.email}</td>
                            <td>${user.telefone}</td>
                            <td><img src="${user.foto}" width="50"></td>
                            <td>
                                <button class="editBtn" data-id="${user.id}">Editar</button>
                                 <button class="deleteBtn" data-id="${user.id}">Excluir</button>
                            </td>
                        </tr>
                    `);
                });

                if (data.total <= usersPerPage * currentPage) {
                    $('#nextPage').prop('disabled', true);
                } else {
                    $('#nextPage').prop('disabled', false);
                }
                if (currentPage == 1) {
                    $('#prevPage').prop('disabled', true);
                } else {
                    $('#prevPage').prop('disabled', false);
                }
            }
        });
    }

    loadUsers(currentPage);

    $('#nextPage').click(function() {
        currentPage++;
        loadUsers(currentPage, $('#search').val());
    });

    $('#prevPage').click(function() {
        currentPage--;
        loadUsers(currentPage, $('#search').val());
    });
  
    $('#search').keyup(function() {
        loadUsers(1, $(this).val());
    });

    $('#userForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('action', $('#userId').val() ? 'update' : 'add');

        $.ajax({
            url: '../controllers/UserController.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                loadUsers(currentPage);
                $('#userForm')[0].reset();
            }
        });
    });

    $(document).on('click', '.deleteBtn', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '../controllers/UserController.php',
            method: 'POST',
            data: { action: 'delete', id: id },
            success: function(response) {
                loadUsers(currentPage);
            }
        });
    });

    $(document).on('click', '.editBtn', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '../controllers/UserController.php',
            method: 'POST',
            data: { action: 'getSingleUser', id: id },
            success: function(response) {
                var user = JSON.parse(response)
                $('#userId').val(user.id);
                $('#nome').val(user.nome);
                $('#email').val(user.email);
                $('#telefone').val(user.telefone);
            }
        });
    });
});
