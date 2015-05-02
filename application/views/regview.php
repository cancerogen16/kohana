<?php  
if (isset($errors)) {
	
	foreach ($errors as $error) {
		echo '<p style="color:red">'.$error.'</p>';		
	}
} 

if (isset($regok)) {
	echo '<p style="color:green">Регистрация успешна</p>';	
} 
?>

<form action="" method="post">
	<table id="reg-form">
		<tr>
			<th colspan="2">Регистрация пользователя</th>
		</tr>
		<tr>
			<td>Эл.почта:</td>
			<td><input type="text" name="email" /></td>
		</tr>
		<tr>
			<td>Секретный код:</td>
			<td><input type="text" name="regcodevalue" /></td>
		</tr>
		<tr>
			<th colspan="2"><input type="submit" name="btnsubmit" value="Зарегистрироваться" /></th>
		</tr>
	</table>
</form>