<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Error\Debugger;
use Cake\Log\Log;
use Cake\Database;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;

class UsersController extends AppController
{
    public $users_value=array();
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->viewBuilder()->setLayout('ajax');
    }

    public function add()
    {
        Log::debug('inside');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
        // if ($this->request->is('ajax')) {
            Log::debug('inside if');
            $data = $this->request->input();
            Log::debug($data);
            Log::debug($this->request->data);
            $step = $this->request->getData('step');
            Log::debug($step);
            Log::debug('outside');
            // $user = $this->Users->newEntity($this->request->getData());
            $step = $this->request->getData('step');

            switch ($step) {
                case 'Step1':
                    Log::debug('inside step1');
                    $user = $this->Users->newEntity($this->request->getData(),['validate' => 'Step1']);
                    if ($user->getErrors()) {
                        Log::debug('error1');
                        $result=$user->getErrors();
                        // $this->Flash->success('Error', [
                        //     'key' => 'positive',
                        //     'params' => [
                        //         'email' => $result['email'],
                        //         'password' => $result['password']
                        //     ]
                        // ]);
                        return $this->response->withStringBody(json_encode(['success' => false, 'errors' => $user->getErrors()]));
                    } 
                    else{
                        $hashPswdObj = new DefaultPasswordHasher;
                        $user->email = $this->request->getData('email');
                        $user->password = $hashPswdObj->hash($this->request->getData('password'));
                        Log::debug($user);
                        $this->set('Users', $user);
                        if ($this->Users->save($user)) {
                            $user_id=$user->id;
                            Log::debug($user_id);
                            // $this->set(compact('user_id'));
                            return $this->response->withStringBody(json_encode(['success' => true, 'user_id' => $user->id]));
                        }
                        else
                        {
                            // $this->Flash->error(__('The user could not be saved. Please, try again.'));
                            return $this->response->withStringBody(json_encode(['success' => false, 'errors' => 'The user could not be saved. Please, try again.']));
                        }
                    }
                    break;
                case 'Step2':
                    // Log::debug('inside step2');
                    // if($this->request->getData('gender') === strval(0)){
                    //     $this->request->data['gender']='male';
                    // }
                    // if($this->request->getData('gender') === strval(1)){
                    //     $this->request->data['gender']='female';
                    // }
                    // Log::debug($this->request->getData());
                    // $user = $this->Users->newEntity($this->request->getData(),['validate' => 'Step2']);
                    // Log::debug($user);
                    
                    Log::debug('inside step2');
                    $user_id = $this->request->getData('id'); 
                    $user = $this->Users->get($user_id);

                    // Update 'gender' field based on your logic
                    if ($this->request->getData('gender') === strval(0)) {
                        $this->request->data['gender'] = 'male';
                    }
                    if ($this->request->getData('gender') === strval(1)) {
                        $this->request->data['gender'] = 'female';
                    }
                    $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'Step2']);
                    
                    if ($user->getErrors()) {
                        Log::debug('error2');
                        // $result=$user->getErrors();
                        // $this->Flash->success('Error', [
                        //     'key' => 'positive',
                        //     'params' => [
                        //         'username' => $result['username'],
                        //         'gender' => $result['gender']
                        //     ]
                        // ]);
                        return $this->response->withStringBody(json_encode(['success' => false, 'errors' => $user->getErrors()]));
                    } 
                    else{
                       $user_id = $this->request->getData('id'); 
                       Log::debug('success2');
                       Log::debug($user_id);
                        // $users = $user->find('all')->where(['id' => $user_id])->first();
                        // $users=$this->Users->get($user_id);
                        $user->username = $this->request->getData('username');
                        $user->gender = $this->request->getData('gender');
                        $this->set('Users', $user);
                        if ($this->Users->save($user)) {
                            // $user_id=$user->id;
                            // Log::debug($user_id);
                            // $this->set(compact('user_id'));
                            return $this->response->withStringBody(json_encode(['success' => true, 'user_id' => $user->id]));
                        }
                        else
                        {
                            $this->Flash->error(__('The user could not be saved. Please, try again.'));
                            return $this->response->withStringBody(json_encode(['success' => false, 'errors' => 'The user could not be saved. Please, try again.']));
                        }
                    }
                    break;
                case 'Step3':
                    Log::debug('inside step3');
                    $user_id = $this->request->getData('id');
                    $user = $this->Users->get($user_id); 
                    $user = $this->Users->patchEntity($user,$this->request->getData(),['validate' => 'Step3']);
                    if ($user->getErrors()) {
                        Log::debug('error3');
                        $result=$user->getErrors();
                        // $this->Flash->success('Error', [
                        //     'key' => 'positive',
                        //     'params' => [
                        //         'hobbies' => $result['hobbies'],
                        //         'interests' => $result['interests']
                        //     ]
                        // ]);
                        return $this->response->withStringBody(json_encode(['success' => true, 'errors' => $user->getErrors()]));
                    } 
                    else{
                        Log::debug('success3');
                        // $users = $user->find('all')->where(['id' => $user_id])->first();
                        $user->hobbies = $this->request->getData('hobbies');
                        $user->interests = $this->request->getData('interests');
                        $this->set('Users', $user);
                        if ($this->Users->save($user)) {
                            $user_id=$user->id;
                            Log::debug($user_id);
                            return $this->response->withStringBody(json_encode(['success' => true]));
                        }
                        else
                        {
                            $this->Flash->error(__('The user could not be saved. Please, try again.'));
                            return $this->response->withStringBody(json_encode(['success' => false, 'errors' => 'The user could not be saved. Please, try again.']));
                        }
                    }
                    break;
                default:
                    break;
            }
        }
        $this->set(compact('user'));
    }
}
