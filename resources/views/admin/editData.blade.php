@extends('layouts.admin')




@section('rightBlock')
    <?php
    $entitiesID = Request::segment(4);

    ?>


    <section class="sub-main">

        <section class="sub-main-header">
            <h3>მონაცემების განახლება</h3>

            <section class="data-bar">
                <a href="#">ქვეყანა</a>
                <a href="#">მუნიციპალიტეტი</a>
                <a href="#">თვითმმართველი ქალაქი</a>
                <a href="#">ქალაქი</a>
                <a href="#">დაბა</a>
            </section>
        </section>
        <!-- ----------------------- Add Data ----------------------- -->



        {{Form::open(array("url" => "admin/editData/update/")) }}
            <section class="adding-style">
                <ul class="add-data-ul">

                    <li>
                        <label>აირჩიეთ ერთეული:</label>
                        <select name="unit">
                            @foreach ($selectUnits as $units)
                             <?php $active = $entitiesID == $units->id ? "selected" : '' ?>
                            <option value="{{$units->id}}" <?=$active?>>{{$units->name}}</option>
                                @endforeach
                        </select>
                    </li>
                    <li>
                        <label>აირჩიეთ წელიწადი: <? echo date('Y')?></label>
                        <select name="year">
                            @for($i=2010;$i<=2025;$i++)
                                <?php if(date('Y')==$i) $selected = 'selected'; else $selected = '';?>
                                <option {{$selected}}>{{$i}}</option>
                            @endfor
                        </select>
                    </li>
                    <li>
                        <label>მონაცემთა ფაილი:</label>
                        <section>
                            <input type="text" name="" value="" />
                            <label for="data-file" class="browse-data">BROWSE</label>
                            <input type="file" name="" value="" id="data-file" />
                        </section>
                    </li>

                </ul>
                <section class="adding-style-text">
                    <label>დამატებით ინფირმაცია</label>
                    <textarea class="adding-style-textarea" name="text">{{$dataSelector[0]->text}}</textarea>
                </section>
            </section>
        </form>

        <section class="expenses-revenues">
            <section class="expenses">
                <ul class="expenses-revenues-heading-ul">
                    <li><h4>ხარჯები არჩეული პერიოდისათვის და ერთეულისათვის</h4></li>
                    <li>
                        <label>სრული ხარჯი</label>
                        <input type="text" name="" value="" />
                    </li>
                </ul>

                <ul class="expenses-revenues-shablon">
                    <li><h5>ტრანსპოტი</h5></li>
                    <li><label>სრული ხარჯი</label><input type="text" name="" value="" /></li>
                    <li><label>საზოგადოებრივი ტრანსპორტი</label><input type="text" name="" value="" /></li>
                    <li><label>კერძო ტრანსპორტი</label><input type="text" name="" value="" /></li>
                    <li><label>სახალხო ტრანსპორტი</label><input type="text" name="" value="" /></li>
                </ul>
            </section>


            <section class="revenues">
                <ul class="expenses-revenues-heading-ul">
                    <li><h4>შემოსავლები არჩეული პერიოდისათვის და ერთეულისათვის</h4></li>
                    <li>
                        <label>სრული შემოსავალი</label>
                        <input type="text" name="" value="" />
                    </li>
                </ul>

                <ul class="expenses-revenues-shablon">
                    <li><h5>შიდა მოსაკრებელი</h5></li>
                    <li><label>სრული ხარჯი</label><input type="text" name="" value="" /></li>
                    <li><label>საზოგადოებრივი ტრანსპორტი</label><input type="text" name="" value="" /></li>
                    <li><label>კერძო ტრანსპორტი</label><input type="text" name="" value="" /></li>
                    <li><label>სახალხო ტრანსპორტი</label><input type="text" name="" value="" /></li>
                </ul>

                <ul class="expenses-revenues-shablon">
                    <li><h5>სახელმწიფო ტრანშები</h5></li>
                    <li><label>სრული ხარჯი</label><input type="text" name="" value="" /></li>
                    <li><label>საზოგადოებრივი ტრანსპორტი</label><input type="text" name="" value="" /></li>
                    <li><label>კერძო ტრანსპორტი</label><input type="text" name="" value="" /></li>
                    <li><label>სახალხო ტრანსპორტი</label><input type="text" name="" value="" /></li>
                </ul>
            </section>
        </section>
        <section class="population-count">
            <label>მოსახლეობის რაოდენობა</label>
            <input type="text" name="" value="" />
        </section>
        <section class="buttons">
            <button type="submit" value="">SAVE</button>
            <button type="reset" value="">CANCEL</button>
        </section>
    </section>
    {{ Form::close() }}
    <!-- ------------------ Add Data END!!! -------------------- -->
    @endsection
