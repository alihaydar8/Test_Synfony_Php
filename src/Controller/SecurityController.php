<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)

    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/connextion", name="security_login")
     */
    public function login()
    {
        return $this->render('security/login.html.twig');
    }
    /**
     * @Route("/deconnextion", name="security_logout")
     */
    public function logout()
    {
    }
}
