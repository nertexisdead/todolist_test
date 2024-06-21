@extends('front.layouts.app')

@section('content')

<main class="pt-3 pb-5">
    <div class="container" style="min-width: 1200px;">
        <div class="px-lg-3 px-2">


        <form action="{{ ENV('APP_URL') }}/lists/save" method="post" enctype="multipart/form-data">

            @csrf

            <div class=" px-lg-2 px-1">

                <div class="card card-border-info">

                    <div class="card-header bg-info">

                        <div class="row">
                            <div class="col-12 col-lg-9">
                                <p class="h3 b-bottom">Создать ToDo</p>
                            </div>
                        </div>

                    </div>

                    <div class="card-body">

                        <div class="row my-2 my-lg-3">
                            <div class="col-12 col-lg-12">
                                <p class="h6">Наименование<span class="text-info">*</span></p>
                                <input class="form-control" type="text" name="name" placeholder="Наименование" required="" autocomplete="off">
                            </div>
                        </div>

                        <div class="row my-4 my-lg-5">
                            <div class="col-12">
                                <div class="d-lg-flex justify-content-center">
                                    <button type="submit" class="btn btn-info mr-3"><i class="mdi mdi-check pr-2"></i>Создать</button>
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


@endsection
