<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 *
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function view()
    {
        if ($this->Auth->user('confirmation') == true) {

            $report_id = $this->request->getQuery('report_id');

            if (isset($report_id)) {
                $reports = $this->Reports->find('all', ['conditions' => ['id' => $report_id]]);
            } else {
                $reports = $this->Reports->find('all');
            }

            $this->response->statusCode('200');
            $data = ['reports' => $reports];
        } else {
            $this->response->statusCode('400');
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

        $report = $this->Reports->newEntity();
        if ($this->request->is('post')) {
            $report = $this->Reports->patchEntity($report, $this->request->getData());
            if ($this->Reports->save($report)) {

                $this->response->withStatus(200);
                $data = ['message' => 'The report has been saved.'];
            } else {
                $errors = $report->getErrors();
                $this->response->statusCode('400');
                $data = [
                    'message' => 'Error while saving.',
                    'error' => $errors,
                    'report' => $report
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
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['post', 'put']);

        $id = $this->request->getData('id');

        $report = $this->Reports->get($id);

        if ($report) {

            if ($this->request->is(['patch', 'post', 'put'])) {
                $report = $this->Reports->patchEntity($report, $this->request->getData());
                if ($this->Reports->save($report)) {

                    $this->response->withStatus(200);
                    $data = ['message' => 'The report has been saved.'];
                } else {
                    $this->response->statusCode('400');
                    $data = [
                        'message' => 'Error while saving, contact the adminitrator.'
                    ];
                }
            } else {
                $this->response->statusCode('400');
                $data = [
                    'message' => 'The request needs to be post or put'
                ];
            }
        } else {
            $this->response->statusCode('400');
            $data = [
                'message' => 'Report not found'
            ];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    /**
     * Delete method
     *
     * @param string|null $id Report id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $id = $this->request->getData('id');

        $report = $this->Reports->get($id);
        if ($this->Reports->delete($report)) {
            $this->response->withStatus(200);
            $data = ['message' => 'The report has been deleted.'];
        } else {
            $this->response->withStatus(400);
            $data = ['message' => 'The report could not be deleted. Please, try again.'];
        }

        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
}
