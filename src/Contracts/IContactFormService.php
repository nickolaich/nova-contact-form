<?php

namespace Nickolaich\NovaContactForm\Contracts;

use Illuminate\Http\Request;

interface IContactFormService
{

    /**
     * @return IContactFormModel
     */
    public function getModelInstance():IContactFormModel;

    /**
     * @param Request $request
     * @return bool
     */
    public function isValid(Request $request);

    /**
     * @param $list
     * @return null|IContactFormModel
     */
    public function submit(Request $request):?IContactFormModel;

    /**
     * @param IContactFormModel $model
     * @param Request $request
     * @return mixed
     */
    public function notify(IContactFormModel $model, Request $request);

}