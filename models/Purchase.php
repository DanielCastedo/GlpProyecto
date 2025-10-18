<?php
namespace Models;

use Core\Database;

class Purchase extends Model {
    protected string $table = 'purchases';
    protected array $fillable = ['date','supplier','driver_id','truck_id','total','status'];

    // Obtener todos con nombre del chofer y camión
    public function allWithRelations(): array {
        $pdo = Database::pdo();
        $sql = "SELECT p.*, d.name AS driver_name, t.plate AS truck_plate
                FROM purchases p
                LEFT JOIN drivers d ON d.id = p.driver_id
                LEFT JOIN trucks t ON t.id = p.truck_id
                ORDER BY p.date DESC, p.id DESC";
        return $pdo->query($sql)->fetchAll();
    }

    public function recalculateTotal(int $purchaseId): void {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare("SELECT SUM(subtotal) AS total FROM purchase_items WHERE purchase_id = ?");
        $stmt->execute([$purchaseId]);
        $total = (float)($stmt->fetch()['total'] ?? 0);
        $pdo->prepare("UPDATE purchases SET total=? WHERE id=?")->execute([$total, $purchaseId]);
    }
}
