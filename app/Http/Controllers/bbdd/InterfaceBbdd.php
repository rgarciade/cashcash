<?php
namespace App\Http\Controllers\bbdd;

interface InterfaceBbdd{
    public function insert(array $request);
    public function getAll();
    public function getFromId($id);
    public function deleteFromId($id);
    public function deleteFromColumAndId(string $colum,$id);
    public function updateValue( array $values,$articleID);
}
