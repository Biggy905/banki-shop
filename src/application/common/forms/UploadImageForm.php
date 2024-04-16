<?php

declare(strict_types=1);

namespace application\common\forms;

use application\common\components\AbstractForm;

final class UploadImageForm extends AbstractForm
{
    public $id_photoalbum;

    public $images;
    public function rules(): array
    {
        return [
            [
                ['id_photoalbum', 'images'],
                'required',
            ],
            [
                'id_photoalbum',
                'validatePhotoAlbum',
            ],
            [
                'images',
                'file',
                'extensions' => 'png, jpg, jpeg',
                'maxSize' => 1024*32,
                'maxFiles' => 5,
            ],
        ];
    }
}
