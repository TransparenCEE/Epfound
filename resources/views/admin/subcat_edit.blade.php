@extends('layouts.admin')






@section('rightBlock')

        {{--  Edit Governance Unit  --}}



<?php
$segment = Request::segment(4);
$trueID = Request::segment(6);
echo Form::open(array("url" => "admin/subcat/parent/$segment/edit/$trueID"));
?>
    <section class="adding-style">
        <ul class="add-category-ul">

            <li>
                <label>მმართველობის ერთეულის ტიპი:</label>
                <select name="category">
                    @foreach ($menu['units'] as $units)
                      <?php $selected = $units->id == $segment ? "selected" : ''; ?>
                    <option value="{{$units->id}}" {{$selected}}>{{$units->name}}</option>
                     @endforeach
                </select>
            </li>
            <li>
                <label>კატეგორიის დასახელება</label>
               {{Form::text('name', $result[0]->name, ['class' => 'name'])}}
            </li>
            <li>
                <label>დასახელება ინგლისურად</label>
               {{Form::text('name_en', $result[0]->name_en, ['class' => 'name'])}}
            </li>
        <li></li>

        </ul>
        <span style="width:800px">
        <section class="adding-style-text">
            <label>დამატებითი ინფორმაცია</label>
            {{ Form::textarea('info', $result[0]->text, ['class' => 'adding-style-textarea'])}}
        </section>
        <section class="adding-style-text">
            <label>დამატებითი ინფორმაცია</label>
            {{ Form::textarea('info_en', $result[0]->text_en, ['class' => 'adding-style-textarea'])}}
        </section>
            </span>
    </section>

    <section class="buttons">
        {{Form::submit('SAVE')}}
        <button type="reset" value="">CANCEL</button>
    </section>
        {{ Form::close() }}






@endsection