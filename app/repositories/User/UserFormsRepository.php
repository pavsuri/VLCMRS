<?php

namespace repositories\User;

use models\UserForms;

class UserFormsRepository extends \repositories\AbstractBaseRepository
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
    function __construct(UserForms $model) {
        $this->model = $model;
    }

    public function getUserForms($userId) 
    {
        $results = $this->build(
                        $this->model->rightjoin('form_types', 'user_forms.form_type_id', '=', 'form_types.id')
                                ->where('user_id', '=', $userId)
                                ->orderBy('form_types.form_type', 'asc')
                                ->select ('form_types.*', new \Illuminate\Database\Query\Expression('count(user_forms.id) as total'))
                                ->groupBy('user_forms.form_type_id')
                                ->get()
        );
        return $results;
    }


}
