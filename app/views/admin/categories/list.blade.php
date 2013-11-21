@foreach($subcategories as $subcategory)

	<i class='glyphicon glyphicon-pencil' onClick="showEditcategoryFrom({{ $subcategory['id'] }});"></i>
	<a href="/admin/categories/view/{{ $subcategory['id'] }}">{{ $subcategory['category_name'] }}</a> <br>

@endforeach

<!-- Modal -->
<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
	    <form class="form-horizontal" role="form" action="/admin/categories/store" method="POST" onsubmit="checkForm(); return false;">
        
	        {{-- Название категории --}}
	        <div class="form-group">
	                <label for="categoryName" class="col-lg-2 control-label">Название категории</label>
	                <div class="col-lg-10">
	                        <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Название категории" onkeyup="translitCategoryUpdate();">
	                </div>
	        </div>


	        {{-- ЧПУ --}}
	        <div class="form-group">
	                <label for="alias" class="col-lg-2 control-label">ЧПУ (алиас)</label>
	                <div class="col-lg-10">
	                        <input type="text" class="form-control" id="alias" name="alias" placeholder="ЧПУ (алиас)">
	                </div>
	        </div>


	        {{-- H1 заголовок --}}
	        <div class="form-group">
	                <label for="header" class="col-lg-2 control-label">H1 заголовок</label>
	                <div class="col-lg-10">
	                        <input type="text" class="form-control" id="header" name="header" placeholder="H1 заголовок">
	                </div>
	        </div>


	        {{-- Meta title --}}
	        <div class="form-group">
	                <label for="metaTitle" class="col-lg-2 control-label">Meta title</label>
	                <div class="col-lg-10">
	                        <input type="text" class="form-control" id="metaTitle" name="metaTitle" placeholder="Meta title">
	                </div>
	        </div>


	        {{-- Meta description --}}
	        <div class="form-group">
	                <label for="metaDescription" class="col-lg-2 control-label">Meta description</label>
	                <div class="col-lg-10">
	                        <input type="text" class="form-control" id="metaDescription" name="metaDescription" placeholder="Meta description">
	                </div>
	        </div>


	        {{-- description --}}
	        <div class="form-group">
	                <label for="description" class="col-lg-2 control-label">Описание</label>
	                <div class="col-lg-10">
	                        <input type="text" class="form-control" id="description" name="description" placeholder="Описание">
	                </div>
	        </div>

	        <input type="hidden" name="categoryId" value="" id="categoryId">
	        <input type="hidden" name="url" value="{{ $_SERVER['REQUEST_URI'] }}" id="url">


	        {{-- content --}}
	        <div class="form-group">
	                <label for="content" class="col-lg-2 control-label">Контент</label>
	                <div class="col-lg-10">
	                        <textarea class="form-control" id="content" name="content" placeholder="Контент"></textarea>
	                </div>
	        </div>

		</form>

	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" onclick="deleteCategory();">Удалить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary" onclick="updateCategory();">Сохранить</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	
//------------------------------------------------------------------------------
// Show modal window with form to edit or delete category
//------------------------------------------------------------------------------
function showEditcategoryFrom (idCategory) {

	// get category info in json format
	$.get('/admin/categories/category-json/' + idCategory, function (data) {
		
		// parse json
		category = JSON.parse(data);

		console.log(category);

		// insert data in fields
		$('#categoryName').val(category.category_name);
		$('#alias').val(category.alias);
		$('#header').val(category.header);
		$('#metaTitle').val(category.meta_title);
		$('#metaDescription').val(category.meta_description);
		$('#description').val(category.description);
		$('#categoryId').val(category.id);
		$('.modal-title').html('Редактирование категории ' +  category.category_name);
		tinymce.activeEditor.setContent(category.content);


		$('#editCategory').modal('show');

	});

}

//------------------------------------------------------------------------------
// delete category after confirm
//------------------------------------------------------------------------------
function deleteCategory () {
	var categoryId   = $('#categoryId').val();
	var categoryName = $('#categoryName').val();

	if(!confirm('Вы уверены что хотите удалить категорию ' + categoryName)) return false;

	$.post('/admin/categories/delete/' + categoryId, function (data) {
		$('#editCategory').modal('hide');
		document.location.reload(true);
		return true;
	});
}


//------------------------------------------------------------------------------
// update category
//------------------------------------------------------------------------------
function updateCategory() {
	var categoryId      = $('#categoryId').val();
	var categoryName    = $('#categoryName').val();
	var alias           = $('#alias').val();
	var header          = $('#header').val();
	var metaTitle       = $('#metaTitle').val();
	var metaDescription = $('#metaDescription').val();
	var description     = $('#description').val();
	var content         = tinymce.activeEditor.getContent();
	var url             = $('#url').val();

	$.post('/admin/categories/update', { categoryId: categoryId,  categoryName: categoryName, alias: alias, header: header, metaTitle: metaTitle, metaDescription: metaDescription, description: description, content: content }, function (data) {
		document.location.reload(true);
	});
}

	//------------------------------------------------------------------------------
    // translit category name to alias and show field to edit alias
    //------------------------------------------------------------------------------
    function translitCategoryUpdate() {
        var category = $('#categoryName').val();

        // hide if empty
        if(category == '') {
            $('#alias').hide("slow");
            return true;   
        }

        // show field with translated alias
        alias = cyr2lat(category);
        $('#alias').val(alias).show("fast");
        return true;
    }


</script>