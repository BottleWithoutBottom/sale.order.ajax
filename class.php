<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
require(__DIR__ . '/vendor/autoload.php');
use Bitrock\LetsEnv;
use Letsrock\Actions\PersonAction;
use Letsrock\Actions\BasketItemsAction;
use Letsrock\Actions\CheckoutAction;
use Bitrix\Main;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Sale;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/components/bitrix/sale.order.ajax/class.php");
$letsEnv = LetsEnv::getInstance();
$letsEnv->parseConfiguration(__DIR__ . '/');

class LetsrockSaleOrderAjax extends SaleOrderAjax
{
    public function executeComponent()
    {
        global $APPLICATION;

        $this->setFrameMode(false);
        $this->context = Main\Application::getInstance()->getContext();
        $this->checkSession = $this->arParams["DELIVERY_NO_SESSION"] == "N" || check_bitrix_sessid();
        $this->isRequestViaAjax = $this->request->isPost() && $this->request->get('via_ajax') == 'Y';
        $isAjaxRequest = $this->request["is_ajax_post"] == "Y";
        if ($isAjaxRequest)
            $APPLICATION->RestartBuffer();

        $this->action = $this->prepareAction();
        Sale\Compatible\DiscountCompatibility::stopUsageCompatible();
        $this->doAction($this->action);
        Sale\Compatible\DiscountCompatibility::revertUsageCompatible();

        if (!$isAjaxRequest)
        {
            CJSCore::Init(['fx', 'popup', 'window', 'ajax', 'date']);
        }
        //is included in all cases for old template
        $this->getHtmls();
        $this->includeComponentTemplate();
    }

    private function getHtmls()
    {
        $basketAction = new BasketItemsAction();
        $this->arResult['BASKET_ITEMS_HTML'] = $basketAction->getHtml($this->arResult['BASKET_ITEMS']);
        $personAction = new PersonAction();
        $this->arResult['PERSON_HTML'] = $personAction->getHtml($this->arResult['ORDER_PROP']['USER_PROPS_Y']);

        $checkoutData = [
            'BASKET_ITEMS' => $this->arResult['BASKET_ITEMS'],
            'DELIVERY_PRICE' => $this->arResult['DELIVERY_PRICE'],
            'ORDER_PRICE' => $this->arResult['ORDER_PRICE'],
            'ALL_QUANTITY' => $this->arUserResult['QUANTITY_LIST']
        ];
        $checkoutAction = new CheckoutAction();
        $this->arResult['CHECKOUT_HTML'] = $checkoutAction->getHtml($checkoutData);
    }
}