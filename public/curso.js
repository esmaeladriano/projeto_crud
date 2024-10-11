$(document).ready(function () {
    let currentPage = 1;
    const itemsPerPage = 4;

    // Inicializando
    carregarCursos();

    // Eventos
    $('#pesquisa').on('input', function () {
        currentPage = 1; // Reseta a página atual para 1 ao pesquisar
        carregarCursos();
    });

    $('#adicionarCursoBtn').click(function () {
        $('#cursoForm')[0].reset();
        $('#cursoId').val('');
        $('#cursoModalLabel').text('Adicionar Curso');
        $('#cursoModal').modal('show');
    });

    $('#salvarCursoBtn').click(function (e) {
        e.preventDefault();
        salvarCurso();
    });

    $(document).on('click', '.editarCursoBtn', function () {
        let id = $(this).data('id');
        editarCurso(id);
    });

    $(document).on('click', '.deletarCursoBtn', function () {
        let id = $(this).data('id');
        deletarCurso(id);
    });

    // Funções

    function carregarCursos() {
        let search = $('#pesquisa').val();
        let offset = (currentPage - 1) * itemsPerPage;

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/CursoController.php',
            type: 'POST',
            data: {
                action: 'listar',
                offset: offset,
                limit: itemsPerPage,
                search: search
            },
            success: function (response) {
                let result = JSON.parse(response);
                let cursos = result.cursos;
                let total = result.total;
                atualizarTabelaCursos(cursos);
                atualizarPaginacao(total);
            }
        });
    }

    function atualizarTabelaCursos(cursos) {
        let tabela = '';
        cursos.forEach(function (curso) {
            tabela += `
                <tr>
                    <td>${curso.id}</td>
                    <td>${curso.nome}</td>
                    <td>
                        <button class="btn btn-sm btn-warning editarCursoBtn" data-id="${curso.id}">Editar</button>
                        <button class="btn btn-sm btn-danger deletarCursoBtn" data-id="${curso.id}">Deletar</button>
                    </td>
                </tr>
            `;
        });
        $('#cursoTableBody').html(tabela);
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
            carregarCursos();
        });
    }

    function salvarCurso() {
        let id = $('#cursoId').val();
        let nome = $('#nome').val();
        let action = id ? 'editar' : 'adicionar';

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/CursoController.php',
            type: 'POST',
            data: {
                action: action,
                id: id,
                nome: nome
            },
            success: function (response) {
                let result = JSON.parse(response);
                if (result.status === 'success') {
                    $('#cursoModal').modal('hide');
                    carregarCursos();
                    mostrarMensagem(result.message, 'success');
                } else {
                    mostrarMensagem(result.message, 'danger');
                }
            }
        });
    }

    function editarCurso(id) {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/CursoController.php',
            type: 'POST',
            data: { action: 'detalhes', id: id },
            success: function (response) {
                let result = JSON.parse(response);
                $('#cursoId').val(result.curso.id);
                $('#nome').val(result.curso.nome);
                $('#cursoModalLabel').text('Editar Curso');
                $('#cursoModal').modal('show');
            }
        });
    }

    function deletarCurso(id) {
        if (confirm('Tem certeza que deseja deletar este curso?')) {
            $.ajax({
                url: 'http://localhost/projeto_crud/controllers/CursoController.php',
                type: 'POST',
                data: { action: 'deletar', id: id },
                success: function (response) {
                    let result = JSON.parse(response);
                    if (result.status === 'success') {
                        carregarCursos();
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
