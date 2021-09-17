<?php
/** @var array $data */
?>
<div class="order__sidebar">
    <div class="order__result">
        <div class="order__result-title">Ваш заказ</div>
        <ul class="order__result-list">
            <? foreach ($data['BASKET_ITEMS'] as $item):
                $title = $item['NAME'];
                $quantity = $item['QUANTITY'];
                $price = $item['PRICE'];
                ?>
                <li class="order__result-item">
                    <a class="order__result-img-link" href="#">
                        <img class="order__result-img" src="<?= $item['PREVIEW_PICTURE_SRC'] ?>" alt="<?= $title ?>">
                    </a>
                    <div class="order__result-content">
                        <div class="order__result-data">
                            <div class="order__result-vendor-code">012578</div>
                            <a class="order__result-item-title" href="#"><?= $title ?></a>
                            <ul class="order__result-params">
                                <li class="order__result-params-item"><span
                                        class="order__result-params-key">Размер:</span><span
                                        class="order__result-params-value">92</span></li>
                                <li class="order__result-params-item"><span
                                        class="order__result-params-key">Кол-во:</span><span
                                        class="order__result-params-value"><?= $title ?></span></li>
                            </ul>
                        </div>
                        <div class="order__result-sum"><?= $price * $quantity ?> руб.</div>
                    </div>
                </li>
            <? endforeach; ?>
        </ul>
        <ul class="order__result-counts">
            <li class="order__result-counts-item"><span class="order__result-counts-key">Кол-во товаров</span><span
                    class="order__result-counts-value"><?= $data['ALL_QUANTITY'] ?> шт.</span></li>
            <li class="order__result-counts-item">
                <span class="order__result-counts-key">Стоимость доставки</span>
                <span class="order__result-counts-value"><?= $data['DELIVERY_PRICE'] ?> руб.</span></li>
        </ul>
        <div class="order__result-total">
            <span class="order__result-total-key">Итого</span><span
                class="order__result-total-value"><?= $data['ORDER_PRICE'] ?> руб.</span></div>
        <div class="order__result-submit active" data-target="order.resultSubmit"><a
                class="button button--order" href="javascript:void(0)"
                data-action="click-&gt;order#submit">Оформить заказ</a>
            <div class="order__result-policy">Нажимая на кнопку «Оформить заказ», я даю свое
                согласие на обработку персональных данных, с договором публичной оферты и
                политикой конфиденциальности ознакомлен и принимаю
            </div>
        </div>
    </div>
</div>
