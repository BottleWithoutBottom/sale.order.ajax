<?php

namespace Letsrock\Actions;
use Letsrock\View;

class BasketItemsAction extends AbstractAction
{
    public function modify($data)
    {
        $this->data = $data;
    }

    public function getHtml($data)
    {
        $this->modify($data);
        return $this->view->render('basket_items.php', [
            'basketItems' => $this->data
        ]);
    }
}