(function () {
    'use strict'
    
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
    
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
    .forEach(function (form) {
    form.addEventListener('submit', function (event) {
    if (!form.checkValidity()) {
    event.preventDefault()
        event.stopPropagation()
        document.getElementById('alerta').style.display = 'block';
        }
        form.classList.add('was-validated')
        
    }, false)
    })
    })()


function proximo() {
var formulario = document.getElementById('formularioAdmissao');

if (formulario.checkValidity()) {
// Redirecionar para a próxima página após a validação do formulário
    // window.location.href = "admissao2.html";
    document.getElementById('exibir').style.display = 'block';
    document.getElementById('validar').style.display = 'none';
    alert('Boa! Passaste na validação')


}
else {
formulario.classList.add('was-validated');
}
}

function exibirDados() {
// Obter dados do formulário
var nome = document.getElementById('nome').value;
var data = document.getElementById('data').value;
var nomeP = document.getElementById('nomeP').value;
var nomeM = document.getElementById('nomeM').value;  
var BI = document.getElementById('BI').value; 
var sexo = document.getElementById('sexo').value;
var nf1 = document.getElementById('nf1').value;
var nf2 = document.getElementById('nf2').value; 
var nf3 = document.getElementById('nf3').value; 
var naturalidade = document.getElementById('Naturalidade').value;
var dadosProvincia = document.getElementById('provincia').value;
var Municipio = document.getElementById('municipio').value;
var distrito = document.getElementById('distrito').value;
var residencia = document.getElementById('residenciaactual').value;
var dataBI = document.getElementById('dataBI').value;   
var estadocivil = document.getElementById('estadocivil').value;
var email = document.getElementById('email').value;
var classe = document.getElementById('classe').value;
var curso = document.getElementById('curso').value;
var periodo = document.getElementById('periodo').value;
var escolantiga = document.getElementById('instituicaoant').value;

// Exibir dados na segunda seção
document.getElementById('dadosNome').innerText = nome;
document.getElementById('dadosData').innerText = data;
document.getElementById('dadosPai').innerText = nomeP;
document.getElementById('dadosMae').innerText = nomeM;
document.getElementById('dadosnaturalidade').innerText = naturalidade;
document.getElementById('dadosProvincia').innerText = dadosProvincia;
document.getElementById('dadosmunicipio').innerText = Municipio;
document.getElementById('dadosdistrito').innerText = distrito;
document.getElementById('dadosresidencia').innerText = residencia;
document.getElementById('dadosSexo').innerText = sexo;
document.getElementById('dadosBI').innerText = BI;
document.getElementById('dadosdataBI').innerText = dataBI;
document.getElementById('dadosestado').innerText = estadocivil;
document.getElementById('dadosnf1').innerText =nf1;
document.getElementById('dadosnf2').innerText =nf2;
document.getElementById('dadosnf3').innerText =nf3;
document.getElementById('dadosemail').innerText = email;
document.getElementById('dadosclasse').innerText = classe;
document.getElementById('dadosopcao').innerText = curso;
document.getElementById('dadosperiodo').innerText =periodo;
document.getElementById('daosescolaantiga').innerText = escolantiga;
    
 document.getElementById('matriculado').innerText = nome;
 document.getElementById('CursoM').innerText = curso;
 document.getElementById('classeM').innerText = classe;
    if (window.print()) {
        alert('AAAAAAAAAAAAAAAA')
    }
    else {
        alert('Boa agora a tua inscrição está feita, Agora só tens que apresentar o ducumento na Secretaria!')
    }
// Ocultar formulário
// document.getElementById('dadosFormulario').style.display = 'none';
// document.getElementsByClassName('atencao')[0].style.display = 'none';
// document.getElementsByClassName('atencao')[1].style.display = 'none';
// document.getElementById('rodape').style.display = 'none';

// // Exibir segunda seção
// document.getElementById('dadosImprimir').style.display = 'block';
// document.getElementById('dadosImprimir').style.marginTop = 0;
// document.getElementById('com').style.border = 'solid 1px gray';
//  document.getElementById('dadosImprimir1').style.display = 'block';
}

function imprimirDados() {
// Chamar a função de impressão do navegador
    if (window.print()) {
    alert('AAAAAAAAAAAAAAAA')
    } 
    else {
        alert('Boa agora a tua inscrição está feita, Agroa só tens que apresentar o ducumento na Secretaria!')
        
       
        
    }
}


