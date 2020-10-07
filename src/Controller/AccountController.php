<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Mailer\Email;

/**
 * Account Controller
 *
 *
 * @method \App\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccountController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['lostAccount', 'verifyToken']);
    }

    public function verifyToken()
    {
        if ($this->request->is('post')) {
            $Tokens = TableRegistry::getTableLocator()->get('Tokens');
            $Users = TableRegistry::getTableLocator()->get('Users');

            $data = $this->request->getData();
            $id = $data['id'];
            $tokenCode = $data['tokenCode'];

            $user = $Users->get($id);


            if ($user) {
                $token = $Tokens->find('all', [
                    'conditions' => ['user_id' => $id]
                ])->first();


                if ($token) {

                    var_dump($token->token);
                    var_dump(password_hash($tokenCode, PASSWORD_DEFAULT));
                    die();

                    if (password_verify($tokenCode, $token->token)) {
                        $tokenTime = $token->expiration + 1800;


                        if($tokenTime >= time())
                        {
                            $this->response->statusCode('200');
                            $data = [
                                'message' => 'token valid.'
                            ];
                        }
                        else{
                            $this->response->statusCode('400');
                            $data = [
                                'message' => 'token expired.',
                                'error' => true
                            ];
                        }
                    }
                    else{
                        $this->response->statusCode('400');
                        $data = [
                            'message' => 'token not valid.',
                            'error' => true
                        ];
                    }

                } else {
                    $this->response->statusCode('400');
                    $data = [
                        'message' => 'token not valid.',
                        'error' => true
                    ];
                }
            } else {
                $this->response->statusCode('400');
                $data = [
                    'message' => 'user not valid.',
                    'error' => true
                ];
            }
        }
    }

    public function changePass($token = null)
    {
        $Users = TableRegistry::getTableLocator()->get('Users');

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $account = $Users->get($account_id);

            $id = $data['id'];
            $tokenCode = $data['tokenCode'];
            $account_id = $data['tokenUser'];

            $account = $Users->get($account_id);

            if ($data['password'] != $data["confirm-password"]) {
                $error = "As senhas não conferem!";
                $this->set(compact('error', 'account_id'));
                return;
            }

            $account->password = $data['password'] . $account->secret;
            $account->authToken = '';

            if ($Accounts->save($account)) {
                $this->Flash->success(__('A senha foi alterada com sucesso!'));
                return $this->redirect(['controller' => '/']);
            }
        }

        if ($token == null || $token == '') {
            die();
            $this->Flash->error(__('Link Inválido!'));
            return $this->redirect(['controller' => '/']);
        }
    }
    public function lostAccount()
    {
        if ($this->request->is('post')) {
            $Users = TableRegistry::getTableLocator()->get('Users');
            $email = $this->request->getData('email');

            $user = $Users->find('all', [
                'conditions' => ['email' => $email]
            ])->first();

            if (isset($user)) {
                $Tokens = TableRegistry::getTableLocator()->get('Tokens');
                $token = $Tokens->newEntity();

                $tokenCode = $this->generateToken(24);
                $token->token = password_hash($tokenCode, PASSWORD_DEFAULT);
                $token->user_id = $user->id;
                $token->expiration = time();

                if ($Tokens->save($token)) {

                    $email = new Email('gerpericial');
                    $email->to($user->email)
                        ->subject('Alteração de senha - Gerenciador Pericial')
                        ->emailFormat('html')
                        ->viewVars(['confirm_email_token' => $tokenCode, 'account_id' => $user->id, 'account_email' => $user->email, 'account_name' => $user->name])
                        ->template('pass_recover')
                        ->send();

                    $this->response->statusCode('200');
                    $data = ['message' => 'Email sent.'];
                } else {
                    $this->response->statusCode('400');
                    $data = ['message' => 'Error to send email.'];
                }
            } else {
                $this->response->statusCode('400');
                $data = ['message' => 'Email not valid.'];
            }
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'Request needs to be post'];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
}
