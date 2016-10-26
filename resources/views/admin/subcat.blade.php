@extends('layouts.admin')



@section('rightBlock')

<?php
        // determines which type is selected
        $selector = $_GET['ctype'] == 1 ? 1 : 2;
       if (!isset($_GET['ctype']) ||  isset($_GET['ctype']) && $_GET['ctype'] == 1) { $activator = 'municipalities-header-a-active'; } else { $activator = '';}
       if (isset($_GET['ctype']) && $_GET['ctype'] == 2) { $activator2 = 'municipalities-header-a-active'; } else { $activator2 = '';}

        ?>
    <section class="sub-main">

        <section class="sub-main-header">
            <h3>{{$headers[0]->name}}</h3>
            <section class="municipalities-header">
                    <a href="<?=Request::fullUrlWithQuery(['ctype' => '1',])?>" target="_parent" class="small {{$activator}}">შემოსავლები</a>
                    <a href="<?=Request::fullUrlWithQuery(['ctype' => '2',])?>" class="small {{$activator2}}">ხარჯები</a>
                <a href="{{Request::url().'/maincat/add/?ctype='.$selector }}"><img src="{{URL::asset('admin/images/plus.png')}}" alt="" title="" />კატეგორიის დამატება</a>
            </section>
        </section>



         {{------------------------- Municipalities Category --------------------------}}
        <?php if(!isset($_GET['ctype'])) $_GET['ctype']=1; $querySubcat = DB::select("SELECT * FROM `subcat` WHERE catId != 0 AND categoryType = '".$_GET['ctype']."' ORDER BY catId ASC");  ?>


        @foreach ($subCat as $subCats)
        <ul class="municipalities-category-list">
            <li>
                <span>{{$subCats->name}}</span>
                <section class="plus-edit-delete">
                    <a href="{{Request::url().'/add/'.$subCats->id .'?ctype='.$selector }}"><img src="{{URL::asset('admin/images/forbidden.png')}}" alt="" title="" /></a>
                    <a href="{{Request::url().'/update/'.$subCats->id.'?ctype='.$selector}}"><img src="{{URL::asset('admin/images/pencil.png')}}" alt="" title="" /></a>
                    <a href="delete/{{$subCats->id}}" onclick="return confirm('Confirm delete?');"><img src="{{URL::asset('admin/images/forbidden.png')}}" alt="" title="" /></a>
                </section>
            </li>

            @foreach ($querySubcat as $subitems)
                @if ($subitems->catId == $subCats->id)
           <li>
                <span>{{$subitems->name}}</span>
                <section class="plus-edit-delete">
                    <a href="parent/{{$subCats->id}}/edit/{{$subitems->id}}"><img src="{{URL::asset('admin/images/pencil.png')}}" alt="" title="" /></a>
                    <a href="delete/{{$subitems->id}}" onclick="return confirm('Confirm delete?');"><img src="{{URL::asset('admin/images/forbidden.png')}}" alt="" title="" /></a>
                </section>
            </li>
                @endif
            @endforeach
        </ul>
        @endforeach


    </section>
      {{------------------ Municipalities END!!! ---------------------}}


@endsection