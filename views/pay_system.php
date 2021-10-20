<? if (!empty($paySystem)): ?>
    <fieldset class="order-step">
        <h3 class="h3 order-step__title">Способы оплаты</h3>
        <div class="order-step__block">
            <div class="order-pay">
                <div class="order-pay-types order-radio-list">
                    <?
                    $checkPaySystem = [];
                    foreach ($paySystem as $item): ?>
                        <label class="order-radio">
                            <? if (!empty($item["CHECKED"])): $checkPaySystem = $item; ?>
                                <input class="order-radio__input" type="radio" name="<?= $item["FIELD_NAME"]; ?>"
                                       value="<?= $item["ID"]; ?>" checked data-change="cash">
                            <? else: ?>
                                <input class="order-radio__input" type="radio" name="<?= $item["FIELD_NAME"]; ?>"
                                       value="<?= $item["ID"]; ?>" data-change="cash">
                            <? endif; ?>
                            <div class="order-radio__content">
                                <div class="order-radio__title">
                                    <?= $item["NAME"]; ?>
                                </div>
                                <div class="order-radio__block">
                                    <? if (!empty($item["PSA_LOGOTIP"]["SRC"])): ?>
                                        <div class="order-pay-icon-list">
                                            <i class="icon icon-visa order-pay-icon"
                                               style="background: url('<?= $item["PSA_LOGOTIP"]["SRC"]; ?>') center no-repeat;background-size: contain;"></i>
                                        </div>
                                    <? endif; ?>
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
            </div>
        </div>
    </fieldset>
<? endif; ?>