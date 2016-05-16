<?php

namespace lemosweb\DB;

abstract class Table
{
	protected $db;
	protected $table;


    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function fetchAll()
    {
        $query = "select * from ".$this->table;

        return $this->db->query($query);

    }

    public function find($id)
    {
        $query = "select * from ".$this->table." where id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }

    public function delete($id)
    {
        $query = "delete from ".$this->table." where id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return true;

    }

    public function insert(array $data)
    {

        $fields =  implode(", ", array_keys($data));
        $bindValues = ":".implode(" , :", array_keys($data));
        $values = array_values($data);
        $keys = array_keys($data);

        $query = "insert into ".$this->table." (".$fields.") values (".$bindValues.")";

        $stmt = $this->db->prepare($query);

        for($i = 0; $i < count($data); $i++):

            $stmt->bindValue(':'.$keys[$i], $values[$i]);

        endfor;

        $stmt->execute();

        return true;

    }

    public function update($id, array $data)
    {

        $values = array_values($data);
        $keys = array_keys($data);

        $query = "UPDATE {$this->table} SET {$this->bindsValuesSQL($data)} WHERE id = :id";

        $stmt = $this->db->prepare($query);

        for($i = 0; $i < count($data); $i++):

            $stmt->bindValue(':'.$keys[$i], $values[$i]);

        endfor;

            $stmt->bindValue(':id', $id);

        $stmt->execute();

        return true;

    }

    /*
     * TRATA OS CAMPOS E BINDVALUES PARA UPDATE
     */
    private function bindsValuesSQL(array $data)
    {
        $binds = array_keys($data);

        $mixValues[] = null;

        for($i = 0; $i < count($binds); $i ++):

            $mixValues[$i] = $binds[$i].' = :'.$binds[$i];

        endfor;

        $mix = implode(", ", $mixValues);

        return $mix;
    }




}