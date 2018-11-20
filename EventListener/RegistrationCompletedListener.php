<?php

namespace NCMF\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationCompletedListener implements EventSubscriberInterface
{

    private $entityManager;
    private $secret;
    private $userManager;

    public function __construct(EntityManagerInterface $entityManager, $secret, UserManagerInterface $userManager)
    {
        $this->entityManager = $entityManager;
        $this->secret = $secret;
        $this->userManager = $userManager;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => ['onRegistrationCompleted', -10],
        );
    }

    public function onRegistrationCompleted(FilterUserResponseEvent $event)
    {
        $request = $event->getRequest();
        $formData = $request->get('fos_user_registration_form');
        if (array_key_exists('check', $formData) && $formData['check'] === $this->secret) {
            $userCount = $this->entityManager
                ->createQuery('SELECT COUNT(n.id) FROM NCMFUserBundle:User n')
                ->getSingleScalarResult();
            if (intval($userCount) === 1) {
                $user = $event->getUser();
                $user->addRole('ROLE_SUPER_ADMIN');
                $this->userManager->updateUser($user);
            }
        }
    }
}