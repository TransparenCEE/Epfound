@extends('layouts.admin')






@section('rightBlock')




        {{--  Add Governance Unit  --}}



<?php
$segment = Request::segment(3);
echo Form::open(array("url" => "admin/category/$segment/add"));
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
               {{Form::text('name', null, ['class' => 'name'])}}
            </li>
            <li>
                <label>დასახელება ინგლისურად</label>
               {{Form::text('name_en', null, ['class' => 'name'])}}
            </li>

            <li>
                <label>საკონტაკტო ელ-ფოსტა</label>
                {{Form::text('email', null, ['class' => 'email']) }}
            </li>

        </ul>
        <div>
        <section class="adding-style-text" style="float:left;">
            <label>დამატებით ინფორმაცია</label>
            {{ Form::textarea('info', null, ['class' => 'adding-style-textarea'])}}
        </section>

        <section class="adding-style-text" style="float: left;display: inline;">
            <label>ინფორმაცია ინგლისურად</label>
            {{ Form::textarea('info_en', null, ['class' => 'adding-style-textarea'])}}
        </section>
        </div>
    </section>

    <section class="change-buttons">
        {{Form::submit('SAVE')}}
        <button type="reset" value="">CANCEL</button>
    </section>
        {{ Form::close() }}






@endsection