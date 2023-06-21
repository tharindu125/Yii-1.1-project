<?php

/**
 * This is the model class for table "guest_details".
 *
 * The followings are the available columns in table 'guest_details':
 * @property integer $guest_id
 * @property string $guest_name
 * @property string $room_number
 * @property string $mobile_number
 * @property string $email
 * @property string $gender
 * @property string $dob
 * @property string $country
 * @property string $dishes
 */
class GuestDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'guest_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('guest_name, room_number, mobile_number, email', 'required'),
			array('guest_name, room_number, mobile_number, gender, country, dishes', 'length', 'max'=>255),
			array('email', 'length', 'max'=>50),
			array('dob', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('guest_id, guest_name, room_number, mobile_number, email, gender, dob, country, dishes', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'guest_id' => 'Guest',
			'guest_name' => 'Guest Name',
			'room_number' => 'Room Number',
			'mobile_number' => 'Mobile Number',
			'email' => 'Email',
			'gender' => 'Gender',
			'dob' => 'Dob',
			'country' => 'Country',
			'dishes' => 'Dishes',
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

		$criteria->compare('guest_id',$this->guest_id);
		$criteria->compare('guest_name',$this->guest_name,true);
		$criteria->compare('room_number',$this->room_number,true);
		$criteria->compare('mobile_number',$this->mobile_number,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('dishes',$this->dishes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GuestDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
