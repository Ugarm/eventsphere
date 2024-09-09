<?php

namespace App\Security;

use App\Entity\ExternalPartner;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class APIAuthenticator extends AbstractAuthenticator
{
    private $entityManager;
    public function __construct(
        EntityManagerInterface      $entityManager,
    ) {
    $this->entityManager = $entityManager;
    }

    public function supports(Request $request): ?bool
    {
        return $request->headers->has('Authorization') && $request->headers->get('Authorization') !== 'null';
    }

    public function authenticate(Request $request): Passport
    {
        $apiToken = str_replace('Bearer ', '', $request->headers->get('Authorization'));

        if (null === $apiToken) {

            throw new CustomUserMessageAuthenticationException('No API token provided');
        }

        $userIdentifier = $this->entityManager->getRepository(User::class)->findOneBy([
            'token' => $apiToken
        ]);

        if (null === $userIdentifier) {
            throw new CustomUserMessageAuthenticationException('API token could not be found');
        }

        $identifier = $userIdentifier->getUserIdentifier();

        return new SelfValidatingPassport(new UserBadge($identifier));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {

        return new JsonResponse([
            'message' => $exception->getMessage(),
            'location' => 'API authentication'
        ], Response::HTTP_UNAUTHORIZED);
    }

}
