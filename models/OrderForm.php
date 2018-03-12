<?php
/**
 * Created by PhpStorm.
 * User: phw
 * Date: 18-3-12
 * Time: 上午11:19
 */

namespace app\models;


use yii\base\Model;

class OrderForm extends Model
{
    public $id;
    public $userId;
    public $payment;
    public $orderTo;

    private $_orderDetail = false;


    /**
     * @return array the validate rules
     */
    public function rules()
    {
        return [
            [['userId', 'payment'], 'required'],
            ['payment', 'int']
        ];
    }

    /**
     * @return bool|null|static
     */
    public function getOrderDetail() {
        if ($this->_orderDetail === false) {
            $this->_orderDetail = OrderDetail::findOne($this->id);
        }
        return $this->_orderDetail;
    }

}