<?php

namespace app\models;

use app\controllers\BaseActiveController;
use Yii;

/**
 * This is the model class for table "order_detail".
 *
 * @property int $id 自增长id
 * @property string $order_time 订单创建时间
 * @property int $user_id 所属用户id
 * @property double $payment 订单金额
 * @property string $remark 备注（自动生成）
 * @property string $order_to 配送目的地
 */
class OrderDetail extends BaseActiveController
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_time'], 'safe'],
            [['user_id'], 'integer'],
            [['payment'], 'number'],
            [['remark'], 'string', 'max' => 200],
            [['order_to'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_time' => 'Order Time',
            'user_id' => 'User ID',
            'payment' => 'Payment',
            'remark' => 'Remark',
            'order_to' => 'Order To',
        ];
    }
}
