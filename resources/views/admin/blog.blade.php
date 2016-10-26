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


        <section class="editForm" <? if(!isset($segment)){ ?>style="display:none"<?}?>>  
        {{Form::open(array("url" => "admin/blog/", 'files' => true)) }}
        <input type="hidden" name="hidden" value="<?=@$items[0]->id?>"/>
            <section class="adding-style">
                <ul class="add-data-ul">

                    <li>
                        <label>სათაური:</label>
                        <input type="text" name="title_ge" class="filetext" value="<?=@$items[0]->title_ge?>" />
                    </li>
                    <li>
                        <label>ავტორი: </label>
                        <input type="text" name="author_ge" class="filetext" value="<?=@$items[0]->author_ge?>" />
                    </li>

                </ul>
                <section class="adding-style-text">
                    <label>დამატებით ინფირმაცია</label>
                    <textarea name="text_ge" class="adding-style-textarea"><?=@$items[0]->text_ge?></textarea>
                </section>
             </section>

            <section class="change-buttons">
                <button type="submit" value="">SAVE</button>
                <button type="reset" value="">CANCEL</button>
            </section>
        {{ Form::close() }}
        </section>




        <? foreach ($itemsList as $value) {?>
        <ul class="municipalities-category-list <? if($value->active==0) echo 'innactive';?>">
            <li>
                <span><?=$value->title_ge?></span>
                <section class="plus-edit-delete">
                    <? if(@$value->active==0){?><a href="/admin/blog/publish/<?=$value->id?>">Pub</a><?}?>
                    <a href="/admin/blog/<?=$value->id?>/"><img src="{{URL::asset('admin/images/pencil.png')}}" alt="" title="" /></a>
                    <a href="/admin/blog/delete/<?=$value->id?>" onclick="return confirm('Confirm delete?');"><img src="{{URL::asset('admin/images/forbidden.png')}}" alt="" title="" /></a>
                </section>
            </li>
        </ul>
        <?php
        } ?>


    </section>



@endsection

