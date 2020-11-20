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
        $this->Auth->allow(['lostAccount', 'changePass', 'verifyToken', 'confirmAccount']);
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
                ])->order(['expiration' => 'DESC'])->first();


                if ($token) {

                    if (password_verify($tokenCode, $token->token)) {
                        $tokenTime = $token->expiration + 1800;
                        $tokenCode = $this->generateToken(24);
                        $token->token = password_hash($tokenCode, PASSWORD_DEFAULT);

                        if ($tokenTime >= time()) {
                            if ($Tokens->save($token)) {

                                $this->response->statusCode('200');
                                $data = [
                                    'message' => 'token valid.',
                                    'error' => false,
                                    'id' => $id,
                                    'tokenCode' => $tokenCode
                                ];
                            } else {
                                $this->response->statusCode('400');
                                $data = [
                                    'message' => 'error while saving token.',
                                    'error' => true
                                ];
                            }
                        } else {
                            $this->response->statusCode('400');
                            $data = [
                                'message' => 'token expired.',
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
                        'message' => 'token not exists.',
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
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    public function changePass()
    {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $Tokens = TableRegistry::getTableLocator()->get('Tokens');
            $Users = TableRegistry::getTableLocator()->get('Users');

            $data = $this->request->getData();
            $id = $data['id'];
            $tokenCode = $data['tokenCode'];
            $password = $data['password'];
            $user = $Users->get($id);


            if ($user) {
                $token = $Tokens->find('all', [
                    'conditions' => ['user_id' => $id]
                ])->order(['expiration' => 'DESC'])->first();


                if ($token) {

                    if (password_verify($tokenCode, $token->token)) {
                        if ($Tokens->delete($token)) {
                            $user->password = $password;
                            if ($Users->save($user)) {
                                $this->createLog("Senha do usuário " . $this->Auth->user('name') . " foi trocada com sucesso");
                                $this->response->statusCode('200');
                                $data = [
                                    'message' => 'The password has been changed.',
                                    'error' => false
                                ];
                            } else {
                                $this->response->statusCode('400');
                                $data = [
                                    'message' => 'The password has not been changed. Please, try again.',
                                    'error' => true
                                ];
                            }
                        }
                    } else {
                        $this->response->statusCode('400');
                        $data = [
                            'message' => 'token expired.',
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
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
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

    public function confirmAccount()
    {
        $Users = TableRegistry::getTableLocator()->get('Users');
        $data = $this->request->getData();
        $id = $data['id'];
        $tokenCode = $data['tokenCode'];

        $user = $Users->get($id);

        if ($user) {

            if (password_verify($tokenCode, $user->email_confirmed)) {
                $user->email_confirmed = time();
                if ($Users->save($user)) {

                    $this->response->statusCode('200');
                    $data = ['message' => 'The email account has been confirmed'];
                }
            } else {
                $this->response->statusCode('400');
                $data = ['message' => 'token not valid', 'error' => true];
            }
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'user not valid', 'error' => true];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    public function resendEmail()
    {
        $Users = TableRegistry::getTableLocator()->get('Users');
        $user = $Users->get($this->Auth->user('id'));

        $token = $this->generateToken(24);
        $user->email_confirmed = password_hash($token, PASSWORD_DEFAULT);
        if ($Users->save($user)) {

            $email = new Email('gerpericial');
            $email->to($user->email)
                ->subject('Confirmação de criação de conta')
                ->emailFormat('html')
                ->viewVars(['confirm_email_token' => $token, 'account_id' => $user->id])
                ->template('default')
                ->send();


            $this->response->statusCode('200');
            $data = ['message' => 'the email has been sent', 'error' => false];
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'error while sending email', 'error' => true];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
}
