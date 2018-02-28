<?php

namespace AppBundle\Services;

use AppBundle\Entity\Author;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class HelloService implements EventSubscriberInterface
{

    /**
     * @var string
     */
    private $name;

    /**
     * HelloService constructor.
     * @param string $name
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        /*
        if($tokenStorage != null){
            $user = $tokenStorage->getToken()->getUser();

            dump($user);

            if(! $user instanceof Author){
                $this->name = "Anonymous";
            } else {
                $this->name = $user->getFullName();
            }
        }*/

    }


    public function greet(){
        return "Hello ".$this->name;
    }


    public function onKernelRequest(GetResponseEvent $event){

        $event->setResponse(new Response("maintenance"));
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => ["onKernelRequest", 1]];
    }
}