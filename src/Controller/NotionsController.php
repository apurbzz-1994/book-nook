<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Notions Controller
 *
 * @property \App\Model\Table\NotionsTable $Notions
 * @method \App\Model\Entity\Notion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($id = null)
    {
        
        $this->paginate = [
            'contain' => ['BooksUsers'],
        ];
        $notions = $this->paginate($this->Notions->find()->where(['books_user_id'=> $id]));

        $this->set(compact('notions'));
    }

    /**
     * View method
     *
     * @param string|null $id Notion id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notion = $this->Notions->get($id, [
            'contain' => ['BooksUsers'],
        ]);

        $this->set(compact('notion'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notion = $this->Notions->newEmptyEntity();
        if ($this->request->is('post')) {
            $notion = $this->Notions->patchEntity($notion, $this->request->getData());
            if ($this->Notions->save($notion)) {
                $this->Flash->success(__('The notion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notion could not be saved. Please, try again.'));
        }
        $booksUsers = $this->Notions->BooksUsers->find('list', ['limit' => 200])->all();
        $this->set(compact('notion', 'booksUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Notion id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notion = $this->Notions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notion = $this->Notions->patchEntity($notion, $this->request->getData());
            if ($this->Notions->save($notion)) {
                $this->Flash->success(__('The notion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notion could not be saved. Please, try again.'));
        }
        $booksUsers = $this->Notions->BooksUsers->find('list', ['limit' => 200])->all();
        $this->set(compact('notion', 'booksUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Notion id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notion = $this->Notions->get($id);
        if ($this->Notions->delete($notion)) {
            $this->Flash->success(__('The notion has been deleted.'));
        } else {
            $this->Flash->error(__('The notion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
