<?php

declare(strict_types=1);

namespace application\common\forms;

use application\common\components\AbstractForm;
use application\common\entities\PhotoAlbum;

final class UpdatePhotoalbumForm extends AbstractForm
{
    public $title;

    public $slug;

    public $old_slug;

    public function rules(): array
    {
        return [
            [
                ['title', 'slug', 'old_slug'],
                'required',
            ],
            [
                'slug',
                'validateCheckSlug',
            ],
            [
                'slug',
                'unique',
                'targetClass' => PhotoAlbum::class,
                'when' => static function ($model) {
                    $result = true;
                    if ($model->slug === $model->old_slug) {
                        $result = false;
                    }

                    return $result;
                }
            ],
            [
                ['slug', 'old_slug'],
                'match',
                'pattern' => '/^[a-zA-Z]\w*$/i',
            ],
        ];
    }

    public function validateCheckSlug(): void
    {
        $photoalbum = PhotoAlbum::find()
            ->byDeletedAtNull()
            ->bySlug($this->old_slug)
            ->exists();

        if (!$photoalbum) {
            $this->addError('slug', 'Запись не найдена');
        }
    }
}
