<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\AlumnoType;
use AppBundle\Entity\Alumno;

class AlumnoController extends Controller
{
    /**
     * @Route("/lista-alumno", name="lista_alumno")
     */
    
    public function listaAlumnoAction(Request $request)
    {
	$em = $this->getDoctrine()->getEntityManager();
	$alumnos = $em -> getRepository('AppBundle:Alumno')->findAll();        
	return $this->render('AppBundle:Alumno:lista_alumnos.html.twig', array ('alumnos' => $alumnos));
    }

    /**
     * @Route("/nuevo-alumno", name="nuevo_alumno")
     */
    public function nuevoAlumnoAction(Request $request)
    {
	$alumno = new Alumno();
	$form = $this->createForm(AlumnoType::class, $alumno);
	$form->handleRequest ($request);
	if ($form->isSubmitted() && $form->isValid()){
		$alumno = $form->getData();
		$em = $this->getDoctrine()->getEntityManager();
		$em -> persist ($alumno);
		$em -> flush();
		return $this->redirectToRoute('editar_alumno', array ('id' => $alumno->getId()));
	}
	return $this->render('AppBundle:Alumno:nuevo_alumno.html.twig', array ('form' => $form->createView()));
    }
    /**
     * @Route("/editar-alumno/{id}", name="editar_alumno")
     */
    public function editarAlumnoAction(Request $request, $id)
    {
	$em = $this->getDoctrine()->getEntityManager();
	$alumno = $em->getRepository('AppBundle:Alumno')->find($id);
	$form = $this->createForm(AlumnoType::class, $alumno);
	$form->handleRequest($request);
	if ($form->isSubmitted() && $form->isValid()) 
	{
		$alumno = $form->getData();
		$em->persist($alumno);
		$em->flush();
	}
	return $this->render('AppBundle:Alumno:editar_alumno.html.twig', array ('alumno' => $alumno, 'form' => $form->createView()));
    }

    /**
     * @Route("/eliminar-alumno/{id}", name="eliminar_alumno")
     */
    public function eliminarAlumnoAction(Request $request, $id)
    {	
	$em = $this->getDoctrine()->getEntityManager();
	$borraralumno = $em->getRepository('AppBundle:Alumno')->find($id);
	$em->remove($borraralumno);
	$em->flush();
	      
	return $this->render('AppBundle:Alumno:eliminar_alumno.html.twig', array ('borraralumno' => $borraralumno));
    }


}
