<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 13.03.14
 * Time: 21:37
 */

namespace Soy\Bundle\ApiBundle\Controller;


use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcher;
use Soy\Bundle\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationInterface;

class UserController extends Controller
{
    /**
     * @View()
     * @RequestParam(name="username")
     */
    public function getUsersAction(ParamFetcher $paramFetcher)
    {
        $username = $paramFetcher->get('username');
        $user=$this->getDoctrine()->getRepository('SoyUserBundle:User')->find($username);
        return $user;

    }

    /**
     * @View()
     * @ParamConverter("user", converter="fos_rest.request_body")
     */
    public function postUsersAction(User $user, ConstraintViolationInterface $validationErrors)
    {
        if (count($validationErrors) > 0) {
            throw new HttpException('400', 'New user data not valid');
        } else {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
           $em->flush();
       }

   }

    /**
     * @View()
     * @ParamConverter("user", converter="fos_rest.request_body")
     */
    public function putUsersAction(User $user, ConstraintViolationInterface $validationErrors)
    {
        if (count($validationErrors) > 0) {
            throw new HttpException('400', 'New user data not valid');
        } else {
            $em=$this->getDoctrine()->getManager();
            $newUser = $this->getDoctrine()->getRepository('SoyUserBundle:User')->find($user->getId());
            $newUser = $user;
            $em->flush();
       }
   }

    /**
     * @View()
     * @RequestParam(name="username")
     */
    public function deleteUsersAction(ParamFetcher $paramFetcher)
    {
        $username = $paramFetcher->get('username');
        $user = $this->getDoctrine()->getRepository('SoyUserBundle:User')->find($username);
        $em=$this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
    }
}
