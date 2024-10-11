$(document).ready(function () {
    let currentPage = 1;
    const itemsPerPage = 4;

    // Inicializando
    carregarAlunos();

    // Eventos
    $('#pesquisa').on('input', function () {
        currentPage = 1; // Reseta a página atual para 1 ao pesquisar
        carregarAlunos();
    });

    $('#adicionarAlunoBtn').click(function () {
        $('#alunoForm')[0].reset();
        $('#alunoId').val('');
        $('#alunoModalLabel').text('Adicionar Aluno');
        $('#alunoModal').modal('show');
    });

    $('#salvarAlunoBtn').click(function (e) {
        e.preventDefault();
        salvarAluno();
    });

    $(document).on('click', '.editarAlunoBtn', function () {
        let id = $(this).data('id');
        editarAluno(id);
    });

    $(document).on('click', '.deletarAlunoBtn', function () {
        let id = $(this).data('id');
        deletarAluno(id);
    });

    // Funções

    function carregarAlunos() {
        let search = $('#pesquisa').val();
        let offset = (currentPage - 1) * itemsPerPage;

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/AlunoController.php',
            type: 'POST',
            data: {
                action: 'listar',
                offset: offset,
                limit: itemsPerPage,
                search: search
            },
            success: function (response) {
                let result = JSON.parse(response);
                let alunos = result.alunos;
                let total = result.total;
                atualizarTabelaAlunos(alunos);
                atualizarPaginacao(total);
            }
        });
    }

    function atualizarTabelaAlunos(alunos) {
        let tabela = '';
        alunos.forEach(function (aluno) {
            tabela += `
                <tr>
                    <td>${aluno.id}</td>
                    <td>${aluno.nome}</td>
                    <td>${aluno.turma}</td>
                    <td>${aluno.curso}</td>
                    <td>${aluno.classe}</td>
                    <td>
                        <button class="btn btn-sm btn-warning editarAlunoBtn" data-id="${aluno.id}">Editar</button>
                        <button class="btn btn-sm btn-danger deletarAlunoBtn" data-id="${aluno.id}">Deletar</button>
                    </td>
                </tr>
            `;
        });
        $('#alunoTableBody').html(tabela);
    }

    function atualizarPaginacao(totalItems) {
        let totalPages = Math.ceil(totalItems / itemsPerPage);
        let paginacaoHtml = '';

        for (let i = 1; i <= totalPages; i++) {
            let activeClass = i === currentPage ? 'active' : '';
            paginacaoHtml += `<li class="page-item ${activeClass}"><a class="page-link" href="#">${i}</a></li>`;
        }

        $('#pagination').html(paginacaoHtml);

        // Evento de clique nas páginas
        $('.page-link').click(function () {
            currentPage = parseInt($(this).text());
            carregarAlunos();
        });
    }

    function salvarAluno() {
        let id = $('#alunoId').val();
        let nome = $('#nome').val();
        let data_nasc = $('#data_nasc').val();
        let nome_pai = $('#nome_pai').val();
        let nome_mae = $('#nome_mae').val();
        let municipio = $('#municipio').val();
        let sexo = $('#sexo').val();
        let bi = $('#bi').val();
        let estado_civil = $('#estado_civil').val();
        let email = $('#email').val();
        let contacto_aluno = $('#contacto_aluno').val();
        let contacto_enca1 = $('#contacto_enca1').val();
        let contacto_enca2 = $('#contacto_enca2').val();
        let classe = $('#classe').val();
        let curso = $('#curso').val();
        let certificado = $('#certificado').val();
        let copia_bi = $('#copia_bi').val();

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/AlunoController.php',
            type: 'POST',
            data: {
                action: 'salvar',
                id,
                nome,
                data_nasc,
                nome_pai,
                nome_mae,
                municipio,
                sexo,
                bi,
                estado_civil,
                email,
                contacto_aluno,
                contacto_enca1,
                contacto_enca2,
                classe,
                curso,
                certificado,
                copia_bi
            },
            success: function (response) {
                let result = JSON.parse(response);
                mostrarMensagem(result.mensagem, result.sucesso);
                carregarAlunos();
                $('#alunoModal').modal('hide');
            }
        });
    }

    function editarAluno(id) {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/AlunoController.php',
            type: 'POST',
            data: {
                action: 'editar',
                id: id
            },
            success: function (response) {
                let aluno = JSON.parse(response);
                $('#alunoId').val(aluno.id);
                $('#nome').val(aluno.nome);
                $('#data_nasc').val(aluno.data_nasc);
                $('#nome_pai').val(aluno.nome_pai);
                $('#nome_mae').val(aluno.nome_mae);
                $('#municipio').val(aluno.municipio);
                $('#sexo').val(aluno.sexo);
                $('#bi').val(aluno.bi);
                $('#estado_civil').val(aluno.estado_civil);
                $('#email').val(aluno.email);
                $('#contacto_aluno').val(aluno.contacto_aluno);
                $('#contacto_enca1').val(aluno.contacto_enca1);
                $('#contacto_enca2').val(aluno.contacto_enca2);
                $('#classe').val(aluno.classe);
                $('#curso').val(aluno.curso);
                $('#certificado').val(aluno.certificado);
                $('#copia_bi').val(aluno.copia_bi);
                $('#alunoModalLabel').text('Editar Aluno');
                $('#alunoModal').modal('show');
            }
        });
    }

    function deletarAluno(id) {
        if (confirm('Tem certeza que deseja deletar este aluno?')) {
            $.ajax({
                url: 'http://localhost/projeto_crud/controllers/AlunoController.php',
                type: 'POST',
                data: {
                    action: 'deletar',
                    id: id
                },
                success: function (response) {
                    let result = JSON.parse(response);
                    mostrarMensagem(result.mensagem, result.sucesso);
                    carregarAlunos();
                }
            });
        }
    }

    function mostrarMensagem(mensagem, sucesso) {
        $('#mensagem').removeClass('alert-success alert-danger').addClass(sucesso ? 'alert-success' : 'alert-danger');
        $('#mensagem').text(mensagem).show();
        setTimeout(() => {
            $('#mensagem').fadeOut();
        }, 3000);
    }
});
