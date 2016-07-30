<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppModel', 'Model');


class Project extends AppModel {
	public function getNameProject($id = null) {
		if (!$id) {
            throw new NotFoundException(__('Invalid Project'));
        }
        $projects = $this->findById($id);
        if (!$projects) {
            throw new NotFoundException(__('Invalid Project'));
        }

        return isset($projects['Project']['name'])? $projects['Project']['name'] : '';
	}


	public function getListProject() {

        $projects = $this->find('all',array(
	            'fields' => array('Project.id','Project.name',)
            ));
        if (!$projects) {
            throw new NotFoundException(__('Invalid Project'));
        }
        $arrListProject = array();
        foreach ($projects as $key => $value) {
        	$arrListProject[$value['Project']['id']] = $value['Project']['name'];
        }

        return $arrListProject;
	}


	const STATUS_NOTFINISH = 0;
	const STATUS_COMPLETE = 1;
    
	public static function getProjectStatus($value = null) {
        $project_status = array(
            Project::STATUS_NOTFINISH => 'Chưa hoàn thành',
            Project::STATUS_COMPLETE => 'Đã hoàn thành'
        );
        if (isset($value)) {
            if (!empty($project_status[$value])) {
                return $project_status[$value];
            } else {
                return '';
            }
        } else {
            return $project_status;
        }
    }

}
