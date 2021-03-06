<?php

namespace PP5\MovieUniverseBundle\Controller;

use PP5\MovieUniverseBundle\Entity\Movie\Review;
use PP5\MovieUniverseBundle\Form\Type\ReviewType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends BaseController {
    /**
     * @Route("/movie/{slug}/add_review", name="add_review", requirements={
	*		"page": "\d+"
	 * })
     * @Template()
     */
	 
	 public function reviewAction(Request $request, $slug)
	 {
	 
		$review = new Review();
		
		$movieService = $this->get('pp5_movie_universe.movie_service');
		
		$form = $this->createForm(new ReviewType(), $review);
 
		$form->handleRequest($request);
		
		$movie = $movieService->getMovie($slug);
		
		if ($form->isValid())
		{
			$movieService->addReview($slug, $review);
 
			$this->get('session')->getFlashBag()->set('notice', 'Recenzja zapisana!');
 
			return $this->redirect($this->generateUrl('movie', array('slug' => $slug)));
		}
	
		return $this->render('PP5MovieUniverseBundle:Review:review.html.twig', array('form' => $form->createView(), 'movie' => $movie));
	 
	 }

}
