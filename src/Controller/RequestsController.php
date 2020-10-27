<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 * @property \App\Model\Table\VehiclesRequestsTable $VehiclesRequests
 * @property \App\Model\Table\VehiclesTable $Vehicles
 *
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequestsController extends AppController
{
    /**
     * View method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->request->allowMethod(['get']);

        $Vehicles = TableRegistry::getTableLocator()->get('vehicles');
        $Victim = TableRegistry::getTableLocator()->get('victims');
        $VehiclesRequests = TableRegistry::getTableLocator()->get('vehicles_requests');
        $VictimsRequests = TableRegistry::getTableLocator()->get('victims_requests');

        $vehicles = array();
        $victims = array();

        if ($this->Auth->user('confirmation') == true) {
            //$requests = $this->Requests->find('all');

            $requests = $this->Requests->find('all');

            foreach ($requests as $request) {
                $vehiclesRequests = $VehiclesRequests->find('all', ['conditions' => ['request_id' => $request->id]]);
                $victimsRequests = $VictimsRequests->find('all', ['conditions' => ['request_id' => $request->id]]);

                foreach ($vehiclesRequests as $v_R) {
                    $allVehicles = $Vehicles->find('all', ['conditions' => ['id' => $v_R->vehicle_id]]);
                    array_push($vehicles, $allVehicles);
                }
                foreach ($victimsRequests as $v_R) {
                    $allVictim = $Victim->find('all', ['conditions' => ['id' => $v_R->victim_id]]);
                    array_push($victims, $allVictim);
                }
                $request->vehicle = $vehicles;
                $request->victims = $victims;
            }


            $this->response = $this->response->withStatus(200);
            $data = ['requests' => $requests];
        } else {
            $this->response = $this->response->withStatus(400);
            $data = ['message' => 'You need someone authorize your request.'];
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
        if ($this->request->is('post')) {
            $Vehicles = TableRegistry::getTableLocator()->get('vehicles');
            $Victim = TableRegistry::getTableLocator()->get('victims');
            $VehiclesRequests = TableRegistry::getTableLocator()->get('vehicles_requests');
            $VictimsRequests = TableRegistry::getTableLocator()->get('victims_requests');

            $vehicleData = [];
            $victimData = [];

            $allData = $this->request->getData();
            if (isset($allData['vehicle'])) {
                $vehicleData = $allData['vehicle'];
                unset($allData['vehicle']);
            }
            if (isset($allData['victim'])) {
                $victimData = $allData['victim'];
                unset($allData['victim']);
            }

            $request = $this->Requests->newEntity();
            $vehicle = $Vehicles->newEntity();
            $vehiclesRequests = $VehiclesRequests->newEntity();
            $victim = $Victim->newEntity();
            $victimsRequests = $VictimsRequests->newEntity();

            $request = $this->Requests->patchEntity($request, $allData);
            if ($this->Requests->save($request)) {

                foreach ($vehicleData as $v) {

                    $existVehicle = $Vehicles->find('all', ['conditions' => ['placa' => $v['placa']]])->first();

                    if ($existVehicle) {
                        $vehicle = $existVehicle;
                    } else {
                        $vehicle = $Vehicles->patchEntity($vehicle, $v);
                    }

                    if ($Vehicles->save($vehicle)) {


                        $vehiclesRequests->vehicle_id = $vehicle->id;
                        $vehiclesRequests->request_id = $request->id;

                        if ($VehiclesRequests->save($vehiclesRequests)) {

                            $vehicle = $Vehicles->newEntity();
                            $vehiclesRequests = $VehiclesRequests->newEntity();
                        } else {
                            $this->response->statusCode('400');
                            $data = ['message' => 'The vehiclesRequests could not be saved. Please, try again.'];
                        }
                    } else {
                        $this->response->statusCode('400');
                        $data = ['message' => 'The vehicle could not be saved. Please, try again.'];
                    }
                }

                foreach ($victimData as $v) {

                    $victim = $Victim->patchEntity($victim, $v);

                    if ($Victim->save($victim)) {

                        $victimsRequests->victim_id = $victim->id;
                        $victimsRequests->request_id = $request->id;

                        if ($VictimsRequests->save($victimsRequests)) {

                            $victim = $Victim->newEntity();
                            $victimsRequests = $VictimsRequests->newEntity();
                        } else {
                            $this->response->statusCode('400');
                            $data = ['message' => 'The victimsRequests could not be saved. Please, try again.'];
                        }
                    } else {
                        $this->response->statusCode('400');
                        $data = ['message' => 'The victim could not be saved. Please, try again.'];
                    }
                }

                $this->response->statusCode('200');
                $data = ['message' => 'The request has been saved.'];
            } else {
                $this->response->statusCode('400');
                $data = [
                    'message' => 'The request could not be saved. Please, try again.',
                    'error' => $request->getErrors()
                ];
            }
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'the request needs to be post.'];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    /**
     * Edit method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $request = $this->Requests->get($id, [
            'contain' => ['Vehicles'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $request = $this->Requests->patchEntity($request, $this->request->getData());
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }
        $vehicles = $this->Requests->Vehicles->find('list', ['limit' => 200]);
        $this->set(compact('request', 'vehicles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $request = $this->Requests->get($id);
        if ($this->Requests->delete($request)) {
            $this->Flash->success(__('The request has been deleted.'));
        } else {
            $this->Flash->error(__('The request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
