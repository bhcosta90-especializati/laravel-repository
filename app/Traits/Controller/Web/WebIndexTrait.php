<?php


namespace App\Traits\Controller\Web;


use App\Traits\Controller\BaseController;

trait WebIndexTrait
{
    use BaseController;

    public function index()
    {
        dd($this->getNameView());
    }
}
