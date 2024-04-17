<?php

/** @var array $item */

use application\common\helpers\ApiUrl\ApiUrl;

$uploadUrl = ApiUrl::to(['image-file/upload', 'slug' => $item['slug']], true);

$js = <<<JS
$(document).ready(function () {    
    $('#uploadFilesSubmit').click(function (e) {
        e.preventDefault();

        var formData = new FormData();
        var allFiles = document.getElementById('input-upload-files').files.length;
        for (var i = 0; i < allFiles; i++) {
            formData.append('images[]', document.getElementById('input-upload-files').files[i]);
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
})
JS;

$this->registerJs($js, \yii\web\View::POS_END);

?>

<section>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Наименование альбома: <?= $item['title']?></h1>
            </div>
            <div class="col-12 p-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadFilesModal">Добавить изображение</button>
            </div>
            <div class="col-12">
                <?php foreach ($item['file_storages'] as $file_storage) {?>

                    <img width="200px" src="/images/<?= $file_storage['name']?>" class="img-thumbnail" alt="...">

                <?php }?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadFilesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить изображение в фотоальбом: <?= $item['title']?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="form-upload-files">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Загрузить изображения</label>
                            <input id="input-upload-files" class="form-control" type="file" name="images[]" multiple>
                        </div>
                        <div>
                            <input type="hidden" name="slug" value="<?= $item['slug']?>"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button id="uploadFilesSubmit" type="button" class="btn btn-primary">Загрузить</button>
                </div>
            </div>
        </div>
    </div>

</section>
