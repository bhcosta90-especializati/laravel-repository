<?php


namespace App\Traits\Controller;


use Illuminate\Http\Request;
use Illuminate\Routing\Route;

trait BaseController
{
    private $request;

    /**
     * @return mixed
     */
    public function getRequest(): Request
    {
        return $this->request ?? request();
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    protected function getNameRoute(): string
    {
        return Route::currentRouteName();
    }

    protected function getActionName(): string
    {
        $action = app(Route::class);
        return collect(explode('@', $action->getActionName()))->last();
    }

    protected  function getNameView(): string
    {
        $requestUri = substr($this->getRequest()->getRequestUri(), 1);
        $requestUriReplace = str_replace('/', '.', $requestUri);
        $actionName = $this->getActionName();

        if(substr($requestUriReplace, -strlen($actionName)) != $actionName) {
            $requestUriReplace .= ".{$actionName}";
        }

        return $requestUriReplace;
    }
}
