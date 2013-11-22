@extends('admin.layout')

@section('content')

    <link rel="stylesheet" type="text/css" href="/css/tree.css">
    <link rel="stylesheet" href="/css/jquery.treeview.css" />
    <script src="/js/jquery.treeview.js"></script>

<script>
    $(document).ready(function(){
        $("#tree").treeview({
//            collapsed: true,
//            animated: "fast",
//            prerendered: true,
//            persist: "location"
            persist: "location",
            collapsed: true,
            unique: true
        });
    });
</script>


<ul id="tree">
    <a href="/admin/adrticles">Корневая категория</a>
        <?php ArticlesController::createTree(); ?>

</ul>

<!--    <details><summary>1. Node</summary>-->
<!--        <div style="margin-left:25px">1.1 Item</div>-->
<!--        <div style="margin-left:25px">1.2 Item</div>-->
<!--        <details style="margin-left:25px"><summary>1.3 Node</summary>-->
<!--            <div style="margin-left:25px">1.3.1 Item</div>-->
<!--            <div style="margin-left:25px">1.3.2 Item</div>-->
<!--        </details>-->
<!--    </details>-->
<!--    <details><summary>2. Node</summary>-->
<!--        <div style="margin-left:25px">2.1 Item</div>-->
<!--        <div style="margin-left:25px">2.2 Item</div>-->
<!--    </details>-->
<!--    <details><summary>3. Node</summary>-->
<!--        <div style="margin-left:25px">3.1 Item</div>-->
<!--    </details>-->

@endsection