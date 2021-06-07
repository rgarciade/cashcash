<?php
namespace App\Http\Controllers\database;
use Illuminate\Database\Eloquent\Model;

class commonBbdd implements InterfaceBbdd{
    protected static $model = Model::class;

    public static function getModel(){
        return static::$model;
    }
    /**
     * @param array ['colum'=>'value']
     */
    public static function insert(array $values) : void{
        static::$model::insert($values);
    }
    /**
     * @return all rows
     */
    public static function getAll() : \Illuminate\Database\Eloquent\Collection{
        return static::$model::all();
    }
    /**
     * @param int number of rows for page
     * @return all rows paginated
     */
    public static function getAllPaginator( int $paginatorNumber) : \Illuminate\Pagination\LengthAwarePaginator{
        return static::$model::paginate($paginatorNumber);
    }
    /**
     * @param int table id
     * @return row paginated
     */
    public static function getFromId($id): \Illuminate\Database\Eloquent\Collection {
        return static::$model::where('id',$id)->get();
    }
    /**
     * @param string table colum
     * @param value colum
     */
    public static function deleteFromColumAndValue($colum,$value) : void{
        try {
            $article = static::$model::where($colum,$value)->firstOrFail();
            $article->delete();
        } catch (\Throwable $th) {
            throw new \Exception("sql delete Error, chech $colum");
        }
    }
    /**
     * @param int table id
     */
    public static function deleteFromId($id) : void{
        try {
            $article = static::$model::where('id',$id)->firstOrFail();
            $article->delete();
        } catch (\Throwable $th) {
            throw new \Exception('sql delete Error, chech id');
        }
    }
    /**
     * @param array array colums and values ['colum'=>'value']
     * @param in table id
     */
    public static function updateValue( array $values,$id) : \Illuminate\Database\Eloquent\Model{
        $article = static::$model::where('id',$id)->firstOrFail();
        $article->update($values);
        return $article;
    }
    /**
     * @param array array colums and values ['colum'=>'value']
     * @param string colum
     * @param colum value
     */
    public static function updateValueWhereColum( array $values,$colum,$value) : \Illuminate\Database\Eloquent\Model{
        $article = static::$model::where($colum,$value)->firstOrFail();
        $article->update($values);
        return $article;
    }
}
