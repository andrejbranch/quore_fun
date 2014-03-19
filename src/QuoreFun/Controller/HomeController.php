<?php

namespace QuoreFun\Controller;

class HomeController extends QuoreController
{
    public function getHomepage($request, $response)
    {
        $this->returnHtmlResponse('layout.html', $response);
    }
}