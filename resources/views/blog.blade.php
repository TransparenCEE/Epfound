@extends('layouts.home')

@section('center')
    <main>
        <section class="questions">
            <div class="wrapper">
                <h2 class="topic">ბლოგი</h2>
                <ul class="qa">
                    <? foreach ($items as $key => $myvalue) {
                        ?>

                    <li>
                        <h3>
                            <a href="/blog/<?=$myvalue->id;?>/"><?=$myvalue->title_ge;?></a>
                        </h3>
                        <span class="answ">ავტორი</span> <a href="#"><?=$myvalue->author_ge;?></a>, <span class="date"><?=date("d",strtotime($myvalue->dateTime));?> <?=date("m",strtotime($myvalue->dateTime));?>, <?=date("Y",strtotime($myvalue->dateTime));?></span>
                        <p><?=mb_substr(strip_tags($myvalue->text_ge),0,200,"UTF-8")?></p>
                    </li>
                        <?
                    }?>
                </ul>
                {{$items->links()}}
            </div>
        </section>
    </main>

@endsection

