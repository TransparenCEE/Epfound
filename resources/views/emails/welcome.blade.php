<!DOCTYPE html>
<html>
<head>
	<title>Mail Form</title>
	<meta charset="utf-8">
</head>
<body>
	<div style="text-align: right;">
		<?=$entitleName?><br>
		საჯარო ინფორმაციის ხელმისაწვდომობაზე<br>
		პასუხისმგებელ პირს,<br>
		მოქალაქე <?=$name?> მცხოვრები <?=$adress?><br>
		<?=$phone?>
	</div>
	<h3 style="text-align: center; margin-top:100px;">განცხადება</h3>
	<p style="padding: 0px 50px; margin-top: 50px;">გთხოვთ, საქართველოს კანონმდებლობის შესაბამისად, მომაწოდოთ შემდეგი საჯარო ინფორმაცია:</p>
	<p style="padding: 0px 50px; margin-top: 10px;"><?=$text?></p>
	<p style="margin-top: 250px; padding: 0px 50px;">პატივისცემით,</p>
	<p style="margin-top: 50px; padding: 0px 50px;"><?=$name?></p>
	<p style="padding: 0px 50px;"><?=date("Y-m-d")?></p>
	<p style="padding: 0px 50px; color: #ff0000; margin-top: 50px;">არასავალდებულო ნაწილი:</p>
	<ol style="color: #ff0000; padding: 0px 90px;">
		<li><?=$gender?></li>
		<li><?=$gender?></li>
		<li><?=$age?></li>
	</ol>
	<br /><br />
პასუხის გასაცემად გადადით შემდეგ ბმულზე<br /><br />
epfund.flash.ge/viewquestion/<?=$token?>
</body>
</html>