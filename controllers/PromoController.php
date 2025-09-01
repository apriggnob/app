<?php
class PromoController {
    private $promoModel;
    
    public function __construct($conn) {
        $this->promoModel = new PromoModel($conn);
    }
    
    public function index() {
        // Get all promotions for promo page
        $data = [
            'featuredPromotions' => $this->promoModel->getFeaturedPromotions(),
            'promotions' => $this->promoModel->getAllPromotions()
        ];
        
        return $data;
    }
    
    public function detail($id) {
        // Get single promotion detail
        $data = [
            'promo' => $this->promoModel->getPromotionById($id)
        ];
        
        return $data;
    }
}
?>