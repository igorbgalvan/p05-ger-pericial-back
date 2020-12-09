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
        if (!$this->verifyUser()) {

            $this->response = $this->response->withStatus(400);
            $data = ['message' => 'You need someone authorize you.', 'error' => true];

            $this->set(compact('data'));
            $this->set('_serialize', 'data');
            return;
        }

        $this->request->allowMethod(['get']);

        $search = $this->request->getQuery('search');

        if ($this->Auth->user('role_id') == 2) {
            $this->paginate = [
                'contain' => ['Users'],
                'order' => ['created' => 'desc'],
            ];
            if ($search != null)
                $logs = $this->paginate($this->Logs->find('all')->where(['OR' => [['message like' => "%" . $search . "%"], ['DATE_FORMAT(created,"%d/%m/%Y") like' => "%" . $search . "%"]]]));
            else
                $logs = $this->paginate($this->Logs);

//
            $this->response->statusCode('200');
            $data = ['logs' => $logs, 'error' => false, 'code' => '200'];
        } else {
            $this->response->statusCode('404');
            $data = ['message' => 'You are not a Admin', 'error' => true, 'code' => '404'];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
}
