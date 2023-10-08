<?php namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
 
 
class GoogleCharts extends Controller
{
 
    public function index() {
 
        // GRAFIk
        $db      = \Config\Database::connect();
        $builder = $db->table('users');   
 
        $query = $builder->query("'SELECT COUNT(id) as count,DAY(created_at) as day_date FROM users WHERE MONTH(created_at) = '" . date('m') . "'AND YEAR(created_at) = '" . date('Y') . "'GROUP BY DAY(created_at)'");
 
        $data['day_wise'] = $query->getResult();
        $query = $this->db->query('SELECT posts.id, posts_category.category_name, category_id, COUNT( * ) as total FROM posts
                JOIN posts_category ON posts_category.id = posts.category_id
                 GROUP BY category_id
                ');
         
        return view('home',$data);
    }
 
}