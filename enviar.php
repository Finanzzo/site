<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $servico = $_POST['servico'];
    $mensagem = $_POST['mensagem'];

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP Zoho
        $mail->isSMTP();
        $mail->Host = 'smtp.zoho.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'finanzzo@finanzzosolucoes.com.br';
        $mail->Password = 'SUA_SENHA_DO_EMAIL'; // Substituir pela senha correta
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Remetente e destinatário
        $mail->setFrom('finanzzo@finanzzosolucoes.com.br', 'FINANZZO');
        $mail->addAddress('finanzzo@finanzzosolucoes.com.br');

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Novo pedido de simulação - Finanzzo';
        $mail->Body = "
            <h2>Nova solicitação de simulação</h2>
            <p><strong>Nome:</strong> {$nome}</p>
            <p><strong>Telefone:</strong> {$telefone}</p>
            <p><strong>CPF:</strong> {$cpf}</p>
            <p><strong>Serviço desejado:</strong> {$servico}</p>
            <p><strong>Mensagem:</strong> {$mensagem}</p>
        ";

        $mail->send();
        header('Location: obrigado.html');
        exit();
    } catch (Exception $e) {
        echo "Erro no envio: {$mail->ErrorInfo}";
    }
}
?>
