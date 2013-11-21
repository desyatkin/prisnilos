@extends('admin.layout')


@section('content')

	<link rel="stylesheet" type="text/css" href="/css/tree.css">

	<h2>Статьи</h2>

	{{-- выводим дерево категорий --}}
	<div class="tree">
	<ul>
		<li>
			<a href="">Корневая категория</a>
			<?php ArticlesController::createTree(); ?>
		</li>	
	</ul>
	</div>

@endsection