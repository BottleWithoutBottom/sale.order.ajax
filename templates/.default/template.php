<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */
?>
<div id="order">
    <?php
    $context = Main\Application::getInstance()->getContext();
    $request = $context->getRequest();

    if (empty($arParams['TEMPLATE_THEME'])) {
        $arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
    }

    if ($arParams['TEMPLATE_THEME'] === 'site') {
        $templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
        $templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
        $arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_' . $templateId . '_theme_id', 'blue', $component->getSiteId());
    }

    if (!empty($arParams['TEMPLATE_THEME'])) {
        if (!is_file(Main\Application::getDocumentRoot() . '/bitrix/css/main/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css')) {
            $arParams['TEMPLATE_THEME'] = 'blue';
        }
    }

    $arParams['ALLOW_USER_PROFILES'] = $arParams['ALLOW_USER_PROFILES'] === 'Y' ? 'Y' : 'N';
    $arParams['SKIP_USELESS_BLOCK'] = $arParams['SKIP_USELESS_BLOCK'] === 'N' ? 'N' : 'Y';

    if (!isset($arParams['SHOW_ORDER_BUTTON'])) {
        $arParams['SHOW_ORDER_BUTTON'] = 'final_step';
    }

    $arParams['HIDE_ORDER_DESCRIPTION'] = isset($arParams['HIDE_ORDER_DESCRIPTION']) && $arParams['HIDE_ORDER_DESCRIPTION'] === 'Y' ? 'Y' : 'N';
    $arParams['SHOW_TOTAL_ORDER_BUTTON'] = $arParams['SHOW_TOTAL_ORDER_BUTTON'] === 'Y' ? 'Y' : 'N';
    $arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] = $arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] === 'N' ? 'N' : 'Y';
    $arParams['SHOW_PAY_SYSTEM_INFO_NAME'] = $arParams['SHOW_PAY_SYSTEM_INFO_NAME'] === 'N' ? 'N' : 'Y';
    $arParams['SHOW_DELIVERY_LIST_NAMES'] = $arParams['SHOW_DELIVERY_LIST_NAMES'] === 'N' ? 'N' : 'Y';
    $arParams['SHOW_DELIVERY_INFO_NAME'] = $arParams['SHOW_DELIVERY_INFO_NAME'] === 'N' ? 'N' : 'Y';
    $arParams['SHOW_DELIVERY_PARENT_NAMES'] = $arParams['SHOW_DELIVERY_PARENT_NAMES'] === 'N' ? 'N' : 'Y';
    $arParams['SHOW_STORES_IMAGES'] = $arParams['SHOW_STORES_IMAGES'] === 'N' ? 'N' : 'Y';

    if (!isset($arParams['BASKET_POSITION']) || !in_array($arParams['BASKET_POSITION'], array('before', 'after'))) {
        $arParams['BASKET_POSITION'] = 'after';
    }

    $arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
    $arParams['SHOW_BASKET_HEADERS'] = $arParams['SHOW_BASKET_HEADERS'] === 'Y' ? 'Y' : 'N';
    $arParams['HIDE_DETAIL_PAGE_URL'] = isset($arParams['HIDE_DETAIL_PAGE_URL']) && $arParams['HIDE_DETAIL_PAGE_URL'] === 'Y' ? 'Y' : 'N';
    $arParams['DELIVERY_FADE_EXTRA_SERVICES'] = $arParams['DELIVERY_FADE_EXTRA_SERVICES'] === 'Y' ? 'Y' : 'N';

    $arParams['SHOW_COUPONS'] = isset($arParams['SHOW_COUPONS']) && $arParams['SHOW_COUPONS'] === 'N' ? 'N' : 'Y';

    if ($arParams['SHOW_COUPONS'] === 'N') {
        $arParams['SHOW_COUPONS_BASKET'] = 'N';
        $arParams['SHOW_COUPONS_DELIVERY'] = 'N';
        $arParams['SHOW_COUPONS_PAY_SYSTEM'] = 'N';
    } else {
        $arParams['SHOW_COUPONS_BASKET'] = isset($arParams['SHOW_COUPONS_BASKET']) && $arParams['SHOW_COUPONS_BASKET'] === 'N' ? 'N' : 'Y';
        $arParams['SHOW_COUPONS_DELIVERY'] = isset($arParams['SHOW_COUPONS_DELIVERY']) && $arParams['SHOW_COUPONS_DELIVERY'] === 'N' ? 'N' : 'Y';
        $arParams['SHOW_COUPONS_PAY_SYSTEM'] = isset($arParams['SHOW_COUPONS_PAY_SYSTEM']) && $arParams['SHOW_COUPONS_PAY_SYSTEM'] === 'N' ? 'N' : 'Y';
    }

    $arParams['SHOW_NEAREST_PICKUP'] = $arParams['SHOW_NEAREST_PICKUP'] === 'Y' ? 'Y' : 'N';
    $arParams['DELIVERIES_PER_PAGE'] = isset($arParams['DELIVERIES_PER_PAGE']) ? intval($arParams['DELIVERIES_PER_PAGE']) : 9;
    $arParams['PAY_SYSTEMS_PER_PAGE'] = isset($arParams['PAY_SYSTEMS_PER_PAGE']) ? intval($arParams['PAY_SYSTEMS_PER_PAGE']) : 9;
    $arParams['PICKUPS_PER_PAGE'] = isset($arParams['PICKUPS_PER_PAGE']) ? intval($arParams['PICKUPS_PER_PAGE']) : 5;
    $arParams['SHOW_PICKUP_MAP'] = $arParams['SHOW_PICKUP_MAP'] === 'N' ? 'N' : 'Y';
    $arParams['SHOW_MAP_IN_PROPS'] = $arParams['SHOW_MAP_IN_PROPS'] === 'Y' ? 'Y' : 'N';
    $arParams['USE_YM_GOALS'] = $arParams['USE_YM_GOALS'] === 'Y' ? 'Y' : 'N';
    $arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
    $arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
    $arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

    $useDefaultMessages = !isset($arParams['USE_CUSTOM_MAIN_MESSAGES']) || $arParams['USE_CUSTOM_MAIN_MESSAGES'] != 'Y';

    if ($useDefaultMessages || !isset($arParams['MESS_AUTH_BLOCK_NAME'])) {
        $arParams['MESS_AUTH_BLOCK_NAME'] = Loc::getMessage('AUTH_BLOCK_NAME_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_REG_BLOCK_NAME'])) {
        $arParams['MESS_REG_BLOCK_NAME'] = Loc::getMessage('REG_BLOCK_NAME_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_BASKET_BLOCK_NAME'])) {
        $arParams['MESS_BASKET_BLOCK_NAME'] = Loc::getMessage('BASKET_BLOCK_NAME_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_REGION_BLOCK_NAME'])) {
        $arParams['MESS_REGION_BLOCK_NAME'] = Loc::getMessage('REGION_BLOCK_NAME_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_PAYMENT_BLOCK_NAME'])) {
        $arParams['MESS_PAYMENT_BLOCK_NAME'] = Loc::getMessage('PAYMENT_BLOCK_NAME_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_BLOCK_NAME'])) {
        $arParams['MESS_DELIVERY_BLOCK_NAME'] = Loc::getMessage('DELIVERY_BLOCK_NAME_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_BUYER_BLOCK_NAME'])) {
        $arParams['MESS_BUYER_BLOCK_NAME'] = Loc::getMessage('BUYER_BLOCK_NAME_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_BACK'])) {
        $arParams['MESS_BACK'] = Loc::getMessage('BACK_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_FURTHER'])) {
        $arParams['MESS_FURTHER'] = Loc::getMessage('FURTHER_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_EDIT'])) {
        $arParams['MESS_EDIT'] = Loc::getMessage('EDIT_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_ORDER'])) {
        $arParams['MESS_ORDER'] = $arParams['~MESS_ORDER'] = Loc::getMessage('ORDER_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_PRICE'])) {
        $arParams['MESS_PRICE'] = Loc::getMessage('PRICE_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_PERIOD'])) {
        $arParams['MESS_PERIOD'] = Loc::getMessage('PERIOD_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_NAV_BACK'])) {
        $arParams['MESS_NAV_BACK'] = Loc::getMessage('NAV_BACK_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_NAV_FORWARD'])) {
        $arParams['MESS_NAV_FORWARD'] = Loc::getMessage('NAV_FORWARD_DEFAULT');
    }

    $useDefaultMessages = !isset($arParams['USE_CUSTOM_ADDITIONAL_MESSAGES']) || $arParams['USE_CUSTOM_ADDITIONAL_MESSAGES'] != 'Y';

    if ($useDefaultMessages || !isset($arParams['MESS_PRICE_FREE'])) {
        $arParams['MESS_PRICE_FREE'] = Loc::getMessage('PRICE_FREE_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_ECONOMY'])) {
        $arParams['MESS_ECONOMY'] = Loc::getMessage('ECONOMY_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_REGISTRATION_REFERENCE'])) {
        $arParams['MESS_REGISTRATION_REFERENCE'] = Loc::getMessage('REGISTRATION_REFERENCE_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_1'])) {
        $arParams['MESS_AUTH_REFERENCE_1'] = Loc::getMessage('AUTH_REFERENCE_1_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_2'])) {
        $arParams['MESS_AUTH_REFERENCE_2'] = Loc::getMessage('AUTH_REFERENCE_2_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_3'])) {
        $arParams['MESS_AUTH_REFERENCE_3'] = Loc::getMessage('AUTH_REFERENCE_3_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_ADDITIONAL_PROPS'])) {
        $arParams['MESS_ADDITIONAL_PROPS'] = Loc::getMessage('ADDITIONAL_PROPS_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_USE_COUPON'])) {
        $arParams['MESS_USE_COUPON'] = Loc::getMessage('USE_COUPON_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_COUPON'])) {
        $arParams['MESS_COUPON'] = Loc::getMessage('COUPON_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_PERSON_TYPE'])) {
        $arParams['MESS_PERSON_TYPE'] = Loc::getMessage('PERSON_TYPE_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PROFILE'])) {
        $arParams['MESS_SELECT_PROFILE'] = Loc::getMessage('SELECT_PROFILE_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_REGION_REFERENCE'])) {
        $arParams['MESS_REGION_REFERENCE'] = Loc::getMessage('REGION_REFERENCE_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_PICKUP_LIST'])) {
        $arParams['MESS_PICKUP_LIST'] = Loc::getMessage('PICKUP_LIST_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_NEAREST_PICKUP_LIST'])) {
        $arParams['MESS_NEAREST_PICKUP_LIST'] = Loc::getMessage('NEAREST_PICKUP_LIST_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PICKUP'])) {
        $arParams['MESS_SELECT_PICKUP'] = Loc::getMessage('SELECT_PICKUP_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_INNER_PS_BALANCE'])) {
        $arParams['MESS_INNER_PS_BALANCE'] = Loc::getMessage('INNER_PS_BALANCE_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_ORDER_DESC'])) {
        $arParams['MESS_ORDER_DESC'] = Loc::getMessage('ORDER_DESC_DEFAULT');
    }

    $useDefaultMessages = !isset($arParams['USE_CUSTOM_ERROR_MESSAGES']) || $arParams['USE_CUSTOM_ERROR_MESSAGES'] != 'Y';

    if ($useDefaultMessages || !isset($arParams['MESS_PRELOAD_ORDER_TITLE'])) {
        $arParams['MESS_PRELOAD_ORDER_TITLE'] = Loc::getMessage('PRELOAD_ORDER_TITLE_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_SUCCESS_PRELOAD_TEXT'])) {
        $arParams['MESS_SUCCESS_PRELOAD_TEXT'] = Loc::getMessage('SUCCESS_PRELOAD_TEXT_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_FAIL_PRELOAD_TEXT'])) {
        $arParams['MESS_FAIL_PRELOAD_TEXT'] = Loc::getMessage('FAIL_PRELOAD_TEXT_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TITLE'])) {
        $arParams['MESS_DELIVERY_CALC_ERROR_TITLE'] = Loc::getMessage('DELIVERY_CALC_ERROR_TITLE_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TEXT'])) {
        $arParams['MESS_DELIVERY_CALC_ERROR_TEXT'] = Loc::getMessage('DELIVERY_CALC_ERROR_TEXT_DEFAULT');
    }

    if ($useDefaultMessages || !isset($arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'])) {
        $arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'] = Loc::getMessage('PAY_SYSTEM_PAYABLE_ERROR_DEFAULT');
    }

    $scheme = $request->isHttps() ? 'https' : 'http';

    switch (LANGUAGE_ID) {
        case 'ru':
            $locale = 'ru-RU';
            break;
        case 'ua':
            $locale = 'ru-UA';
            break;
        case 'tk':
            $locale = 'tr-TR';
            break;
        default:
            $locale = 'en-US';
            break;
    }
    $this->addExternalJs($templateFolder . '/order_ajax.js');
    \Bitrix\Sale\PropertyValueCollection::initJs();
    $this->addExternalJs($templateFolder . '/script.js');
    ?>
    <NOSCRIPT>
        <div style="color:red"><?= Loc::getMessage('SOA_NO_JS') ?></div>
    </NOSCRIPT>
    <?

    if ($request->get('ORDER_ID') <> '') {
        include(Main\Application::getDocumentRoot() . $templateFolder . '/confirm.php');
    } elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET']) {
        include(Main\Application::getDocumentRoot() . $templateFolder . '/empty.php');
    } else {
        Main\UI\Extension::load('phone_auth');
        ?>
        <section class="order" data-controller="order">
            <form class="container" id="order-form">
                <input type="hidden" name="location_type" value="code">
                <div class="order__inner">
                    <div class="order__content">
                        <section class="tabs" data-controller="tabs">
                            <nav class="tabs-nav"><a class="tabs-nav__link active" href="javascript:void(0)"
                                                     data-action="click-&gt;tabs#open" data-tab="new"
                                                     data-target="tabs.nav">Для новых покупателей</a><a
                                        class="tabs-nav__link" href="javascript:void(0)"
                                        data-action="click-&gt;tabs#open" data-tab="has-account" data-target="tabs.nav">Уже
                                    есть аккаунт</a></nav>
                            <section class="tabs-content">
                                <article class="tabs-content__item active" data-target="tabs.content"
                                         data-tab-content="new">
                                    <form class="order-form">
                                        <section class="order-step-section">
                                            <?= $arResult['BASKET_ITEMS_HTML'] ?>
                                            <?= $arResult['PERSON_HTML'] ?>
                                            <?= $arResult['DELIVERY_HTML'] ?>
                                            <?= $arResult['PAY_SYSTEM_HTML'] ?>
                                        </section>
                                        <div class="order-comment">
                                            <label class="field field--textarea" data-controller="field"
                                                   data-target="form.field"><span class="field__placeholder"><span
                                                            class="field__placeholder-text">Комментарий к заказу</span></span>
                                                <textarea class="field__input" name="comment"
                                                          data-target="field.input"
                                                          data-action="input-&gt;field#validate focus-&gt;field#addFocus blur-&gt;field#removeFocus"
                                                          maxlength="100"></textarea>
                                            </label>
                                        </div>
                                    </form>
                                </article>
                                <article class="tabs-content__item" data-target="tabs.content"
                                         data-tab-content="has-account">
                                    <section class="form form--auth">
                                        <h3 class="h3 form__title">Вход</h3>
                                        <form class="form__block" data-controller="form" data-form-method="post">
                                            <div class="form__field">
                                                <label class="field" data-controller="field"
                                                       data-target="form.field"><span
                                                            class="field__placeholder"><span
                                                                class="field__placeholder-text">Email или телефон</span></span>
                                                    <input class="field__input" name="login" type="text"
                                                           data-target="field.input"
                                                           data-action="input-&gt;field#validate focus-&gt;field#addFocus blur-&gt;field#removeFocus">
                                                </label>
                                            </div>
                                            <div class="form__field">
                                                <label class="field" data-controller="field"
                                                       data-target="form.field"><span
                                                            class="field__placeholder"><span
                                                                class="field__placeholder-text">Пароль</span></span>
                                                    <input class="field__input" name="password" type="password"
                                                           data-target="field.input"
                                                           data-action="input-&gt;field#validate focus-&gt;field#addFocus blur-&gt;field#removeFocus">
                                                </label>
                                            </div>
                                            <div class="form__submit">
                                                <button class="button button--submit" type="submit">Войти
                                                </button>
                                            </div>
                                            <div class="form__policy">Нажимая на кнопку «Войти», я даю свое согласие
                                                на обработку персональных данных, с договором публичной оферты и
                                                политикой конфиденциальности ознакомлен и принимаю
                                            </div>
                                        </form>
                                    </section>
                                </article>
                            </section>
                        </section>
                    </div>
                    <?= $arResult['CHECKOUT_HTML'] ?>
                </div>
            </form>
        </section>
    <?
    $signer = new Main\Security\Sign\Signer;
    $signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
    $messages = Loc::loadLanguageFile(__FILE__);
    ?>
        <script>
            BX.message(<?=CUtil::PhpToJSObject($messages)?>);
            BX.Sale.OrderAjaxComponent.init({
                result: <?=CUtil::PhpToJSObject($arResult['JS_DATA'])?>,
                locations: <?=CUtil::PhpToJSObject($arResult['LOCATIONS'])?>,
                params: <?=CUtil::PhpToJSObject($arParams)?>,
                signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
                siteID: '<?=CUtil::JSEscape($component->getSiteId())?>',
                ajaxUrl: '<?=CUtil::JSEscape("/basket/order2/")?>',
                templateFolder: '<?=CUtil::JSEscape($templateFolder)?>',
                propertyValidation: true,
                showWarnings: true,
                pickUpMap: {
                    defaultMapPosition: {
                        lat: 55.76,
                        lon: 37.64,
                        zoom: 7
                    },
                    secureGeoLocation: false,
                    geoLocationMaxTime: 5000,
                    minToShowNearestBlock: 3,
                    nearestPickUpsToShow: 3
                },
                propertyMap: {
                    defaultMapPosition: {
                        lat: 55.76,
                        lon: 37.64,
                        zoom: 7
                    }
                },
                orderBlockId: 'bx-soa-order',
                authBlockId: 'bx-soa-auth',
                basketBlockId: 'bx-soa-basket',
                regionBlockId: 'bx-soa-region',
                paySystemBlockId: 'bx-soa-paysystem',
                deliveryBlockId: 'bx-soa-delivery',
                pickUpBlockId: 'bx-soa-pickup',
                propsBlockId: 'bx-soa-properties',
                totalBlockId: 'bx-soa-total'
            });
        </script>
        <script>
            <?
            // spike: for children of cities we place this prompt
            $city = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();
            ?>
            BX.saleOrderAjax.init(<?=CUtil::PhpToJSObject(array(
                'source' => $component->getPath() . '/get.php',
                'cityTypeId' => intval($city['ID']),
                'messages' => array(
                    'otherLocation' => '--- ' . Loc::getMessage('SOA_OTHER_LOCATION'),
                    'moreInfoLocation' => '--- ' . Loc::getMessage('SOA_NOT_SELECTED_ALT'), // spike: for children of cities we place this prompt
                    'notFoundPrompt' => '<div class="-bx-popup-special-prompt">' . Loc::getMessage('SOA_LOCATION_NOT_FOUND') . '.<br />' . Loc::getMessage('SOA_LOCATION_NOT_FOUND_PROMPT', array(
                            '#ANCHOR#' => '<a href="javascript:void(0)" class="-bx-popup-set-mode-add-loc">',
                            '#ANCHOR_END#' => '</a>'
                        )) . '</div>'
                )
            ))?>);
        </script>
    <?
    if ($arParams['SHOW_PICKUP_MAP'] === 'Y' || $arParams['SHOW_MAP_IN_PROPS'] === 'Y') {
    if ($arParams['PICKUP_MAP_TYPE'] === 'yandex') {
    $this->addExternalJs($templateFolder . '/scripts/yandex_maps.js');
    $apiKey = htmlspecialcharsbx(Main\Config\Option::get('fileman', 'yandex_map_api_key', ''));
    ?>
        <script src="<?= $scheme ?>://api-maps.yandex.ru/2.1.50/?apikey=<?= $apiKey ?>&load=package.full&lang=<?= $locale ?>"></script>
        <script>
            (function bx_ymaps_waiter() {
                if (typeof ymaps !== 'undefined' && BX.Sale && BX.Sale.OrderAjaxComponent)
                    ymaps.ready(BX.proxy(BX.Sale.OrderAjaxComponent.initMaps, BX.Sale.OrderAjaxComponent));
                else
                    setTimeout(bx_ymaps_waiter, 100);
            })();
        </script>
    <?
    }

    if ($arParams['PICKUP_MAP_TYPE'] === 'google') {
    $this->addExternalJs($templateFolder . '/scripts/google_maps.js');
    $apiKey = htmlspecialcharsbx(Main\Config\Option::get('fileman', 'google_map_api_key', ''));
    ?>
        <script async defer
                src="<?= $scheme ?>://maps.googleapis.com/maps/api/js?key=<?= $apiKey ?>&callback=bx_gmaps_waiter">
        </script>
        <script>
            function bx_gmaps_waiter() {
                if (BX.Sale && BX.Sale.OrderAjaxComponent)
                    BX.Sale.OrderAjaxComponent.initMaps();
                else
                    setTimeout(bx_gmaps_waiter, 100);
            }
        </script>
    <?
    }
    }

    if ($arParams['USE_YM_GOALS'] === 'Y') {
    ?>
        <script>
            (function bx_counter_waiter(i) {
                i = i || 0;
                if (i > 50)
                    return;

                if (typeof window['yaCounter<?=$arParams['YM_GOALS_COUNTER']?>'] !== 'undefined')
                    BX.Sale.OrderAjaxComponent.reachGoal('initialization');
                else
                    setTimeout(function () {
                        bx_counter_waiter(++i)
                    }, 100);
            })();
        </script>
        <?
    }
    }
    ?>
</div>
<div id="scripts-order"></div>