<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "zonawaktu".
 *
 * @property int $idZonaWaktu
 * @property string $namaZonaWaktu
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
class ZonaWaktu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zonawaktu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['namaZonaWaktu'], 'required'],
            [['deleted'], 'integer'],
            [['deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['namaZonaWaktu'], 'string', 'max' => 30],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idZonaWaktu' => 'Id Zona Waktu',
            'namaZonaWaktu' => 'Nama Zona Waktu',
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
        return $this->hasMany(Kondisidaun::className(), ['idZonaWaktu' => 'idZonaWaktu']);
    }
}
