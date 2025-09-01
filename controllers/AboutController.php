<?php
class AboutController {
    private $branchModel;
    private $testimonialModel;
    
    public function __construct($conn) {
        $this->branchModel = new BranchModel($conn);
        $this->testimonialModel = new TestimonialModel($conn);
    }
    
    public function index() {
        // Get data for about page
        $data = [
            'branches' => $this->branchModel->getAllBranches(),
            'testimonials' => $this->testimonialModel->getAllTestimonials()
        ];
        
        return $data;
    }
}
?>