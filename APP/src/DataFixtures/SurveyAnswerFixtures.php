<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\SurveyAnswer;
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


class SurveyAnswerFixtures extends Fixture implements DependentFixtureInterface{

    public function load(ObjectManager $manager) {
        
      //  $key= $this->getReference(UserFixtures::ADMIN_USER_REFERENCE);
        for ($i = 0; $i < 50; $i++) {

            $surveyAnswer = new SurveyAnswer();
            $name = UserFixtures::generateName($i%2);
            $surveyAnswer->setFirstName($name[0]);
            $surveyAnswer->setLastName($name[1]);
            $dob = new \DateTime(date("Y-m-d H:i:s", mt_rand(-2208988800,1531134123)));
            $surveyAnswer->setDob($dob);
            $surveyAnswer->setIsActive(true);
//$a =$key->get(1);
            $surveyAnswer->setUser($this->getReference(UserFixtures::ADMIN_USER_REFERENCE.$i));
          //  $surveyAnswer->setUser($this->getReference(UserFixtures::ADMIN_USER_REFERENCE)[]);
            $manager->persist($surveyAnswer);
        }

        $manager->flush();
    }
    
    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }

}
