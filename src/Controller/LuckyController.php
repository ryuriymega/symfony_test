<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    public function number()
    {
        $number = random_int(0, 100);
        
		$conn = $this->getDoctrine()->getManager()->getConnection();
		$query = 'SELECT * FROM posts';
		$stmt = $conn->prepare($query);
		$stmt->execute();
		$posts=$stmt->fetchAll();
		
        return $this->render(
        'lucky/number.html.twig', [
            'number' => $number,
			'posts' => $posts
        ]);
    }
}
?>
