<?php

namespace Nickolaich\NovaContactForm\Services;

use Illuminate\Http\Request;
use Nickolaich\NovaContactForm\Contracts\IContactFormModel;
use Nickolaich\NovaContactForm\Contracts\IContactFormNotification;
use Nickolaich\NovaContactForm\Contracts\IContactFormService;
use Nickolaich\NovaContactForm\Models\ContactFormModel;

class NovaContactFormService implements IContactFormService
{

    /**
     * @return IContactFormModel
     */
    public function getModelInstance():IContactFormModel
    {
        return new ContactFormModel();
    }

    /**
     * @param $list
     * @return bool
     */
    public function isValid(Request $request)
    {
        if ($request->name && ($request->email || $request->phone)){
            return true;
        }
        return false;
    }

    /**
     * @param $list
     * @return null|IContactFormModel
     */
    public function submit(Request $request):?IContactFormModel
    {
        $contact = $this->getModelInstance();

        $input = array_map(function($item){
            // html not allowed for non empty value, otherwise leave item value (null/0/false etc)
            return is_string($item) && $item ? htmlentities($item) : $item;
        }, $request->input());
        $contact->fill($input);
        $contact->status = $contact->getDefaultStatus();
        $contact->save();
        return $contact;
    }

    /**
     * @param IContactFormModel $model
     * @param Request $request
     * @return mixed
     */
    public function notify(IContactFormModel $model, Request $request)
    {
        $model->notify(app(IContactFormNotification::class, ['opts'=>['body'=>$model->description]]));
    }

}