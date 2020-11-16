<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * RequestDocuments Controller
 *
 * @property \App\Model\Table\RequestDocumentsTable $RequestDocuments
 *
 * @method \App\Model\Entity\RequestDocument[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequestDocumentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Requests'],
        ];
        $requestDocuments = $this->paginate($this->RequestDocuments);

        $this->set(compact('requestDocuments'));
    }

    /**
     * View method
     *
     * @param string|null $id Request Document id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestDocument = $this->RequestDocuments->get($id, [
            'contain' => ['Requests'],
        ]);

        $this->set('requestDocument', $requestDocument);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $requestDocument = $this->RequestDocuments->newEntity();
        if ($this->request->is('post')) {
            $requestDocument = $this->RequestDocuments->patchEntity($requestDocument, $this->request->getData());
            if ($this->RequestDocuments->save($requestDocument)) {
                $this->response->statusCode('200');
                $data = ['message' => 'The document has been saved'];
            } else {
                $this->response->statusCode('400');
                $data = ['message' => 'The document has not saved', 'error' => $requestDocument->getErrors()];
            }
        } else {
            $this->response->statusCode('400');
            $data = ['message' => 'Method Not Allowed'];
        }
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    /**
     * Edit method
     *
     * @param string|null $id Request Document id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestDocument = $this->RequestDocuments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestDocument = $this->RequestDocuments->patchEntity($requestDocument, $this->request->getData());
            if ($this->RequestDocuments->save($requestDocument)) {
                $this->Flash->success(__('The request document has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request document could not be saved. Please, try again.'));
        }
        $requests = $this->RequestDocuments->Requests->find('list', ['limit' => 200]);
        $this->set(compact('requestDocument', 'requests'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Request Document id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requestDocument = $this->RequestDocuments->get($id);
        if ($this->RequestDocuments->delete($requestDocument)) {
            $this->Flash->success(__('The request document has been deleted.'));
        } else {
            $this->Flash->error(__('The request document could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
