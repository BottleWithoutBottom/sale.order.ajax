<fieldset class="order-step">
    <h3 class="h3 order-step__title">Способ доставки</h3>
    <div class="order-step__block">
        <!-- Можно задать дефолтное значение-->
        <div class="order-delivery" data-block="delivery">
            <div class="order-delivery-types order-radio-list">
                <? $checkDelivery = [];
                foreach ($delivery as $item): ?>
                    <label class="order-radio">
                        <? if (!empty($item["CHECKED"])): $checkDelivery = $item; ?>
                            <input class="order-radio__input" type="radio" name="<?= $item["FIELD_NAME"]; ?>"
                                   value="<?= $item["ID"]; ?>" checked data-change="delivery">
                        <? else: ?>
                            <input class="order-radio__input" type="radio" name="<?= $item["FIELD_NAME"]; ?>"
                                   value="<?= $item["ID"]; ?>" data-change="delivery">
                        <? endif; ?>
                        <div class="order-radio__content">
                            <div class="order-radio__title"><?= $item["NAME"]; ?></div>
                            <div class="order-radio__block">
                                <div class="order-icon-list">
                                    <div class="order-icon"><i
                                                class="icon icon-money order-icon__pic"></i><span
                                                class="order-icon__text"><?= $item["PRICE"]; ?> руб.</span>
                                    </div>
                                    <div class="order-icon"><i
                                                class="icon icon-time order-icon__pic"></i><span
                                                class="order-icon__text"><?= $item["PERIOD_TEXT"]; ?></span>
                                    </div>
                                </div>
                                <? if (!empty($item["DESCRIPTION"])): ?>
                                    <div class="order-radio__desc">
                                        <?= $item["DESCRIPTION"]; ?>
                                    </div>
                                <? endif; ?>
                            </div>
                        </div>
                    </label>
                <? endforeach; ?>
            </div>
            <section class="order-delivery-state-list">
                <fieldset class="order-delivery-state">
                    <legend class="order-delivery-state__title">
                        <?= $checkDelivery["NAME"]; ?>
                    </legend>
                    <? if (!empty($checkDelivery["DESCRIPTION"])): ?>
                        <div class="order-delivery-state__block">
                            <p><?= $checkDelivery["DESCRIPTION"]; ?></p>
                        </div>
                    <? endif; ?>
                    <? //if (!empty($this->arResult["DOP_RESULT_EVENTS"]["sdek"])): ?>
                        <div id="selectDelivery_<?=$checkDelivery["ID"];?>"></div>
                    <? //endif; ?>
                </fieldset>
            </section>
        </div>
    </div>
</fieldset>