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

    /**
     * Get list of User Forms
     * 
     * @param type $userId
     * @return type
     */
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

    /**
     * Get User Form Info and Values.
     * 
     * @param type $userId
     * @param type $formId
     * @return type
     */
    public function getUserFormById($userId, $formId)
    {
        $results = $this->build(
                        $this->model->join('form_values', 'form_values.user_form_id', '=', 'user_forms.id')
                                ->join('forms', 'forms.id', '=', 'user_forms.form_id')
                                ->where('forms.id', '=', $formId)
                                ->where('user_forms.user_id', '=', $userId)
                                ->orderBy('form_values.id', 'asc')
                                ->select ('form_values.uuid', 'form_values.value')
                                ->get()
        );
        return $results;
    }
}
