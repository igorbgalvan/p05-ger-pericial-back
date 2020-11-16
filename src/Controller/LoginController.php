<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Security;
use Cake\Event\Event;

/**
 * Login Controller
 *
 *
 * @method \App\Model\Entity\Login[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoginController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login']);
    }

    public function login()
    {
        if ($this->request->is('post')) {

            $user = $this->Auth->identify();

            if (!$user) {
                $this->response = $this->response->withStatus(400);
                $data = ['message' => 'Usuário ou senha inválidos'];
            } else {
                $this->Auth->setUser($user);
                $user['token'] = \Firebase\JWT\JWT::encode(['sub' => $user['email'], 'exp' => time() + 86400], Security::salt());
                $this->response->statusCode('200');
                $data = [
                    'message' => 'Bem vindo!',
                    'user' => $user
                ];
            }
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'Bad request'];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
}
