@extends('layouts.home')

@section('center')
<?php
	$months = array(
		'01'=>'იანვარი',
		'02'=>'თებერვალი',
		'03'=>'მარტი',
		'04'=>'აპრილი',
		'05'=>'მაისი',
		'06'=>'ივნისი',
		'07'=>'ივლისი',
		'08'=>'აგვისტო',
		'09'=>'სექტემბერი',
		'10'=>'ოქტომბერი',
		'11'=>'ნოემბერი',
		'12'=>'დეკემბერი',	
	);
?>
	<main>
		<section class="questions">
			<div class="wrapper">
				<h2 class="topic">მოთხოვნილი საჯარო ინფორმაცია</h2>
				<p class="pp">საქართველოს ზოგადი ადმინისტრაციული კოდექსის თანახმად, ყველას აქვს უფლება, მიიღოს საჯარო ინფორმაცია, თუ ის არ შეიცავს სახელმწიფო, პროფესიულ ან კომერციულ საიდუმლოებას ან პერსონალურ ინფორმაციას (იხ. კოდექსის მუხლი 10 - <a href="https://matsne.gov.ge/ka/document/view/16270" target="_blank">https://matsne.gov.ge/ka/document/view/16270</a>)</p>
				<form class="srch" action="/answers/faqs/">
					<div>
						<label for="keyword">საძიებო სიტყვა</label>
						<input type="text" name="kw" id="keyword" value="<?=@$_GET['kw']?>">
					</div>
					<div>
						<label for="from">თარიღიდან:</label>
						<input type="text" name="from" id="from" value="<?=@$_GET['from']?>">
					</div>
					<div>
						<label for="to">თარიღამდე:</label>
						<input type="text" name="to" id="to" value="<?=@$_GET['to']?>">
					</div>
					<div>
						<label for="municipp">მუნიციპალიტეტი:</label>
						<select id="municipp" name="category">
							<option value="">აირჩიე</option>
							<?php
								foreach ($entitleList as $value) {
									if($value->id==@$_GET['category']) $selected = 'selected'; else $selected = '';
 			 						echo '<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>';
								}
							?>
						</select>
					</div>
					<div>
						<label for="municipa">სტატუსი:</label>
						<select id="municipa" name="status">
							<option value="">აირჩიე</option>
							<option value="1">პასუხგაცემული</option>
							<option value="2">პასუხის გარეშე</option>
							<option value="3">დაგვიანებული პასუხი</option>
						</select>
					</div>
					<div>
						<input type="submit" value="გაფილტრვა" name="">
					</div>
				</form>
				<ul class="qa">
					<? foreach ($questions as $key => $myvalue) {

						$myvalue->dateTime;
						?>

					<li>
						<h3>
							<a href="/viewquestion/<?=str_replace('-', rand(3, 9), $myvalue->token);?>"><?=$myvalue->subject;?></a>
						</h3> <span class="sector"><?=$myvalue->sector;?></span> 
						 <span class="date"><?=date("d",strtotime($myvalue->dateTime));?> <?=$months[date("m",strtotime($myvalue->dateTime))];?>, <?=date("Y",strtotime($myvalue->dateTime));?></span>
					</li>
						<?
					}?>
				</ul>
				<!-- 
				<span class="pages">გვერდები</span>
				<ul class="pagination">
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#" class="active">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">6</a></li>
					<li><a href="#">7</a></li>
					<li><a href="#">8</a></li>
				</ul> -->
			</div>
		</section>
	</main>

@endsection

