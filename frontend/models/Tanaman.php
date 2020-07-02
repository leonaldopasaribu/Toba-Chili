<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tanaman".
 *
 * @property int $idTanaman
 * @property string $labelTanaman
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 *
 * @property Kondisidaun[] $kondisidauns
 */
class Tanaman extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tanaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['labelTanaman'], 'required'],
            [['deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['labelTanaman'], 'string', 'max' => 30],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTanaman' => 'Id Tanaman',
            'labelTanaman' => 'Label Tanaman',
            'deleted' => 'Deleted',
            'deleted_at' => 'Deleted At',
            'deleted_by' => 'Deleted By',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKondisidauns()
    {
        return $this->hasMany(Kondisidaun::className(), ['idTanaman' => 'idTanaman']);
    }
}
