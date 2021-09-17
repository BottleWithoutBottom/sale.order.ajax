<?php

namespace Letsrock;

class View
{
    /**
     * @param string $viewName - название view
     * @param array $params - массив значений, которые будут преобразованы в переменные
     */
    public function render(string $viewName, $params = [])
    {
        if (empty($viewName)) return false;

        if (!empty($params)) extract($params);
        ob_start();
        require($_SERVER['DOCUMENT_ROOT'] . '/local/components/bitrix/sale.order.ajax/views/' . $viewName);
        return ob_get_clean();
    }
}