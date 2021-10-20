<?php

namespace Letsrock\Actions;

use Letsrock\View;

class PaySystemAction extends AbstractAction
{
    public function modify($data)
    {
        $paySystem = [];
        foreach ($data as $itemData) {
            if (empty($itemData["FIELD_NAME"]))
                $itemData["FIELD_NAME"] = "PAY_SYSTEM_ID";
            $paySystem[$itemData["ID"]] = $itemData;
        }
        $this->data = $paySystem;
    }

    public function getHtml($data)
    {
        $this->modify($data);
        return $this->view->render('pay_system.php', [
            'paySystem' => $this->data
        ]);
    }
}