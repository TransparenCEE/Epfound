@extends('layouts.home')
@section('center')
    <main>
        <section class="questions">
            <div class="wrapper">
                <h2 class="topic"><?=$kitxva?></h2>
                <?php 
                $token = Request::segment(2);
                foreach ($item as $_item) {

                    if($_item->type==0) $divClass = 'question'; else $divClass = 'answer';
                    ?>
                        <section class="<?=$divClass?>">
                            <h3><?=$_item->name?></h3>
                            <span class="date"><?=$_item->dateTime?></span>
                            <p><?=$_item->text?></p>
                        </section>
                    <?
                }
                ?>
                <?php  if(!isset($topID)){?>

                <? if($userID==0 || $userID==1){ ?>
                <section class="answthequestion <? if($userID==0) echo 'user'; else echo 'entitle'; ?>">
                    <h3>პასუხის გაცემა </h3>
                        {{Form::open(array("url" => "viewquestion/$token/", 'files' => true))}}
                        <input type="hidden" name="token" value="<?=$token?>" >
                        <input type="hidden" name="id" value="<?=$item[0]->id?>" >
                        <input type="hidden" name="entitiesID" value="<?=$item[0]->entitiesID?>" >
                        <input type="hidden" name="type" value="<?=$userID?>" >
                        {{ Form::textarea('text', null, ['class' => 'adding-style-textarea'])}}
                        <? if($userID==1){?><input type="file" name="file" /><? } ?>
                        {{Form::submit('SAVE')}}
                        {{ Form::close() }}
                </section>
                <? } ?>

                <?php } ?>
            </div>
        </section>
    </main>





@endsection
