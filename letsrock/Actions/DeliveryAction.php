<?php

namespace Letsrock\Actions;
use Letsrock\View;

class DeliveryAction extends AbstractAction
{
    public function modify($data)
    {
        $this->data = $data;
    }

    public function getHtml($data)
    {
        $this->modify($data);
        return $this->view->render('delivery_block.php', [
            'delivery' => $this->data
        ]);
    }
}