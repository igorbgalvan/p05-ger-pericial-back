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
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Upload');
    }

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


        if ($this->Auth->user('confirmation') == true) {
            //$requests = $this->Requests->find('all');

            $requests = $this->Requests->find('all', [
                'contain' => ['Vehicles', 'Victims', 'RequestDocuments'],
            ]);


            $this->response = $this->response->withStatus(200);
            $data = ['requests' => $requests];
        } else {
            $this->response = $this->response->withStatus(400);
            $data = ['message' => 'You need someone authorize your request.'];
        }
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }


    public function uploadDocument()
    {


        if ($this->request->is('post')) {

            $id = $this->request->getData('id');

            $picture_ext = pathinfo($this->request->data['document']['name'], PATHINFO_EXTENSION);

            if (in_array($picture_ext, ['png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF', 'pdf', 'doc', 'docx', 'csv', 'txt', 'pptx', 'ppt',  'xlsx', 'xls', 'odt', 'rtf', 'html'])) {
                $Documents = TableRegistry::getTableLocator()->get('request_documents');

                $requestDocument = $Documents->newEntity();

                $name = $id . "." . uniqid() . rand(10, 99) . '.' . $picture_ext;

                $data = ['request_id' => $this->request->data['id'], 'doc_name' => $name, 'title' => $this->request->data['title']];

                $requestDocument = $Documents->patchEntity($requestDocument, $data);
                if ($this->Upload->uploadFile('documents', $name,  $this->request->data['document'])) {
                    if ($Documents->save($requestDocument)) {
                        $this->response->statusCode('200');
                        $data = ['message' => 'The document has been uploaded', 'success' => true];
                    } else {
                        $this->response->statusCode('400');
                        $data = ['message' => 'The document has not uploaded in db', 'success' => false, 'error' => $requestDocument->getErrors()];
                    }
                } else {
                    $this->response->statusCode('400');
                    $data = ['message' => 'The document has not uploaded in system', 'success' => false, 'error' => $requestDocument->getErrors()];
                }
            } else {
                $this->response->statusCode('400');
                $data = ['message' => 'Extension not valid.'];
            }
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'Method Not Allowed'];
        }
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    public function select()
    {
        $this->request->allowMethod(['get']);

        if ($this->Auth->user('confirmation') == true) {

            $Requests = TableRegistry::getTableLocator()->get('requests');

            $requests = $Requests->find('all');
            $requests->rightJoin(['Users' => 'users'], ['Users.id = user_id']);
            $requests->select(['Users.id', 'count' => $requests->func()->count('user_id')])->where(['Users.confirmation' => 1, 'Users.actived' => 1])->group(['Users.id']);

            if (json_decode(json_encode($requests))) {

                $user_count = array();
                $min_values = array();

                foreach ($requests as $request) {
                    $user_count[$request['Users']['id']] = $request['count'];
                }
                $min = min($user_count);

                foreach ($user_count as $key => $value) {
                    if ($value === $min)
                        $min_values[$key] = $value;
                }

                $user = array_rand($min_values, 1);


                $this->response = $this->response->withStatus(200);
                $data = ["user_selected" => $user];
            } else {
                $this->response = $this->response->withStatus(400);
                $data = ['message' => 'You need someone authorize your request.', 'error' => true];
            }
        } else {
            $this->response = $this->response->withStatus(400);
            $data = ['message' => 'Something got wrong, call the server admin.', 'error' => true];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    public function viewUser($id = null)
    {


        if ($this->Auth->user('confirmation') == true) {
            $requests = $this->Requests->find('all', ['conditions' => ['user_id' => $id]]);

            $this->response->statusCode('200');
            $data = ['requests' => $requests, 'error' => false];
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'You need someone authorize your request.', 'error' => true];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    public function viewOne($id = null)
    {
        $this->request->allowMethod(['get']);


        if ($this->Auth->user('confirmation') == true) {
            //$requests = $this->Requests->find('all');

            $request = $this->Requests->get($id, [
                'contain' => ['Vehicles', 'Victims'],
            ]);

            if ($request) {
                $this->response = $this->response->withStatus(200);
                $data = ['request' => $request];
            } else {
                $this->response = $this->response->withStatus(404);
                $data = ['message' => 'Not found', 'error' => true];
            }
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
        if ($this->request->is(['post', 'put'])) {
            $id = $this->request->getData('id');

            $request = $this->Requests->get($id, [
                'contain' => ['Vehicles', 'Victims'],
            ]);

            $request = $this->Requests->patchEntity($request, $this->request->getData());
            if ($this->Requests->save($request)) {

                $this->response->statusCode('200');
                $data = ['message' => "A requisição foi salva com sucesso"];
            } else {
                $error = $request->getErrors();
                $this->response->statusCode('400');
                $data = ['message' => "A requisição não foi salva. Por favor, contate um administrador.", "error" => $error];
            }
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
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
