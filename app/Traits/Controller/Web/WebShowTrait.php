<?php


namespace App\Traits\Controller\Web;


use App\Traits\Controller\BaseController;

trait WebShowTrait
{
    use BaseController;

    public function show($id)
    {
        $nameView = str_replace(".{$id}", "", $this->getNameView());
        dd($nameView);
    }
}
