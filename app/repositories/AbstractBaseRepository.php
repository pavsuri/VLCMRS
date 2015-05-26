<?php 

namespace repositories;

use Util;

abstract class AbstractBaseRepository
{
  /**
   * Eloquent model
   *
   * @var mixed
   */
  protected $model;

  /**
   * Injected Laravel DB object.
   *
   * @var DatabaseManager
   */
  protected $db;

  /**
   * Name of the table in the database.
   *
   * @var string
   */
  protected $table;

  /**
   * Collection of relationships in which to eager load when querying
   *
   * @var array
   */
  protected $relationships = [];

  /**
   * @param mixed $model Eloquent model
   */
  function __construct($model)
  {
    $this->model = $model;
  }

  /**
   * Initialize additional properties and objects.
   *
   * @return void
   */
  protected function boot()
  {
    $this->db = App::make('Illuminate\Database\DatabaseManager');
    $this->table = $this->model->getTable();
  }

  /**
   * Perform loading of data source, such as applying eager loading logic.
   *
   * @param  string|array $relationships either single or multiple relationships
   * @return mixed  base object of data source with applied logic
   */
  protected function load($relationships = null)
  {
    // if more relationships where passed, then add them
    if ($relationships) $this->with($relationships);
    return $this->model->with($this->relationships);
  }

  /**
   * Build the result into a clean object with iteration ability.
   *
   * @param  mixed $results typically an Eloquent object
   * @return stdObject  basic object, nested is needed
   */
  protected function build($results)
  {
    $resultsArray = [];

    // clear the relationships stored, otherwise the same relationships
    // will be applied to all future queries through this repo instance
    $this->relationships = [];

    // if there are no results, simply return null
    if (!$results) {
      return null;
    }

    // if the results object has a "toArray()" method
    // we can use it to build an array of the Eloquent object
    // otherwise, we'll need to create an array by hand
    if (!is_callable($results, 'toArray')) {
      $resultsArray = Util\Obj::objectToArray($results);
    } else {
      $resultsArray = $results->toArray();
    }

    // return our clean object, with no ties to Eloquent
    return Util\Obj::arrayToObject($resultsArray);
  }

  /**
   * Specify relationships in which to eager load when querying.
   *
   * @param  string|array $relationships either single or multiple relationships
   * @return self                to allow method chaining
   */
  public function with($relationships)
  {
    $relationships = (array) $relationships;
    foreach ($relationships as $relationship) $this->relationships[] = $relationship;
    return $this;
  }

  /**
   * Get all from model.
   *
   * @return mixed  all results from model
   */
  public function getAll()
  {
    return $this->build(
      $this->load()->get()
    );
  }

  /**
   * Get a specific record by its unique ID.
   *
   * @param  integer $id identifier for model record
   * @return mixed  model result for specified id
   */
  public function getById($id)
  {
    return $this->build(
      $this->load()->where('id', $id)->first()
    );
  }

  /**
   * Insert a new record into the database.
   *
   * @param  array  $attributes mass assignments
   * @return boolean  success in inserting
   */
  public function insert($attributes = [])
  {
    return $this->save($this->create($attributes));
  }

  /**
   * Insert a new record into the database and retrieve the ID inserted.
   *
   * @param  array  $attributes mass assignments
   * @return integer|null  the ID of the inserted record, or null if failed
   */
  public function insertGetId($attributes = [])
  {
    $model = $this->create($attributes);

    if ($this->save($model)) {
      return $model->id;
    }

    return null;
  }

  /**
   * Insert a new record into the database and retrieve the inserted object.
   *
   * @param  array  $attributes mass assignments
   * @return stdObject|null  basic object, nested is needed
   */
  public function insertGet($attributes = [])
  {
    $model = $this->create($attributes);

    if ($this->save($model)) {
      return $this->build($model);
    }

    return null;
  }

  /**
   * Perform a bulk insert of records.
   *
   * @param  array $items collection of items ready to be created
   * @return boolean  whether insert was successful or not
   */
  public function bulkInsert($items = [])
  {
    return DB::table('users')->insert($items);
  }

  /**
   * Update a model record in the database.
   *
   * @param  integer  $id id of the modal record
   * @param  array  $attributes mass assignments
   * @return boolean        success in updating
   */
  public function update($id, $attributes = [])
  {
    $eloquentRecord = $this->model->find($id);
    return $eloquentRecord->update($attributes);
  }

  /**
   * Delete a model record, or many.
   *
   * @param  mixed $modelId should be an integer or an array of integers
   * @param  boolean $force whether the deletion should be forced (to disable softDelete)
   * @return boolean  success in deletion
   */
  public function delete($modelId)
  {
    $modelIds = (array) $modelId;
    return $this->model->destroy($modelIds);
  }

  /**
   * Perform a manual save on the model instance.
   *
   * @param  mixed $model the model to be manually saved (can be inserting or updating)
   * @return bool  true if successful, false otherwise
   */
  public function save($model)
  {
    return $model->save();
  }

  /**
   * Create a new instance of the model and return it.
   *
   * @param  array  $attributes mass assignments
   * @return mixed  the new model instance
   */
  protected function create($attributes = [])
  {
    return $this->model->newInstance($attributes);
  }

}
