<?php
class BlogController {
    private $blogModel;
    
    public function __construct($conn) {
        $this->blogModel = new BlogModel($conn);
    }
    
    public function index() {
        // Get all blogs for blog page
        $data = [
            'blogs' => $this->blogModel->getAllBlogs()
        ];
        
        return $data;
    }
    
    public function detail($id) {
        // Get single blog detail
        $data = [
            'blog' => $this->blogModel->getBlogById($id)
        ];
        
        return $data;
    }
}
?>