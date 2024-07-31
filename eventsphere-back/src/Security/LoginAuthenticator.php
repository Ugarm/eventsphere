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
use Symfony\Component\Validator\Constraints\Json;

class LoginAuthenticator extends AbstractAuthenticator
{
    private $entityManager;
    public function __construct(
        EntityManagerInterface      $entityManager,
    ) {
        $this->entityManager = $entityManager;
    }
    // Methods to know if authentication is supported
    public function supports(Request $request): ?bool
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy([
            'email' => json_decode($request->getContent())->email
        ]);

        if ($user) {

            return json_decode($request->getContent())->email && password_verify(json_decode($request->getContent())->password, $user->getPassword());
        } else {
            $user = $this->entityManager->getRepository(ExternalPartner::class)->findOneBy([
                'email' => json_decode($request->getContent())->email
            ]);

            return json_decode($request->getContent())->email && password_verify(json_decode($request->getContent())->password, $user->getPassword());
        }

    }

    public function authenticate(Request $request): Passport
    {
        $currentUser = $this->entityManager->getRepository(User::class)->findOneBy([
            'email' => json_decode($request->getContent())->email
        ]);

        if ($currentUser) {
            $identifier = $currentUser->getUserIdentifier();

            // TODO : Ajouter l'enum "UserType::IS_CONNECTED"
            return new SelfValidatingPassport(
                new UserBadge($identifier)
            );
        } else {
            $currentPartner = $this->entityManager->getRepository(ExternalPartner::class)->findOneBy([
                'email' => json_decode($request->getContent())->email
            ]);

            dump($currentPartner);
            $identifier = $currentPartner->getUserIdentifier();
            dump($identifier);
            return new SelfValidatingPassport(
                new UserBadge($identifier)
            );
        }
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {

        return new JsonResponse([
            'message' => $exception->getMessage(),
            'location' => 'Login authentication'
        ], Response::HTTP_UNAUTHORIZED);
    }
}
