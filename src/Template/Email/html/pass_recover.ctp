<h4>Olá, <b><?= $account_name ?></b></h4>
<p>Para mudar a senha da sua conta, acesse o link:</p>

<p>Conta: <?= $account_name ?></p>
<p>Senha: <a href="https://megabaiak.com.br/login/change-pass/<?= $account_id . '.' . $confirm_email_token?>">
  Clique aqui para alterar sua senha!
</a></p>
