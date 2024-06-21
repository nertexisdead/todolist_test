@extends('front.layouts.app')

@section('content')

<style>
    .image {
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .selection {
        width: 100%;
    }
</style>

<main class="pt-3 pb-5">
    <div class="container" style="min-width: 1200px;">
    <div class="px-lg-3 px-2">


	<form action="{{ ENV('APP_URL') }}/lists/update" method="post">
		<input type="hidden" name="id" id="id" value="{{ $lists->id }}">
		@csrf

		<div class=" px-lg-2 px-1">

			<div class="card card-border-info">

				<div class="card-header bg-info">

					<div class="row">
						<div class="col-12 col-lg-9">
							<p class="h3 b-bottom">Редактировать ToDo</p>
						</div>
					</div>

				</div>

				<div class="card-body">

                        <div class="row my-2 my-lg-3">
                            <div class="col-12 col-lg-12">
                                <p class="h6">Наименование<span class="text-info">*</span></p>
                                <input class="form-control" type="text" name="name" placeholder="Наименование" value="{{ $lists->name }}" required="" autocomplete="off">
                            </div>
                        </div>

                        <? if ($lists->user_id == $user->id) { ?>
                        <div class="row my-2 my-lg-3">
                            <div class="col-12 col-lg-12">
                                <p class="h6">Кто получает доступ<span class="text-info">*</span></p>
                                <select name="users_for_edit[]" id="users_for_edit" class="form-control" multiple>
                                    <?php
                                        $users_for_edit = json_decode($lists->users_for_edit);
                                        foreach ($users as $user) { ?>
                                        <option value="{{ $user->id }}" <?php if (isset($users_for_edit) && in_array($user->id, $users_for_edit)) { echo 'selected'; } ?>>{{ $user->name }}</option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row my-2 my-lg-3">
                            <div class="col-12 col-lg-12">
                                <p class="h6">Кто может смотреть<span class="text-info">*</span></p>
                                <select name="users_for_view[]" id="users_for_view" class="form-control" multiple>
                                    <?php
                                        $users_for_view = json_decode($lists->users_for_view);
                                        foreach ($users as $user) { ?>
                                        <option value="{{ $user->id }}" <?php if (isset($users_for_view) && in_array($user->id, $users_for_view)) { echo 'selected'; } ?>>{{ $user->name }}</option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="row my-2 my-lg-3">
                            <div class="col-12 col-lg-12 d-flex form-inline">
                                <p class="h6 text-uppercase mb-0">Задачи<span class="text-info">*</span></p>
                                <a href="#!" class="btn btn-link" id="add_task">
                                    <i class="mdi mdi-plus-circle-outline pr-2"></i>
                                </a>
                                <input class="form-control search-task py-0 mr-2" id="search-task-tag" value="{{ isset($_GET['tag']) ? $_GET['tag'] : '' }}" placeholder="Введите тег...">
                                <a href="{{ ENV('APP_URL') }}/lists/edit/{{ $lists->id }}" class="font-weight-bold">
                                    <i class="mdi mdi-close"></i> Сброс
                                </a>
                            </div>
                        </div>

                        <div class="row my-2 my-lg-3">
                            <div class="col-12 col-lg-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 400px;">Текст</th>
                                            <th style="width: 400px;">Теги</th>
                                            <th>Картинка</th>
                                        </tr>
                                    </thead>
                                    <tbody id="task_list">
                                        <?php foreach ($tasks as $task) {
                                            if (isset($_GET['tag'])) {
                                                $tags_array = json_decode($task->tags, true);

                                            // Проверка успешности декодирования JSON и что $tags_array является массивом
                                            if (is_array($tags_array)) {
                                                // Проверка наличия подстроки в каждом теге массива
                                                $tag_found = false;
                                                foreach ($tags_array as $tag) {
                                                    if (strpos($tag, $_GET['tag']) !== false) {
                                                        $tag_found = true;
                                                        break;
                                                    }
                                                }

                                                // Если тег найден, выводим строку задачи
                                                if ($tag_found) {
                                                    $show_tags = $tags_array;
                                            ?>
                                            <tr class="task_{{ $task->id }}">
                                                <td><textarea type="text" id="task_text_{{ $task->id }}" name="task_text_{{ $task->id }}" class="form-control task_text_{{ $task->id }}">{{ $task->text }}</textarea></td>
                                                <td><textarea type="text" id="task_tags_{{ $task->id }}" name="task_tags_{{ $task->id }}" class="form-control task_tags_{{ $task->id }}">@if(isset($show_tags) && count($show_tags) > 0){{ implode(', ', $show_tags) }} @endif</textarea>
                                                    <small class="form-text text-muted">Введите теги через запятую</small>
                                                </td>
                                                <td id="task_image_{{ $task->id }}">
                                                        <?php if (isset($task->image)) { ?>
                                                            <div class="image" id="task_image_prev_{{ $task->id }}">
                                                                <a href="{{ ENV('APP_URL') }}/{{ $task->image }}" target="_blank">
                                                                    <img src="{{ ENV('APP_URL') }}/{{ $task->image }}" alt="" style="width: 150px; height: 150px;">
                                                                </a>
                                                                <a href="#" class="delete-image" data-id="{{ $task->id }}"><i class="mdi mdi-delete"></i></a>
                                                            </div>
                                                        <?php } ?>
                                                    <input type="file" id="task_picture_{{ $task->id }}" name="task_picture_{{ $task->id }}" class="form-control task_picture_{{ $task->id }}">
                                                </td>
                                            </tr>
                                            <?php
                                                    }
                                                }
                                            } else {
                                                $tags = json_decode($task->tags);
                                                ?>
                                        <tr class="task_{{ $task->id }}">
                                            <td><textarea type="text" id="task_text_{{ $task->id }}" name="task_text_{{ $task->id }}" class="form-control task_text_{{ $task->id }}">{{ $task->text }}</textarea></td>
                                            <td><textarea type="text" id="task_tags_{{ $task->id }}" name="task_tags_{{ $task->id }}" class="form-control task_tags_{{ $task->id }}">@if(isset($tags) && count($tags) > 0){{ implode(', ', $tags) }} @endif</textarea>
                                                <small class="form-text text-muted">Введите теги через запятую</small>
                                            </td>
                                            <td id="task_image_{{ $task->id }}">
                                                    <?php if (isset($task->image)) { ?>
                                                        <div class="image" id="task_image_prev_{{ $task->id }}">
                                                            <a href="{{ ENV('APP_URL') }}/{{ $task->image }}" target="_blank">
                                                                <img src="{{ ENV('APP_URL') }}/{{ $task->image }}" alt="" style="width: 150px; height: 150px;">
                                                            </a>
                                                            <a href="#" class="delete-image" data-id="{{ $task->id }}"><i class="mdi mdi-delete"></i></a>
                                                        </div>
                                                    <?php } ?>
                                                <input type="file" id="task_picture_{{ $task->id }}" name="task_picture_{{ $task->id }}" class="form-control task_picture_{{ $task->id }}">
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


					<div class="row my-4 my-lg-5">
						<div class="col-12">
							<div class="d-lg-flex justify-content-center">
								<button type="submit" class="btn btn-info mr-3"><i class="mdi mdi-check pr-2"></i>Сохранить</button>
								<a class="btn btn-outline-secondary" href="{{ ENV('APP_URL') }}/lists">Отмена</a>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>

	</form>


    </div>
    </div>

</main>



<script>
    $(document).ready(function(){
        $(document).on('change', '.search-task', function () {
            search_task();

        });


        function search_task() {
            var full_url = '';
            var str = '';

            data = {};
            data['tag'] = $('#search-task-tag').val();
            for (var key in data) {
                value = data[key];

                if (value != '') {
                    if (str != '') {
                        str += '&';
                    } else {
                        str += '?';
                    }
                    str += key + '=';
                    str += value;
                }
            }


            var full_url = $('#current_url').val() + '/' + str;
            window.location.href = full_url;
        }

        $('#users_for_edit').select2();
        $('#users_for_view').select2();


        $('#add_task').on('click', function(e){
            e.preventDefault();
            var list = $('#id').val();

            $.ajax({
                url: '{{ route('add_task') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    list: list
                },
                success: function(response){
                    // console.log(response);
                    if(response.success) {
                        var newRow = `
                                <tr>
                                    <td><textarea type="text" id="task_text_${response.task}" name="task_text_${response.task}" class="form-control task_text_${response.task}"></textarea></td>
                                    <td><textarea type="text" id="task_tags_${response.task}" name="task_tags_${response.task}" class="form-control task_tags_${response.task}"></textarea>
                                    <small class="form-text text-muted">Введите теги через запятую</small></td>
                                    <td id="task_image_${response.task}"><input type="file" id="task_picture_${response.task}" name="task_picture_${response.task}" class="form-control task_picture_${response.task}"></td>
                                </tr>`;
                        $('#task_list').append(newRow);
                    }
                },
                error: function(xhr){
                    console.log(xhr.responseText);
                }
            });
        });

        $('#task_list').on('change', 'textarea[name^="task_text_"]', function() {
            var id = $(this).attr('id').split('_')[2];
            var text = $(this).val();

            $.ajax({
                url: '{{ route('add_task_text') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    text: text
                },
                success: function(response){
                    if(response.success) {
                        console.log('Task updated successfully');
                    }
                },
                error: function(xhr){
                    console.log(xhr.responseText);
                }
            });
        });

        $('#task_list').on('change', 'textarea[name^="task_tags_"]', function() {
            var id = $(this).attr('id').split('_')[2];
            var tags = $(this).val().split(',').map(tag => tag.trim());


            $.ajax({
                url: '{{ route('add_task_tags') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    tags: tags
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Теги задачи успешно обновлены');
                    }
                },
                error: function(xhr) {
                    console.log('Ошибка AJAX-запроса: ' + xhr.responseText);
                }
            });
        });

        $('#task_list').on('change', 'input[name^="task_picture_"]', function() {
            var id = $(this).attr('id').split('_')[2];
            var image = $(this)[0].files[0];
            var formData = new FormData();
            formData.append('id', id);
            formData.append('image', image);

            $.ajax({
                url: '{{ route('add_task_image') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Изображение задачи успешно загружено');
                        var imageUrl = '{{ ENV('APP_URL') }}/' + response.url_img;
                        var imgElement = '<div class="image">' +
                            '<a href="' + imageUrl + '" target="_blank">' +
                                '<img src="' + imageUrl + '" alt="" style="width: 150px; height: 150px;">' +
                            '</a>' +
                            '<a href="#" class="delete-image" data-id="' + id + '"><i class="mdi mdi-delete"></i></a>' +
                        '</div>';

                        $('#task_image_' + id).empty();
                        $('#task_image_' + id).prepend(imgElement);

                        var inputFileElement = '<input type="file" id="task_picture_' + id + '" name="task_picture_' + id + '" class="form-control task_picture_' + id + '">';
                        $('#task_image_' + id).append(inputFileElement);
                    } else {
                        console.log('Ошибка загрузки изображения: ' + response.error);
                    }
                },
                error: function(xhr) {
                    console.log('Ошибка AJAX-запроса: ' + xhr.responseText);
                }
            });
        });

        $('#task_list').on('click', '.delete-image', function(e) {
            e.preventDefault();

            var taskId = $(this).data('id');
            var imageContainer = $(this).closest('.image');

            $.ajax({
                url: '{{ route('del_task_image') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: taskId
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Изображение задачи успешно удалено');
                        imageContainer.remove();
                    } else {
                        console.log('Ошибка удаления изображения: ' + response.error);
                    }
                },
                error: function(xhr) {
                    console.log('Ошибка AJAX-запроса: ' + xhr.responseText);
                }
            });
        });
    });
</script>


@endsection
