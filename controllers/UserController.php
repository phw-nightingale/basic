<?php
/**
 * Created by PhpStorm.
 * User: phw
 * Date: 18-3-8
 * Time: 下午3:09
 */

namespace app\controllers;

use app\models\LoginForm;

class UserController extends BaseActiveController
{
    public $modelClass = 'app\models\User';

    public function actionLogin() {
        $model = new LoginForm();
        $model->setAttributes($this->post);
        if ($model->login()) {
            return [
                'code' => 200,
                'message' => '登陆成功',
                'data' => [
                    'access_token' => $model->user->access_token
                ]
            ];
        }
        return [
            'code' => 500,
            'message' => $model->errors
        ];
    }
}