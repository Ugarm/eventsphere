<?php

namespace App\Services;

use App\Entity\ExternalPartner;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class ExternalPartnerPasswordHasher
{
    private PasswordHasherFactoryInterface $passwordHasherFactory;

    public function __construct(PasswordHasherFactoryInterface $passwordHasherFactory)
    {
        $this->passwordHasherFactory = $passwordHasherFactory;
    }

    /**
     * Hash the given plain password and set it on the provided ExternalPartner entity.
     *
     * @param ExternalPartner $partner The ExternalPartner entity to set the hashed password on.
     * @param string $plainPassword The plain password to hash and set.
     */
    public function hashPartnerPassword(ExternalPartner $partner, string $plainPassword): void
    {
        // Choose the appropriate hasher based on the entity class
        $hasher = $this->passwordHasherFactory->getPasswordHasher(ExternalPartner::class);
        // Hash the plain password
        $hashedPassword = $hasher->hash($plainPassword);
        
        // Set the hashed password to the partner
        $partner->setPassword($hashedPassword);
    }
}
