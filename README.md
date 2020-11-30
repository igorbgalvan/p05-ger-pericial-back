
# Gerenciador Pericial

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)

O projeto começa pelo desenvolvimento de um Sistema Web, onde terão as funcionalidades de cadastro, atualização e exclusão de usuários, distribuição de tarefas, histórico de alteração, calendário de plantões, geração de relatórios específicos, função de filtro de busca, anexo de documentos por parte dos peritos, alteração e exclusão e cadastro de laudos.


## Pré-requisitos

Antes de iniciar, certifique-se de cumprir os seguintes requisitos:
<!--- Estes são alguns exemplos de requisitos. Adicione, duplique e remove como necessário --->
* Você deve possuir a última versão do PHP, HTML, JavaScript e CSS instalado.
* Você deve possuir uma máquina Linux ou Windows (Lembrando que o sistema foi feito todo em Linux).
* Você deve ler o https://www.php.net/manual/pt_BR/ dos termos de uso do PHP.
* Você deve ler o https://dev.w3.org/html5/html-author/ dos termos de uso do HTML 5.
* Você deve ler o https://www.w3schools.com/cssref/ dos termos de uso do CSS 3.
* Você deve possuir o composer na versão 1.6.3 https://getcomposer.org/download/
* Você deve possuir a versão 3.x do CakePHP https://book.cakephp.org/3/en/index.html

## Como executar

Para fazer o deploy da aplicação siga os seguintes passos:

Linux:
```
* Passo a passo do nosso ambiente:
 - Instale o xampp;
 - Inicialize o xamppp usando 'sudo /opt/lampp/xampp start';
 - Acesse localhost/phpmyadmin
 - Crie um banco de dados;
 - Dê um git clone do projeto;
 - User o comando 'composer install';
 - Acesse localhost;

* Para fins de teste, o banco de dados utilizado foi o mySQL.
* (Feito em ambiente unix - Ubuntu)
sudo apt-get install php-mysql
```

## Usando Gerenciador pericial

Para usar Gerenciador pericial, estas são as opções:
* Abra o navegador e digite o endereço explicitado pelo seu servidor.
* Ao abrir a aplicação você poderá:
  * Se cadastrar;
  * Fazer login;
  * Recuperar senha perdida;
  * Editar perfil;
  * Alterar foto de perfíl;
  * Confirmar e-mail cadastrado;
  * Autorizar usuário (Administrador);
  * Desativar um usuário (Administrador);
  * Ativar um usuário (Administrador);
  * Ver todos os usuários cadastrados no sistema;
  * Cadastrar requisições de perícia;
  * Cadastrar laudos encima dessas requisições;
  * listar todas as requisições;
  * listar todos os laudos;
  * Editar quantas vezes quiser essas requisições;
  * Editar quantas vezes quiser os laudos;
  * Enviar documentos para as requisições;
  * Visualizar detalhadamente cada requisição;
  * Cadastrar veículos nas requisições;
  * Cadastrar vítimas nas requisições;
  * Distribuir requisições automáticas para os peritos, baseado em uma lógica;
  * Visualizar quais requisições foram distribuidas para seu usuário.
  * Ver relatórios de logs de alterações (Administrador);
  * Ver análise dos peritos;
  * Ver estatística dos tipos de exames;
 

## Evolução da Aplicação
* Primeira Sprint
    * Base inicial
        * Todo sistema de login;
        * Alteração de senha;
        * Acesso ao sistema;
        * Autorização do sistema;
* Segunda sprint
    *

## Contribuidores

As seguintes pessoas contribuiram para este projeto:

* Igor Galvan (https://github.com/igorbgalvan)

## Licença de uso

Este é um projeto privado com direitos reservados para a Universidade Federal do Mato Grosso do Sul.

