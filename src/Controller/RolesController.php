<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 *
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
        $this->set('_serialize', 'roles');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if(!$this->verifyUser()){

            $this->response = $this->response->withStatus(400);
            $data = ['message' => 'You need someone authorize you.'];

            $this->set(compact('data'));
            $this->set('_serialize', 'data');
            return;
        }

        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->response->withStatus(200);
                $data = ['message' => 'The role has been saved.'];
            } else {
                $this->response->statusCode('400');
                $data = [
                    'message' => 'The role could not be saved. Please, try again.'
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

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if(!$this->verifyUser()){

            $this->response = $this->response->withStatus(400);
            $data = ['message' => 'You need someone authorize you.'];

            $this->set(compact('data'));
            $this->set('_serialize', 'data');
            return;
        }

        $role = $this->Roles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if(!$this->verifyUser()){

            $this->response = $this->response->withStatus(400);
            $data = ['message' => 'You need someone authorize you.'];

            $this->set(compact('data'));
            $this->set('_serialize', 'data');
            return;
        }
        
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getData('id');
        $role = $this->Roles->get($id);
        if ($this->Auth->user('role_id') == 2) {
            if ($this->Roles->delete($role)) {
                $this->response->withStatus(200);
                $data = ['message' => 'The role has been deleted.'];
            } else {
                $this->response->statusCode('400');
                $data = [
                    'message' => 'The role could not be deleted. Please, try again.'
                ];
            }
        } else {
            $this->response->statusCode('400');
            $data = [
                'message' => 'you need to be an admin.'
            ];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
}
