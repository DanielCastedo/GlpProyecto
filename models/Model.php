<?php
namespace Models;
use Core\Database;

abstract class Model {
    protected string $table;
    protected array $fillable = [];
    public function all(): array {
        $stmt = Database::pdo()->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll();
    }
    public function find(int $id): ?array {
        $stmt = Database::pdo()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]); $row = $stmt->fetch();
        return $row ?: null;
    }
    public function create(array $data): int {
        $data = array_intersect_key($data, array_flip($this->fillable));
        $cols = array_keys($data);
        $placeholders = implode(',', array_fill(0, count($cols), '?'));
        $sql = "INSERT INTO {$this->table} (" . implode(',', $cols) . ") VALUES ({$placeholders})";
        $stmt = Database::pdo()->prepare($sql); $stmt->execute(array_values($data));
        return (int) Database::pdo()->lastInsertId();
    }
    public function update(int $id, array $data): bool {
        $data = array_intersect_key($data, array_flip($this->fillable));
        $sets = implode(',', array_map(fn($c)=>"$c = ?", array_keys($data)));
        $sql = "UPDATE {$this->table} SET {$sets} WHERE id = ?";
        $stmt = Database::pdo()->prepare($sql);
        return $stmt->execute([...array_values($data), $id]);
    }
    public function delete(int $id): bool {
        $stmt = Database::pdo()->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
