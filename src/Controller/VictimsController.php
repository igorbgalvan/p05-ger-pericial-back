<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Victims Controller
 *
 * @property \App\Model\Table\VictimsTable $Victims
 *
 * @method \App\Model\Entity\Victim[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VictimsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $victims = $this->paginate($this->Victims);

        $this->set(compact('victims'));
    }

    /**
     * View method
     *
     * @param string|null $id Victim id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $victim = $this->Victims->get($id, [
            'contain' => ['Requests'],
        ]);

        $this->set('victim', $victim);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $victim = $this->Victims->newEntity();
        if ($this->request->is('post')) {
            $victim = $this->Victims->patchEntity($victim, $this->request->getData());
            if ($this->Victims->save($victim)) {
                $this->Flash->success(__('The victim has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The victim could not be saved. Please, try again.'));
        }
        $requests = $this->Victims->Requests->find('list', ['limit' => 200]);
        $this->set(compact('victim', 'requests'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Victim id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $victim = $this->Victims->get($id, [
            'contain' => ['Requests'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $victim = $this->Victims->patchEntity($victim, $this->request->getData());
            if ($this->Victims->save($victim)) {
                $this->Flash->success(__('The victim has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The victim could not be saved. Please, try again.'));
        }
        $requests = $this->Victims->Requests->find('list', ['limit' => 200]);
        $this->set(compact('victim', 'requests'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Victim id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $victim = $this->Victims->get($id);
        if ($this->Victims->delete($victim)) {
            $this->Flash->success(__('The victim has been deleted.'));
        } else {
            $this->Flash->error(__('The victim could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
