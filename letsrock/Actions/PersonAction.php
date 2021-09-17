<?php

namespace Letsrock\Actions;
use Letsrock\View;

class PersonAction extends AbstractAction
{
    public function modify($data)
    {
        $person = [];
        $person['FIO'] = $this->searchPropertyByKey($data, 'FIO');
        $person['EMAIL'] = $this->searchPropertyByKey($data, 'CODE');
        $person['PHONE'] = $this->searchPropertyByKey($data, 'PHONE');

        $this->data = $person;
    }

    public function getHtml($data)
    {
        $this->modify($data);
        return $this->view->render('person.php', [
            'person' => $this->data
        ]);
    }

    private function searchPropertyByKey($data, $code, $fieldName = 'VALUE')
    {
        return current(array_filter($data, function ($item) use ($code, $fieldName) {
            return $item['CODE'] == $code;
        }))[$fieldName];
    }
}