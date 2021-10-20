<?
/** @var array $person */
?>

<fieldset class="order-step">
    <h3 class="h3 order-step__title">Укажите контактные данные</h3>
    <div class="order-step__block">
        <div class="order-field-list">
            <? foreach ($personBlock as $block): ?>
                <div class="order-field-row">
                    <? foreach ($block as $item): ?>
                        <? if (!empty($arResult["LOCATIONS"][$item["ID"]]["output"][0])): ?>
                            <label class="field order-field" style="display:block; width: 100%;">
                                <?= $arResult["LOCATIONS"][$item["ID"]]["output"][0]; ?>
                            </label>
                        <? else: ?>
                            <label class="field order-field"
                                   data-controller="field" data-target="form.field">
                            <span class="field__placeholder">
                                <span class="field__placeholder-text"><?= $item["NAME"]; ?></span>
                            </span>
                                <input class="field__input" name="<?= $item["FIELD_NAME"]; ?>" type="text"
                                       data-target="field.input"
                                       data-action="input-&gt;field#validate focus-&gt;field#addFocus blur-&gt;field#removeFocus"
                                       tabindex="1" value="<?= $item["VALUE"]; ?>">
                            </label>
                        <? endif; ?>
                    <? endforeach; ?>
                </div>
            <? endforeach; ?>

        </div>
    </div>
</fieldset>