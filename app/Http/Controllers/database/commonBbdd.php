<?php
namespace App\Http\Controllers\database;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

class commonBbdd implements InterfaceBbdd{
    protected static string $model = Model::class;

    public static function getModel(){
        return static::$model;
    }
    /**
     * @param array ['column'=>'value']
     */
    public static function insert(array $values) : void{
        static::$model::insert($values);
    }

    /**
     * @return Collection
     */
    public static function getAll() : Collection{
        return static::$model::all();
    }

    /**
     * @param int number of rows for page
     * @return LengthAwarePaginator
     */
    public static function getAllPaginator( int $paginatorNumber) : LengthAwarePaginator{
        return static::$model::paginate($paginatorNumber);
    }

    /**
     * @param int table id
     * @return Collection paginated
     */
    public static function getFromId($id): Collection {
        return static::$model::where('id',$id)->get();
    }

    /**
     * @param string table column
     * @param value column
     * @throws Throwable
     */
    public static function deleteFromColumAndValue($colum,$value) : void{
        try {
            $article = static::$model::where($colum,$value)->firstOrFail();
            $article->delete();
        } catch (Throwable $th) {
            throw new \Exception("sql delete Error, check $colum");
        }
    }

    /**
     * @param int table id
     * @throws Throwable
     */
    public static function deleteFromId($id) : void{
        try {
            $article = static::$model::where('id',$id)->firstOrFail();
            $article->delete();
        } catch (Throwable $th) {
            throw new \Exception('sql delete Error, chech id');
        }
    }
    /**
     * @param array array colums and values ['column'=>'value']
     * @param in table id
     */
    public static function updateValue( array $values,$id) : \Illuminate\Database\Eloquent\Model{
        $article = static::$model::where('id',$id)->firstOrFail();
        $article->update($values);
        return $article;
    }
    /**
     * @param array array columns and values ['column'=>'value']
     * @param string column
     * @param colum value
     */
    public static function updateValueWhereColum(array $values, $column, $value) : \Illuminate\Database\Eloquent\Model{
        $article = static::$model::where($column,$value)->firstOrFail();
        $article->update($values);
        return $article;
    }
}
