<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "kondisidaun".
 *
 * @property int $idKondisi
 * @property int $idTanaman
 * @property int $idZonaWaktu
 * @property string $tanggalPencatatan
 * @property string $kondisiDaun
 * @property string $gambar
 * @property int|null $deleted
 * @property string|null $deleted_at
 * @property string|null $deleted_by
 * @property string|null $created_at
 * @property string|null $created_by
 * @property string|null $updated_at
 * @property string|null $updated_by
 *
 * @property Datalingkungan[] $datalingkungans
 * @property Tanaman $idTanaman0
 * @property Zonawaktu $idZonaWaktu0
 */
class KondisiDaun extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kondisidaun';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTanaman', 'idZonaWaktu', 'kondisiDaun', 'deleted'], 'integer'],
            [['waktuPencatatan', 'deleted_at', 'created_at', 'updated_at'], 'safe'],
            [['gambar'], 'string', 'max' => 150],
            [['deleted_by', 'created_by', 'updated_by'], 'string', 'max' => 32],
            [['idTanaman'], 'exist', 'skipOnError' => true, 'targetClass' => Tanaman::className(), 'targetAttribute' => ['idTanaman' => 'idTanaman']],
            [['idZonaWaktu'], 'exist', 'skipOnError' => true, 'targetClass' => Zonawaktu::className(), 'targetAttribute' => ['idZonaWaktu' => 'idZonaWaktu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idKondisi' => 'Id Kondisi',
            'idTanaman' => 'Id Tanaman',
            'idZonaWaktu' => 'Id Zona Waktu',
            'waktuPencatatan' => 'Waktu Pencatatan',
            'kondisiDaun' => 'Kondisi Daun',
            'gambar' => 'Gambar',
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
    public function getDatalingkungans()
    {
        return $this->hasMany(Datalingkungan::className(), ['idKondisi' => 'idKondisi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTanaman()
    {
        return $this->hasOne(Tanaman::className(), ['idTanaman' => 'idTanaman']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZonaWaktu()
    {
        return $this->hasOne(Zonawaktu::className(), ['idZonaWaktu' => 'idZonaWaktu']);
    }
}
