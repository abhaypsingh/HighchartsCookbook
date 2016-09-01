<?php

/**
 * This is the model class for table "tbl_monster".
 *
 * The followings are the available columns in table 'tbl_monster':
 * @property integer $id
 * @property string $name
 * @property double $height
 * @property double $weight
 * @property integer $hp
 * @property integer $attack
 * @property integer $defense
 * @property integer $special_attack
 * @property integer $special_defense
 * @property integer $speed
 */
class Monster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_monster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('hp, attack, defense, special_attack, special_defense, speed', 'numerical', 'integerOnly'=>true),
			array('height, weight', 'numerical'),
			array('name', 'length', 'max'=>32),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, height, weight, hp, attack, defense, special_attack, special_defense, speed', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Name',
			'height' => 'Height',
			'weight' => 'Weight',
			'hp' => 'Hp',
			'attack' => 'Attack',
			'defense' => 'Defense',
			'special_attack' => 'Special Attack',
			'special_defense' => 'Special Defense',
			'speed' => 'Speed',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('height',$this->height);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('hp',$this->hp);
		$criteria->compare('attack',$this->attack);
		$criteria->compare('defense',$this->defense);
		$criteria->compare('special_attack',$this->special_attack);
		$criteria->compare('special_defense',$this->special_defense);
		$criteria->compare('speed',$this->speed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Monster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
