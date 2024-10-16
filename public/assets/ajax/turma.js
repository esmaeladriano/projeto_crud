$(document).ready(function () {
    let currentPage = 1;
    const itemsPerPage = 4;

    // Inicializando
    carregarTurmas();

    // Eventos
    $('#pesquisa').on('input', function () {
        currentPage = 1; // Reseta a página atual para 1 ao pesquisar
        carregarTurmas();
    });

    $('#adicionarTurmaBtn').click(function () {
        $('#turmaForm')[0].reset();
        $('#turmaId').val('');
        $('#turmaModalLabel').text('Adicionar Turma');
        carregarClasses(); // Carregar classes
        carregarCursos();  // Carregar cursos
        $('#turmaModal').modal('show');
    });

    $('#salvarTurmaBtn').click(function (e) {
        e.preventDefault();
        salvarTurma();
    });

    $(document).on('click', '.editarTurmaBtn', function () {
        let id = $(this).data('id');
        editarTurma(id);
    });

    $(document).on('click', '.deletarTurmaBtn', function () {
        let id = $(this).data('id');
        deletarTurma(id);
    });

    // Funções

    function carregarTurmas() {
        let search = $('#pesquisa').val();
        let offset = (currentPage - 1) * itemsPerPage;

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            type: 'POST',
            data: {
                action: 'listar',
                offset: offset,
                limit: itemsPerPage,
                search: search
            },
            success: function (response) {
                let result = JSON.parse(response);
                let turmas = result.turmas;
                let total = result.total;
                atualizarTabelaTurmas(turmas);
                atualizarPaginacao(total);
            }
        });
    }

    function atualizarTabelaTurmas(turmas) {
        let tabela = '';
        turmas.forEach(function (turma) {
            tabela += `
                <tr>
                    <td>${turma.id}</td>
                    <td>${turma.nome}</td>
                    <td>${turma.id_classe}</td>
                    <td>${turma.id_curso}</td>
                    <td>${turma.ano}</td>
                    <td>
                        <button class="btn btn-sm btn-warning editarTurmaBtn" data-id="${turma.id}">Editar</button>
                        <button class="btn btn-sm btn-danger deletarTurmaBtn" data-id="${turma.id}">Deletar</button>
                    </td>
                </tr>
            `;
        });
        $('#turmaTableBody').html(tabela);
    }

    function atualizarPaginacao(totalItems) {
        let totalPages = Math.ceil(totalItems / itemsPerPage);
        let paginacaoHtml = '';

        for (let i = 1; i <= totalPages; i++) {
            let activeClass = i === currentPage ? 'active' : '';
            paginacaoHtml += `<li class="page-item ${activeClass}"><a class="page-link" href="#">${i}</a></li>`;
        }

        $('#pagination').html(paginacaoHtml);

        $('.page-link').click(function (e) {
            e.preventDefault();
            currentPage = parseInt($(this).text());
            carregarTurmas();
        });
    }

    function salvarTurma() {
        let id = $('#turmaId').val();
        let nome = $('#nome').val();
        let id_classe = $('#id_classe').val(); // Obtém o ID da classe selecionada
        let id_curso = $('#id_curso').val(); // Obtém o ID do curso selecionado
        let ano = $('#ano').val(); // Obtém o ano

        let action = id ? 'editar' : 'adicionar';

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            type: 'POST',
            data: {
                action: action,
                id: id,
                nome: nome,
                id_classe: id_classe,
                id_curso: id_curso,
                ano: ano
            },
            success: function (response) {
                let result = JSON.parse(response);
                if (result.status === 'success') {
                    $('#turmaModal').modal('hide');
                    carregarTurmas();
                    mostrarMensagem(result.message, 'success');
                } else {
                    mostrarMensagem(result.message, 'danger');
                }
            }
        });
    }

    function editarTurma(id) {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            type: 'POST',
            data: { action: 'detalhes', id: id },
            success: function (response) {
                let result = JSON.parse(response);
                $('#turmaId').val(result.turma.id);
                $('#nome').val(result.turma.nome);
                $('#id_classe').val(result.turma.id_classe); // Carrega a classe
                $('#id_curso').val(result.turma.id_curso); // Carrega o curso
                $('#ano').val(result.turma.ano); // Carrega o ano
                $('#turmaModalLabel').text('Editar Turma');
                $('#turmaModal').modal('show');
            }
        });
    }

    function deletarTurma(id) {
        if (confirm('Tem certeza que deseja deletar esta turma?')) {
            $.ajax({
                url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
                type: 'POST',
                data: { action: 'deletar', id: id },
                success: function (response) {
                    let result = JSON.parse(response);
                    if (result.status === 'success') {
                        carregarTurmas();
                        mostrarMensagem(result.message, 'success');
                    } else {
                        mostrarMensagem(result.message, 'danger');
                    }
                }
            });
        }
    }

    function carregarClasses() {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            type: 'POST',
            data: { action: 'getClasses' },
            success: function (response) {
                let result = JSON.parse(response);
                let classes = result.classes;
                let options = '';
                classes.forEach(function (classe) {
                    options += `<option value="${classe.id}">${classe.nome}</option>`;
                });
                $('#id_classe').html(options);
            }
        });
    }

    function carregarCursos() {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/TurmaController.php',
            type: 'POST',
            data: { action: 'getCursos' },
            success: function (response) {
                let result = JSON.parse(response);
                let cursos = result.cursos;
                let options = '';
                cursos.forEach(function (curso) {
                    options += `<option value="${curso.id}">${curso.nome}</option>`;
                });
                $('#id_curso').html(options);
            }
        });
    }

    function mostrarMensagem(mensagem, tipo) {
        $('#mensagem').text(mensagem).removeClass('alert-success alert-danger').addClass(`alert-${tipo}`).show();
        setTimeout(function () {
            $('#mensagem').hide();
        }, 3000);
    }
});
