<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use App\View\Tradutor;
use Cake\Filesystem\File;
use Cake\Utility\Security;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewUnUsers($id = null)
    {
        if ($this->Auth->user('role_id') == 2) {
            if ($this->Auth->user('confirmation') == true) {
                $user = $this->Users->find('all', [
                    'conditions' => ['confirmation' => 0]
                ]);

                $this->response->statusCode('200');
                $data = ['user' => $user];
            } else {
                $this->response->statusCode('400');
                $data = ['message' => 'You need someone authorize your request.'];
            }
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'You are not a Admin'];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }


    public function viewUsers($id = null)
    {
        if ($this->Auth->user('confirmation') == true) {
            $user = $this->Users->find('all', [
                'conditions' => ['confirmation' => 1]
            ]);

            $data = ['user' => $user];
            $this->response->statusCode('200');
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'You need someone authorize your request.'];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    public function authorizeUser($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        if (true) {
            if ($this->Auth->user('role_id') == 2) {
                if ($this->Auth->user('confirmation') == true) {
                    $id = $this->request->getData('id');
                    $user = $this->Users->find('all', [
                        'conditions' => ['id' => $id]
                    ])->first();

                    if ($user) {

                        if ($user->confirmation == false) {

                            $user->confirmation = true;

                            if ($this->Users->save($user)) {
                                $this->response->statusCode('200');
                                $data = ['message' => 'the ' . $user->email . ' has been authorized.'];
                            } else {
                                $errors = $user->getErrors();
                                $this->response->statusCode('400');
                                $data = [
                                    'message' => 'Error while saving.',
                                    'error' => $errors
                                ];
                            }
                        } else {
                            $data = [
                                'message' => 'This users is already authorized.',
                            ];
                        }
                    } else {
                        $this->response->statusCode('400');
                        $data = ['message' => 'This user is not valid.'];
                    }
                } else {
                    $this->response->statusCode('400');
                    $data = ['message' => 'You need someone authorize your request.'];
                }
            } else {
                $this->response->statusCode('400');
                $data = ['message' => 'You are not a Admin'];
            }
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'the request needs to be post or put'];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }


    public function promoteUser($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        if (true) {
            if ($this->Auth->user('role_id') == 2) {
                if ($this->Auth->user('confirmation') == true) {
                    $id = $this->request->getData('id');
                    $user = $this->Users->find('all', [
                        'conditions' => ['id' => $id]
                    ])->first();

                    if ($user) {

                        if ($user->role_id == 1) {

                            $user->role_id = 2;

                            if ($this->Users->save($user)) {
                                $this->response->statusCode('200');
                                $data = ['message' => 'the ' . $user->email . ' has been promoted.'];
                            } else {
                                $errors = $user->getErrors();
                                $this->response->statusCode('400');
                                $data = [
                                    'message' => 'Error while saving.',
                                    'error' => $errors
                                ];
                            }
                        } else {
                            $data = [
                                'message' => 'This users is already an admin.',
                            ];
                        }
                    } else {
                        $this->response->statusCode('400');
                        $data = ['message' => 'This user is not valid.'];
                    }
                } else {
                    $this->response->statusCode('400');
                    $data = ['message' => 'You need someone authorize your request.'];
                }
            } else {
                $this->response->statusCode('400');
                $data = ['message' => 'You are not a Admin'];
            }
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'the request needs to be post or put'];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->response->withStatus(200);
                $data = ['message' => 'The user has been saved.'];
            } else {
                $errors = $user->getErrors();
                $this->response->statusCode('400');
                $data = [
                    'message' => 'Error while saving.',
                    'error' => $errors
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
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['post', 'put']);

        $id = $this->request->getData('id');

        if (isset($id)) {
            $user = $this->Users->find('all', [
                'conditions' => ['id' => $id]
            ])->first();


            if ($this->Auth->user('id') == $user->id || $this->Auth->user('role_id') == 2) {
                $data = $this->request->getData();

                if ($this->Auth->user('role_id') == 1) {
                    $data['role_id'] = 1;
                    if ($user->confirmation == 0)
                        $data['confirmation'] = 0;
                    else
                        $data['confirmation'] = 1;
                }


                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    $this->response->statusCode('200');
                    $this->Auth->setUser($user);

                    $data = [
                        'message' => 'The user has been saved.',
                        'user' => $user
                    ];
                } else {
                    $errors = $user->getErrors();
                    $this->response->statusCode('400');
                    $data = [
                        'message' => 'Error while saving.',
                        'error' => $errors
                    ];
                }
            } else {
                $this->response->statusCode('400');
                $data = [
                    'message' => 'Login on your account to edit profile'
                ];
            }
        } else {
            $this->response->statusCode('400');
            $data = [
                'message' => 'User ID missing.'
            ];
        }
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getData('id');
        $user = $this->Users->get($id);
        if ($this->Auth->user('id') == $user->id || $this->Auth->user('role_id') == 2) {
            if ($this->Users->delete($user)) {
                $this->response->withStatus(200);
                $data = ['message' => 'The user has been deleted.'];
            } else {
                $this->response->statusCode('400');
                $data = [
                    'message' => 'The user could not be deleted. Please, try again.'
                ];
            }
        } else {
            $this->response->statusCode('400');
            $data = [
                'message' => 'you need to be an admin or logged on your account.'
            ];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
}
