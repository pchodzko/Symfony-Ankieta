<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of User
 *
 * @author PrzemyslawC
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SurveyAnswer", mappedBy="user", orphanRemoval=true)
     */
    private $surveyAnswers;


    public function __construct() {
        parent::__construct();
        $this->surveyAnswers = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|SurveyAnswer[]
     */
    public function getSurveyAnswers(): Collection
    {
        return $this->surveyAnswers;
    }

    public function addSurveyAnswer(SurveyAnswer $surveyAnswer): self
    {
        if (!$this->surveyAnswers->contains($surveyAnswer)) {
            $this->surveyAnswers[] = $surveyAnswer;
            $surveyAnswer->setUser($this);
        }

        return $this;
    }

    public function removeSurveyAnswer(SurveyAnswer $surveyAnswer): self
    {
        if ($this->surveyAnswers->contains($surveyAnswer)) {
            $this->surveyAnswers->removeElement($surveyAnswer);
            // set the owning side to null (unless already changed)
            if ($surveyAnswer->getUser() === $this) {
                $surveyAnswer->setUser(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


}
