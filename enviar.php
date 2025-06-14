<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $servico = htmlspecialchars($_POST['servico']);
    $mensagem = htmlspecialchars($_POST['mensagem']);

    $destino = "finanzzo@finanzzosolucoes.com.br";
    $assunto = "Nova solicitação de simulação pelo site";

    $corpo = "Nova solicitação recebida:\n\n";
    $corpo .= "Nome: $nome\n";
    $corpo .= "Telefone: $telefone\n";
    $corpo .= "CPF: $cpf\n";
    $corpo .= "Serviço: $servico\n";
    $corpo .= "Mensagem: $mensagem\n";

    $headers = "From: contato@finanzzosolucoes.com.br\r\n";
    $headers .= "Reply-To: $destino\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($destino, $assunto, $corpo, $headers)) {
        header("Location: obrigado.html");
        exit();
    } else {
        echo "Erro ao enviar o e-mail. Por favor, tente novamente mais tarde.";
    }
} else {
    echo "Acesso inválido.";
}
?>
