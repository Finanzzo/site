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

 <input type="hidden" name="_captcha" value="false" />
        <input type="text" name="nome" placeholder="Seu nome" required />
        <input type="tel" name="telefone" placeholder="Seu telefone" required />
        <select name="servico" required>
          <option value="">Tipo de serviço</option>
          <option>Consignado INSS</option>
          <option>Portabilidade</option>
          <option>Refinanciamento</option>
          <option>Antecipação FGTS</option>
          <option>Servidor Público</option>
          <option>CLT</option>
        </select>
        <textarea name="mensagem" placeholder="Sua mensagem" rows="4" required></textarea>
        <button type="submit">Enviar</button>
        <p class="lgpd">Ao enviar, você concorda com nossa <a href="privacy.html">Política de Privacidade</a> e o uso dos seus dados conforme a LGPD.</p>
      </form>
    </section>
  </main>
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
