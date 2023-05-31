<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblannual_priority_intervention".
 *
 * @property string $intervention_id
 * @property int $year
 * @property int|null $priority
 * @property string|null $training_type
 *
 * @property Tblemployee[] $emps
 * @property Tblintervention $intervention
 * @property TblempInterventionYear[] $tblempInterventionYears
 */
class AnnualPriorityIntervention extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblannual_priority_intervention';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year', 'priority'], 'required'],
            [['year', 'priority'], 'integer'],
            [['year'], 'unique', 'targetAttribute' => 'intervention_id'],
            [['intervention_id'], 'integer'],
            [['training_type'], 'string', 'max' => 50],
            [['intervention_id', 'year'], 'unique', 'targetAttribute' => ['intervention_id', 'year']],
            [['intervention_id'], 'exist', 'skipOnError' => true, 'targetClass' => Intervention::className(), 'targetAttribute' => ['intervention_id' => 'intervention_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'intervention_id' => 'Intervention ID',
            'year' => 'Year',
            'priority' => 'Priority',
            'training_type' => 'Training Type',
        ];
    }

    /**
     * Gets query for [[Emps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['emp_id' => 'emp_id'])->viaTable('tblemp_intervention_year', ['intervention_id' => 'intervention_id', 'year' => 'year']);
    }

    /**
     * Gets query for [[Intervention]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntervention()
    {
        return $this->hasOne(Intervention::className(), ['intervention_id' => 'intervention_id']);
    }

    /**
     * Gets query for [[TblempInterventionYears]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeInterventionYears()
    {
        return $this->hasMany(EmployeeInterventionYear::className(), ['intervention_id' => 'intervention_id', 'year' => 'year']);
    }
}
