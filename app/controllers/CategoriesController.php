<?php

Class CategoriesController extends BaseController {

	//------------------------------------------------------------------------------
	// Category main page
	//------------------------------------------------------------------------------
	public function getIndex() {

		// get subcategories
		$subcategories = Categories::where('parent_id', '=', 0)->get();

		// set name to root category
		$category['category_name'] = 'Корневая категория';

		$view = View::make('admin.categories.layout')
						->with('subcategories', $subcategories)
						->with('parentId', '0')
						->with('parents', array())
						->with('category', $category);

		return $view;

	}


	//------------------------------------------------------------------------------
	// view category
	//------------------------------------------------------------------------------
	public function getView($parentId) {

		// get subcategories 
		$subcategories = Categories::where('parent_id', '=', $parentId)->get();

		// get category info
		$category = Categories::find($parentId)->toArray();

		// get parents for build tree
		$parents = Categories::getParents($parentId);

		$view = View::make('admin.categories.layout')
						->with('subcategories', $subcategories)
						->with('parentId', $parentId)
						->with('parents', $parents)
						->with('category', $category);

		return $view;

	}


	//------------------------------------------------------------------------------
	// save category
	//------------------------------------------------------------------------------
	public function postStore() {

		// get values
		$categoryName = Input::get('category');
		$url          = Input::get('url');
		$parentId     = Input::get('parent_id');
		$alias        = Input::get('categoryAlias');

		// validation
		if(empty($categoryName) || empty($alias)) {
			die('Поля категория и алиас обязательны для заполения');
		}

		// write data
		$category                = new Categories;
		$category->parent_id     = (int)$parentId;
		$category->category_name = $categoryName;
		$category->alias         = $alias;
		$category->save();

		return Redirect::to($url);

	}


	//------------------------------------------------------------------------------
	// Get category info in json format
	//------------------------------------------------------------------------------
	public function getCategoryJson($idCategory) {
		$category = Categories::find($idCategory)->toJson();

		return $category;
	}


	//------------------------------------------------------------------------------
	// delete category
	//------------------------------------------------------------------------------
	function postDelete($idCategory) {
		$category = Categories::find($idCategory)->delete();
	}


	//------------------------------------------------------------------------------
	// update category
	//------------------------------------------------------------------------------
	function postUpdate() {

		// get values
		$url             = Input::get('url');
		$categoryId      = Input::get('categoryId');
		$categoryName    = Input::get('categoryName');
		$alias           = Input::get('alias');
		$header          = Input::get('header');
		$metaTitle       = Input::get('metaTitle');
		$metaDescription = Input::get('metaDescription');
		$description     = Input::get('description');
		$content         = Input::get('content');

		// get category instance
		$category = Categories::find($categoryId);

		// save data
		$category->category_name    = $categoryName;
		$category->alias            = $alias;
		$category->header           = $header;
		$category->meta_title       = $metaTitle;
		$category->meta_description = $metaDescription;
		$category->description      = $description;
		$category->content          = $content;
		$category->save();

	}




}