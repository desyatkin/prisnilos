@extends('admin.layout')

@section('content')

{{-- Подключаем TinyMCE --}}
<script type="text/javascript" src="/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "#content",
    });
</script>

<h2>Добавить категорию</h2>
<b>Текущая категория:</b> {{ $category['category_name'] }}

<div class="row">
    <div class="col-md-8">

        @include('admin.categories.form')

        <br>

        @include('admin.categories.list')
    </div>
    <div class="col-md-4" style="backgroud-color: #808080;">

        @include('admin.categories.tree')

    </div>
</div>



@endsection