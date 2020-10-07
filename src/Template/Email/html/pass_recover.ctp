<h4>Olá, <b><?= $account_name ?></b></h4>
<p>Para mudar a senha da sua conta, acesse o link:</p>

<p>E-mail: <?= $account_email ?></p>
<p>Senha: <a href="localhost/p05-ger-pericial/account/change-pass/<?= $account_id . '.' . $confirm_email_token?>">
  Clique aqui para alterar sua senha!
</a></p>
