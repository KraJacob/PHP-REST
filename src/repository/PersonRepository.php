<?php 
namespace Src\repository;

use PDOException;

class PersonRepository{
    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $statement = "
            SELECT id, firstname, lastname, firstparent_id, secondparent_id
            FROM
                person;
        ";

        try{
            $statement = $this->db->query($statement);
            return $statement->fecthAll(\PDO::FETCH_ASSOC);
        }catch(PDOException $ex){
            exit($ex->getMessage());
        }
    }

    public function getOne($id)
    {
        $statement = "
        SELECT id, firstname, lastname, firstparent_id, secondparent_id
        FROM
            person where id = ?;
        ";

        try{
           $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $ex){
            exit($ex->getMessage());
        };
    }

    public function insert(Array $data)
    {
        $statement = "
            INSERT INTO person 
                (firstname, lastname, firstparent_id, secondparent_id)
            VALUES
                (:firstname, :lastname, :firstparent_id, :secondparent_id);
        ";

        try{
            $statement = $statement->$this->db->prepare($statement);
            $statement->execute(array(
                'firstname'=>$data['firstname'],
                'lastname'=>$data['lastname'],
                'firstparent_id'=>$data['firstparent_id'],
                'secondparent_id'=>$data['secondparent_id'],
            ));

            return $statement->rowCount();
        }catch(PDOException $ex){
            exit($ex->getMessage());
        }
    }

    public function update($id, Array $input)
    {
        $statement = "
            UPDATE person
            SET 
                firstname = :firstname,
                lastname  = :lastname,
                firstparent_id = :firstparent_id,
                secondparent_id = :secondparent_id
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'id' => (int) $id,
                'firstname' => $input['firstname'],
                'lastname'  => $input['lastname'],
                'firstparent_id' => $input['firstparent_id'] ?? null,
                'secondparent_id' => $input['secondparent_id'] ?? null,
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function delete($id)
    {
        $statement = "
            DELETE FROM person
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('id' => $id));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

}