<div class="data-section-outer">
    <div class="data-section-inner">
            <div class="customer-info">
                <h2 class="customer-title">Информация о клиенте</h2>
                <div class="info-group">
                    <div class="info-item">
                        <label for="fio">Фио: </label><input name="fio" id="fio" placeholder="дата заказа"/>
                    </div>
                    <div class="info-item">
                        <label for="phone">Телефон: </label><input name="phone" id="phone" placeholder="дата заказа"/>
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
                            <button class="button track-number" data-id="track-number-area">Добавить почтовый трек номер</button>
                        </div>
                    </div>
                </div>
                <div class="info-group">
                    <input id="track-number-area" name="track-number" placeholder="Введите почтовый номер">
                </div>

            </div>
    </div>
</div>
<div class="control-section-outer">
    <div class="control-section-inner">
        <button class="form-control goto">Перейти к списку заказов</button>
        <button class="form-control save">Сохранить и продолжить</button>
    </div>
</div>
<script>
    $( document ).ready(function() {
        $("button").click(function (){
            var clickId = $(this).data("id");
            $('#'+ clickId).toggle();
        });
    });
</script>