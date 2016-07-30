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
App::import('Model', 'Project');

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

	public $components = array('Paginator');
    
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


    public function add() {
        $this->loadModel('Project');
        $this->set('lisProject', $this->Project->getListProject());
        $this->set('arrStatusT', $this->Task->getTaskStatus());
        $this->set('arrPositionT', $this->Task->getTaskPosition());
        
		if ($this->request->is('post')) {
            $this->Task->create();
               
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash(__('The Task has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Task could not be saved. Please, try again.'));
			}
		}
	}

	public function edit($id = null) {
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

        if (!$this->request->data) {
            $this->request->data = $tasks;
        }

        $this->loadModel('Project');
        $this->set('lisProject', $this->Project->getListProject());
        $this->set('arrStatusT', $this->Task->getTaskStatus());
        $this->set('arrPositionT', $this->Task->getTaskPosition());
        $this->set('tasks', $tasks);
    }

}
