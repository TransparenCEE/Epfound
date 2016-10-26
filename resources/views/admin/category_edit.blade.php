@extends('layouts.admin')


@section('rightBlock')

        {{--  Edit Governance Unit  --}}


<?php
$segment = Request::segment(3);
$trueID = Request::segment(5);
echo Form::open(array("url" => "admin/category/$segment/update/$trueID"));
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

            <li>
                <label>საკონტაკტო ელ-ფოსტა</label>
                {{Form::text('email', $result[0]->email, ['class' => 'email']) }}
            </li>

        </ul>
        <span style="width:785px">
        <section class="adding-style-text">
            <label>დამატებით ინფორმაცია</label>
            {{ Form::textarea('info', $result[0]->text, ['class' => 'adding-style-textarea'])}}
        </section> 
        <section class="adding-style-text" style="float:left;display: inline;">
            <label>ინფორმაცია ინგლისურად</label>
            {{ Form::textarea('info_en', $result[0]->text, ['class' => 'adding-style-textarea'])}}
        </section>
</span>
    </section>

    <section class="change-buttons">
        {{Form::submit('SAVE')}}
        <button type="reset" value="">CANCEL</button>
    </section>
        {{ Form::close() }}






@endsection