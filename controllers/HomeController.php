<?php
class HomeController {
    private $conn;
    private $promoModel;
    private $blogModel;
    private $serviceModel;
    private $testimonialModel;

    public function __construct($db) {
        $this->conn = $db;
        $this->promoModel = new PromoModel($db);
        $this->blogModel = new BlogModel($db);
        $this->serviceModel = new ServiceModel($db);
        $this->testimonialModel = new TestimonialModel($db);
    }

    public function index() {
        $featuredPromotions = $this->promoModel->getFeaturedPromotions();
        $services = $this->serviceModel->getAllServices();
        $promotions = $this->promoModel->getActivePromotions(); // Pastikan method ini ada di PromoModel
        $testimonials = $this->testimonialModel->getFeaturedTestimonials();
        $recentBlogs = $this->blogModel->getRecentBlogs(3);
        
        return [
            'featuredPromotions' => $featuredPromotions,
            'services' => $services,
            'promotions' => $promotions,
            'testimonials' => $testimonials,
            'recentBlogs' => $recentBlogs
        ];
    }
}
?>