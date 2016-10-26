@extends('layouts.admin')


@section('rightBlock')


<?php
    $segment = Request::segment(3);
?>
<script>
$(document).ready(function(){

    $("#addBlog").click(function(){
        $(".editForm").show("fast");
    });
})
</script>
    <section class="sub-main">

        <section class="sub-main-header">
            <h3>ბლოგი</h3>
            <section class="municipalities-header" id="addBlog">
                <a href="#"><img src="{{URL::asset('admin/images/plus.png')}}" alt="" title=""  />დამატება</a>
            </section>
        </section>





        <? foreach ($itemsList as $value) {?>
        <ul class="municipalities-category-list">
            <li>
                <span>1</span>
                <section class="plus-edit-delete">
                    <a href="/admin/blog/<?=$value->id?>/"><img src="{{URL::asset('admin/images/pencil.png')}}" alt="" title="" /></a>
                    <a href="/admin/blog/delete/<?=$value->id?>" onclick="return confirm('Confirm delete?');"><img src="{{URL::asset('admin/images/forbidden.png')}}" alt="" title="" /></a>
                </section>
            </li>
        </ul>
        <?php
        } ?>


    </section>




@endsection

