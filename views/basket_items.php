<?

/** @var array $basketItems */
?>
<fieldset class="order-step">
    <h3 class="h3 order-step__title">Состав заказа</h3>
    <div class="order-step__block">
        <div class="cart__head">
            <div class="cart__row">
                <div class="cart__col _photo">Фото</div>
                <div class="cart__col _about">Описание</div>
                <div class="cart__col _availability">Наличие</div>
                <div class="cart__col _price">Цена</div>
                <div class="cart__col _quantity">Кол-во</div>
                <div class="cart__col _total">Итого</div>
            </div>
        </div>
        <div class="cart__body">
            <? foreach ($basketItems as $item):
                $title = $item['NAME'];
                $basePrice = $item['BASE_PRICE'];
                $price = $item['PRICE'];
                $quantity = $item['QUANTITY'];
                ?>
                <div class="cart__row" data-controller="product-cart" data-product-cart-id="" data-cart-target="card">
                    <div class="cart__col _photo">
                        <a class="cart__img-link" href="#">
                            <img class="cart__img"
                                 src="<?= $item['PREVIEW_PICTURE_SRC'] ?>"
                                 alt="<?= $title ?>"></a>
                    </div>
                    <div class="cart__col _about">
                        <div class="cart__vendor-code">012578</div>
                        <a class="cart__title" href="#"><?= $title ?></a>
                        <div class="cart__size">
                            <span class="cart__size-key">Размер</span>
                            <span class="cart__size-value">92</span>
                        </div>
                    </div>
                    <div class="cart__col _availability">
                        <ul class="cart__availability">
                            <li class="cart__availability-item">123
                            </li>
                        </ul>
                    </div>
                    <div class="cart__col _price">
                        <div class="cart__price">
                            <div class="cart__price-old"><?= $basePrice ?></div>
                            <div class="cart__price-value"><?= $price ?> руб.</div>
                        </div>
                    </div>
                    <div class="cart__col _quantity">
                        <div class="quantity">
                            <div class="quantity__minus" data-action="click->product-cart#decrementQuantity"></div>
                            <input class="quantity__input" type="number" name="quantity" data-target="product-cart.quantity" data-action="change->product-cart#changeQuantity" value="1">
                            <div class="quantity__plus" data-action="click->product-cart#incrementQuantity"></div>
                        </div>
                    </div>
                    <div class="cart__col _total">
                        <div class="cart__total">
                            <div class="cart__total-old"><?= $basePrice * $quantity ?>руб.</div>
                            <div class="cart__total-value"><?= $price * $quantity ?> руб.</div>
                        </div>
                        <i class="icon icon-delete cart__delete"
                           data-action="click->product-cart#removeFromCart"></i>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <div class="cart__footer">
            <div class="cart__clean">
                <a class="cart__clean-link" href="#" data-action="click->cart#clear">Очистить
                    корзину</a>
            </div>
        </div>
    </div>
</fieldset>