<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
abstract class Model
{
    public static function find($id)
    {
        $sql = 'SELECT * FROM ' . strtolower(static::class) . ' WHERE id = :id';
        var_dump($sql);
    }

    public function create()
    {
        $cols = get_object_vars($this);

        $values = array_map(fn($item) => ':' . $item, array_keys($cols));

        $sql = 'INSERT INTO ' . strtolower(static::class) . ' (' . implode(', ', array_keys($cols)) . ') VALUES (' . implode(', ', $values) .')';
        return $sql;
    }

    public function delete()
    {
        $sql = 'DELETE * FROM ' . strtolower(static::class) . ' WHERE id = :id';
        return $sql;
    }
    public function update()
    {
        $sql = 'UPDATE * FROM ' . strtolower(static::class) . ' WHERE id = :id';
        return $sql;
    }
    public function save()
    {
        $sql = ' UPDATE '  . strtolower(static::class) . ' SET name = :name, email = '.'email ' . 'WHERE id = :id ';
        return $sql;
        //$this->name. $this->email. $this->id;


    }

}

//user
final class User extends Model
{
    public $id;
    public $name;
    public $email;
}
$user = new User;
$user->id = '1';
$user = User::find(1);
var_dump($user); // SELECT * FROM user WHERE id = :id

$user = new User;
$user->name = 'John';
$result = $user->save();
var_dump($result); // UPDATE user SET name = :name, email = 'email' WHERE id = :id

$result = $user->delete();
var_dump($result); // DELETE user WHERE id = :id

$user = new User;
$user->name = 'John';
$user->email = 'some@gmail.com';
$result = $user->save();
var_dump($result); // INSERT INTO user (id, name, email) VALUES (:id, :name, :email)