<?php
namespace Nickolaich\NovaContactForm\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Nickolaich\NovaContactForm\Contracts\IContactFormService;

class ContactController extends Controller
{

    /**
     * Submit contact form
     * @param IContactFormService $service
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Nickolaich\NovaContactForm\Contracts\IContactFormModel|null
     */
    public function submit(IContactFormService $service, Request $request)
    {
        if (!$service->isValid($request) || !($model = $service->submit($request)) ){
            return response()->json('Invalid request data', 422);
        }
        $service->notify($model, $request);
        return $model;
    }
}