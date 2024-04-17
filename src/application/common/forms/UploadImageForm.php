<?php

declare(strict_types=1);

namespace application\common\forms;

use application\common\components\AbstractForm;
use application\common\entities\PhotoAlbum;

final class UploadImageForm extends AbstractForm
{
    public $slug;

    public $images;
    public function rules(): array
    {
        return [
            [
                ['slug', 'images'],
                'required',
            ],
            [
                'slug',
                'validatePhotoAlbum',
            ],
            [
                'images',
                'file',
                'extensions' => 'png, jpg, jpeg',
                'maxSize' => 1024*1024*32,
                'maxFiles' => 5,
            ],
        ];
    }

    public function validatePhotoAlbum(): void
    {
        $exists = PhotoAlbum::find()
            ->byDeletedAtNull()
            ->bySlug($this->slug)
            ->exists();

        if (!$exists) {
            $this->addError('photoalbum', 'Запись не найдена');
        }
    }
}
