<?php
// src/Controller/delPosts.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class deletePosts extends AbstractController
{
    public function deletePosts()
    {
		
		$resultAnswer="Укажите необходимые параметры";
		
		if(isset($_GET['id'])){
			$resultAnswer="Удалён пост с ID = ".$_GET['id'];
			
			$conn = $this->getDoctrine()->getManager()->getConnection();
			$query = "DELETE FROM posts WHERE id=:id";
			$stmt = $conn->prepare($query);
			$params['id'] = $_GET['id'];
			$stmt->execute($params);
		}
		
		return $this->render(
			'delete/delPosts.html.twig', [
				'resultAnswer' => $resultAnswer
			]);
    }
}
?>
