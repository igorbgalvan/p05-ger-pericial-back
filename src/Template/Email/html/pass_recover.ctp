<h4>Olá, <b><?= $account_name ?></b></h4>
<p>Para mudar a senha da sua conta, acesse o link:</p>

<p>E-mail: <?= $account_email ?></p>
<p>Senha: <a href="https://191.252.202.56/fabrica/p05-ger-pericial/account/verify-token/<?= $account_id . '.' . $confirm_email_token?>">
  Clique aqui para alterar sua senha!
</a></p>
