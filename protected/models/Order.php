<?php

/**
 * This is the model class for table "{{order}}".
 *
 * The followings are the available columns in table '{{order}}':
 * @property integer $id
 * @property string $order_date
 * @property string $total_price
 * @property integer $customer_id
 * @property integer $payment_id
 * @property integer $shipment_id
 * @property integer $status
 * @property integer $is_received
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Payment $payment
 * @property Shipment $shipment
 * @property OrderItem[] $orderItems
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_date, total_price, customer_id, is_received', 'required'),
			array('customer_id, payment_id, shipment_id, status, is_received', 'numerical', 'integerOnly'=>true),
			array('total_price', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_date, total_price, customer_id, payment_id, shipment_id, status, is_received, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'payment' => array(self::BELONGS_TO, 'Payment', 'payment_id'),
			'shipment' => array(self::BELONGS_TO, 'Shipment', 'shipment_id'),
			'orderItems' => array(self::HAS_MANY, 'OrderItem', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_date' => 'Order Date',
			'total_price' => 'Total Price',
			'customer_id' => 'Customer',
			'payment_id' => 'Payment',
			'shipment_id' => 'Shipment',
			'status' => 'Status',
			'is_received' => 'Is Received',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('order_date',$this->order_date,true);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('payment_id',$this->payment_id);
		$criteria->compare('shipment_id',$this->shipment_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('is_received',$this->is_received);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
