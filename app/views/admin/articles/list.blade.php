@extends('admin.layout')

@section('content')

<div class="pull-left">
	<h2>Статьи</h2>
</div>


<div class="pull-right">
	<a href="/admin/articles" class="btn btn-primary">
		<span class="glyphicon glyphicon-list"></span>
		Дерево категорий
	</a>

	<a href="/admin/articles/create/{{ $categoryId }}" class="btn btn-success">
		<span class="glyphicon glyphicon-plus"></span>
		Добавить статью
	</a>
	
</div>

<div style="clear: both;"></div><br>



<script type="text/javascript">
	//------------------------------------------------------------------------------
	// Удаление статьи
	//------------------------------------------------------------------------------
	function deleteArticle (id) {
		if(confirm('Действительно удалить?')) {
			document.location = '/admin/articles/destroy/' + id;
		}
		else return false;
	}

	//------------------------------------------------------------------------------
	// Сортировка по категории
	//------------------------------------------------------------------------------
	function changeCategory () {
		var categoryId = $('#category').val();

		document.location = '/admin/articles/index/' + categoryId;
	}

	//------------------------------------------------------------------------------
	// Сортировка по подкатегории
	//------------------------------------------------------------------------------
	function changeSubcategory () {
		var categoryId    = $('#category').val();
		var subcategoryId = $('#subcategory').val();

		document.location = '/admin/articles/index/' + categoryId + '/' + subcategoryId;
	}
</script>



@endsection