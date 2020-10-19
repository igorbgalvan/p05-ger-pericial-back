<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VehiclesRequests Controller
 *
 * @property \App\Model\Table\VehiclesRequestsTable $VehiclesRequests
 *
 * @method \App\Model\Entity\VehiclesRequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VehiclesRequestsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Vehicles', 'Requests'],
        ];
        $vehiclesRequests = $this->paginate($this->VehiclesRequests);

        $this->set(compact('vehiclesRequests'));
    }

    /**
     * View method
     *
     * @param string|null $id Vehicles Request id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vehiclesRequest = $this->VehiclesRequests->get($id, [
            'contain' => ['Vehicles', 'Requests'],
        ]);

        $this->set('vehiclesRequest', $vehiclesRequest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vehiclesRequest = $this->VehiclesRequests->newEntity();
        if ($this->request->is('post')) {
            $vehiclesRequest = $this->VehiclesRequests->patchEntity($vehiclesRequest, $this->request->getData());
            if ($this->VehiclesRequests->save($vehiclesRequest)) {
                $this->Flash->success(__('The vehicles request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicles request could not be saved. Please, try again.'));
        }
        $vehicles = $this->VehiclesRequests->Vehicles->find('list', ['limit' => 200]);
        $requests = $this->VehiclesRequests->Requests->find('list', ['limit' => 200]);
        $this->set(compact('vehiclesRequest', 'vehicles', 'requests'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicles Request id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vehiclesRequest = $this->VehiclesRequests->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehiclesRequest = $this->VehiclesRequests->patchEntity($vehiclesRequest, $this->request->getData());
            if ($this->VehiclesRequests->save($vehiclesRequest)) {
                $this->Flash->success(__('The vehicles request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vehicles request could not be saved. Please, try again.'));
        }
        $vehicles = $this->VehiclesRequests->Vehicles->find('list', ['limit' => 200]);
        $requests = $this->VehiclesRequests->Requests->find('list', ['limit' => 200]);
        $this->set(compact('vehiclesRequest', 'vehicles', 'requests'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicles Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vehiclesRequest = $this->VehiclesRequests->get($id);
        if ($this->VehiclesRequests->delete($vehiclesRequest)) {
            $this->Flash->success(__('The vehicles request has been deleted.'));
        } else {
            $this->Flash->error(__('The vehicles request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
