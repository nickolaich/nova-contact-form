<?php

namespace Nickolaich\NovaContactForm\Contracts;

interface IContactFormModel
{

    /**
     * @return string|mixed
     */
    public function getDefaultStatus();

    /**
     * @return mixed
     */
    public function getStatusOptions();
}