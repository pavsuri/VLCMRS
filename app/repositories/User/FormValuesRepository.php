<?php

namespace repositories\User;

use models\FormValues;

class FormValuesRepository extends \repositories\AbstractBaseRepository
{

    /**
     * User model
     *
     * @var mixed
     */
    protected $model;

    /**
     * Constructor
     * 
     * @param User $model
     */
    function __construct(FormValues $model) {
        $this->model = $model;
    }

}
