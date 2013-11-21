<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Дерево категорий</h3>
  </div>
  <div class="panel-body">

  <style type="text/css">
  	.tree {
  		margin: 0;
  		padding: 0;

  		margin-left: 5px;
  	}

  </style>

  <?php
  	echo buildTree($parents, 0);

	function   buildTree($tree, $parentId) {
	    $html = '';
	    foreach ($tree as $row) {
	        if ($row['parent_id'] == $parentId) {
	            $html .= '<li class="tree">';
	            
	            $html .= '<a href="/admin/categories/view/'. $row['id'] .'">'.$row['category_name'].'</a>';
	            $html .= buildTree($tree, $row['id']);
	            $html .= '</li>';
	        }
	    }

	    return $html ? '<ul class="tree">' . $html . '</ul>' . "\n" : '';
	}
  ?>
    
  </div>
</div>