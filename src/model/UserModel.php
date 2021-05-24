<?php
namespace sarassoroberto\usm\model;
use \PDO;
use sarassoroberto\usm\config\local\AppConfig;
use sarassoroberto\usm\entity\User;

class UserModel
{

    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:dbname='.AppConfig::DB_NAME.';host='.AppConfig::DB_HOST, AppConfig::DB_USER, AppConfig::DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // TODO: togliere echo
            echo $e->getMessage();
        }
    }
    //il risultato di un fetch all è SEMPRE una mail

    // CRUD
    public function create(User $user)
    {

        try {
            $pdostm = $this->conn->prepare('INSERT INTO User (firstName,lastName,email,birthday,password)
            VALUES (:firstName,:lastName,:email,:birthday,:password);');

            $pdostm->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
            $pdostm->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
            $pdostm->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
            $pdostm->bindValue(':birthday', $user->getBirthday(), PDO::PARAM_STR);
            $pdostm->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);


            $pdostm->execute();
        } catch (\PDOException $e) {
            // TODO: Evitare echo
            echo $e->getMessage();

        }
    }


    public function readAll()
    {
        $pdostm = $this->conn->prepare('SELECT * FROM User;');
        $pdostm->execute();
        return $pdostm->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,User::class,['','','','','']);
    }

    public function readOne($user_id)
    {
        try {
            $sql = "Select * from User where userId=:user_id";
            $pdostm = $this->conn->prepare($sql);
            $pdostm->bindValue('user_id', $user_id, PDO::PARAM_INT);
            $pdostm->execute();
            $result = $pdostm->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,User::class,['','','','','']);

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
        $pdostm->bindValue(':user_id',$user->getUserId());
       
        
        $pdostm->execute();

        if($pdostm->rowCount() === 0) {
            return false;
        } else if($pdostm->rowCount() === 1){
            return true;
        }
    }

    public function delete(int $user_id):bool
    {
        $sql = "delete from User where userId=:user_id ";
        
        $pdostm = $this->conn->prepare($sql);
        $pdostm->bindValue(':user_id',$user_id,PDO::PARAM_INT);
        $pdostm->execute();

        
        if($pdostm->rowCount() === 0) {
            return false;
        } else if($pdostm->rowCount() === 1){
            return true;
        }


  
    }
            
public function checkEmail($email):bool {
 

        $usermodel = new UserModel(); //mi serve usermodel per fare collegamento a DB
        $sql = "Select email from User where email= :email:"; 
        $pdostm = $this->conn->prepare($sql);
        $pdostm->bindValue(':email', $email, PDO::PARAM_STR);
        $pdostm->execute();
        if($pdostm->rowCount()=== 0){
            return false;
        }
     else if($pdostm->rowCount() === 1) {
        return true;
    }
 
}


public function checkpassword($password):bool {//booleana: se la trova ver, se non la trova fala. in ingresso prende come parametro una password

    $usermodel = new UserModel(); //mi serve usermodel per fare collegamento a DB
    $sql = "Select password from User where email= :email:"; //la query da chiedere al DB
    $pdostm = $this->conn->prepare($sql); //Stringa di connessione al DB
    $pdostm->bindValue(':password', $password, PDO::PARAM_STR); //boh
    $pdostm->execute();//esecuzione della query
    if($pdostm->rowCount()=== 0){//se trova il necessario si connette e ritorna falso
        return false;
    }
 else if($pdostm->rowCount() === 1) {
    return true;
}

}
public function findByEmail(string $email):?User
{
    try {
        $sql = "Select * from User where email=:email";
        $pdostm = $this->conn->prepare($sql);
        $pdostm->bindValue('email', $email, PDO::PARAM_STR);
        $pdostm->execute();
        $result = $pdostm->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, User::class, ['','','','','']);

        return count($result) === 0 ? null : $result[0];

    } catch (\Throwable $th) {
        echo "qualcosa è andato storto";
        echo " ". $th->getMessage();
        //throw $th;
    }
}

public function autenticate($email,$password) {

    //chiamata al Database con la var sql
    $sql = "SELECT * FROM user where email=:email and password=:password";
    $pdostm = $this->conn->prepare($sql);
    $pdostm->bindValue('email', $email, PDO::PARAM_STR );
    $pdostm->bindValue('password', $password, PDO::PARAM_STR );
    $pdostm->execute();
    $result = $pdostm -> fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,User::class,['','','','','']);

    //fetch all crea nella variabile result un array di utente con 5 parametri 
    //sotto controllo 
    return count($result)===0 ? null:$result[0];
}


/*public function autenticate(string $email,string $password):?User
    {
        $user = $this->findByEmail($email);
        if(!is_null($user)) {
            $passwordHash = $user->getPassword();
            return password_verify($password,$passwordHash) ? $user : null;
        }
        return null;
    }*/


      
}
