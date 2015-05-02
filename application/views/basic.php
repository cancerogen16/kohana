<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Образовательная система</title>
        <link href="/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div id="container">
            <div id="header">
                <h1>Образовательная система</h1>
                <a href="/auth/">Войти</a>
                <a href="/auth/logout">Выйти</a>
                <a href="/admin/main/">Админка</a>
                <a href="/auth/reg/">Регистрация</a>
                <a href="/auth/hpass/">Создать пароль</a>
                <a href="/auth/hochuvspomnit/">Вспоминаем пароль</a>
                <!-- end .header -->
            </div>
            <div id="content">

                <?php echo $content; ?>	

            </div>

            <div style="clear:both;"> </div>
            <div id="empty"> </div>

            <!-- end .container -->
        </div>
        <div id="footer">
            <hr>
            <p>
                Footer
            </p>
            <!-- end .footer -->
        </div>
    </body>
</html>
