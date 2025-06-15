<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebendo os dados do formulário
    $nome = strip_tags(trim($_POST["nome"]));
    $telefone = strip_tags(trim($_POST["telefone"]));
    $cpf = strip_tags(trim($_POST["cpf"]));
    $servico = strip_tags(trim($_POST["servico"]));
    $mensagem = strip_tags(trim($_POST["mensagem"]));

    // Validação básica
    if (empty($nome) || empty($telefone) || empty($cpf) || empty($servico) || empty($mensagem)) {
        header("Location: erro.html");
        exit;
    }

    // E-mail de destino
    $destino = "finanzzo@finanzzosolucoes.com.br"; // 🔥 Troque pelo seu e-mail
    $assunto = "📩 Nova solicitação de simulação - FINANZZO";

    // Corpo do e-mail
    $conteudo = "Você recebeu uma nova solicitação de simulação:\n\n";
    $conteudo .= "👤 Nome: $nome\n";
    $conteudo .= "📞 Telefone: $telefone\n";
    $conteudo .= "🆔 CPF: $cpf\n";
    $conteudo .= "💼 Serviço: $servico\n";
    $conteudo .= "📝 Mensagem: $mensagem\n";

    // Cabeçalhos do e-mail
    $headers = "From: finanzzo@finanzzosolucoes.com.br\r\n"; // 🔥 Configure seu domínio
    $headers .= "Reply-To: $destino\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Envia o e-mail
    if (mail($destino, $assunto, $conteudo, $headers)) {
        // Redireciona para a página de obrigado
        header("Location: obrigado.html");
        exit;
    } else {
        // Redireciona para página de erro, se falhar
        header("Location: erro.html");
        exit;
    }

} else {
    // Acesso direto sem POST vai para página inicial
    header("Location: index.html");
    exit;
}
?>
