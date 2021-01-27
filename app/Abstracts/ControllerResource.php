<?php


namespace App\Abstracts;


use App\Traits\Controller\Web\{WebCreateTrait, WebEditTrait, WebIndexTrait, WebShowTrait};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class ControllerResource
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use WebIndexTrait, WebCreateTrait, WebEditTrait, WebShowTrait;
}
