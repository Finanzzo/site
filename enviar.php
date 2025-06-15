<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Configurações do e-mail
$emailDestino = 'finanzzo@finanzzosolucoes.com.br';
$smtpHost = 'smtp.zoho.com';
$smtpPort = 587;
$smtpUser = 'finanzzo@finanzzosolucoes.com.br';
$smtpPass = '25254141Ge@';  // coloque sua senha do app aqui

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = filter_var(trim($_POST['nome']), FILTER_SANITIZE_STRING);
    $telefone = filter_var(trim($_POST['telefone']), FILTER_SANITIZE_STRING);
    $cpf = filter_var(trim($_POST['cpf']), FILTER_SANITIZE_STRING);
    $servico = filter_var(trim($_POST['servico']), FILTER_SANITIZE_STRING);
    $mensagem = filter_var(trim($_POST['mensagem']), FILTER_SANITIZE_STRING);

    $mail = new PHPMailer(true);

    try {
        // Configurações SMTP
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUser;
        $mail->Password = $smtpPass;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $smtpPort;

        // Remetente e destinatário
        $mail->setFrom($smtpUser, 'FINANZZO');
        $mail->addAddress($emailDestino);

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Nova solicitação de simulação - FINANZZO';
        $mailContent = "
        <h2>Nova solicitação de simulação</h2>
        <p><strong>Nome:</strong> {$nome}</p>
        <p><strong>Telefone:</strong> {$telefone}</p>
        <p><strong>CPF:</strong> {$cpf}</p>
        <p><strong>Serviço:</strong> {$servico}</p>
        <p><strong>Mensagem:</strong><br>" . nl2br($mensagem) . "</p>
        ";
        $mail->Body = $mailContent;

        $mail->send();
        header('Location: obrigado.html');
        exit;
    } catch (Exception $e) {
        echo 'Erro ao enviar mensagem: ', $mail->ErrorInfo;
    }
} else {
    header('Location: index.html');
    exit;
}
?>
