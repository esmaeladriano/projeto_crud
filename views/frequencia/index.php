<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Frequência</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Gerenciar Frequência</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#frequenciaModal" id="addFrequenciaBtn">Adicionar Frequência</button>

        <input type="text" id="pesquisa" placeholder="Pesquisar..." class="form-control mt-3" />

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Aluno</th>
                    <th>Turma</th>
                    <th>Disciplina</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="frequenciaTableBody">
                <!-- Dados serão carregados aqui -->
            </tbody>
        </table>

        <nav>
            <ul class="pagination" id="pagination">
                <!-- Paginação será gerada aqui -->
            </ul>
        </nav>

        <!-- Modal -->
        <div class="modal fade" id="frequenciaModal" tabindex="-1" aria-labelledby="frequenciaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="frequenciaModalLabel">Adicionar Frequência</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frequenciaForm">
                            <div class="form-group">
                                <label for="aluno_id">Aluno</label>
                                <select id="aluno_id" class="form-control">
                                    <!-- Opções de alunos serão carregadas aqui -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="turma_id">Turma</label>
                                <select id="turma_id" class="form-control">
                                    <!-- Opções de turmas serão carregadas aqui -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="disciplina_id">Disciplina</label>
                                <select id="disciplina_id" class="form-control">
                                    <!-- Opções de disciplinas serão carregadas aqui -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" id="data" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control">
                                    <option value="presente">Presente</option>
                                    <option value="ausente">Ausente</option>
                                    <option value="justificado">Justificado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="observacao">Observação</label>
                                <textarea id="observacao" class="form-control"></textarea>
                            </div>
                            <input type="hidden" id="frequencia_id" value="">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../public/candidatura.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
