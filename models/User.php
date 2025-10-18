<?php
namespace Models;

use Core\Database;

class User extends Model {
    protected string $table = 'users';
    protected array $fillable = ['name','email','password_hash','role'];

    public function findByEmail(string $email) {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
