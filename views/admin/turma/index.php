<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Turmas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Gerenciamento de Turmas</h2>
        
        <div id="mensagem" class="alert alert-dismissible fade show" style="display:none;"></div>

        <div class="mb-3">
            <input type="text" id="pesquisa" class="form-control" placeholder="Pesquisar turma...">
        </div>

        <button id="adicionarTurmaBtn" class="btn btn-primary">Adicionar Turma</button>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>ID Classe</th>
                    <th>ID Curso</th>
                    <th>Ano</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="turmaTableBody">
                <!-- As turmas serão inseridas aqui via AJAX -->
            </tbody>
        </table>

        <nav>
            <ul class="pagination" id="pagination"></ul>
        </nav>
    </div>

    <!-- Modal para Adicionar/Editar Turma -->
    <div class="modal fade" id="turmaModal" tabindex="-1" role="dialog" aria-labelledby="turmaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="turmaModalLabel">Adicionar Turma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="turmaForm">
                        <input type="hidden" id="turmaId" value="">
                        <div class="form-group">
                            <label for="nome">Nome da Turma</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="id_classe">Classe</label>
                            <select id="id_classe" class="form-control" required>
                                <!-- As classes serão carregadas aqui via AJAX -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_curso">Curso</label>
                            <select id="id_curso" class="form-control" required>
                                <!-- Os cursos serão carregados aqui via AJAX -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ano">Ano</label>
                            <input type="text" class="form-control" id="ano" required>
                        </div>
                        <button type="submit" id="salvarTurmaBtn" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../public/assets/ajax/turma.js"></script>
</body>
</html>
