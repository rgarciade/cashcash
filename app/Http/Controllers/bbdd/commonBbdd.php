<?php
namespace App\Http\Controllers\bbdd;
use Illuminate\Database\Eloquent\Model as model;

class commonBbdd implements InterfaceBbdd{
    const model = null;
    function __construct() {
        $this->model = new model();
    }
    public function getModel(){
        return new model();
    }
    public function insert(array $values){
        return $this->model::insert($values);
    }
    public function getAll(){
        return $this->model::all();
    }
    public function getAllPaginator($paginatorNumber){
        return $this->model::paginate($paginatorNumber);
    }
    public function getFromId($id){
        return $this->model::where('id',$id)->get();
    }
    public function deleteFromColumAndId($colum,$id){
        try {
            $article = $this->model::where($colum,$id)->firstOrFail();
            $article->delete();
        } catch (\Throwable $th) {
            throw new \Exception("sql delete Error, chech $colum");
        }
    }
    public function deleteFromId($id){
        try {
            $article = $this->model::where('id',$id)->firstOrFail();
            $article->delete();
        } catch (\Throwable $th) {
            throw new \Exception('sql delete Error, chech id');
        }
    }
    public function updateValue( array $values,$articleID){
        $article = $this->model::where('id',$articleID)->firstOrFail();
        $article->update($values);
        return $article;
    }
}
