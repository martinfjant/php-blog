<?php

namespace Blogg\Controllers;

use Blogg\Core\Request;

abstract class AbstractController
{
    protected $request;
    protected $view;
    //protected $customerId;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /*public function setCustomerId(int $customerId)
    {
        $this->customerId = $customerId;
    }
    */

    protected function render(string $template, array $params = []): string
    {
        extract($params);

        ob_start();
        include $template;
        $renderedView = ob_get_clean();

        return $renderedView;
    }

    protected function redirect(string $url)
    {
      //  ob_start();
        header('Location: '.$url);
      //  ob_end_flush();
      //  die();
    }
}
