<?php

namespace repositories;

use models\FormList;

use \Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;
class FormListRepository extends AbstractBaseRepository
{
    
  protected $model;
  
/**
   * Constructor
   * 
   * @param Form $model
   */
  public function __construct(FormList $model)
  {
    $this->model = $model;
  }
  
  public function getCategoryForms() 
  {
    //select group_concat(t1.name),t1.type_id as form_type_id, t2.form_type, group_concat(t1.id) as form_id from forms as t1
//left join form_types as t2 on t1.type_id = t2.id where t1.status=active group by t1.type_id order by t2.id asc  
      
      //SELECT * FROM forms left join form_types on forms.type_id=form_types.id where forms.status=active
      //$pdo = DB::connection('coliban')->pdo;
      //$sql = "select * from forms";
      //$results = $pdo->exec( $sql );
//    $results = $this->build(
//                    $this->model->select ('*')
//                                ->leftJoin('form_types', 'forms.type_id', '=', 'form_types.id')
//                                ->where('forms.status', '=', 'active')
//                                ->groupby('forms.type_id')                                
//                                ->get()
//    );
      $results = DB::select('select group_concat(t1.name) as form_names,t1.type_id as form_type_id, t2.form_type as category_name, group_concat(t1.id) as form_ids from forms as t1
left join form_types as t2 on t1.type_id = t2.id where t1.status=active group by t1.type_id order by t2.id asc');
    return $results;        
  }

}
