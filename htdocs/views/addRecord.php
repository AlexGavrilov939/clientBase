<div class="data-section-outer">
    <div class="data-section-inner">
            <div class="customer-info">
                <h2 class="customer-title">Информация о клиенте</h2>
                <div class="info-group">
                    <div class="info-item">
                        <label for="fio">Фио: </label><input name="fio" id="fio" placeholder="Фамилия Имя Отчество"/>
                    </div>
                    <div class="info-item">
                        <label for="phone">Телефон: </label><input name="phone" id="phone" placeholder="Телефон с кодом города"/>
                    </div>
                </div>
                <div class="info-group">
                    <div class="info-item">
                        <div class="add-address">
                            <img  src="../assets/img/address.png"/>
                            <button class="button address" data-id="address-area">Добавить адрес</button>
                       </div>
                        <textarea id="address-area">dasdas</textarea>
                    </div>
                    <div class="info-item">
                        <div class="add-description">
                            <img  src="../assets/img/description.png"/>
                            <button class="button description" data-id="description-area">Добавить описание</button>
                        </div>
                        <textarea id="description-area">dasdas</textarea>
                    </div>
                </div>
            </div>

    </div>
</div>
<div class="data-section-outer">
    <div class="data-section-inner">
            <div class="order-info">
                <h2 class="customer-title">Информация о заказе</h2>
                <div class="info-group">
                    <div class="info-item">
                        <div class="add-track-number">
                            <img  src="../assets/img/post.png"/>
                            <button class="button track-number">Почтовый трек номер</button>
                        </div>
                    </div>
                </div>
                <div class="info-group">
                    <input id="track-number-area" name="track-number" placeholder="Введите почтовый номер">
                </div>
                <div class="shipment">
                    <div class="shipment-item-deactivated">
                        <div title="Удалить карточку" class="delete-item">&#10006;</div>

                        <div class="media">
                            <form class="upload" method="post" action="addRecord/addTmpImage" enctype="multipart/form-data">
                                <div class="drop">
                                    Image Here
                                    <a>Browse</a>
                                    <input type="file" name="upl" multiple />
                                </div>
                                <div class="blockedImage">
<!--                                    <div class="deleteButton">Delete</div>-->
                                </div>
                                <ul>
                                    <!-- The file uploads will be shown here -->
                                </ul>
                            </form>

                        </div>
                        <div class="info">
                            <div class="cart-item">
                                <label for="title">Название: </label><input type="text" class="title" name="title" placeholder="название продукта"/>
                            </div>
                            <div class="cart-item">
                                <label for="article">Артикул: </label><input type="text" class="article" name="article" placeholder="Артикул продукта"/>
                            </div>
                            <div class="cart-item">
                                <label for="price">Цена: </label><input type="text" class="price" name="price" placeholder="Цена"/>
                            </div>
                            <div class="cart-item">
                                <label for="delivery">Доставка: </label><input type="text" class="delivery" name="delivery" placeholder="Стоимость доставки"/>
                            </div>
                        </div>
                        <div class="desc">
                            <label for="item-description-area">Оставить комментарий:</label>
                            <textarea class="item-description-area" name="item-description-area"></textarea>
                            <form class="upload-clip" enctype="multipart/form-data" action="addRecord/addTmpImage" method="post">
                                <ul class="clip-area">
                                    <li class="clip-item">
                                        <img class="drop-clip" title="Прикрепить изображение" src="../assets/img/clip.png"/>
                                        <input class="clip-input" type="file" multiple="" name="upl">
                                        <span>Прикрепить изображение</span>
                                    </li>

                                </ul>
                            </form>
                        </div>
                    </div>
                    <span id="add-shipment-item">Добавить наименование</span>
                </div>

            </div>
    </div>
</div>

<div class="control-section-outer">
    <div class="control-section-inner">
        <button class="form-control" id="goto">Перейти к списку заказов</button>
        <button class="form-control" id="save">Сохранить и продолжить</button>
    </div>
</div>
<script>
    $( document ).ready(function() {
        $("button").click(function (){
            var clickId = $(this).data("id");
            $('#'+ clickId).toggle();
        });

        $("#add-shipment-item").click(function() {
            var cartDiv = $('.shipment-item-deactivated').clone();
            cartDiv.toggleClass('shipment-item-deactivated shipment-item');
            $(this).before(cartDiv);
        });
        $("#save").click(function () {
            var data = {
                clientInfo : {
                    fio         : $('#fio').val(),
                    phone       : $('#phone').val(),
                    address     : $('#address-area').val(),
                    description : $('#description-area').val(),
                },
                orderInfo : {
                    postData : {
                        'trackNumber' : $('#track-number-area').val()
                    },
                    orders : getOrders()
                }
            };

            function getOrders()
            {
                var data = [];

                $('.shipment-item').each(function(i, obj) {
                    var mainImageObj = $(this).find('.upload');
                    var descriptionObj = $(this).find('.upload-clip');
                    var order = {
                        name             : $(this).find('input.title').val(),
                        article          : $(this).find('input.article').val(),
                        price            : $(this).find('input.price').val(),
                        delivery         : $(this).find('input.delivery').val(),
                        description      : $(this).find('textarea.item-description-area').val(),
                        mainImage        : getImgName(mainImageObj),
                        descriptionImage : getImgName(descriptionObj)
                    };
                    data.push(order);
                });

                return data;
            }

            function getImgName(obj)
            {
                var images = [];
                $.each(obj.find('img.tmpImage'), function(key, value) {
                    images.push((($(this).attr('src').split('/').pop())));
                });

                if(images.length == 1) {

                    return images[0];
                }

                return images;
            }

            $.post( "addRecord/processingOrderPost",data, function( data ) {
//                console.log(data);
//                window.location.href = "addRecord/success";
            });
        });




    });

    $(document).on('click', ".delete-item", function() {
        $(this).parent().remove();
    });

</script>
<script>
    $(document).on('click', ".deleteButton", function() {
        console.log('make request');
        var data = $(this).parent().find('img').attr("src");
        console.log(data);
        $.post( "addRecord/deleteImage",data, function( data ) {
            $( ".result" ).html( data );
        });
    });
</script>
<script>
    $(document).on('click', ".status", function() {
        var form = $(this).parents('.upload');
        form.find('.blockedImage').hide();
        form.find('.blockedImage').empty();
        form.find('.drop').show();
    });
</script>
<script>
    $(document).on('focus', "li.blockedImage", function() {
        console.log('image');
    });
</script>
<!-- JavaScript Includes -->
<script src="../assets/js/jquery.knob.js"></script>

<!-- jQuery File Upload Dependencies -->
<script src="../assets/js/jquery.ui.widget.js"></script>
<script src="../assets/js/jquery.iframe-transport.js"></script>
<script src="../assets/js/jquery.fileupload.js"></script>

<!-- Our main JS file -->
<script src="../assets/js/upload.js"></script>
