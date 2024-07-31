<?php

namespace App\Services;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Constraints\PasswordStrength;
use Symfony\Component\Validator\Validation;


class DataValidator
{
    public function verifyEvents($data, $type): bool 
    {
        $validator = Validation::createValidator();

        if ($eventName = $data[$type .'_name']) {
            $violations = $validator->validate($eventName, [
                new Length(['min' => 3]),
                // new NoSuspiciousCharacters()
            ]);
        } 
        
        if ($this->violationHandler($violations, 'Nom de l\'event : ') === false) {
            $this->violationHandler($violations, 'Nom de l\'event : ');

            return false;
        }

        if ($eventDate = $data[$type .'_date']) {
            $anteriorDate = new DateTimeImmutable();
            $violations = $validator->validate($eventDate, [
                new Length(['min' => 3]),
                // new NoSuspiciousCharacters(),
                new GreaterThanOrEqual($anteriorDate->modify('-1 day')->format('Y/m/d'))
            ]);
        }

        if ($this->violationHandler($violations, 'Date de l\'event : ') === false) {
            $this->violationHandler($violations, 'Date de l\'event : ');

            return false;
        }

        if ($eventCity = $data[$type .'_city']) {
            $violations = $validator->validate($eventCity, [
                new Length(['min' => 3]),
                // new NoSuspiciousCharacters()
            ]);
        }

        if ($this->violationHandler($violations, 'Terter : ') === false) {
            $this->violationHandler($violations, 'Terter : ');

            return false;
        }

        if ($eventRegion = $data[$type .'_region']) {
            $violations = $validator->validate($eventRegion, [
                new Length(['min' => 3]),
                // new NoSuspiciousCharacters()
            ]);
        }

        if ($this->violationHandler($violations, 'Région : ') === false) {
            $this->violationHandler($violations, 'Région : ');

            return false;
        }

        if ($eventAddress = $data[$type .'_address']) {
            $violations = $validator->validate($eventAddress, [
                new Length(['min' => 3]),
                // new NoSuspiciousCharacters(),
            ]);
        }

        if ($this->violationHandler($violations, 'Adresse : ') === false) {
            $this->violationHandler($violations, 'Adresse : ');

            return false;
        }

        if ($eventEventType = $data[$type .'_type']) {
            $violations = $validator->validate($eventEventType, [
                new Length(['min' => 4]),
                // new NoSuspiciousCharacters()
            ]);
        }

        if ($this->violationHandler($violations, 'Type d\'event : ') === false) {
            $this->violationHandler($violations, 'Type d\'event : ');

            return false;
        }

        if ($eventMaxAttendees = $data[$type .'_attendees']) {
            $violations = $validator->validate($eventMaxAttendees, [
                // new NoSuspiciousCharacters()
            ]);

            if ($eventMaxAttendees < 2 || $eventMaxAttendees > 1000) {

                return false;
            } 
        }


        if ($this->violationHandler($violations, 'Nombre max de participants : ') === false) {
            $this->violationHandler($violations, 'Nombre max de participants : ');

            return false;
        }

        return true;
    }

    public function registrationDataValidation($data): bool
    {
        $validator = Validation::createValidator();

        if ($pw = $data['password']) {
            $violations = $validator->validate($pw, [
                new Length(['min' => 8]),
                new NotCompromisedPassword(),
                // new NoSuspiciousCharacters(),
                new PasswordStrength()
            ]);

            $this->violationHandler($violations, ' Mot de passe : ');
        }

        if ($lastname = $data['lastname']) {
            $violations = $validator->validate($lastname, [
                new Length(['min' => 2]),
                // new NoSuspiciousCharacters(),
            ]);

            $this->violationHandler($violations, 'Nom : ');
        }

        if ($firstname = $data['firstname']) {

            $violations = $validator->validate($firstname, [
                new Length(['min' => 2]),
                // new NoSuspiciousCharacters(),
            ]);

            $this->violationHandler($violations, ' Prénom : ');
        }

        if ($nickname = $data['nickname']) {

            $violations = $validator->validate($nickname, [
                new Length(['min' => 2]),
                // new NoSuspiciousCharacters(),
            ]);

            $this->violationHandler($violations, 'Pseudo : ');
        }

        if ($email = $data['email']) {
            $violations = $validator->validate($email, [
                new Length(['min' => 8]),
                // new NoSuspiciousCharacters(),
                new Constraints\Email()
            ]);

            $this->violationHandler($violations, 'Email : ');
        }

        if ($city = $data['city']) {
            $violations = $validator->validate($city, [
                new Length(['min' => 2]),
                // new NoSuspiciousCharacters(),
            ]);

            $this->violationHandler($violations, 'Ville : ');
        }

        if ($roles = $data['roles']) {

            forEach($roles as $role) {
                $violations = $validator->validate($role, [
                    new Length(['min' => 4]),
                    // new NoSuspiciousCharacters(),
                ]);

                $this->violationHandler($violations, 'Roles : ');
            }
        }

        return true;
    }

    public function partnerRegistrationDataValidation($data): bool
    {
        $validator = Validation::createValidator();

        if ($pw = $data['password']) {
            $violations = $validator->validate($pw, [
                new Length(['min' => 8]),
                new NotCompromisedPassword(),
                // new NoSuspiciousCharacters(),
                new PasswordStrength()
            ]);

            $this->violationHandler($violations, ' Mot de passe : ');
        }

        if ($lastname = $data['lastname']) {
            $violations = $validator->validate($lastname, [
                new Length(['min' => 2]),
                // new NoSuspiciousCharacters(),
            ]);

            $this->violationHandler($violations, 'Nom : ');
        }

        if ($firstname = $data['firstname']) {

            $violations = $validator->validate($firstname, [
                new Length(['min' => 2]),
                // new NoSuspiciousCharacters(),
            ]);

            $this->violationHandler($violations, ' Prénom : ');
        }

        if ($partnername = $data['partnername']) {

            $violations = $validator->validate($partnername, [
                new Length(['min' => 2]),
                // new NoSuspiciousCharacters(),
            ]);

            $this->violationHandler($violations, 'Partner name : ');
        }

        if ($email = $data['email']) {
            $violations = $validator->validate($email, [
                new Length(['min' => 8]),
                // new NoSuspiciousCharacters(),
                new Constraints\Email()
            ]);

            $this->violationHandler($violations, 'Email : ');
        }

        if ($city = $data['city']) {
            $violations = $validator->validate($city, [
                new Length(['min' => 2]),
                // new NoSuspiciousCharacters(),
            ]);

            $this->violationHandler($violations, 'Ville : ');
        }

        return true;
    }

    public function violationHandler($violations, $value): bool
    {
        if (0 !== count($violations)) {
            foreach ($violations as $violation) {

                echo $value . $violation->getMessage().'<br>';
            }

            return false;
        } else {

            return true;
        }
    }
}





