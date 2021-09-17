<?php

namespace Letsrock\Actions;

class CheckoutAction extends AbstractAction
{
    public function modify($data)
    {
        $this->data = $data;
        $this->data['ALL_QUANTITY'] = array_reduce($data['ALL_QUANTITY'], function($carry, $item) {
            return $carry +=$item;
        }, 0);
    }

    public function getHtml($data)
    {
        $this->modify($data);
        return $this->view->render('checkout.php', [
            'data' => $this->data
        ]);
    }
}