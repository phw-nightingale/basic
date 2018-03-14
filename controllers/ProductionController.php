<?php
/**
 * Created by PhpStorm.
 * User: phw
 * Date: 18-3-14
 * Time: 上午11:12
 */

namespace app\controllers;

use app\models\UploadImageForm;

class ProductionController extends BaseActiveController
{
    public $modelClass = 'app\models\Production';

    public function actionUpload() {
        $model = new UploadImageForm();
        return $model->upload();
    }

}