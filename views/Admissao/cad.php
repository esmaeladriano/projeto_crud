<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Candidaturas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Gerenciamento de Candidaturas</h2>
        
        <div id="mensagem" class="alert alert-dismissible fade show" style="display:none;"></div>

        <div class="mb-3">
            <input type="text" id="pesquisa" class="form-control" placeholder="Pesquisar candidato...">
        </div>

        <button id="adicionarCandidaturaBtn" class="btn btn-primary" data-toggle="modal" data-target="#candidaturaModal">Adicionar Candidatura</button>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Sexo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="candidaturaTableBody">
                <!-- As candidaturas serão inseridas aqui via AJAX -->
            </tbody>
        </table>

        <nav>
            <ul class="pagination" id="pagination"></ul>
        </nav>
    </div>

    <!-- Modal para Adicionar/Editar Candidatura -->
    <div class="modal fade" id="candidaturaModal" tabindex="-1" role="dialog" aria-labelledby="candidaturaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="candidaturaModalLabel">Adicionar Candidatura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="candidaturaForm" enctype="multipart/form-data">
                        <input type="hidden" id="candidaturaId" value="">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="data_nasc">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nasc" required>
                        </div>
                        <div class="form-group">
                            <label for="nome_pai">Nome do Pai</label>
                            <input type="text" class="form-control" id="nome_pai" required>
                        </div>
                        <div class="form-group">
                            <label for="nome_mae">Nome da Mãe</label>
                            <input type="text" class="form-control" id="nome_mae" required>
                        </div>
                        <div class="form-group">
                            <label for="municipio">Município</label>
                            <input type="text" class="form-control" id="municipio" required>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <input type="text" class="form-control" id="sexo" required>
                        </div>
                        <div class="form-group">
                            <label for="BI">BI</label>
                            <input type="text" class="form-control" id="BI" required>
                        </div>
                        <div class="form-group">
                            <label for="estado_civil">Estado Civil</label>
                            <input type="text" class="form-control" id="estado_civil" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="contacto_aluno">Contacto Aluno</label>
                            <input type="text" class="form-control" id="contacto_aluno">
                        </div>
                        <div class="form-group">
                            <label for="contacto_enca1">Contacto Encarregado 1</label>
                            <input type="text" class="form-control" id="contacto_enca1" required>
                        </div>
                        <div class="form-group">
                            <label for="contacto_enca2">Contacto Encarregado 2</label>
                            <input type="text" class="form-control" id="contacto_enca2" required>
                        </div>
                        <div class="form-group">
                        <label for="classe">Classe</label>
                        <select id="classe" name="classe" class="form-control" required></select>
                    </div>
                    <div class="form-group">
                        <label for="curso">Curso</label>
                        <select id="curso" name="curso" class="form-control" required></select>
                    </div>
                        <div class="form-group">
                            <label for="bi_file">Cópia do BI (Arquivo)</label>
                            <input type="file" class="form-control" id="bi_file" required>
                        </div>
                        <div class="form-group">
                            <label for="certificado_file">Certificado (Arquivo)</label>
                            <input type="file" class="form-control" id="certificado_file" required>
                        </div>
                        <button type="submit" id="salvarCandidaturaBtn" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../public/candidatura.js"></script>
</body>
</html>
