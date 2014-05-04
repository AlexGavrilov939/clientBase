<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../assets/css/reset.css"/>
        <link type="text/css" rel="stylesheet" href="../assets/css/theme.css"/>
        <link type="text/css" rel="stylesheet" href="../assets/css/fonts.css"/>
        <link type="text/css" rel="stylesheet" href="../assets/css/upload.css"/>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"  type="text/javascript"></script>
    </head>
    <body>
        <div class="header">
            <ul class="header-control">
                <li class="exit">
                    <a href="/logout">fasf</a>
                </li>
            </ul>
        </div>
        <div class="main-wrapper">
            <div class="navigation">
                <a href="/main" class="item"><img src="../assets/img/dashboard.png"/>клиенты</a>
                <a href="/addRecord" class="item add-record"><img src="../assets/img/addRecord.png"/>Добавить заказ</a>
                <a href="/export" class="item excel"><img src="../assets/img/excel.png"/>импорт / экспорт</a>
            </div>
            <div class="content"><?=$data['content']?></div>
        </div>
        <div class="footer">footer</div>
    </body>
</html>