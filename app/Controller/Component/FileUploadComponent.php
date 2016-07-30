<?php
/**
 * Class FileUploadComponent
 */
class FileUploadComponent extends Component {

    /**
     * @param $folder
     * @param $file
     * @param array $permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
     * @param null $itemId
     * @return array
     */
    public function uploadFiles($folder, $file, $permitted = array(), $itemId = null, $width = null, $height = null) {
        $result = array(
            'code' => 0,
            'path' => null,
            'file_name' => null
        );

        // setup dir names absolute and relative
        $folder_url = UPLOADS_FILE_PATH . $folder;
        $upload_max_size = ini_get('upload_max_filesize');

        // create the folder if it does not exist
        if (!is_dir($folder_url)) {
            mkdir($folder_url, 0755, true);
        }
        // if itemId is set create an item folder
        $idfolder = $itemId;
        if ($itemId) {
            if ($itemId < 1000) {
                $idfolder = '0001';
            } else {
                $idfolder = intval($itemId / 1000) . '000';
            }
            // set new absolute folder
            $folder_url = UPLOADS_FILE_PATH . $folder . DS . $idfolder;
            // create directory
            if (!is_dir($folder_url)) {
                mkdir($folder_url, 0755);
            }
        }

        // replace spaces with underscores
        $filename = str_replace(' ', '_', $file['name']);
        // assume filetype is false
        $typeOK = true;
        // check file type is ok
        if (count($permitted)) {
            $typeOK = false;
            foreach ($permitted as $type) {
                if ($type == $file['type']) {
                    $typeOK = true;
                    break;
                }
            }
        }
        //If file type is image
        //Get extension file upload
        $now = date('YmdHis') . uniqid() . $filename;
        $url = $folder_url . DS . $now;
        $ext = pathinfo($url, PATHINFO_EXTENSION);
        // if file type ok upload the file
        if ($typeOK) {
            // switch based on error code
            switch ($file['error']) {
                case 0:
                    // create unique filename and upload file  
                    if ((!$width) || (!$height)) {
                        $width = 300;
                        $height = 300;
                    }
                    try {
                        if (strtolower($ext) == 'jpeg' || strtolower($ext) == 'png' || strtolower($ext) == 'gif' || strtolower($ext) == 'jpg' || strtolower($ext) == 'bmp') {
                            list($w, $h) = getimagesize($file['tmp_name']);
                            /* calculate new image size with ratio */
                            if ($w > $h) {
                                $ratio = max($width / $w, $height / $h);
                                $h = ceil($height / $ratio);
                                $x = ($w - $width / $ratio) / 2;
                                $y = ($h - $height / $ratio) / 2;
                                $w = ceil($width / $ratio);
                            } else {
                                $ratio = min($width / $w, $height / $h);
                                $h = ceil($height / $ratio);
                                $x = ($w - $width / $ratio) / 2;
                                $y = ($h - $height / $ratio) / 2;
                                $w = ceil($width / $ratio);
                            }
                            /* read binary data from image file */
                            $imgString = file_get_contents($file['tmp_name']);
                            /* create image from string */
                            $image = imagecreatefromstring($imgString);
                            $tmp = imagecreatetruecolor($width, $height);
                            imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h);
                            // Resize 

                            /* Save image */
                            switch ($file['type']) {
                                case 'image/jpeg':
                                    imagejpeg($tmp, $url, 100);
                                    $success = true;
                                    break;
                                case 'image/png':
                                    imagepng($tmp, $url, 0);
                                    $success = true;
                                    break;
                                case 'image/gif':
                                    imagegif($tmp, $url);
                                    $success = true;
                                    break;
                                default:
                                    exit;
                                    break;
                            }
                            /* cleanup memory */
                            imagedestroy($image);
                            imagedestroy($tmp);
                        } else {
                            $success = move_uploaded_file($file['tmp_name'], $url);
                        }
                    } catch (Exception $e) {
                        echo 'Error: ' . $e->getMessage();
                    }
                    // if upload was successful
                    if ($success) {
                        // save the url of the file
                        $result['path'] = $idfolder . DS . $now;
                        $result['file_name'] = $filename;
                        $result['code'] = 1;
                    } else {
                        $result['errors'] = __("Failed to up the file, please up again.");
                        $result['ref'] = json_encode($file);
                    }
                    break;
                case 3:
                    // an error occured
                    $result['errors'] = __("");
                    $result['ref'] = json_encode($file);
                    break;
                default:
                    // an error occured
                    $result['errors'] = __("Failed to up the file, please up again.");
                    $result['ref'] = json_encode($file) . "upload_max_size: " . $upload_max_size;
                    break;
            }
        } elseif ($file['error'] == 4) {
            // no file was selected for upload
            $result['nofiles'] = __("Please select an image file.");
            $result['ref'] = json_encode($file) . "upload_max_size: " . $upload_max_size;
        } else {
            // unacceptable file type
            $result['errors'] = __("Please select an image file.");
            $result['ref'] = json_encode($file) . "upload_max_size: " . $upload_max_size;
        }
        return $result;
    }


    public function downloadFile($fileId, $folder) {

        $File = ClassRegistry::init('File');
        $path = $File->find('first', array(
            'fields' => array('File.path', 'File.name'),
            'conditions' => array('File.id' => $fileId)
        ));

        if ($path) {
            $pathFile = UPLOADS_FILE_PATH . $folder . DS . $path['File']['path'];
            $nameFile = $path['File']['name'];

            if (file_exists($pathFile)) {
                header("Content-Type: application/octet-stream");
                header("Content-Disposition: attachment; filename=" . $nameFile);
                readfile($pathFile);
                return true;
            }
        }
        return false;
    }
}
