@extends('layouts.home')

@section('center')


    <main>
        <section class="questions">
            <div class="wrapper">
                <? if(isset($topID)){ ?>
<h2 class="topic">თქვენი მოთხოვნა გაგზავნილია, გთხოვთ დაელოდოთ პასუხს 10 დღის განმავლობაში ელ-ფოსტის მეშვეობით. აგრეთვე თქვენი შეკითხვა გამოქვეყნდა ჩვენს <a href="/answers/faqs/">ვებ გვერდზე</a></h2>       
                <?}else { ?>
            <h2 class="topic">საჯარო ინფორმაციის გამოთხოვნა </h2>
            <p class="pp">თქვენს მიერ განცხადებაში მითითებული ინფორმაცია (მოთხოვნა) ხელმისაწვდომი იქნება ვებ-გვერდის მომხმარებლებისთვის. შესაბამისად, გთხოვთ, არ მიუთითოთ პირადი მონაცემები განცხადების ტექსტში. წინააღმდეგ შემთხვევაში, ევროპის ფონდი არ აგებს პასუხს თქვენს მიერ გამჟღავნებული მონაცემების კონფიდენციალურობაზე!</p>
            
    {{Form::open(array("url" => "ask-question/send/", 'class' => 'askq', 'id' => 'askquestion', 'files' => true,))}}
                <table>
                    <tr> 
                        <td>
                            <label for="sector">აირჩიეთ თქვენი სექტორი:</label>
                            <select name="sector" id="sector">
                                 <option>საჯარო</option>
                                 <option>არასამთავრობო</option>
                                 <option>მედია</option>
                                 <option>ბიზნესი</option>
                                 <option>მოქალაქე </option>
                            </select>
                        </td>
                        <td>
                            <label for="munic">აირჩიეთ მუნიციპალიტეტი:</label>
                            <select name="entitleMail" id="munic">
                            @foreach ($entitleList as $value)
                                 <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="title">სათაური:</label>
                            {{Form::text('subject', NULL, ['class' => 'name', 'data-validation' => 'length', 'data-validation-length' => 'min4', 'id' => 'title']) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="msg">შეტყობინება:</label>
                            {{ Form::textarea('text', null, ['class' => 'adding-style-textarea', 'data-validation' => 'length', 'data-validation-length' => 'min4', 'id' => 'msg'])}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="fullname">თქვენი სახელი:</label>
                            {{Form::text('name', NULL, ['class' => 'name', 'data-validation' => 'length', 'data-validation-length' => 'min4', 'id' => 'fullname']) }}
                        </td>
                        <td>
                            <label for="email">თქვენი ელ-ფოსტა:</label>
                            {{Form::email('email', NULL, ['class' => 'name', 'data-validation' => 'email', 'id' => 'email']) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="phone">ტელეფონი:</label>
                            {{Form::text('phone', NULL, ['class' => 'name', 'data-validation' => 'number', 'id' => 'phone']) }}
                        </td>
                        <td>
                            <label for="adress">მისაამრთი:</label>
                            {{Form::text('adress', NULL, ['class' => 'name', 'data-validation' => 'length', 'data-validation-length' => 'min4', 'id' => 'adress']) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="gender">სქესი:</label>
                            <select name="gender" id="gender">
                                 <option>მამრობითი</option>
                                 <option>მდედრობითი</option>
                            </select>
                        </td>
                        <td>
                            <label for="age">ასაკი:</label>
                            <select name="age" id="age">
                                 <option>18-30</option>
                                 <option>30-45</option>
                                 <option>45-60</option>
                                 <option>60+</option>
                            </select>
                        </td>
                    </tr>
                </table><!-- 
                <div class="notrobot">
                    <span>
                        <input type="checkbox" id="notrobot" name="">
                        <label for="notrobot">I'm not a robot</label>   
                    </span>
                    <img src="images/captcha.png" alt="">
                </div> -->
                {{Form::submit('გაგზავნა', NULL, ['id' => 'send'])}}
                {{ Form::close() }}
            <p class="shenishvna">საქართველოს ზოგადი ადმინისტრაციული კოდექსის თანახმად, ყველას აქვს უფლება, მიიღოს საჯარო ინფორმაცია, თუ ის არ შეიცავს სახელმწიფო, პროფესიულ ან კომერციულ საიდუმლოებას ან პერსონალურ ინფორმაციას (იხ. კოდექსის მუხლი 10 - <a href="https://matsne.gov.ge/ka/document/view/16270" target="_blank">https://matsne.gov.ge/ka/document/view/16270</a>)</p>
<p class="pp">
აღნიშნული ვებ-გვერდის საშუალებით, შეგიძლიათ ელექტრონულად გამოითხოვოთ საჯარო ინფორმაცია სასურველი თვითმმართველი ერთეულიდან თქვენთვის საინტერესო საკითხებზე. თქვენს მიერ წარდგენილი მოთხოვნა და შესაბამისიპასუხი საჯაროდ იქნება ასახული ამავე ვებ-გვერდზე.
</p>
            </div>

            <? } ?>

        </section>
    </main>

@endsection

