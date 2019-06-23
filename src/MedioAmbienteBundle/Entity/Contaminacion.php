<?php

namespace MedioAmbienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contaminacion
 *
 * @ORM\Table(name="contaminacion")
 * @ORM\Entity(repositoryClass="MedioAmbienteBundle\Repository\ContaminacionRepository")
 */
class Contaminacion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

