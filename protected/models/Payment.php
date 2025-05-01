<?php

/**
 * This is the model class for table "{{payment}}".
 *
 * The followings are the available columns in table '{{payment}}':
 * @property integer $id
 * @property string $payment_date
 * @property string $payment_method
 * @property string $amount
 * @property integer $customer_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 * @property Customer $customer
 */
class Payment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{payment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_date, payment_method, amount, customer_id', 'required'),
			array('customer_id, status', 'numerical', 'integerOnly'=>true),
			array('payment_method', 'length', 'max'=>100),
			array('amount', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, payment_date, payment_method, amount, customer_id, status, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Order', 'payment_id'),
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'payment_date' => 'Payment Date',
			'payment_method' => 'Payment Method',
			'amount' => 'Amount',
			'customer_id' => 'Customer',
			'status' => 'Status',
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
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('payment_method',$this->payment_method,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('status',$this->status);
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
	 * @return Payment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
