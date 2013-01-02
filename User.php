<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $image
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $profile
 *
 * The followings are the available model relations:
 * @property Post[] $posts
 */
class User extends CActiveRecord
{
  /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, salt, email', 'length', 'max'=>128),
			array('image, profile', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('image, id, username, password, salt, email, profile', 'safe', 'on'=>'search'),
			//array('image', 'file', 'types'=>'jpg, gif, png'),  
			array('image_name,image_type,image_size,image', 'safe')
		);
	}
	
	public function beforeSave()  
	{  
    if ($file = getInstance($this,'image'))
    {  
		$file->saveAs(Yii::app()->baseUrl.'/images/'.$this->image);
		$this->image_name = $file->name;  
        $this->image_type = $file->type;  
        $this->image_size = $file->size;  
        $this->image = file_get_contents($file->tempName);  
    }  
  
    return parent::beforeSave();  
	}  

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'image' => 'Image',
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
			'email' => 'Email',
			'profile' => 'Profile',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('image',$this->image,true);
		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('profile',$this->profile,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function validatePassword($password)
    {
        return $this->hashPassword($password,$this->salt)===$this->password;
    }
 
    public function hashPassword($password,$salt)
    {
        return $password;
    }
}