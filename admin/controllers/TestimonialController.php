<?php
class TestimonialController {
    private $testimonialModel;
    
    public function __construct($conn) {
        $this->testimonialModel = new TestimonialModel($conn);
    }
    
    public function index() {
        return $this->testimonialModel->getAllTestimonials();
    }
    
    public function create($data) {
        return $this->testimonialModel->createTestimonial($data);
    }
    
    public function edit($id) {
        return $this->testimonialModel->getTestimonialById($id);
    }
    
    public function update($id, $data) {
        return $this->testimonialModel->updateTestimonial($id, $data);
    }
    
    public function delete($id) {
        return $this->testimonialModel->deleteTestimonial($id);
    }
    
    public function toggleApproval($id) {
        return $this->testimonialModel->toggleTestimonialApproval($id);
    }
}
?>