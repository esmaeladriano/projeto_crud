$(document).ready(function () {
    let currentPage = 1;
    const itemsPerPage = 4;

    carregarAulas();

    $('#pesquisa').on('input', function () {
        currentPage = 1;
        carregarAulas();
    });

    $('#adicionarAulaBtn').click(function () {
        $('#aulaForm')[0].reset();
        $('#aulaId').val('');
        $('#aulaModalLabel').text('Adicionar Aula');
        $('#aulaModal').modal('show');
        carregarDisciplinas();
        carregarTurmas();
        carregarProfessores();
    });

    $('#salvarAulaBtn').click(function (e) {
        e.preventDefault();
        salvarAula();
    });

    $(document).on('click', '.editarAulaBtn', function () {
        let id = $(this).data('id');
        editarAula(id);
    });

    $(document).on('click', '.deletarAulaBtn', function () {
        let id = $(this).data('id');
        deletarAula(id);
    });

    function carregarAulas() {
        let search = $('#pesquisa').val();
        let offset = (currentPage - 1) * itemsPerPage;

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/AulaController.php',
            type: 'POST',
            data: {
                action: 'listar',
                offset: offset,
                limit: itemsPerPage,
                search: search
            },
            success: function (response) {
                let result = JSON.parse(response);
                let aulas = result.aulas;
                let total = result.total;
                atualizarTabelaAulas(aulas);
                atualizarPaginacao(total);
            }
        });
    }

    function atualizarTabelaAulas(aulas) {
        $('#aulaTableBody').empty();
        aulas.forEach(aula => {
            $('#aulaTableBody').append(`
                <tr>
                    <td>${aula.id_sc}</td>
                    <td>${aula.nome_disciplina}</td>
                    <td>${aula.nome_turma}</td>
                    <td>${aula.nome_professor}</td>
                    <td>${aula.ano}</td>
                    <td>${aula.status}</td>
                    <td>
                        <button class="btn btn-warning editarAulaBtn" data-id="${aula.id_sc}">Editar</button>
                        <button class="btn btn-danger deletarAulaBtn" data-id="${aula.id_sc}">Deletar</button>
                    </td>
                </tr>
            `);
        });
    }

    function atualizarPaginacao(total) {
        $('#pagination').empty();
        let totalPages = Math.ceil(total / itemsPerPage);
        for (let i = 1; i <= totalPages; i++) {
            $('#pagination').append(`
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#">${i}</a>
                </li>
            `);
        }

        $('.page-link').click(function (e) {
            e.preventDefault();
            currentPage = $(this).text();
            carregarAulas();
        });
    }

    function salvarAula() {
        let id = $('#aulaId').val();
        let data = {
            id_disciplina: $('#id_disciplina').val(),
            id_turma: $('#id_turma').val(),
            id_professor: $('#id_professor').val(),
            ano: $('#ano').val(),
            status: $('#status').val(),
            action: id ? 'editar' : 'adicionar'
        };

        if (id) data.id_sc = id;

        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/AulaController.php',
            type: 'POST',
            data: data,
            success: function (response) {
                let result = JSON.parse(response);
                alert(result.message);
                $('#aulaModal').modal('hide');
                carregarAulas();
            }
        });
    }

    function editarAula(id) {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/AulaController.php',
            type: 'POST',
            data: { action: 'detalhes', id: id },
            success: function (response) {
                let aula = JSON.parse(response).aula;
                $('#aulaId').val(aula.id_sc);
                $('#id_disciplina').val(aula.id_disciplina);
                $('#id_turma').val(aula.id_turma);
                $('#id_professor').val(aula.id_professor);
                $('#ano').val(aula.ano);
                $('#status').val(aula.status);
                $('#aulaModalLabel').text('Editar Aula');
                $('#aulaModal').modal('show');
                carregarDisciplinas();
                carregarTurmas();
                carregarProfessores();
            }
        });
    }

    function deletarAula(id) {
        if (confirm('Tem certeza que deseja deletar esta aula?')) {
            $.ajax({
                url: 'http://localhost/projeto_crud/controllers/AulaController.php',
                type: 'POST',
                data: { action: 'deletar', id: id },
                success: function (response) {
                    let result = JSON.parse(response);
                    alert(result.message);
                    carregarAulas();
                }
            });
        }
    }

    function carregarDisciplinas() {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/AulaController.php',
            type: 'POST',
            data: { action: 'listar_disciplinas' },
            success: function (response) {
                let disciplinas = JSON.parse(response);
                $('#id_disciplina').empty();
                disciplinas.forEach(disciplina => {
                    $('#id_disciplina').append(`<option value="${disciplina.id}">${disciplina.nome}</option>`);
                });
            }
        });
    }

    function carregarTurmas() {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/AulaController.php',
            type: 'POST',
            data: { action: 'listar_turmas' },
            success: function (response) {
                let turmas = JSON.parse(response);
                $('#id_turma').empty();
                turmas.forEach(turma => {
                    $('#id_turma').append(`<option value="${turma.id}">${turma.nome}</option>`);
                });
            }
        });
    }

    function carregarProfessores() {
        $.ajax({
            url: 'http://localhost/projeto_crud/controllers/AulaController.php',
            type: 'POST',
            data: { action: 'listar_professores' },
            success: function (response) {
                let professores = JSON.parse(response);
                $('#id_professor').empty();
                professores.forEach(professor => {
                    $('#id_professor').append(`<option value="${professor.id}">${professor.nome}</option>`);
                });
            }
        });
    }
});
