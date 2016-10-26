@extends('layouts.admin')






@section('rightBlock')


    <?php
     // check if it's update section


    //  like municipality id
    $main_subcat = Request::segment(3);
    $subcat = Request::segment(5);
    $selector = $_GET['ctype'];
    ?>

    {{Form::open(array("url" => "admin/subcat/$main_subcat/update/$subcat/?ctype=$selector", 'files' => true))}}
    <section class="adding-style">
        <ul class="add-category-ul">

            <li>
                <label>მმართველობის ერთეულის ტიპი:</label>
                <select name="category">
                    @foreach ($menu['units'] as $units)
                        <?php $selected = $units->id == $main_subcat ? "selected" : ''; ?>
                        <option value="{{$units->id}}" {{$selected}}>{{$units->name}}</option>
                    @endforeach
                </select>
            </li>
            <li>
                <label>კატეგორიის ტიპი</label>
                <select name="categoryType">
                    <option value="1">შემოსავალი</option>
                    <option value="2" <?php if($_GET['ctype'] == 2) echo 'selected'; ?> >ხარჯი</option>
                </select>
            </li>

            <li>
                <label>კატეგორიის დასახელება</label>
                {{Form::text('name', $result[0]->name, ['class' => 'name']) }}
            </li>
            <li>
                <label>დასახელება ინგლისურად</label>
                {{Form::text('name_en', $result[0]->name_en, ['class' => 'name']) }}
            </li>

            <li>
                <label>კატეგორიის იკონკა:</label>
                <section>
                    <input type="text" value="{{$result[0]->icon}}" class="filetext">
                    <label for="data-file" class="browse-data" id="vax">BROWSE</label>
                    {{Form::file('image', $attributes = array('id' => 'data-file'))}}
                </section>
            </li>


        </ul>
        <span style="width:800px">
        <section class="adding-style-text">
            <label>დამატებითი ინფორმაცია</label>
            {{ Form::textarea('info', $result[0]->text, ['class' => 'adding-style-textarea'])}}
        </section>
        <section class="adding-style-text">
            <label>ინფორმაცია ინგლისურად</label>
            {{ Form::textarea('info_en', $result[0]->text_en, ['class' => 'adding-style-textarea'])}}
        </section>
            </span>
    </section>

    <section class="change-buttons">
        {{Form::submit('SAVE')}}
        <button type="reset" value="">CANCEL</button>
    </section>
    {{ Form::close() }}

@endsection