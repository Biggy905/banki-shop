<?php

declare(strict_types=1);

namespace application\common\forms;

use application\common\components\AbstractForm;
use application\common\entities\PhotoAlbum;

final class SlugPhotoAlbumForm extends AbstractForm
{
    public $slug;

    public function rules(): array
    {
        return [
            [
                'slug',
                'required',
            ],
            [
                'slug',
                'string',
            ],
            [
                'slug',
                'trim',
            ],
            [
                'slug',
                'validatePhotoAlbum',
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
            $this->addError('slug', 'Запись не найдена');
        }
    }
}
