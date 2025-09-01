<?php
class PromoController {
    private $promoModel;
    
    public function __construct($conn) {
        $this->promoModel = new PromoModel($conn);
    }
    
    public function index() {
        return $this->promoModel->getAllPromotions();
    }
    
    public function create($data) {
        return $this->promoModel->createPromotion($data);
    }
    
    public function edit($id) {
        return $this->promoModel->getPromotionById($id);
    }
    
    public function update($id, $data) {
        return $this->promoModel->updatePromotion($id, $data);
    }
    
    public function delete($id) {
        return $this->promoModel->deletePromotion($id);
    }
    
    public function toggleStatus($id) {
        return $this->promoModel->togglePromotionStatus($id);
    }
}
?>