@extends('front.layouts.app')

@section('content')
<style>
	.table thead.sticky-top th {
		border-bottom: 0px solid #9ecfff !important;
	}
	.table thead th {
		text-transform: uppercase;
		font-weight: 650;
		font-size: 12px;
	}
	.table td, .table th {
		padding: 0.45rem;
		font-size: 11px;
	}
	.table th {
		border-top: 0px solid #dee2e6 !important;
	}
	.b-bottom-grey {
		/* -webkit-box-shadow: -1px 23px 21px -22px rgba(0, 0, 0, 0.53); */
		-moz-box-shadow: -1px 23px 21px -22px rgba(0, 0, 0, 0.53);
		box-shadow: -1px 23px 21px -22px rgba(0, 0, 0, 0.53);
	}
	.form-control {
		border: 1px solid #b3b6b9 !important;
		border-radius: 0 !important;
		font-size: 1.1rem !important;
		color: #1b1d1e !important;
	}
	.card {
		/* box-shadow: 0px 5px 10px 2px rgba(34, 60, 80, 0.2); */
		border-radius: 0 !important;
		border: unset !important;
	}
	.form-control::placeholder {
		color: #8e8e8e;
	}
	.form-control:focus {
		border-color: #accef3!important;
		box-shadow: unset!important;
	}
</style>

<main class="pt-3 pb-5">
    <div class="container" style="min-width: 1200px;">
    <div class="px-lg-3 px-2">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-12 d-flex form-inline" style="gap: 20px;">
                        <p class="h4 text-uppercase mr-3 mb-0 ml-3">ToDo lists</p>
                        <?php if (isset($user)) { ?>
                        <a href="{{ ENV('APP_URL') }}/lists/new" class="btn btn-link">
                            <i class="mdi mdi-plus-circle-outline pr-2"></i>Новый
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover" id="client-list--table">
                        <thead class="sticky-top top-menu bg-white b-bottom-grey">
                            <tr class="thead-name">
                                <th>№</th>
                                <th>Наименование</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody style="border-top: none">
							<?php
                            if (isset($lists)) {
                            foreach ($lists as $list) {
                                if (isset($user) && ($list->user_id == $user->id || (isset($list->users_for_edit) && in_array($user->id, json_decode($list->users_for_edit))) || (isset($list->users_for_view) && in_array($user->id, json_decode($list->users_for_view))))) {
                                ?>
                            <tr>
                                <td style="width:70px;">{{ $list->id }}</td>
                                <td>{{ $list->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <? if (isset($list->users_for_view) && in_array($user->id, json_decode($list->users_for_view))) { ?>
                                        <a class="btn btn-outline-primary mr-3 py-0" href="{{ ENV('APP_URL') }}/lists/view/{{ $list->id }}" title="Просмотр ">
											<i class="mdi mdi-eye"></i>
										</a>
                                        <?php }
                                        if ($list->user_id == $user->id || (isset($list->users_for_edit) && in_array($user->id, json_decode($list->users_for_edit)))) { ?>
                                        <a class="btn btn-outline-primary mr-3 py-0" href="{{ ENV('APP_URL') }}/lists/edit/{{ $list->id }}" title="Редактирование ">
											<i class="mdi mdi-settings"></i>
										</a>
										<a class="btn btn-outline-danger mr-3 py-0" href="#" onclick="confirmDelete({{ $list->id }})" title="Удалить">
											<i class="mdi mdi-delete"></i>
										</a>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
							<?php
                                    }
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>


<script>
    function confirmDelete(listId) {
        if (confirm('Вы уверены, что хотите удалить этот ToDO?')) {
            window.location.href = "{{ ENV('APP_URL') }}/lists/remove/" + listId;
        }
    }

</script>

@endsection
