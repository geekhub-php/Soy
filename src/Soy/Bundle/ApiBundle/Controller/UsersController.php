<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 13.03.14
 * Time: 21:37
 */

namespace Soy\Bundle\ApiBundle\Controller;


use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;
use Soy\Bundle\UserBundle\Entity\User;
use Soy\Bundle\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
   public function getUsersAction($username)
   {
       $user=$this->getDoctrine()->getRepository('SoyUserBundle:User')->find($username);
       $view = new View();
       $view
           ->setData($user)
           ->setFormat('json');
       return $this->get('fos_rest.view_handler')->handle($view);

   }
   public function postUsersAction(Request $request)
   {
       $user = new User();
       $form = $this->createForm(new RegistrationFormType(new User()),$user);
       $form->handleRequest($request);
       if ($form->isValid())
       {
           /**
            * @var $user \Soy\Bundle\UserBundle\Entity\User
            */
           $user=$form->getData();
           $em=$this->getDoctrine()->getManager();
           $em->persist($user);
           $em->flush();
            return $this->getUsersAction($user->getUsername());
       }
       $view=View::create($form);
       return $this->get('fos_rest.view_handler')->handle($view);

   }
   public function putUsersAction(Request $request ,$username)
   {
       $user=$this->getDoctrine()->getRepository('SoyUserBundle:User')->find($username);
       $form=$this->createForm(new RegistrationFormType(new User()),$user,array('method'=>'PUT'));
       $form->handleRequest($request);
       if($form->isValid())
       {
           $em=$this->getDoctrine()->getManager();
           $em->persist($user);
           $em->flush();
           $view=new View(null,Codes::HTTP_NO_CONTENT);
          return $this->get('fos_rest.view_handler')->handle($view);
       }
       $view=View::create($form);
       return $this->get('fos_rest.view_handler')->handle($view);
   }
    public function deleteUsersAction($username)
    {
        $user = $this->getDoctrine()->getRepository('SoyUserBundle:User')->find($username);
        $em=$this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
    }
}
