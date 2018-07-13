<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class UserFixtures extends Fixture {

    private $encoder;

    const ADMIN_USER_REFERENCE = 'admin-user';

    private static $femaleNameArray = ["Anna", "Maria,Katarzyna", "Małgorzata", "Agnieszka", "Krystyna", "Barbara", "Ewa", "Elżbieta", "Zofia", "Janina", "Teresa", "Joanna", "Magdalena", "Monika", "Jadwiga", "Danuta", "Irena", "Halina", "Helena", "Beata", "Aleksandra", "Marta", "Dorota", "Marianna", "Grażyna", "Jolanta", "Stanisława", "Iwona", "Karolina", "Bożena", "Urszula", "Justyna", "Renata", "Alicja", "Paulina", "Sylwia", "Natalia", "Wanda", "Agata", "Aneta", "Izabela", "Ewelina", "Marzena", "Wiesława", "Genowefa", "Patrycja", "Kazimiera", "Edyta", "Stefania"];
    private static $maleNameArray = ["Jan", "Andrzej", "Piotr", "Krzysztof", "Stanisław", "Tomasz", "Paweł", "Józef", "Marcin", "Marek", "Michał", "Grzegorz", "Jerzy", "Tadeusz", "Adam", "Łukasz", "Zbigniew", "Ryszard", "Dariusz", "Henryk", "Mariusz", "Kazimierz", "Wojciech", "Robert", "Mateusz", "Marian", "Rafał", "Jacek", "Janusz", "Mirosław", "Maciej", "Sławomir", "Jarosław", "Kamil", "Wiesław", "Roman", "Władysław", "Jakub", "Artur", "Zdzisław", "Edward", "Mieczysław", "Damian", "Dawid", "Przemysław", "Sebastian", "Czesław", "Leszek", "Daniel", "Waldemar"];
    private static $lastNameArray = ["Nowak", "Kowalski", "Wiśniewski", "Dąbrowski", "Lewandowski", "Wójcik", "Kamiński", "Kowalczyk", "Zieliński", "Szymański", "Woźniak", "Kozłowski", "Jankowski", "Wojciechowski", "Kwiatkowski", "Kaczmarek", "Mazur", "Krawczyk", "Piotrowski", "Grabowski", "Nowakowski", "Pawłowski", "Michalski", "Nowicki", "Adamczyk", "Dudek", "Zając", "Wieczorek", "Jabłoński", "Król", "Majewski", "Olszewski", "Jaworski", "Wróbel", "Malinowski", "Pawlak", "Witkowski", "Walczak", "Stępień", "Górski", "Rutkowski", "Michalak", "Sikora", "Ostrowski", "Baran", "Duda", "Szewczyk", "Tomaszewski", "Pietrzak", "Marciniak", "Wróblewski", "Zalewski", "Jakubowski", "Jasiński", "Zawadzki", "Sadowski", "Bąk", "Chmielewski", "Włodarczyk", "Borkowski", "Czarnecki", "Sawicki", "Sokołowski", "Urbański", "Kubiak", "Maciejewski", "Szczepański", "Kucharski", "Wilk", "Kalinowski", "Lis", "Mazurek", "Wysocki", "Adamski", "Kaźmierczak", "Wasilewski", "Sobczak", "Czerwiński", "Andrzejewski", "Cieślak", "Głowacki", "Zakrzewski", "Kołodziej", "Sikorski", "Krajewski", "Gajewski", "Szymczak", "Szulc", "Baranowski", "Laskowski", "Brzeziński", "Makowski", "Ziółkowski", "Przybylski"];

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager) {
        // $product = new Product();
        // $manager->persist($product);
        //$users = new ArrayCollection();
        for ($i = 0; $i < 50; $i++) {

            $user = new User();
            //$user->setName('product ' . $i);
            $password = $this->encoder->encodePassword($user, 'pass_1234');
            $user->setEmail('user_' . mt_rand(10, 10000) . '@google.pl');
            $user->setUsername('user_' . mt_rand(10, 10000));
//            $this->addReference($user->setUsername(), $users);
            $user->setPassword($password);
            //$users->add($user);
            $manager->persist($user);
            $this->addReference(self::ADMIN_USER_REFERENCE . $i, $user);
        }



            $user = new User();
            $password = $this->encoder->encodePassword($user, 'przemek');
            $user->setEmail('przemek@localhos.st');
            $user->setUsername('przemek');
            $user->setPassword($password);
            $user->setEnabled(true);
            $manager->persist($user);
       
            $user = new User();
            $password = $this->encoder->encodePassword($user, 'admin');
            $user->setEmail('admin@localhos.st');
            $user->setUsername('admin');
            $user->setPassword($password);
            $user->setEnabled(true);
            $user->addRole('ROLE_ADMIN');
            $manager->persist($user);
            
       
        $manager->flush();
    }

    public function generateName(bool $gender = null): array { 
            $retName = [];
            if (is_null($gender)) {
                $gender = mt_rand(0, 1);
            }
            if ($gender) {
                $retName[] = self::$femaleNameArray[array_rand(self::$femaleNameArray, 1)];
                $surname = self::$lastNameArray[array_rand(self::$lastNameArray,1)];
                $surname = preg_replace("/\\\\*(ski)/m","ska", $surname);
                $surname = preg_replace('/\\\\*(cki)/m','cka', $surname);
                $surname = preg_replace('/\\\\*(dzki)/m','dzka', $surname);
                $retName[] = $surname;
            } else {
                $retName[] = self::$maleNameArray[array_rand(self::$maleNameArray, 1)];
                $retName[] = self::$lastNameArray[array_rand(self::$lastNameArray,1)];
            }
            return $retName;
        }
    }
    