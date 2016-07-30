<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Task
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class TasksController extends AppController {

	public $components = array('Paginator','FileUpload');
    
    public function index() {
        $this->loadModel('Project');

        $this->Paginator->settings = array(
            'limit' => LIMIT_PROJECT
        );

        $task = $this->Paginator->paginate('Task');

        foreach ($task as $key => $value) {
            $task[$key]['Task']['project_id'] = $this->Project->getNameProject($value['Task']['project_id']);
        }


        $this->set('task', $task);
        $this->set('arrStatusT', $this->Task->getTaskStatus());

    }

    /*Add task*/
    public function add() {
        $this->loadModel('Project');
        $this->loadModel('File');
        $this->loadModel('User');
        $this->loadModel('AssignTask');

        $this->set('lisProject', $this->Project->getListProject());
        $this->set('arrStatusT', $this->Task->getTaskStatus());
        $this->set('arrPositionT', $this->Task->getTaskPosition());
        $this->set('arrUser', $this->User->getListUser());
        
		if ($this->request->is('post')) {
            $this->Task->create();
			if ($this->Task->save($this->request->data)) {
                $currIdTask = $this->Task->getLastInsertId();
                if(!empty($this->request->data['Task']['assign_user'])){
                    $assign['user_id'] = $this->request->data['Task']['assign_user'];
                    $assign['task_id'] = $currIdTask;
                    if(!$this->AssignTask->save($assign)){
                        $this->Flash->error(__('The AssignTask could not be saved. Please, try again.'));
                    }
                }
                if( !empty($this->request->data['Task']['upload']['name'])){
                    $fileu = $this->FileUpload->uploadFiles(ADMIN_PATH, $this->data['Task']['upload'], $permitted = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png','application/x-zip-compressed'));
                    $file['task_id'] = $currIdTask;
                    $file['status'] = '0';
                    $file['name'] = $fileu['file_name'];
                    $file['path'] = $fileu['path'];
                    if(!$this->File->save($file)){
                        $this->Flash->error(__('The File could not be saved. Please, try again.'));
                    }
                    
                }
                $this->Session->setFlash(__('The Task has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Task could not be saved. Please, try again.'));
			}
		}
	}

    /*Edit task*/
	public function edit($id = null) {
        $this->loadModel('Project');
        $this->loadModel('File');
        $this->loadModel('User');
        $this->loadModel('AssignTask');
        

        if (!$id) {
            throw new NotFoundException(__('Invalid Task'));
        }

        $tasks = $this->Task->findById($id);
        if (!$tasks) {
            throw new NotFoundException(__('Invalid Task'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->request->data['Task']['id'] = $id;
            if ($this->Task->save($this->request->data)) {
                //check save AssignTask
                if(!empty($this->request->data['Task']['assign_user'])){
                    $taskAssigns = $this->AssignTask->find("all",array(
                        "conditions" => array("task_id" => $id)
                    ));
                    if(isset($taskAssigns['0']['AssignTask'])){
                        $assign['user_id'] = $this->request->data['Task']['assign_user'];
                        $assign['task_id'] = $id;
                        $assign['id'] = $taskAssigns['0']['AssignTask']['id'];
                        if($this->AssignTask->save($assign)){
                            
                        }else{
                            $this->Flash->error(__('The AssignTask could not be saved. Please, try again.'));
                        }
                    }
                }
                // check save file
                if( !empty($this->request->data['Task']['upload']['name'])){
                    $fileu = $this->FileUpload->uploadFiles(ADMIN_PATH, $this->data['Task']['upload'], $permitted = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png'));
                    $taskAssigns = $this->File->find("all",array(
                        "conditions" => array("task_id" => $id)
                    ));
                    if(isset($taskAssigns['0']['File'])){
                        $file['task_id'] = $currIdTask;
                        $file['status'] = '0';
                        $file['name'] = $fileu['file_name'];
                        $file['path'] = $fileu['path'];
                        $file['id'] = $taskAssigns['0']['File']['id'];

                        if(!$this->File->save($file)){
                            $this->Flash->error(__('The File could not be saved. Please, try again.'));
                        }

                    }
                    
                    
                }

                $this->Flash->success(__('The Task has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }

            $this->Flash->error(__('Unable to update The Task.'));
        }
        if (!$this->request->data) {
            $this->request->data = $tasks;
        }
        
        $this->set('lisProject', $this->Project->getListProject());
        $this->set('arrStatusT', $this->Task->getTaskStatus());
        $this->set('arrPositionT', $this->Task->getTaskPosition());
        $this->set('arrUser', $this->User->getListUser());
        $this->set('tasks', $tasks);
    }


    /*Edit task*/
    public function view($id = null) {
        $this->loadModel('Project');
        $this->loadModel('File');
        $this->loadModel('User');
        $this->loadModel('AssignTask');
        if (!$id) {
            throw new NotFoundException(__('Invalid Task'));
        }

        $tasks = $this->Task->findById($id);
        if (!$tasks) {
            throw new NotFoundException(__('Invalid Task'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->request->data['Task']['id'] = $id;
            if ($this->Task->save($this->request->data)) {
                $this->Flash->success(__('The Task has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }

            $this->Flash->error(__('Unable to update The Task.'));
        }

        $file = $this->File->findDetailFile(array("task_id"=>$id));



        $this->set('lisProject', $this->Project->getListProject());
        $this->set('arrStatusT', $this->Task->getTaskStatus());
        $this->set('arrPositionT', $this->Task->getTaskPosition());
        $this->set('tasks', $tasks);
        $this->set('file', $file);
    }


    public function task_get_user($id = null){
        $this->loadModel("AssignTask");
        $this->loadModel("User");

        $taskAssigns = $this->AssignTask->find("all",array(
            "conditions" => array("task_id" => $id)
        ));
        $userIds = array();
        foreach ($taskAssigns as $key => $value) {
            $userIds[] = $value['AssignTask']['user_id'];
        }
        $result = "";
        $users = $this->User->find("all",array(
            'conditions' => array("id" => $userIds)
        ));
        foreach ($users as $k => $v) {
            $result .= $v['User']['name']."<br />";
        }
        echo $result;die;
    }

    public function dowload($fileId, $folder){
        if(!empty($fileId) && !empty($folder)){
            $this->FileUpload->downloadFile($fileId, $folder);
        }else{
            throw new NotFoundException(__('Error file'));
        }
    }

}
