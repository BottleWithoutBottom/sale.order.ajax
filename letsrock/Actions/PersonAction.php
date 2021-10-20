<?php

namespace Letsrock\Actions;
use Letsrock\View;

class PersonAction extends AbstractAction
{
    protected $personBlock = [];
    public function modify($data)
    {
        $person = [];
        $person['FIO'] = $this->searchPropertyByKey($data, 'FIO');
        $person['EMAIL'] = $this->searchPropertyByKey($data, 'CODE');
        $person['PHONE'] = $this->searchPropertyByKey($data, 'PHONE');
        $personBlock = array_chunk($data['ORDER_PROP']['USER_PROPS_Y'], 2);
        $this->data = $data;
        $this->personBlock = $personBlock;
    }

    public function getHtml($data)
    {
        $this->modify($data);
        return $this->view->render('person.php', [
            'personBlock' => $this->personBlock,
            'arResult' => $this->data
        ]);
    }

    private function searchPropertyByKey($data, $code, $fieldName = 'VALUE')
    {
        return current(array_filter($data, function ($item) use ($code, $fieldName) {
            return $item['CODE'] == $code;
        }))[$fieldName];
    }
}