<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblcompetency_type".
 *
 * @property string $comp_type
 * @property string|null $competency_type_description
 *
 * @property Tblcompetency[] $tblcompetencies
 */
class CompetencyType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblcompetency_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comp_type'], 'required'],
            [['comp_type'], 'string', 'max' => 50],
            [['competency_type_description'], 'string', 'max' => 255],
            [['comp_type'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comp_type' => 'Comp Type',
            'competency_type_description' => 'Competency Type Description',
        ];
    }

    /**
     * Gets query for [[Tblcompetencies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompetencies()
    {
        return $this->hasMany(Competency::className(), ['comp_type' => 'comp_type']);
    }
}
