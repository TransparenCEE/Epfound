@extends('layouts.home')

@section('center')
 
    <main>
        <section class="questions">
            <div class="wrapper">
                <!-- !~! -->
                <br />
                <br />
                <? if(isset($insertID) && $insertID>0){ echo '<div class="succ">თქვენი სტატია წარმატებით აიტვირთა</div>'; }?>
                <br />
                <br />
                {{Form::open(array("url" => "blog/add", 'id' => 'addblog', 'files' => true)) }}
                <h6>სტატიის სათაური</h6>
                    <input type="text" name="title_ge" data-validation="length" id="blogtitle" data-validation-length="min4"  placeholder="სტატიის სათაური" />
                <h6>თქვენი სახელი ( სრულად )</h6>
                    <input type="text" name="author_ge" data-validation="length" id="yourname" data-validation-length="min4" placeholder="თქვენი სახელი" />
                <h6>ბლოგის სტატია</h6>
                    <textarea name="text_ge" data-validation="length" data-validation-length="min4" id="message" placeholder="ბლოგის სტატია"></textarea> 
                <h6>თქვენი ელ-ფოსტა</h6>
                    <input type="text" name="email" data-validation="email" placeholder="თქვენი ელ-ფოსტა" />
                    <input type="submit" name="submit" value="SUBMIT" />
                {{Form::close()}}
            </div>
        </section>
    </main>

@endsection

