<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aulas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../../public/assets/ajax/aula.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Aulas</h2>
        <div class="mb-3">
            <input type="text" id="pesquisa" class="form-control" placeholder="Pesquisar por disciplina...">
        </div>
        <button class="btn btn-primary" id="adicionarAulaBtn">Adicionar Aula</button>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Disciplina</th>
                    <th>Turma</th>
                    <th>Professor</th>
                    <th>Ano</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="aulaTableBody">
                <!-- Dados serão preenchidos via AJAX -->
            </tbody>
        </table>
        <nav>
            <ul class="pagination" id="pagination">
                <!-- Paginação -->
            </ul>
        </nav>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="aulaModal" tabindex="-1" role="dialog" aria-labelledby="aulaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aulaModalLabel">Adicionar Aula</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="aulaForm">
                    <div class="modal-body">
                        <input type="hidden" id="aulaId">
                        <div class="form-group">
                            <label for="id_disciplina">Disciplina</label>
                            <select id="id_disciplina" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="id_turma">Turma</label>
                            <select id="id_turma" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="id_professor">Professor</label>
                            <select id="id_professor" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="ano">Ano</label>
                            <input type="text" class="form-control" id="ano">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" class="form-control">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                        <div id="mensagem" style="display:none;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" id="salvarAulaBtn">Salvar Aula</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
