<?php
// src/Controller/AddPost.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddPost extends AbstractController
{
    public function addNewPost()
    {
		
		$resultAnswer="Укажите необходимые параметры";
		
		if(
			(isset($_GET['postContent']))
				AND
			(isset($_GET['userName']))
		){
			
			if(!isset($_GET['Homepage'])){
				$Homepage="";
			}else{
				$Homepage=$_GET['Homepage'];
			}
			
			$resultAnswer="Новый пост добавлен со следующими данными : ".
				"postContent=".$_GET['postContent'].", ".
				"userName=".$_GET['userName'].", ".
				"HTTP_USER_AGENT=".$_SERVER['HTTP_USER_AGENT'].", ".
				"REMOTE_ADDR=".$_SERVER['REMOTE_ADDR'].", ".
				"Homepage=".$Homepage;
			
			$conn = $this->getDoctrine()->getManager()->getConnection();
			$query = "INSERT INTO posts(username,postContent,ip_addr,browser,Homepage) VALUES(:userName,:postContent,:ip_addr,:browser,:Homepage)";
			$stmt = $conn->prepare($query);
			$params['userName'] = $_GET['userName'];
			$params['postContent'] = $_GET['postContent'];
			$params['ip_addr'] = $_SERVER['REMOTE_ADDR'];
			$params['browser'] = $_SERVER['HTTP_USER_AGENT'];
			$params['Homepage'] = $Homepage;
			$stmt->execute($params);
		}
		
		return $this->render(
			'add/newPost.html.twig', [
				'resultAnswer' => $resultAnswer
			]);
    }
}
?>
