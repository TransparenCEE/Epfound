@extends('layouts.admin')






@section('rightBlock')

    {{--  Edit Governance Unit  --}}



    <?php
    $segment = Request::segment(3);
    $trueID = Request::segment(5);
    $typeSegment = $_GET['ctype'];
    echo Form::open(array("url" => "admin/subcat/$segment/add/$trueID"));
    ?>
    <input type="hidden" name="Type" value="<?=$typeSegment?>">
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
                {{Form::text('name', NULL, ['class' => 'name'])}}
            </li>
            <li>
                <label>დასახელება ინგლისურად</label>
                {{Form::text('name_en', NULL, ['class' => 'name'])}}
            </li>
            <li></li>


        </ul>
        <span style="width:800px;">
        <section class="adding-style-text">
            <label>დამატებითი ინფორმაცია</label>
            {{ Form::textarea('info', NULL, ['class' => 'adding-style-textarea'])}}
        </section>
        <section class="adding-style-text">
            <label>ინფორმაცია ინგლისურად</label>
            {{ Form::textarea('info_en', NULL, ['class' => 'adding-style-textarea'])}}
        </section>
            </span>
    </section>

    <section class="change-buttons">
        {{Form::submit('SAVE')}}
        <button type="reset" value="">CANCEL</button>
    </section>
    {{ Form::close() }}






@endsection