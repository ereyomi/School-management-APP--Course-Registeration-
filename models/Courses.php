<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property int $id
 * @property string $name
 * @property string $course_code
 * @property int $unit
 * @property int $level_id
 * @property int $department_id
 * @property string $created_at
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'course_code', 'unit', 'faculty_id', 'level_id', 'department_id'], 'required'],
            [['unit', 'level_id', 'department_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['course_code'], 'string', 'max' => 10],
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
            'course_code' => 'Course Code',
            'unit' => 'Unit',
            'faculty_id' => 'Faculty',
            'level_id' => 'Level',
            'department_id' => 'Department',
        ];
    }
}
