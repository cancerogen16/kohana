<p style="text-align:center">Введите адрес эл. почты.</p>
<?php if(isset($error)){?>
<p style="color:red; text-align:center">Адрес эл. почты не найден.</p>
<?php } ?>
<?php if(isset($ok)){?>
<p style="color:green; text-align:center">Проверьте вашу эл. почту.</p>
<?php } ?>
<div style="margin: 20px auto;width:300px;">
    <form action="" method="post">
        <table class="login">
            <tr>
                <th colspan="2" style="padding-bottom:10px;">Вспоминаем пароль</th>
            </tr>
            <tr>
                <td>Эл. почта:</td>
                <td><input type="text" name="email" id="email"><span id="trueimg"></span><span id="falseimg"></span></td>
            </tr>
            <th colspan="2" style="text-align:right"><input type="submit" value="Вспомнить" style="width:170px; height:30px" name="btnsubmit"></th>
        </table>
    </form>
</div>

<script type="text/javascript">
function runajax(){
    var email = $('#email').val();
    $.ajax({
        type: "post",
        data: "email=" + email,
        url: "/ajax/emailunique",
        dataType: "json",
        success: function(data){
            if(!data.result){
                $('#trueimg').css('display','block');
                $('#falseimg').css('display','none');
            } else {
                $('#trueimg').css('display','none');
                $('#falseimg').css('display','block');
            }
        }
    });
}
$(document).ready(function(){
    $('#email').on("blur",runajax);
});

</script>