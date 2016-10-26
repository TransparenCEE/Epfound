@extends('layouts.admin')


@section('rightBlock')


    <?php
     // check if it's update section


    //  like municipality id
    $main_subcat = Request::segment(3);
    ?>

    {{Form::open(array("url" => "admin/subcat/$main_subcat/maincat/add", 'files' => true))}}
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
                {{Form::select('categoryType', array('1' => 'შემოსავალი', '2' => 'ხარჯი'))}}
            </li>

            <li>
                <label>კატეგორიის დასახელება</label>
                {{Form::text('name', NULL, ['class' => 'name']) }}
            </li>
            <li>
                <label>დასახელება ინგლისურად</label>
                {{Form::text('name_en', NULL, ['class' => 'name']) }}
            </li>

            <li>
                <label>კატეგორიის იკონკა:</label>
                <section>
                    <input type="text" class="filetext">
                    <label for="data-file" class="browse-data" id="vax">BROWSE</label>
                    {{Form::file('image', $attributes = array('id' => 'data-file'))}}
                </section>
            </li>


        </ul>
        <span style="width:800px;">
        <section class="adding-style-text">
            <label>დამატებით ინფორმაცია</label>
            {{ Form::textarea('info', null, ['class' => 'adding-style-textarea'])}}
        </section>
        <section class="adding-style-text">
            <label>ინფორმაცია ინგლისურად</label>
            {{ Form::textarea('info_en', null, ['class' => 'adding-style-textarea'])}}
        </section>
            </span>
    </section>

    <section class="change-buttons">
        {{Form::submit('SAVE')}}
        <button type="reset" value="">CANCEL</button>
    </section>
    {{ Form::close() }}

@endsection