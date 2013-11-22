<?php

class ArticlesController extends \BaseController {

    //------------------------------------------------------------------------------
    // Main page
    //
    // author - kdesyatkin
    // date - 22/11/13 17:51
    //------------------------------------------------------------------------------
	public function getIndex($categoryId = 999, $subcategoryId = 0)	{

        $categories = Categories::where('parent_id', '=', 0)->get();

		$view = View::make('admin.articles.categories')
                        ->with('categories', $categories);

		return $view;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($idCategory)
	{
		
		// Биндим переменные для редаткирования
		$article['id'] = '';
		$article['category_id'] = $idCategory;
		$article['article_name'] = '';
		$article['alias'] = '';
		$article['header'] = '';
		$article['meta_title'] = '';
		$article['meta_description'] = '';
		$article['description'] = '';
		$article['content'] = '';
		$article['preview'] = '';

		$view = View::make('admin.articles.create')
						->with('article', $article)
						->with('categoryId', $idCategory);

		return $view;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		if( !Input::has('articleName') ) die('Поле название обязательно для заполнения');

		// Загружаем изображение 
		$preview = $this->uploadImage('preview', 'userfiles/');

		//  Если редактирование, то выбираем элемент
		if(Input::has('id')) $article = Articles::find( Input::get('id') );
		else $article                   = new Articles;

		$article->category_id      = Input::get('categoryId');
		$article->article_name     = Input::get('articleName');
		$article->alias            = Input::get('alias');
		$article->header           = Input::get('header');
		$article->meta_title       = Input::get('meta_title');
		$article->meta_description = Input::get('meta_description');
		$article->description      = Input::get('description');
		$article->content          = Input::get('content');

		// Заносим в базу только если есть изображение
		if($preview) $article->preview = $preview;
		
		$article->save();

		return Redirect::to('/admin/articles/show-category/'.Input::get('categoryId'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		// Получаем статью
		$article = Articles::find($id)->toArray();

		$view = View::make('admin.articles.create')
						->with('article', $article);

		return $view;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDestroy($id)
	{
		$article = Articles::find($id)->delete();

		return Redirect::back();
	}

	//------------------------------------------------------------------------------
	// Отдает список подкатегорий
	//------------------------------------------------------------------------------
	public function postSubcategories() {
		if(!Input::has('parentId')) return false;
		$result = '';

		$subcategories = Categories::where('parent_id', '=', Input::get('parentId'))
										->get()
										->toArray();


		foreach($subcategories as $subcategory) {
			$result .= '<option value="'. $subcategory['id'] .'">'. $subcategory['category_name'] .'</option>';
		}

		return $result;
	}

	//------------------------------------------------------------------------------
	// function create family tree for categories 
	// use this plugin - http://thecodeplayer.com/walkthrough/css3-family-tree
    //
    // !!! Not used now !!!
    //
	//------------------------------------------------------------------------------
	public static function createTree($id=0) {

		$subcategories = Categories::where('parent_id', '=', $id);

		if($subcategories->exists()) {
			$subcategories = $subcategories->get();
			
			echo '<ul>';
			foreach ($subcategories as $subcategory) {

				echo '<li>
  						 	<a onclick="return false;" href="/admin/articles/show-category/'. $subcategory->id .'">'. $subcategory->category_name .'</a>';
							echo ArticlesController::createTree($subcategory->id);
				echo '</li>';
				
			}
			echo '</ul>'; 
			
		} 
		
	}


	//------------------------------------------------------------------------------
	// Show articles in category
	//------------------------------------------------------------------------------
	public function getShowCategory($id) {
		$articles = Articles::where('category_id', '=', $id)->paginate(25);

		$view = View::make('admin.articles.list')
						->with('articles', $articles)
						->with('categoryId', $id);

		return $view;
	}







}