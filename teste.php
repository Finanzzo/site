<?php
$para = "finanzzo@finanzzosolucoes.com.br";
$assunto = "Teste de envio PHP";
$mensagem = "Funcionando!";
$cabecalho = "From: contato@seudominio.com";

if(mail($para, $assunto, $mensagem, $cabecalho)) {
    echo "✅ Email enviado com sucesso!";
} else {
    echo "❌ Falha no envio. Verifique o servidor.";
}
?>
