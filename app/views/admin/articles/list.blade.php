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

	<form class="navbar-form" role="search">
	  <div class="form-group">
	    <input type="text" class="form-control" placeholder="Search">
	  </div>
	  <button type="submit" class="btn btn-default">Submit</button>
	</form>
	
</div>

<div style="clear: both;"></div><br>

<table class="table table-striped">

	{{-- Выводим список статей --}}
	@foreach ($articles as $article)

	        <tr>
	                
                {{-- Кнопка для удаления категории --}}
                <td width="10">                        
                    <span class="glyphicon glyphicon-trash" title="Удалить" onclick="deleteArticle({{ $article->id }});"></span>
                </td>

                {{-- Название статьи --}}
                <td>
                    <a href="/admin/articles/edit/{{ $article->id }}">
                        {{ $article->article_name }}
                    </a>
                </td>

                {{-- Категория --}}
                <td>
                        {{ $article->category->category_name }}
                </td>

                {{-- Подкатегория --}}
		        @if( isset($article->subcategory->category_name) )
	                <td>
	                   	{{ $article->subcategory->category_name }}
	                </td>
    		    @endif

                {{-- Дата создания --}}
                <td width="150">
                    {{ $article->created_at }}
                </td>

	        </tr>

	@endforeach
  
</table>

{{-- Пагинация --}}
<center>
        {{ $articles->links() }}
</center>


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