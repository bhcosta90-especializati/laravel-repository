<?php


namespace App\Traits\Controller\Web;


use App\Traits\Controller\BaseController;

trait WebEditTrait
{
    use BaseController;

    public function edit($id)
    {
        $nameView = str_replace(".{$id}", "", $this->getNameView());
        dd($nameView);
    }
}
