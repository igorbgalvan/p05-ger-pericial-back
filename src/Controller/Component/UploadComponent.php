<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Exception\InternalErrorException;
use Cake\ORM\TableRegistry;

/**
 * Upload component
 */
class UploadComponent extends Component
{

    public function uploadFile($folder, $uniqName, $data)
    {

        $dir = WWW_ROOT . 'files' . DS . $folder;

        $file_tmp_name = $data['tmp_name'];
        $filename = $data['name'];


        if (is_uploaded_file($file_tmp_name)) {
            if(move_uploaded_file($file_tmp_name, $dir . DS . $uniqName))
                return true;
        }
        return false;
    }

    public function uploadPicture($data)
    {
        return $this->upload($data, 'pictures');
    }
}
