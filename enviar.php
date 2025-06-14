<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Honeypot: se o campo oculto "website" tiver conteúdo, é spam
    if (!empty($_POST['website'])) {
        // Spam detectado, não enviar e finalizar script
        exit("Erro: Spam detectado.");
    }

    // Sanitizar e pegar dados do formulário
    $nome = filter_var(trim($_POST['nome']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $mensagem = filter_var(trim($_POST['mensagem']), FILTER_SANITIZE_STRING);

    // Verifica se os dados essenciais estão preenchidos e válidos
    if (empty($nome) || empty($email) || empty($mensagem) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Erro: Dados do formulário inválidos.");
    }

    $destinatario = "finanzzo@finanzzosolucoes.com.br"; // <--- coloque seu e-mail real aqui
    $assunto = "Mensagem do site Finanzzo";

    $corpo = "Nome: $nome\n";
    $corpo .= "Email: $email\n\n";
    $corpo .= "Mensagem:\n$mensagem\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($destinatario, $assunto, $corpo, $headers)) {
        // Redireciona para página de obrigado
        header("Location: obrigado.html");
        exit;
    } else {
        echo "Erro ao enviar mensagem, tente novamente mais tarde.";
    }
} else {
    // Acesso direto ao arquivo, redireciona para página inicial
    header("Location: index.html");
    exit;
}
?>
