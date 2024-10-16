$(document).ready(function () {
    let currentPage = 1;
    const itemsPerPage = 4;

    // Inicializando
    carregarDisciplinas();

    // Eventos
    $('#pesquisa').on('input', function () {
        currentPage = 1; // Reseta a página atual para 1 ao pesquisar
        carregarDisciplinas();
    });

    $('#adicionarDisciplinaBtn').click(function () {
        $('#disciplinaForm')[0].reset();
        $('#disciplinaId').val('');
        $('#disciplinaModalLabel').text('Adicionar Disciplina');
        $('#disciplinaModal').modal('show');
    });

    $('#salvarDisciplinaBtn').click(function (e) {
        e.preventDefault();
        salvarDisciplina();
    });

    $(document).on('click', '.editarDisciplinaBtn', function () {
        let id = $(this).data('id');
        editarDisciplina(id);
    });

    $(document).on('click', '.deletarDisciplinaBtn', function () {
        let id = $(this).data('id');
        deletarDisciplina(id);
    });

    // Funções

    function carregarDisciplinas() {
        let search = $('#pesquisa').val();
        let offset = (currentPage - 1) * itemsPerPage;

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/DisciplinaController.php',
            type: 'POST',
            data: {
                action: 'listar',
                offset: offset,
                limit: itemsPerPage,
                search: search
            },
            success: function (response) {
                let result = JSON.parse(response);
                let disciplinas = result.disciplinas;
                let total = result.total;
                atualizarTabelaDisciplinas(disciplinas);
                atualizarPaginacao(total);
            }
        });
    }

    function atualizarTabelaDisciplinas(disciplinas) {
        let tabela = '';
        disciplinas.forEach(function (disciplina) {
            tabela += `
                <tr>
                    <td>${disciplina.id}</td>
                    <td>${disciplina.nome}</td>
                    <td>
                        <button class="btn btn-sm btn-warning editarDisciplinaBtn" data-id="${disciplina.id}">Editar</button>
                        <button class="btn btn-sm btn-danger deletarDisciplinaBtn" data-id="${disciplina.id}">Deletar</button>
                    </td>
                </tr>
            `;
        });
        $('#disciplinaTableBody').html(tabela);
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
            carregarDisciplinas();
        });
    }

    function salvarDisciplina() {
        let id = $('#disciplinaId').val();
        let nome = $('#nome').val();
        let action = id ? 'editar' : 'adicionar';

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/DisciplinaController.php',
            type: 'POST',
            data: {
                action: action,
                id: id,
                nome: nome
            },
            success: function (response) {
                let result = JSON.parse(response);
                if (result.status === 'success') {
                    $('#disciplinaModal').modal('hide');
                    carregarDisciplinas();
                    mostrarMensagem(result.message, 'success');
                } else {
                    mostrarMensagem(result.message, 'danger');
                }
            }
        });
    }

    function editarDisciplina(id) {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/DisciplinaController.php',
            type: 'POST',
            data: { action: 'detalhes', id: id },
            success: function (response) {
                let result = JSON.parse(response);
                $('#disciplinaId').val(result.disciplina.id);
                $('#nome').val(result.disciplina.nome);
                $('#disciplinaModalLabel').text('Editar Disciplina');
                $('#disciplinaModal').modal('show');
            }
        });
    }

    function deletarDisciplina(id) {
        if (confirm('Tem certeza que deseja deletar esta disciplina?')) {
            $.ajax({
                url: 'http://localhost/projeto_crud/controllers/DisciplinaController.php',
                type: 'POST',
                data: { action: 'deletar', id: id },
                success: function (response) {
                    let result = JSON.parse(response);
                    if (result.status === 'success') {
                        carregarDisciplinas();
                        mostrarMensagem(result.message, 'success');
                    } else {
                        mostrarMensagem(result.message, 'danger');
                    }
                }
            });
        }
    }

    function mostrarMensagem(mensagem, tipo) {
        $('#mensagem').text(mensagem).removeClass('alert-success alert-danger').addClass(`alert-${tipo}`).show();
        setTimeout(function () {
            $('#mensagem').hide();
        }, 3000);
    }
});
