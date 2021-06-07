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
    public static function getFromId($id){
        return static::$model::where('id',$id)->get();
    }
    public static function deleteFromColumAndId($colum,$id) : void{
        try {
            $article = static::$model::where($colum,$id)->firstOrFail();
            $article->delete();
        } catch (\Throwable $th) {
            throw new \Exception("sql delete Error, chech $colum");
        }
    }
    public static function deleteFromId($id) : void{
        try {
            $article = static::$model::where('id',$id)->firstOrFail();
            $article->delete();
        } catch (\Throwable $th) {
            throw new \Exception('sql delete Error, chech id');
        }
    }
    public static function updateValue( array $values,$articleID) : \Illuminate\Database\Eloquent\Model{
        $article = static::$model::where('id',$articleID)->firstOrFail();
        $article->update($values);
        return $article;
    }
}
