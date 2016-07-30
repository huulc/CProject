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

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class Task extends AppModel {

	const STATUS_START = 0;
	const STATUS_COMPLETE = 1;
	const STATUS_STOP = 2;
    
	public static function getTaskStatus($value = null) {
        $task_status = array(
            Task::STATUS_START => 'Bắt đầu dự án',
            Task::STATUS_COMPLETE => 'Đã hoàn thành',
            Task::STATUS_STOP => 'Hủy task',
        );
        if (isset($value)) {
            if (!empty($task_status[$value])) {
                return $task_status[$value];
            } else {
                return '';
            }
        } else {
            return $task_status;
        }
    }




    const POSITION_1 = 0;
	const POSITION_2 = 1;
	const POSITION_3 = 2;
    
	public static function getTaskPosition($value = null) {
        $task_position = array(
            Task::POSITION_1 => 'Trung bình',
            Task::POSITION_2 => 'Ưu tiên',
            Task::POSITION_3 => 'Khẩn cấp',
        );
        if (isset($value)) {
            if (!empty($task_position[$value])) {
                return $task_position[$value];
            } else {
                return '';
            }
        } else {
            return $task_position;
        }
    }


    


}
