<?php
class ServiceController {
    private $serviceModel;
    private $testimonialModel;
    private $branchModel;
    
    public function __construct($conn) {
        $this->serviceModel = new ServiceModel($conn);
        $this->testimonialModel = new TestimonialModel($conn);
        $this->branchModel = new BranchModel($conn);
    }
    
    public function index() {
        // Get data for service page
        $data = [
            'services' => $this->serviceModel->getAllServices(),
            'testimonials' => $this->testimonialModel->getAllTestimonials(),
            'branches' => $this->branchModel->getAllBranches()
        ];
        
        return $data;
    }
}
?>