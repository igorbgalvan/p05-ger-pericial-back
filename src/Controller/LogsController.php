<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Logs Controller
 *
 * @property \App\Model\Table\LogsTable $Logs
 *
 * @method \App\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function view()
    {
        if(!$this->verifyUser()){

            $this->response = $this->response->withStatus(400);
            $data = ['message' => 'You need someone authorize you.'];

            $this->set(compact('data'));
            $this->set('_serialize', 'data');
            return;
        }

        $this->request->allowMethod(['get']);

        if ($this->Auth->user('role_id') == 2) {
            $this->paginate = [
                'contain' => ['Users'],
            ];
            $logs = $this->paginate($this->Logs);

            $this->response->statusCode('400');
            $data = ['logs' => $logs, 'numbers' => $this->Paginator->numbers()];
        }
        else{
            $this->response->statusCode('400');
            $data = ['message' => 'You are not a Admin'];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
}
