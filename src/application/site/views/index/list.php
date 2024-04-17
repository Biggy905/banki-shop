<?php

/** @var array $list */

use application\common\helpers\ApiUrl\ApiUrl;

$url = ApiUrl::to(['photoalbum/create'], true);

$js = <<<JS

        $(document).ready(function () {
            $('#createPhotoalbumSubmit').click(function (e){
                e.preventDefault();
                
                let body = JSON.stringify({
                    'title': $('#form-create-photoalbum input[name="title"]').val(),
                    'slug': $('#form-create-photoalbum input[name="slug"]').val()
                });
                
                var objectSend = sendForm(
                    'POST',
                    '$url',
                    'application/json; charset=utf-8',
                    'json',
                    body
                );
                
                responseForm(objectSend);
                
                return false;
            });
            
            $('#send-order').click( function (e){
                e.preventDefault();
                
                return false;
            });
        })

JS;

$jsUpdate = <<<JS
        $(document).ready(function () {
JS;

foreach ($list as $key => $item) {
    $updateUrl = ApiUrl::to(['photoalbum/update', 'slug' => $item['slug']], true);
    $deleteUrl = ApiUrl::to(['photoalbum/delete', 'slug' => $item['slug']], true);
    $uploadUrl = ApiUrl::to(['image-file/upload', 'slug' => $item['slug']], true);

    $jsUpdate .= <<<JS

    $('#uploadFilesSubmit$key').click(function (e) {
        e.preventDefault();

        var formData = new FormData();
        var allFiles = document.getElementById('input-upload-files$key').files.length;
        for (var i = 0; i < allFiles; i++) {
            formData.append('images[]', document.getElementById('input-upload-files$key').files[i]);
        }

        $.ajax({
			type: "POST",
			url: '$uploadUrl',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			dataType : 'json',
			success: function(data){
				location.href = data['data']['url'];
			}
		});
        
        return false;
    })

    $('#updatePhotoalbumSubmit$key').click(function (e){
        e.preventDefault();
        
        let body = JSON.stringify({
            'title': $('#form-update-photoalbum$key input[name="title"]').val(),
            'slug': $('#form-update-photoalbum$key input[name="slug"]').val()
        });
                
        var objectSend = sendForm(
            'PATCH',
            '$updateUrl',
            'application/json; charset=utf-8',
            'json',
            body
        );
        
        responseForm(objectSend);     
        
        return false;
    })
    

            $('#deletePhotoalbumModal$key').click(function (e){
                e.preventDefault();
                
                var body;
                
                var objectSend = sendForm(
                    'DELETE',
                    '$deleteUrl',
                    'application/json; charset=utf-8',
                    'json',
                    body
                );
                
                responseForm(objectSend);
                
                return false;
            });
            
            $('#send-order').click( function (e){
                e.preventDefault();
                
                return false;
            });


JS;

}

$jsUpdate .= <<<JS
        })
JS;


$this->registerJs($js, \yii\web\View::POS_END);
$this->registerJs($jsUpdate, \yii\web\View::POS_END);

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPhotoalbumModal">
                            Добавить фотоальбом
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-12 p-3">
                <div class="accordion" id="accordionExample">

                    <?php foreach ($list as $key => $item) {?>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key?>" aria-expanded="false" aria-controls="collapse<?= $key?>">
                                    Фотоальбом: <?= $item['title']?>
                                </button>
                            </h2>
                            <div id="collapse<?= $key?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <?php foreach ($item['file_storages'] as $file_storage) {?>

                                        <img width="200px" src="/images/<?= $file_storage['name']?>" class="img-thumbnail" alt="...">

                                    <?php }?>

                                </div>
                                <div class="accordion-body">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadFilesModal<?= $key?>">Добавить изображение</button>
                                </div>
                                <div class="accordion-body">
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updatePhotoalbumModal<?= $key?>">Обновить фотоальбом</button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#deletePhotoalbumModal<?= $key?>">Удалить фотоальбом</button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="uploadFilesModal<?= $key?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить изображение в фотоальбом: <?= $item['title']?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="form-upload-files<?= $key?>">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Загрузить изображения</label>
                                                <input id="input-upload-files<?= $key?>" class="form-control" type="file" name="images[]" multiple>
                                            </div>
                                            <div>
                                                <input type="hidden" name="slug" value="<?= $item['slug']?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                        <button id="uploadFilesSubmit<?= $key?>" type="button" class="btn btn-primary">Загрузить</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="updatePhotoalbumModal<?= $key?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Обновить фотоальбом</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="form-update-photoalbum<?= $key?>">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Название альбома</span>
                                                <input type="text" class="form-control" name="title" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1" value="<?= $item['title']?>">
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Ссылка альбома</span>
                                                <input type="text" class="form-control" name="slug" placeholder="Slug" aria-label="Slug" aria-describedby="basic-addon1" value="<?= $item['slug']?>">
                                            </div>
                                            <div>
                                                <input type="hidden" name="old_slug" value="<?= $item['slug']?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                        <button id="updatePhotoalbumSubmit<?= $key?>" type="button" class="btn btn-primary">Обновить</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="deletePhotoalbumModal<?= $key?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Удалить фотоальбом</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div id="form-delete-photoalbum<?= $key?>">
                                        <input type="hidden" name="slug" value="<?= $item['slug']?>"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                        <button id="create-photoalbum-submit" type="button" class="btn btn-danger">Удалить</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }?>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="createPhotoalbumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Создать фотоальбом</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="form-create-photoalbum">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Название альбома</span>
                        <input type="text" class="form-control" name="title" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Ссылка альбома</span>
                        <input type="text" class="form-control" name="slug" placeholder="Slug" aria-label="Slug" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button id="createPhotoalbumSubmit" type="button" class="btn btn-primary">Создать</button>
            </div>
        </div>
    </div>
</div>
