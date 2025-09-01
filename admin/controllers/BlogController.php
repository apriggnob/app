<?php
class BlogController {
    private $blogModel;
    
    public function __construct($conn) {
        $this->blogModel = new BlogModel($conn);
    }
    
    public function index() {
        return $this->blogModel->getAllBlogs();
    }
    
    public function create($data) {
        return $this->blogModel->createBlog($data);
    }
    
    public function edit($id) {
        return $this->blogModel->getBlogById($id);
    }
    
    public function update($id, $data) {
        return $this->blogModel->updateBlog($id, $data);
    }
    
    public function delete($id) {
        return $this->blogModel->deleteBlog($id);
    }
    
    public function toggleStatus($id) {
        return $this->blogModel->toggleBlogStatus($id);
    }
}
?>