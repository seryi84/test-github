<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mailout".
 *
 * @property integer $id
 * @property integer $check
 * @property string $email
 * @property string $theme
 * @property string $text
 * @property string $date
 */
class Mailout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['check'], 'integer'],
            [['email', 'theme'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['email'], 'string', 'max' => 150],
            [['theme'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'check' => 'Check',
            'email' => 'Получатель',
            'theme' => 'Тема письма',
            'text' => 'Текст',
            'date' => 'Дата получения',
        ];
    }
    
    public $current_date;
    public function init(){
    parent::init();
    $this->current_date = date("Y-m-d H:i:s");
    }
    
    public function beforeSave() {
        $this->date = $this->current_date;
        
        return parent::beforeSave($insert);
    }
}
