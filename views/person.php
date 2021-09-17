<?
/** @var array $person */
?>

<fieldset class="order-step">
    <h3 class="h3 order-step__title">Укажите контактные данные</h3>
    <div class="order-step__block">
        <div class="order-field-list">
            <div class="order-field-row">
                <label class="field order-field focus"
                       data-controller="field" data-target="form.field">
                    <span class="field__placeholder">
                        <span class="field__placeholder-text">ФИО</span>
                        <?= $person['FIO'] ?>
                    </span>
                    <input class="field__input" name="fio" type="text"
                           data-target="field.input"
                           data-action="input-&gt;field#validate focus-&gt;field#addFocus blur-&gt;field#removeFocus"
                           tabindex="1" value="<?= $person['FIO'] ?>">
                </label>
                <label class="field order-field" data-controller="field"
                       data-target="form.field">
                    <span class="field__placeholder">
                        <span class="field__placeholder-text">Электронная почта</span>
                        <?= $person['EMAIL'] ?>
                    </span>
                    <input class="field__input" name="email" type="text"
                           data-target="field.input"
                           data-action="input-&gt;field#validate focus-&gt;field#addFocus blur-&gt;field#removeFocus"
                           tabindex="4" value="<?= $person['EMAIL'] ?>">
                </label>
            </div>
        </div>
    </div>
</fieldset>