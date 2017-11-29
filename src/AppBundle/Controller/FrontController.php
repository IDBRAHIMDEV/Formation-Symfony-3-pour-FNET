<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class FrontController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em    = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('AdminBundle:Post')->findAll();
        
        return $this->render('AppBundle:Front:index.html.twig', array(
            'posts' => $posts
        ));
    }


     /**
     * @Route("/about")
     */
    public function aboutAction()
    {
        return $this->render('AppBundle:Front:index.html.twig', array(
            // ...
        ));
    }


     /**
     * @Route("/post/{slug}")
     */
    public function showAction($slug)
    {
        return $this->render('AppBundle:Front:index.html.twig', array(
            // ...
        ));
    }


     /**
     * @Route("/{_locale}/contact")
     */
    public function contactAction(Request $request, \Swift_Mailer $mailer)
    {
         

        $form = $this->createFormBuilder()
        ->add('from')
        ->add('subject')
        ->add('body', TextareaType::class)
        ->add('send', SubmitType::class)
        ->getForm();

$form->handleRequest($request);

if($form->isSubmitted()) {
   //traitement envoi de mail
  
   $data = $form->getData();

   $message = (new \Swift_Message($data['subject']))
   ->setFrom($data['from'])
   ->setTo('idbrahimdev@gmail.com')
   ->setBody($data['body'], 'text/plain');

   $mailer->send($message);
   
   
}

return $this->render('AppBundle:Front:contact.html.twig', ['form' => $form->createView()]);



    }

}
