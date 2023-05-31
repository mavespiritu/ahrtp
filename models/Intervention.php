<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblintervention".
 *
 * @property string $intervention_id
 * @property string|null $intervention_title
 * @property string|null $comp_id
 *
 * @property Tblcompetency $comp
 * @property TblannualPriorityIntervention[] $tblannualPriorityInterventions
 */
class Intervention extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblintervention';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['intervention_title', 'comp_id'], 'required'],
            [['intervention_title'], 'string', 'max' => 255],
            [['comp_id', 'intervention_id'], 'integer'],
            [['comp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Competency::className(), 'targetAttribute' => ['comp_id' => 'comp_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'intervention_id' => 'Intervention ID',
            'intervention_title' => 'Intervention',
            'comp_id' => 'Competency',
        ];
    }

    /**
     * Gets query for [[Comp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompetency()
    {
        return $this->hasOne(Competency::className(), ['comp_id' => 'comp_id']);
    }

    /**
     * Gets query for [[TblannualPriorityInterventions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnnualPriorityInterventions()
    {
        return $this->hasMany(AnnualPriorityIntervention::className(), ['intervention_id' => 'intervention_id']);
    }
}
