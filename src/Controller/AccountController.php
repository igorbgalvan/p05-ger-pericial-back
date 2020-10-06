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
        $this->Auth->allow(['lostAccount']);
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
                $token->token = password_hash($token, PASSWORD_DEFAULT);
                $token->user_id = $user->id;
                $token->expiration = time();

                if ($Tokens->save($token)) {

                    $email = new Email('gerpericial');
                    $email->to($user->email)
                        ->subject('Alteração de senha - Gerenciador Pericial')
                        ->emailFormat('html')
                        ->viewVars(['confirm_email_token' => $tokenCode, 'account_id' => $user->id, 'account_name' => $user->name])
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
        }
        else
        {
            $this->response->statusCode('400');
            $data = ['message' => 'Request needs to be post'];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
}
