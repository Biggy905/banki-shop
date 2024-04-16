<?php

declare(strict_types=1);

namespace application\common\forms;

use application\common\components\AbstractForm;
use application\common\entities\PhotoAlbum;

final class CreatePhotoalbumForm extends AbstractForm
{
    public $title;
    public $slug;

    public function rules(): array
    {
        return [
            [
                ['title', 'slug'],
                'required',
            ],
            [
                'slug',
                'unique',
                'targetClass' => PhotoAlbum::class,
            ],
            [
                'slug',
                'match',
                'pattern' => '/^[a-zA-Z]\w*$/i',
            ],
        ];
    }
}
