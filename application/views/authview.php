<?php  
if (isset($error)) {
	if ($error) {
		echo '<p style="color:red">Логин или пароль введён неверно</p>';	
	} 
} 
?>

<form action="" method="post">
	<table id="login-form">
		<tr>
			<th colspan="2">Авторизация</th>
		</tr>
		<tr>
			<td>Логин:</td>
			<td><input type="text" name="login" /></td>
		</tr>
		<tr>
			<td>Пароль:</td>
			<td><input type="password" name="password" /></td>
		</tr>
		<tr>
			<th colspan="2"><input type="submit" name="btnsubmit" value="Войти" /></th>
		</tr>
	</table>
</form>