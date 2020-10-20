<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VictimsRequests Controller
 *
 * @property \App\Model\Table\VictimsRequestsTable $VictimsRequests
 *
 * @method \App\Model\Entity\VictimsRequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VictimsRequestsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Victims', 'Requests'],
        ];
        $victimsRequests = $this->paginate($this->VictimsRequests);

        $this->set(compact('victimsRequests'));
    }

    /**
     * View method
     *
     * @param string|null $id Victims Request id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $victimsRequest = $this->VictimsRequests->get($id, [
            'contain' => ['Victims', 'Requests'],
        ]);

        $this->set('victimsRequest', $victimsRequest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $victimsRequest = $this->VictimsRequests->newEntity();
        if ($this->request->is('post')) {
            $victimsRequest = $this->VictimsRequests->patchEntity($victimsRequest, $this->request->getData());
            if ($this->VictimsRequests->save($victimsRequest)) {
                $this->Flash->success(__('The victims request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The victims request could not be saved. Please, try again.'));
        }
        $victims = $this->VictimsRequests->Victims->find('list', ['limit' => 200]);
        $requests = $this->VictimsRequests->Requests->find('list', ['limit' => 200]);
        $this->set(compact('victimsRequest', 'victims', 'requests'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Victims Request id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $victimsRequest = $this->VictimsRequests->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $victimsRequest = $this->VictimsRequests->patchEntity($victimsRequest, $this->request->getData());
            if ($this->VictimsRequests->save($victimsRequest)) {
                $this->Flash->success(__('The victims request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The victims request could not be saved. Please, try again.'));
        }
        $victims = $this->VictimsRequests->Victims->find('list', ['limit' => 200]);
        $requests = $this->VictimsRequests->Requests->find('list', ['limit' => 200]);
        $this->set(compact('victimsRequest', 'victims', 'requests'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Victims Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $victimsRequest = $this->VictimsRequests->get($id);
        if ($this->VictimsRequests->delete($victimsRequest)) {
            $this->Flash->success(__('The victims request has been deleted.'));
        } else {
            $this->Flash->error(__('The victims request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
