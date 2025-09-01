<?php
class BlogModel {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Get all blogs
    public function getAllBlogs() {
        $query = "SELECT * FROM blogs ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        $blogs = [];
        
        while ($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }
        
        return $blogs;
    }
    
    // Get blog by ID
    public function getBlogById($id) {
        $query = "SELECT * FROM blogs WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
    
    // Create new blog
    public function createBlog($data) {
        $query = "INSERT INTO blogs (title, content, excerpt, image_url, author, is_published) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", 
            $data['title'], 
            $data['content'], 
            $data['excerpt'], 
            $data['image_url'], 
            $data['author'], 
            $data['is_published']
        );
        
        return $stmt->execute();
    }
    
    // Update blog
    public function updateBlog($id, $data) {
        $query = "UPDATE blogs SET title = ?, content = ?, excerpt = ?, image_url = ?, author = ?, is_published = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssii", 
            $data['title'], 
            $data['content'], 
            $data['excerpt'], 
            $data['image_url'], 
            $data['author'], 
            $data['is_published'], 
            $id
        );
        
        return $stmt->execute();
    }
    
    // Delete blog
    public function deleteBlog($id) {
        $query = "DELETE FROM blogs WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }
    
    // Toggle blog status
    public function toggleBlogStatus($id) {
        // Get current status
        $query = "SELECT is_published FROM blogs WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $newStatus = $row['is_published'] ? 0 : 1;
        
        // Update status
        $query = "UPDATE blogs SET is_published = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $newStatus, $id);
        
        return $stmt->execute();
    }
}
?>