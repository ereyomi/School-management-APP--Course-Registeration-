<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faculties".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 */
class Faculties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faculties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
        ];
    }
     public function getStudents()
    {
        return $this->hasMany(Students::className(), ['faculty_id' => 'id']);
    }

     public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['faculty_id' => 'id']);
    }

}
