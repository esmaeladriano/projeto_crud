<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Inscrição</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 30px;
        }
        .atencao {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h2 {
            font-size: 2rem;
            animation: bounceIn 2s ease;
        }
        .form-control {
            transition: all 0.3s ease-in-out;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }
        .botao {
            margin-top: 20px;
            text-align: center;
        }
        .step {
            display: none;
            animation: fadeIn 1s;
        }
        .step.active {
            display: block;
        }
        @keyframes bounceIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            60% {
                transform: scale(1.1);
                opacity: 1;
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="atencao animate__animated animate__fadeInDown">
        <h2>PREENCHA FICHA DE INSCRIÇÃO</h2>
    </div>

    <div class="card mt-5 shadow-lg p-4 bg-white rounded">
        <form id="formularioAdmissao" class="needs-validation" novalidate>
            <div class="step active" id="step1">
                <h4 class="text-primary">Informações Pessoais</h4>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="nome">Nome Completo:</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Primeiro Nome" required pattern="(?=.*[a-z])(?=.*[A-Z]).{4,}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="data">Data de Nascimento:</label>
                        <input type="date" class="form-control" name="data" id="data" required min="1975-01-01" max="2009-12-31" maxlength="10">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="nomeP">Nome Completo do Pai:</label>
                        <input type="text" class="form-control" name="nomeP" id="nomeP" placeholder="Nome do pai" required pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="nomeM">Nome Completo da Mãe:</label>
                        <input type="text" class="form-control" name="nomeM" id="nomeM" placeholder="Nome da mãe" required pattern="(?=.*[a-z])(?=.*[A-Z]).{8,}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="municipio">Município de:</label>
                        <input type="text" class="form-control" name="municipio" id="municipio" required>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="sexo">Sexo:</label>
                        <select class="form-control" name="sexo" id="sexo" required>
                            <option value="" disabled selected>Selecione</option>
                            <option>Feminino</option>
                            <option>Masculino</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="BI">Nº do BI:</label>
                        <input type="text" class="form-control" name="BI" id="BI" required placeholder="Bilhete de identidade" pattern="[0-9]{9}[A-Za-z]{2}[0-9]{3}">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="estadocivil">Estado Civil:</label>
                        <select class="form-control" name="estadocivil" id="estadocivil" required>
                            <option value="" disabled selected>Selecione</option>
                            <option>Solteiro(a)</option>
                            <option>Casado(a)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="email">Seu email:</label>
                        <input type="text" class="form-control" name="email" id="email" required placeholder="Seu E-mail" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="nf1">Contacto do Aluno(a):</label>
                        <input type="tel" class="form-control" name="nfaluno" id="nf1" placeholder="Contacto do Aluno" maxlength="9" pattern="[0-9]{9}">
                    </div>
                </div>
            </div>

            <div class="step" id="step2">
                <h4>Informações de Contato</h4>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="nf2">Contacto Encarregado 1:</label>
                        <input type="tel" class="form-control" name="nf2" id="nf2" placeholder="Contacto Encarregado 1" maxlength="9" pattern="[0-9]{9}" required>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="nf3">Contacto Encarregado 2:</label>
                        <input type="tel" class="form-control" name="nf3" id="nf3" placeholder="Contacto Encarregado 2" maxlength="9" pattern="[0-9]{9}" required>
                    </div>
                </div>
            </div>

            <div class="step" id="step3">
                <h4>Informações Acadêmicas</h4>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="classe">Opções de Classes:</label>
                        <select class="form-control" name="classe" id="classe" required>
                            <option value="" disabled selected>Selecione</option>
                            <?php 
                            include_once('C:\xampp\htdocs\sistema\conexao.php');
                            $s1 = "SELECT * FROM `classe`";
                            $r1 = mysqli_query($conexao, $s1);
                            while($c = mysqli_fetch_assoc($r1)) {   
                                echo '<option value="'.$c['id'].'">'.$c['nome'].'</option>';   
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="curso">Opções de Curso:</label>
                        <select class="form-control" name="curso" id="curso" required>
                            <option value="" disabled selected>Selecione</option>
                            <?php 
                            $s1 = "SELECT * FROM `curso`";
                            $r1 = mysqli_query($conexao, $s1);
                            while($c = mysqli_fetch_assoc($r1)) {   
                                echo '<option value="'.$c['id'].'">'.$c['nome'].'</option>';   
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="step" id="step4">
                <h4>Documentação</h4>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="certificado">Certificado ou declaração:</label>
                        <input type="file" class="form-control" required id="certificado" name="certificado">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="copia">Copia do BI ou Passaporte:</label>
                        <input type="file" class="form-control" required id="copia" name="CoBI">
                    </div>
                </div>
            </div>


            <div class="botao">
                <button type="button" id="anterior" class="btn btn-secondary" disabled>Anterior</button>
                <button type="button" id="proximo" class="btn btn-primary">Próximo</button>
                <button type="submit" class="btn btn-success" id="submitButton" disabled>Inscrever-se</button>
            </div>
        </form>
    </div>
</div>

<script>
   $(document).ready(function() {
    let currentStep = 0;
    const steps = $('.step');

    $(steps[currentStep]).addClass('active');

    $('#proximo').click(function() {
        if (validateStep(currentStep)) {
            $(steps[currentStep]).removeClass('active');
            currentStep++;
            $(steps[currentStep]).addClass('active');

            $('#anterior').prop('disabled', false);
            if (currentStep === steps.length - 1) {
                $('#proximo').hide();
                $('#submitButton').prop('disabled', false);
            }
        }
    });

    $('#anterior').click(function() {
        $(steps[currentStep]).removeClass('active');
        currentStep--;
        $(steps[currentStep]).addClass('active');

        $('#proximo').show();
        if (currentStep === 0) {
            $('#anterior').prop('disabled', true);
        }
    });

    function validateStep(stepIndex) {
        let isValid = true;
        $(steps[stepIndex]).find(':input[required]').each(function() {
            if (!this.checkValidity()) {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        return isValid;
    }

    $(steps).find(':input[required]').on('blur', function() {
        validateStep(currentStep);
    });

    $('#formularioAdmissao').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: 'adimissao.php',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                let result = JSON.parse(response);
                if (result.status === 'success') {
                    alert(result.message);
                    window.location.href = 'url_de_sucesso.php';
                } else {
                    alert(result.message);
                }
            },
            error: function(xhr, status, error) {
                alert("Ocorreu um erro: " + error);
            }
        });
    });
});
</script>

</body>
</html>
