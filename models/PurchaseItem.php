<?php
namespace Models;

use Core\Database;

class PurchaseItem extends Model {
    protected string $table = 'purchase_items';
    protected array $fillable = ['purchase_id','product_id','qty','unit_cost','subtotal'];

    public function itemsByPurchase(int $purchaseId): array {
        $pdo = Database::pdo();
        $stmt = $pdo->prepare("SELECT i.*, p.name AS product_name FROM purchase_items i
                               JOIN products p ON p.id = i.product_id
                               WHERE i.purchase_id = ?");
        $stmt->execute([$purchaseId]);
        return $stmt->fetchAll();
    }
}
