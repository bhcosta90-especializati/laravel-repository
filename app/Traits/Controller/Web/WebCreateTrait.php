<?php


namespace App\Traits\Controller\Web;


use App\Traits\Controller\BaseController;

trait WebCreateTrait
{
    use BaseController;

    public function create()
    {
        dd($this->getNameView());
    }
}
