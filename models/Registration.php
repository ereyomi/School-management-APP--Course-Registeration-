<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registration".
 *
 * @property int $id
 * @property int $student_id
 * @property int $level_id
 * @property string $courses
 * @property int $status
 * @property string $created_at
 */
class Registration extends \yii\db\ActiveRecord
{
    const PENDING = 0,
        APPROVED = 1,
        REJECTED = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['courses'], 'required'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'courses' => 'Courses',
        ];
    }

    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['user_id' => 'student_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'student_id']);
    }
    public function getFaculty()
    {
        return $this->hasOne(Faculties::className(), ['id' => 'faculty_id']);
    }
}
