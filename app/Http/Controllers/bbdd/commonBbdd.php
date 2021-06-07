<?php
namespace App\Http\Controllers\bbdd;
use Illuminate\Database\Eloquent\Model;

class commonBbdd implements InterfaceBbdd{
    protected static $model = Model::class;

    public static function getModel(){
        return static::$model;
    }
    public static function insert(array $values){
        return static::$model::insert($values);
    }
    public static function getAll(){
        return static::$model::all();
    }
    public static function getAllPaginator($paginatorNumber){
        return static::$model::paginate($paginatorNumber);
    }
    public static function getFromId($id){
        return static::$model::where('id',$id)->get();
    }
    public static function deleteFromColumAndId($colum,$id){
        try {
            $article = static::$model::where($colum,$id)->firstOrFail();
            $article->delete();
        } catch (\Throwable $th) {
            throw new \Exception("sql delete Error, chech $colum");
        }
    }
    public static function deleteFromId($id){
        try {
            $article = static::$model::where('id',$id)->firstOrFail();
            $article->delete();
        } catch (\Throwable $th) {
            throw new \Exception('sql delete Error, chech id');
        }
    }
    public static function updateValue( array $values,$articleID){
        $article = static::$model::where('id',$articleID)->firstOrFail();
        $article->update($values);
        return $article;
    }
}
