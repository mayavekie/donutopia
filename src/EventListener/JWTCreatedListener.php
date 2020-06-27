<?php


namespace App\EventListener;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedListener
{
    /**
     * @var EntityManagerInterface
     */
    private $entitymanager;
    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager)
    {
        $this->requestStack = $requestStack;
        $this->entitymanager = $entityManager;
    }

    public function onJWTCreated(JWTCreatedEvent $event) {
        $userName= $event->getUser()->getUsername();
        /**
         * @var User $user
         */
        $user = $this->entitymanager->getRepository(User::class)->findOneBy(['email'=>$userName]);

        $payload = $event->getData();
        $payload['id']=$user->getId();
        
        $event->setData($payload);
    }

}