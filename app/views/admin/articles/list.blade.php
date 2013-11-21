@extends('admin.layout')

@section('content')

<link rel="stylesheet" type="text/css" href="/css/tree.css">

<div class="pull-left">
	<h2>Статьи</h2>



</div>


<div class="pull-right">
	<a href="/admin/articles/create" class="btn btn-success">
		<span class="glyphicon glyphicon-plus"></span>
		Добавить статью
	</a>
</div>

<div style="clear: both;"></div><br>

<!-- 
<div class="tree">
	<ul>
		<li>
			<a href="#">Parent</a>
			<ul>
				<li>
					<a href="#">Child</a>
					<ul>
						<li>
							<a href="#">Grand Child</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">Child</a>
					<ul>
						<li><a href="#">Grand Child</a></li>
						<li>
							<a href="#">Grand Child</a>
							<ul>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
								<li>
									<a href="#">Great Grand Child</a>
								</li>
							</ul>
						</li>
						<li><a href="#">Grand Child</a></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</div> -->

<div class="tree">
<ul>
	<li>
		<a href="">Корневая категория</a>
	

	<?php ArticlesController::createTree(); ?>
	</li>	
</ul>
</div>

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