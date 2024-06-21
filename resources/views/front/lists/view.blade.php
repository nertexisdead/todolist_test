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


		<input type="hidden" name="id" id="id" value="{{ $lists->id }}">

		<div class=" px-lg-2 px-1">

			<div class="card card-border-info">

				<div class="card-header bg-info">

					<div class="row">
						<div class="col-12 col-lg-9">
							<p class="h3 b-bottom">Просмотр ToDo</p>
						</div>
					</div>

				</div>

				<div class="card-body">

                        <div class="row my-2 my-lg-3">
                            <div class="col-12 col-lg-12">
                                <p class="h6">Наименование<span class="text-info">*</span></p>
                                <input class="form-control" type="text" name="name" value="{{ $lists->name }}" readonly>
                            </div>
                        </div>

                        <div class="row my-2 my-lg-3">
                            <div class="col-12 col-lg-12 d-flex form-inline">
                                <p class="h6 text-uppercase mb-0 mr-2">Задачи<span class="text-info">*</span></p>
                                <input class="form-control search-task py-0 mr-2" id="search-task-tag" value="{{ isset($_GET['tag']) ? $_GET['tag'] : '' }}" placeholder="Введите тег...">
                                <a href="{{ ENV('APP_URL') }}/lists/view/{{ $lists->id }}" class="font-weight-bold">
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
                                                <td><textarea type="text" id="task_text_{{ $task->id }}" name="task_text_{{ $task->id }}" class="form-control task_text_{{ $task->id }}" readonly>{{ $task->text }}</textarea></td>
                                                <td><textarea type="text" id="task_tags_{{ $task->id }}" name="task_tags_{{ $task->id }}" class="form-control task_tags_{{ $task->id }}" readonly>@if(isset($show_tags) && count($show_tags) > 0){{ implode(', ', $show_tags) }} @endif</textarea></td>
                                                <td id="task_image_{{ $task->id }}">
                                                        <?php if (isset($task->image)) { ?>
                                                            <div class="image" id="task_image_prev_{{ $task->id }}">
                                                                <a href="{{ ENV('APP_URL') }}/{{ $task->image }}" target="_blank">
                                                                    <img src="{{ ENV('APP_URL') }}/{{ $task->image }}" alt="" style="width: 150px; height: 150px;">
                                                                </a>
                                                            </div>
                                                        <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                                    }
                                                }
                                            } else {
                                                $tags = json_decode($task->tags);
                                                ?>
                                        <tr class="task_{{ $task->id }}">
                                            <td><textarea type="text" id="task_text_{{ $task->id }}" name="task_text_{{ $task->id }}" class="form-control task_text_{{ $task->id }}" readonly>{{ $task->text }}</textarea></td>
                                            <td><textarea type="text" id="task_tags_{{ $task->id }}" name="task_tags_{{ $task->id }}" class="form-control task_tags_{{ $task->id }}" readonly>@if(isset($tags) && count($tags) > 0){{ implode(', ', $tags) }} @endif</textarea></td>
                                            <td id="task_image_{{ $task->id }}">
                                                    <?php if (isset($task->image)) { ?>
                                                        <div class="image" id="task_image_prev_{{ $task->id }}">
                                                            <a href="{{ ENV('APP_URL') }}/{{ $task->image }}" target="_blank">
                                                                <img src="{{ ENV('APP_URL') }}/{{ $task->image }}" alt="" style="width: 150px; height: 150px;">
                                                            </a>
                                                        </div>
                                                    <?php } ?>
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
                                    <a class="btn btn-outline-secondary" href="{{ ENV('APP_URL') }}/lists">Назад к списку листов</a>
                                </div>
                            </div>
                        </div>



				</div>
			</div>

		</div>



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
    });
</script>

@endsection
