<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "datalingkungan".
 *
 * @property int $idDataLingkungan
 * @property int $idKondisi
 * @property string $waktuPencatatan
 * @property float $pH
 * @property float $kelembabanTanah
 * @property float $kelembabanUdara
 * @property float $suhu
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 *
 * @property Kondisidaun $idKondisi0
 */
class DataLingkungan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'datalingkungan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idKondisi'], 'required'],
            [['idKondisi', 'deleted'], 'integer'],
            [['waktuPencatatan', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['pH', 'kelembabanTanah', 'kelembabanUdara', 'suhu'], 'number'],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['idKondisi'], 'exist', 'skipOnError' => true, 'targetClass' => Kondisidaun::className(), 'targetAttribute' => ['idKondisi' => 'idKondisi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idDataLingkungan' => 'Id Data Lingkungan',
            'idKondisi' => 'Id Kondisi',
            'waktuPencatatan' => 'Waktu Pencatatan',
            'pH' => 'P H',
            'kelembabanTanah' => 'Kelembaban Tanah (%)',
            'kelembabanUdara' => 'Kelembaban Udara (%)',
            'suhu' => 'Suhu (C)',
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
    public function getKondisiDaun()
    {
        return $this->hasOne(Kondisidaun::className(), ['idKondisi' => 'idKondisi']);
    }
}
