<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));



        // $pokemon = $this->Pokemons->find()
        //     ->where([
        //         'OR' => [
        //             'condition1' => 'a',
        //             'condition2' => 'b'
        //         ], 

        //     ]);

        // debug($pokemon); exit;
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Books', 'Books.Categories'],
        ]);

       
        // placing code from the edit function here
        if ($this->request->is(['patch', 'post', 'put'])) {

            /**
             * SUPER IMPORTANT: I'm sending the ID of each book as a hidden field
             * called "hiddenid". I'll be manually changing these to "id" here
             */

             

            $booksChanged = $this->request->getData()['books'];
            $dataToPatch = $this->request->getData();
            $books = [];
            
            foreach($booksChanged as $book){
                $bookEntry = ['id' => $book['hiddenid'] , '_joinData'=>$book['_joinData']];
                array_push($books, $bookEntry);
            }



            $dataToPatch['books'] = $books;

           
           
            /**
             * SUPER IMPORTANT: Note that I am turning off the validations for
             * the books and users entity, because I'm not altering them in any way. 
             * All I'm doing is adding things to the join table, and that's already being 
             * validated properly. 
             * 
             * 
             * 
             * 
             * 
             * Also, note that the reason it prompts invalid validation in the first place is because
             * $dataToPatch only has a list of books, and nothing about the user. So it considers 
             * the other fields as blank. However, if you're turning off validation, it will retain the
             * previous value
             * 
             * 
             * */    

            $user = $this->Users->patchEntity($user, $dataToPatch, [
                'validate' => false,
                'associated' => [
                    'Books' => ['validate' => false],
                    'Books._joinData'
                ]
            ]);

           
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your reading preference has been updated'));

                return $this->redirect(['action' => 'view', $user->id]);
            }
            $this->Flash->error(__('Your reading preference could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $books = $this->Users->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'books'));
    }

     /** 
     * I'm using the user's id to track who the user is. I might have to change this so that
     * the user's id is fetched from the authentication object instead.
    */
    public function addBookByUser($id = null)
    {
        // decoding the id
        $id = base64_decode($id);

        $user = $this->Users->get($id, [
            'contain' => ['Books'],
        ]);

        //generating list of book ids the reader already has
        /**
         * I'm generating an array of all the book ids and reading status of books
         * the user currently has on their collection. Secondly, I'm getting a list
         * of book ids that the user has selected via the POST request. Afterwards, 
         * making a comparison to see if any selected book already belongs to the user's
         * collection. If it does, then I'm setting the same status. 
         */
        $booksUserAlreadyHas = [];

        foreach($user->books as $book){
            $booksUserAlreadyHas[$book->id] = $book->_joinData->status;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            /**code for setting the book status to "want to read" by default*/
            $allBookIds = $this->request->getData()['books']['_ids'];
            $bookIdsUserAlreadyHas = array_keys($booksUserAlreadyHas);
           
            $books = [];
            $dataToPatch = $this->request->getData();
            
            
            //need to add a check here so that it doesn't throw error when
            // no book is selected or all books are unselected.
            //added a if check if no book is selected (returns an empty id array) 
            if(!empty($allBookIds)){
                foreach($allBookIds as $id){
                    // need to add a check here to see if a book already has a status
                    if(in_array($id, $bookIdsUserAlreadyHas)){
                        $bookEntry = ['id' => $id, '_joinData' => ['status'=>$booksUserAlreadyHas[$id]]];
                        array_push($books, $bookEntry);
                    }
                    else{
                        $bookEntry = ['id' => $id, '_joinData' => ['status'=>'Want to read']];
                        array_push($books, $bookEntry);
                    }
                }
            }
            
            //setting the books attribute with the new array
            $dataToPatch['books'] = $books;

            //debug($dataToPatch);
            
          
            /** =============end code here========================================*/
            
            // note that I am patching the modified array, and not the original request data
            $user = $this->Users->patchEntity($user, $dataToPatch, [
                'associated' => ['Books._joinData'=>['validate'=>false]]
            ]);


           
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your books collection has been updated'));

                return $this->redirect(['action' => 'view', $user->id]);
            }
            $this->Flash->error(__('Your books collection could not be updated. Please, try again.'));
        }
        $books = $this->Users->Books->find('list', ['limit' => 200])->all();
        $allBooks = $this->Users->Books->find();
      
        $this->set(compact('user', 'books', 'allBooks'));
    }

    
    public function editProfile($id = null){
        $user = $this->Users->get($id, [
            'contain' => ['Books'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'view', $user->id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $books = $this->Users->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'books'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null){
        $user = $this->Users->get($id, [
            'contain' => ['Books'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $books = $this->Users->Books->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'books'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }
    
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {

            // fetching the logged in user's id so that they can be redirected to their profile
           $loggedInUserId = $this->request->getAttribute('authentication')->getIdentity()->id;
        
         
            
            // redirect to User's own profile when logged in
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Users',
                'action' => 'view', $loggedInUserId
            ]);
    
            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }


}
