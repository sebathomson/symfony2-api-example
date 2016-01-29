<?php  

namespace ApiBundle\Controller\V1;  
 
use FOS\RestBundle\Controller\FOSRestController;  
use FOS\RestBundle\Controller\Annotations as Rest;  
 
class UserController extends FOSRestController  
{     

	/**
	 * GET Route annotation.
	 * @return array
	 * @Rest\Get("/users/get.{_format}")
	 * @Rest\View
	 */
	public function getUsersAction()
	{
	    $em    = $this->getDoctrine()->getManager();
	    $users = $em->getRepository('AppBundle:User')->findAll();

	    return array('users' => $users);
	}

	/**
	 * POST Route annotation.
	 * @Rest\Post("/users/new.{_format}")
	 * @Rest\View
	 * @return array
	 */
	public function addUserAction(Request $request)
	{
	    $user = new AppBundle\Entity\User();
	    $form = $this->createForm(new \ApiBundle\Form\Type\RegistrationFormType(), $user);
	
	    $form->handleRequest($request);
	
	    if ($form->isValid())
	    {
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($user);
	        $em->flush();
	
	        return array('user' =>  $user);
	    }
	
	    return View::create($form, 400);
	}

	/**
	 * PATCH Route annotation.
	 * @Rest\Patch("/users/edit/{id}.{_format}")
	 * @Rest\View
	 * @return array
	 */
	public function editAction(Request $request, $id)
	{
	    $em   = $this->getDoctrine()->getManager();
	    $user = $em->getRepository('AppBundle:User')->find($id); 

	    if (!$user) {
		throw $this->createNotFoundException('User not found!');
	    }

	    $form = $this->createForm(new \ApiBundle\Form\Type\RegistrationFormType(), $user, array('method' => 'PATCH'));
	 
	    $form->handleRequest($request);

	    if ($form->isValid()) {           
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
 
                return array('user' => $user);
	    }

            return View::create($form, 400);
	}

	/**
	 * DELETE Route annotation.
	 * @Rest\Delete("/users/delete/{id}.{_format}")
	 * @Rest\View(statusCode=204)
	 * @return array
	 */
	public function deleteAction($id)
	{
	    $em = $this->getDoctrine()->getManager();
	    $user = $em->getRepository('AppBundle:User')->find($id);
	 
	    $em->remove($user);
	    $em->flush();
	}

        /**
         * @return array
         * @Rest\Get("/users/{id}")
         * @Rest\View
         */
        public function getUserAction($id)
        {
             $em   = $this->getDoctrine()->getManager();
             $user = $em->getRepository('AppBundle:User')->find($id);

             return array('user' => $user);
        }

}

