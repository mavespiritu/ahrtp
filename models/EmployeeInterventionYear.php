<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblemp_intervention_year".
 *
 * @property string $intervention_id
 * @property int $year
 * @property string $emp_id
 *
 * @property Tblemployee $emp
 * @property TblannualPriorityIntervention $intervention
 */
class EmployeeInterventionYear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblemp_intervention_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['intervention_id', 'year', 'emp_id'], 'required'],
            [['year'], 'integer'],
            [['emp_id'], 'string', 'max' => 50],
            [['intervention_id'], 'integer'],
            [['intervention_id', 'year'], 'exist', 'skipOnError' => true, 'targetClass' => AnnualPriorityIntervention::className(), 'targetAttribute' => ['intervention_id' => 'intervention_id', 'year' => 'year']],
            [['emp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['emp_id' => 'emp_id']],
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
            'interventionName' => 'Intervention',
            'year' => 'Year',
            'emp_id' => 'Employee',
            'employeeName' => 'Employee',
            'competencyName' => 'Competency',
        ];
    }

    /**
     * Gets query for [[Emp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['emp_id' => 'emp_id']);
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

    public function getCompetency()
    {
        return $this->intervention->competency;
    }

    public function getCompetencyName()
    {
        return $this->competency ? $this->competency->competency : '';
    }

    public function getInterventionName()
    {
        return $this->intervention ? $this->intervention->intervention_title : '';
    }

    public function getEmployeeName()
    {
        return $this->employee ? $this->employee->fullName : '';
    }
}
