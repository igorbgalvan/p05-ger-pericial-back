<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

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
        $this->Auth->allow(['createAccount']);
    }

    public function createAccount()
    {
        $Users = TableRegistry::getTableLocator()->get('Users');
        $user = $Users->newEntity();
        if ($this->request->is('post')) {
            $user = $Users->patchEntity($user, $this->request->getData());

            if ($Users->save($user)) {
                $this->response->statusCode('200');
                $data = [
                    'message' => 'Conta criada com sucesso!',
                ];
            }
            else
            {
                $this->response->statusCode('400');
                $data = [
                    'message' => 'The request needs to be post'
                ];
            }
        } else {
            $this->response->statusCode('400');
            $data = [
                'message' => 'The request needs to be post'
            ];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
}
