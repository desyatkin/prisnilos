<?php 

Class Categories extends Eloquent {

    protected $table = 'categories';

   	//------------------------------------------------------------------------------
    // Рекурсивное получение родительских категорий
    //------------------------------------------------------------------------------
    public static function getParents($parentId, $parents = array()) {

    	$parent = Categories::find($parentId);

    	if(!$parent) { 
    		return $parents;
    	}
    	else {
    		$parent_array = array(
				'id'            => $parent->id,
				'parent_id'     => $parent->parent_id,
				'category_name' => $parent->category_name, 
				'alias'         => $parent->alias );

    		array_push($parents, $parent_array);

    		return Categories::getParents($parent->parent_id, $parents);
    	}

    }

}