<?php 

namespace sarassoroberto\usm\model;

use \PDO;
use sarassoroberto\usm\config\local\AppConfig;
use sarassoroberto\usm\entity\Interesse;
use sarassoroberto\usm\entity\User;


class InteresseModel
{
    private $conn;
    
    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:dbname='.AppConfig::DB_NAME.';host='.AppConfig::DB_HOST, AppConfig::DB_USER, AppConfig::DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // TODO: togliere echo
            echo $e->getMessage();
        }
    }




// CRUD
public function create(Interesse $interesse)
{
    try {
        $pdostm = $this->conn->prepare('INSERT INTO Interesse (nome)
        VALUES (:nome);');

        $pdostm->bindValue(':nome', $interesse->getNome(), PDO::PARAM_STR);

        $pdostm->execute();

    } catch (\PDOException $e) {
        
        throw $e;
    }
}

public function AddInterest(int $interesseId, int $user_Id)
{
    try {
        $pdostm = $this->conn->prepare('INSERT INTO user_interesse (InteresseId, UserId)
        VALUES (:interesseId, :user_Id);');

        $pdostm->bindValue(':interesseId', $interesseId, PDO::PARAM_STR);
        $pdostm->bindValue(':user_Id', $user_Id, PDO::PARAM_STR);
        $pdostm->execute();

    } catch (\PDOException $e) {
        
        throw $e;
    }
}

public function readAll()
    {
        $pdostm = $this->conn->prepare('SELECT * FROM Interesse;');
        $pdostm->execute();
        return $pdostm->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Interesse::class, ['','']);
    }

    public function readOne($user_id)
    {
        try {
            $sql = "Select * from User where userId=:user_id";
            $pdostm = $this->conn->prepare($sql);
            $pdostm->bindValue('user_id', $user_id, PDO::PARAM_INT);
            $pdostm->execute();
            $result = $pdostm->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, User::class, ['','','','','']);

            return count($result) === 0 ? null : $result[0];
        } catch (\Throwable $th) {
            echo "qualcosa è andato storto";
            echo " ". $th->getMessage();
            //throw $th;
        }
    }


    public function update($user)
    {
        $sql = "UPDATE User set firstName=:firstName, 
                                lastName=:lastName,
                                email=:email,
                                birthday=:birthday
                                where userId=:user_id;";
        $pdostm = $this->conn->prepare($sql);
        $pdostm->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
        $pdostm->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
        $pdostm->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $pdostm->bindValue(':birthday', $user->getBirthday(), PDO::PARAM_STR);
        $pdostm->bindValue(':user_id', $user->getUserId());
        
        try {
            $pdostm->execute();

            if ($pdostm->rowCount() === 0) {
                return false;
            } elseif ($pdostm->rowCount() === 1) {
                return true;
            }
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete(int $interesseId):bool
    {
        $sql = "delete from Interesse where InteresseId=:interesseId ";
        
        $pdostm = $this->conn->prepare($sql);
        $pdostm->bindValue(':InteresseId', $interesseId, PDO::PARAM_INT);
        $pdostm->execute();

        
        if ($pdostm->rowCount() === 0) {
            return false;
        } elseif ($pdostm->rowCount() === 1) {
            return true;
        }
    }

}


?>