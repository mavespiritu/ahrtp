<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblemployee".
 *
 * @property string $emp_id
 * @property string|null $fname
 * @property string|null $lname
 * @property string|null $mname
 *
 * @property TblannualPriorityIntervention[] $interventions
 * @property TblempInterventionYear[] $tblempInterventionYears
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblemployee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_id', 'fname', 'lname'], 'required'],
            [['emp_id', 'fname', 'lname', 'mname'], 'string', 'max' => 50],
            [['emp_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Emp ID',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'mname' => 'Middle Name',
        ];
    }

    /**
     * Gets query for [[Interventions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInterventions()
    {
        return $this->hasMany(AnnualPriorityIntervention::className(), ['intervention_id' => 'intervention_id', 'year' => 'year'])->viaTable('tblemp_intervention_year', ['emp_id' => 'emp_id']);
    }

    /**
     * Gets query for [[TblempInterventionYears]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeInterventionYears()
    {
        return $this->hasMany(EmployeeInterventionYear::className(), ['emp_id' => 'emp_id']);
    }

    public function getFullName()
    {
        return $this->fname.' '.$this->lname;
    }
}
