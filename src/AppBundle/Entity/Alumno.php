<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="alumno")
 */
class Alumno
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $apellidos;
    
    /**
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="alumno")
     * @ORM\JoinColumn(name="curso_id", referencedColumnName="id")
     */
    protected $curso;

    /**
     * @ORM\ManyToMany(targetEntity="ActividadExtra", inversedBy="alumnos")
     */
    protected $actividadesExtra;

    public function __construct() {
        $this->actividadesExtra = new ArrayCollection();
    }

   

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Alumno
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Alumno
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set curso
     *
     * @param \AppBundle\Entity\Curso $curso
     *
     * @return Alumno
     */
    public function setCurso(\AppBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \AppBundle\Entity\Curso
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Add actividadesExtra
     *
     * @param \AppBundle\Entity\ActividadExtra $actividadesExtra
     *
     * @return Alumno
     */
    public function addActividadesExtra(\AppBundle\Entity\ActividadExtra $actividadesExtra)
    {
        $this->actividadesExtra[] = $actividadesExtra;

        return $this;
    }

    /**
     * Remove actividadesExtra
     *
     * @param \AppBundle\Entity\ActividadExtra $actividadesExtra
     */
    public function removeActividadesExtra(\AppBundle\Entity\ActividadExtra $actividadesExtra)
    {
        $this->actividadesExtra->removeElement($actividadesExtra);
    }

    /**
     * Get actividadesExtra
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActividadesExtra()
    {
        return $this->actividadesExtra;
    }
}
