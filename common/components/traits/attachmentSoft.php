<?php

namespace common\components\traits;

use common\components\upload\uploader;
use yii\db\ActiveRecord;

/**
 * Class attachment
 * @package common\components\traits
 */
trait attachmentSoft
{
    /**
     * @param string $type
     * @return ActiveRecord|null
     */
    public function getAttachment($type = uploader::TYPE_IMAGE)
    {
        return self::find()->where(['obj_type' => $this::lastNameClass(), 'obj_id' => $this->id, 'type' => $type])->one();
    }

    /**
     * @param null $const
     * @return mixed
     */
    public function getAttachments($const = null)
    {
        return self::findAll([
            'obj_type' => $this::lastNameClass(),
            'obj_id' => $this->id,
            'type' => $const ?: array_keys(uploader::ALL_TYPES)
        ]);
    }

    /**
     * @param string $type
     * @return mixed
     */
    public function miniatureAttachment($type = uploader::TYPE_IMAGE)
    {
        $model = self::findOne(['obj_type' => $this::lastNameClass(), 'obj_id' => $this->id, 'type' => $type]);
        return isset($model, $model->url) ? $model->url : self::getDefaultIconUrl($this::lastNameClass(), $type);
    }
}