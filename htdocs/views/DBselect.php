<div id="DbList">
    <div id="DbListInner">
        <div class="title">Выберите клиентскую базу:</div>
        <ul class="DbList">
            <?php foreach($data as $item):?>
            <li class="DbListItem">
                <img class="ok" src="../assets/img/ok.png"/>
                    <b class="name"><?=$item?></b>
                <div class="delete">
                    <span>Удалить</span><img title="Удалить" src="../assets/img/delete.png"/>
                </div>
            </li>
            <?php endforeach?>
        </ul>
        <div class="addBase"><button id="addNewBase">Добавить новую:</button><input type="text" placeholder/></div>
        <div class="DbSubmit">
            <input type="submit" value="Сохранить и продолжить" id="submit">
        </div>
    </div>
</div>
<script>
    var currentDbName;
    $(document).on('click', "b.name", function() {
        var li = $(this).parent().parent().children('li').not($(this).parent());
        li.each(function () {
            $(this).find('.ok').hide();
        });
        $(this).parent().find('.ok').toggle();
        currentDbName = $(this).parent().find('.name').text();
    });
    $( document).ready(function () {
        $("#addNewBase").click(function() {
            var input = $(this).parent().find('input').val();
            if(input.length == 0) {
                console.log('false');
                return false;
            }
            $.post('/login/createDb', {name : input}, function() {
                console.log('db created!');
            });
            $(".DbList").append(
            '<li class="DbListItem">' +
                '<img class="ok" src="../assets/img/ok.png"/>' +
                '<b class="name">' + input + '</b>' +
                '<div class="delete"><span>Удалить</span><img title="Удалить" src="../assets/img/delete.png"/></div>' +
            '</li>');
        });
    });
    $(document).on('click', "div.delete", function() {
        var li = $(this).parent();
        var dbName = li.find('b.name').text();
        if (confirm("Вы точно хотите удалить базу с именем \"" + dbName + '\" ?')) {
            li.remove();
            $.post('/login/removeDb', {name : dbName}, function() {
                console.log('success');
            });
        }
    });
    $(document).on('click', "#submit", function() {
        if(currentDbName == undefined) {
            alert('Чтобы продолжить работу необходимо выбрать существующую базу, либо создать новую!');
        } else {
            $.post('/login/saveDefaultDb', {defaultDb : currentDbName}, function() {
                window.location.href = '/main';
                console.log('name of the database is successfully stored in cookies');
            });
        }
    });
</script>