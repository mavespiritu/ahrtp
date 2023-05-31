<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblcompetency".
 *
 * @property string $comp_id
 * @property string|null $competency
 * @property string|null $comp_type
 *
 * @property TblcompetencyType $compType
 * @property Tblintervention[] $tblinterventions
 */
class Competency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblcompetency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['competency'], 'unique'],
            [['comp_id'], 'integer'],
            [['competency', 'comp_type'], 'required'],
            [['comp_type'], 'string', 'max' => 50],
            [['competency'], 'string', 'max' => 255],
            [['comp_type'], 'exist', 'skipOnError' => true, 'targetClass' => CompetencyType::className(), 'targetAttribute' => ['comp_type' => 'comp_type']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comp_id' => 'Comp ID',
            'competency' => 'Competency',
            'comp_type' => 'Competency Type',
        ];
    }

    /**
     * Gets query for [[CompType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompetencyType()
    {
        return $this->hasOne(CompetencyType::className(), ['comp_type' => 'comp_type']);
    }

    /**
     * Gets query for [[Tblinterventions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInterventions()
    {
        return $this->hasMany(Intervention::className(), ['comp_id' => 'comp_id']);
    }
}
