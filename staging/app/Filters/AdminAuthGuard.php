<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminAuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session=session();
        $admin = $session->get('admin');
        if (!isset($admin['loggedIn']))
        {
            return redirect()->to('/admin/login');
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}