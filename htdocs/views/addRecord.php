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
                            <div class="image-view"></div>
                            <button id="add-image">Добавить изображение</button>
                        </div>
                        <div class="info">
                            <div class="cart-item">
                                <label for="title">Название: </label><input type="text" name="title" placeholder="название продукта"/>
                            </div>
                            <div class="cart-item">
                                <label for="article">Артикул: </label><input type="text" name="article" placeholder="Артикул продукта"/>
                            </div>
                            <div class="cart-item">
                                <label for="price">Цена: </label><input type="text" name="price" placeholder="Цена"/>
                            </div>
                            <div class="cart-item">
                                <label for="delivery">Доставка: </label><input type="text" name="delivery" placeholder="Стоимость доставки"/>
                            </div>
                        </div>
                        <div class="desc">
                            <label for="item-description-area">Оставить комментарий:</label>
                            <textarea class="item-description-area" name="item-description-area"></textarea>
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
                fio         : $('#fio').val(),
                phone       : $('#phone').val(),
                address     : $('#address-area').val(),
                description : $('#description-area').val(),
                trackNumber : $('#track-number-area').val(),
                
            };
            console.log(data);
        });
    });

    $(document).on('click', ".delete-item", function() {
        $(this).parent().remove();
    });
</script>