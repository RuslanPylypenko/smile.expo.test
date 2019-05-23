<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedback_product".
 *
 * @property int $id
 * @property string $user_name
 * @property string $user_email
 * @property string $text
 * @property string $date
 */
class FeedbackProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'user_email', 'text', 'date'], 'required'],
            [['text'], 'string'],
            [['date'], 'safe'],
            [['user_name', 'user_email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'user_name' => Yii::t('main', 'User Name'),
            'user_email' => Yii::t('main', 'User Email'),
            'text' => Yii::t('main', 'Text'),
            'date' => Yii::t('main', 'Date'),
        ];
    }
}
