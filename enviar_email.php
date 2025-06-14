<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["nome"]));
    $telefone = strip_tags(trim($_POST["telefone"]));
    $servico = strip_tags(trim($_POST["servico"]));
    $mensagem = strip_tags(trim($_POST["mensagem"]));

    $para = "finanzzo@finanzzosolucoes.com.br"; // <== Troque aqui para seu e-mail
    $assunto = "Simulação de Crédito - FINANZZO";

    $corpo = "Nova solicitação de simulação:\n\n";
    $corpo .= "Nome: $nome\n";
    $corpo .= "Telefone: $telefone\n";
    $corpo .= "Serviço: $servico\n";
    $corpo .= "Mensagem:\n$mensagem\n";

    $cabecalho = "From: no-reply@finanzzo.com\n";
    $cabecalho .= "Reply-To: no-reply@finanzzo.com";

    if (mail($para, $assunto, $corpo, $cabecalho)) {
        // Redirecionar para uma página de obrigado ou exibir mensagem
        echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Erro ao enviar a mensagem. Tente novamente.'); window.history.back();</script>";
    }
} else {
    echo "Método inválido.";
}
?>
