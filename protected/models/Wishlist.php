<?php

/**
 * This is the model class for table "{{wishlist}}".
 *
 * The followings are the available columns in table '{{wishlist}}':
 * @property integer $wishlist_id
 * @property integer $customer_id
 * @property integer $product_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Product $product
 */
class Wishlist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{wishlist}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wishlist_id, customer_id, product_id', 'required'),
			array('wishlist_id, customer_id, product_id, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('wishlist_id, customer_id, product_id, status, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'wishlist_id' => 'Wishlist',
			'customer_id' => 'Customer',
			'product_id' => 'Product',
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

		$criteria->compare('wishlist_id',$this->wishlist_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('product_id',$this->product_id);
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
	 * @return Wishlist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
