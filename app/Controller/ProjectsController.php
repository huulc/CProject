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
 * @link          http://cakephp.org CakePHP(tm) Project
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
class ProjectsController extends AppController {

	public $components = array('Paginator');
    
    public function index() {
        $this->Paginator->settings = array(
            'limit' => LIMIT_PROJECT,
            'conditions' => array( 'Project.published' => 1)
        );

        $project = $this->Paginator->paginate('Project');

        $this->set('arrStatusP', $this->Project->getProjectStatus());
        $this->set('Project', $project);
    }


    public function add() {
    	$this->set('arrStatusP', $this->Project->getProjectStatus());
		if ($this->request->is('post')) {
            $this->Project->create();
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The Project has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The Project could not be saved. Please, try again.'));
			}
		}
	}

	public function edit($id = null) {

        if (!$id) {
            throw new NotFoundException(__('Invalid Project'));
        }

        $projects = $this->Project->findById($id);
        if (!$projects) {
            throw new NotFoundException(__('Invalid Project'));
        }

        if ($this->request->is(array('post', 'put'))) {

            $this->request->data['Project']['id'] = $id;
            if ($this->Project->save($this->request->data)) {
                $this->Flash->success(__('The Project has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }

            $this->Flash->error(__('Unable to update The Project.'));
        }

        if (!$this->request->data) {
            $this->request->data = $projects;
        }

        $this->set('arrStatusP', $this->Project->getProjectStatus());
        $this->set('projects', $projects);
    }

}
