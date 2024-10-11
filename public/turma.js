// $(document).ready(function () {
//     var currentPage = 1;
//     var turmasPerPage = 4;

//     // Função para carregar turmas
//     function loadTurmas(page, search = '') {
//         $.ajax({
//             url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
//             method: 'POST',
//             data: {
//                 action: 'getTurmas',
//                 offset: (page - 1) * turmasPerPage,
//                 limit: turmasPerPage,
//                 search: search
//             },
//             dataType: 'json',
//             success: function (data) {
//                 $('#turmaTable tbody').empty();
//                 $.each(data.turmas, function (index, turma) {
//                     $('#turmaTable tbody').append(`
//                         <tr>
//                             <td>${turma.id}</td>
//                             <td>${turma.turma}</td>
//                             <td>${turma.curso}</td>
//                             <td>${turma.classe}</td>
//                             <td>${turma.turno}</td>
//                             <td>
//                                 <button class="btn btn-warning editBtn" data-toggle="modal" data-target="#turmaModal" data-id="${turma.id}">Editar</button>
//                                 <button class="btn btn-danger deleteBtn" data-id="${turma.id}">Excluir</button>
//                             </td>
//                         </tr>
//                     `);
//                 });

//                 // Atualizar estado dos botões de paginação
//                 $('#nextPage').prop('disabled', data.total <= turmasPerPage * currentPage);
//                 $('#prevPage').prop('disabled', currentPage === 1);
//             }
//         });
//     }

//     // Carregar turmas na inicialização
//     loadTurmas(currentPage);

//     // Função de Paginação
//     $('#nextPage').click(function () {
//         currentPage++;
//         loadTurmas(currentPage, $('#search').val());
//     });

//     $('#prevPage').click(function () {
//         currentPage--;
//         loadTurmas(currentPage, $('#search').val());
//     });

//     // Pesquisa
//     $('#search').keyup(function () {
//         loadTurmas(1, $(this).val());
//     });

//     function cadastrarTurma() {
//         var formData = $('#turmaForm').serialize();
//         formData += '&action=add'; // Definindo a ação como 'add' para cadastro
        
//         $.ajax({
//             url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
//             method: 'POST',
//             data: formData,
//             success: function (response) {
//                 var res = JSON.parse(response);
//                 showToast(res.message); // Mostrar toast com a mensagem recebida
//                 if (res.success) {
//                     loadTurmas(currentPage);
//                     $('#turmaForm')[0].reset();
//                     $('#turmaModal').modal('hide');
//                 }
//             }
//         });
//     }
    
    
//     function editarTurma() {
//         var formData = $('#turmaForm').serialize();
//         formData += '&action=update'; // Definindo a ação como 'update' para edição
        
//         $.ajax({
//             url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
//             method: 'POST',
//             data: formData,
//             success: function (response) {
//                 var res = JSON.parse(response);
//                 showToast(res.message); // Mostrar toast com a mensagem recebida
//                 if (res.success) {
//                     loadTurmas(currentPage);
//                     $('#turmaForm')[0].reset();
//                     $('#turmaModal').modal('hide');
//                 }
//             }
//         });
//     }
//     $('#turmaForm').submit(function (e) {
//         e.preventDefault();
        
//         if ($('#id').val()) {
//             editarTurma(); // Se houver um ID, edita a turma
//         } else {
//             cadastrarTurma(); // Se não houver ID, cadastra uma nova turma
//         }
//     });
        
    
//     // Função para exibir toast do Bootstrap
//     function showToast(message) {
//         var toastHTML = `
//             <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
//                 <div class="toast-header">
//                     <strong class="me-auto">Notificação</strong>
//                     <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
//                 </div>
//                 <div class="toast-body">
//                     ${message}
//                 </div>
//             </div>
//         `;
//         $('#toastContainer').append(toastHTML); // Adicione o toast ao container
//         $('.toast').last().toast('show'); // Exiba o último toast adicionado
//     }
    

//     // Carregar dropdowns ao abrir o modal
//     function loadDropdowns() {
//         loadCursos();
//         loadClasses();
//         loadTurnos();
//     }

//     // Carregar dropdowns ao abrir o modal
//     $('#turmaModal').on('show.bs.modal', function () {
//         loadDropdowns(); // Carregar dropdowns
//         $('#turmaForm')[0].reset(); // Limpar o formulário
//         $('#id').val(''); // Resetar ID
//     });

//     // Editar turma
//     $(document).on('click', '.editBtn', function () {
//         var id = $(this).data('id');

//         // Carregar os dados da turma
//         $.ajax({
//             url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
//             method: 'POST',
//             data: { action: 'getSingleTurma', id: id },
//             success: function (response) {
//                 var turma = JSON.parse(response);
//                 $('#id').val(turma.id);
//                 $('#nome').val(turma.nome);
//                 $('#id_curso').val(turma.id_curso);
//                 $('#id_classe').val(turma.id_classe);
//                 $('#id_turno').val(turma.id_turno);
//                 $('#ano_lectivo').val(turma.ano_lectivo);

//                 loadDropdowns(); // Carregar dropdowns novamente para garantir que eles estejam atualizados

//                 $('#turmaModal').modal('show');
//             }
//         });
//     });

//     // Funções para carregar cursos, classes e turnos
//     function loadCursos() {
//         $.ajax({
//             url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
//             method: 'POST',
//             data: { action: 'getCursos' },
//             success: function (response) {
//                 var cursos = JSON.parse(response);
//                 $('#id_curso').empty();
//                 $.each(cursos, function (index, curso) {
//                     $('#id_curso').append(`<option value="${curso.id}">${curso.nome}</option>`);
//                 });
//             }
//         });
//     }

//     function loadClasses() {
//         $.ajax({
//             url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
//             method: 'POST',
//             data: { action: 'getClasses' },
//             success: function (response) {
//                 var classes = JSON.parse(response);
//                 $('#id_classe').empty();
//                 $.each(classes, function (index, classe) {
//                     $('#id_classe').append(`<option value="${classe.id}">${classe.nome}</option>`);
//                 });
//             }
//         });
//     }

//     function loadTurnos() {
//         $.ajax({
//             url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
//             method: 'POST',
//             data: { action: 'getTurnos' },
//             success: function (response) {
//                 var turnos = JSON.parse(response);
//                 $('#id_turno').empty();
//                 $.each(turnos, function (index, turno) {
//                     $('#id_turno').append(`<option value="${turno.id}">${turno.nome}</option>`);
//                 });
//             }
//         });
//     }

//     // Excluir turma
//     $(document).on('click', '.deleteBtn', function () {
//         var id = $(this).data('id');
//         if (confirm('Deseja realmente excluir esta turma?')) {
//             $.ajax({
//                 url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
//                 method: 'POST',
//                 data: { action: 'delete', id: id },
//                 success: function (response) {
//                     loadTurmas(currentPage);
//                 }
//             });
//         }
//     });
// });

$(document).ready(function () {
    var currentPage = 1;
    var turmasPerPage = 4;

    // Função para carregar turmas
    function loadTurmas(page, search = '') {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            method: 'POST',
            data: {
                action: 'getTurmas',
                offset: (page - 1) * turmasPerPage,
                limit: turmasPerPage,
                search: search
            },
            dataType: 'json',
            success: function (data) {
                $('#turmaTable tbody').empty();
                $.each(data.turmas, function (index, turma) {
                    $('#turmaTable tbody').append(`
                        <tr>
                            <td>${turma.id}</td>
                            <td>${turma.turma}</td>
                            <td>${turma.curso}</td>
                            <td>${turma.classe}</td>
                            <td>${turma.turno}</td>
                            <td>
                                <button class="btn btn-warning editBtn" data-toggle="modal" data-target="#turmaModal" data-id="${turma.id}">Editar</button>
                                <button class="btn btn-danger deleteBtn" data-id="${turma.id}">Excluir</button>
                            </td>
                        </tr>
                    `);
                });

                // Atualizar estado dos botões de paginação
                $('#nextPage').prop('disabled', data.total <= turmasPerPage * currentPage);
                $('#prevPage').prop('disabled', currentPage === 1);
            }
        });
    }

    // Carregar turmas na inicialização
    loadTurmas(currentPage);

    // Função de Paginação
    $('#nextPage').click(function () {
        currentPage++;
        loadTurmas(currentPage, $('#search').val());
    });

    $('#prevPage').click(function () {
        currentPage--;
        loadTurmas(currentPage, $('#search').val());
    });

    // Pesquisa
    $('#search').keyup(function () {
        loadTurmas(1, $(this).val());
    });

    // Função para cadastrar turma
    function cadastrarTurma() {
        var formData = $('#turmaForm').serialize();
        formData += '&action=add'; // Definindo a ação como 'add' para cadastro

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            method: 'POST',
            data: formData,
            success: function (response) {
                var res = JSON.parse(response);
                showToast(res.message); // Mostrar toast com a mensagem recebida
                if (res.success) {
                    loadTurmas(currentPage);
                    $('#turmaForm')[0].reset();
                    $('#turmaModal').modal('hide');
                }
            }
        });
    }

    // Função para editar turma
    function editarTurma() {
        var formData = $('#turmaForm').serialize();
        formData += '&action=update'; // Definindo a ação como 'update' para edição

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            method: 'POST',
            data: formData,
            success: function (response) {
                var res = JSON.parse(response);
                showToast(res.message); // Mostrar toast com a mensagem recebida
                if (res.success) {
                    loadTurmas(currentPage); // Recarregar a lista de turmas
                    $('#turmaForm')[0].reset();
                    $('#turmaModal').modal('hide');
                }
            }
        });
    }

    // Submissão do formulário (cadastrar ou editar)
    $('#turmaForm').submit(function (e) {
        e.preventDefault();

        if ($('#id').val()) {
            editarTurma(); // Se houver um ID, edita a turma
            loadTurmas(currentPage);
            $('#turmaForm')[0].reset();
            $('#turmaModal').modal('hide');
        } else {
            cadastrarTurma(); // Se não houver ID, cadastra uma nova turma
        }
    });

    // Função para exibir toast do Bootstrap com duração de 1 minuto
    function showToast(message) {
        var toastId = 'toast' + Math.random().toString(36).substr(2, 9); // Gerar ID único para o toast
        var toastHTML = `
            <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="60000">
                <div class="toast-header">
                    <strong class="me-auto">Notificação</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;
        $('#toastContainer').append(toastHTML); // Adicione o toast ao container
        $('#' + toastId).toast('show'); // Exiba o toast adicionado
    }

    // Carregar dropdowns ao abrir o modal
    function loadDropdowns() {
        loadCursos();
        loadClasses();
        loadTurnos();
    }

    // Carregar dropdowns ao abrir o modal
    $('#turmaModal').on('show.bs.modal', function () {
        loadDropdowns(); // Carregar dropdowns
        $('#turmaForm')[0].reset(); // Limpar o formulário
        $('#id').val(''); // Resetar ID
    });

    // Editar turma
    $(document).on('click', '.editBtn', function () {
        var id = $(this).data('id');

        // Carregar os dados da turma
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            method: 'POST',
            data: { action: 'getSingleTurma', id: id },
            success: function (response) {
                var turma = JSON.parse(response);
                $('#id').val(turma.id);
                $('#nome').val(turma.nome);
                $('#id_curso').val(turma.id_curso);
                $('#id_classe').val(turma.id_classe);
                $('#id_turno').val(turma.id_turno);
                $('#ano_lectivo').val(turma.ano_lectivo);

                loadDropdowns(); // Carregar dropdowns novamente para garantir que eles estejam atualizados

                $('#turmaModal').modal('show');
            }
        });
    });

    // Funções para carregar cursos, classes e turnos
    function loadCursos() {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            method: 'POST',
            data: { action: 'getCursos' },
            success: function (response) {
                var cursos = JSON.parse(response);
                $('#id_curso').empty();
                $.each(cursos, function (index, curso) {
                    $('#id_curso').append(`<option value="${curso.id}">${curso.nome}</option>`);
                });
            }
        });
    }

    function loadClasses() {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            method: 'POST',
            data: { action: 'getClasses' },
            success: function (response) {
                var classes = JSON.parse(response);
                $('#id_classe').empty();
                $.each(classes, function (index, classe) {
                    $('#id_classe').append(`<option value="${classe.id}">${classe.nome}</option>`);
                });
            }
        });
    }

    function loadTurnos() {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            method: 'POST',
            data: { action: 'getTurnos' },
            success: function (response) {
                var turnos = JSON.parse(response);
                $('#id_turno').empty();
                $.each(turnos, function (index, turno) {
                    $('#id_turno').append(`<option value="${turno.id}">${turno.nome}</option>`);
                });
            }
        });
    }

    // Excluir turma
    $(document).on('click', '.deleteBtn', function () {
        var id = $(this).data('id');
        if (confirm('Deseja realmente excluir esta turma?')) {
            $.ajax({
                url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
                method: 'POST',
                data: { action: 'delete', id: id },
                success: function (response) {
                    loadTurmas(currentPage);
                    showToast('Turma excluída com sucesso!'); // Exibir notificação de exclusão
                }
            });
        }
    });
});
