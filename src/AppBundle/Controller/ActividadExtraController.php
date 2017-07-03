<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\ActividadExtraType;
use AppBundle\Entity\ActividadExtra;

class ActividadExtraController extends Controller
{
    /**
     * @Route("/lista-actividad-extra", name="lista_actividad_extra")
     */
    public function listaActividadExtraAction(Request $request)
    {
	$em = $this->getDoctrine()->getEntityManager();
	$actividadesExtra = $em -> getRepository('AppBundle:ActividadExtra')->findAll();        
	return $this->render('AppBundle:ActividadExtra:lista_actividad_extra.html.twig', array ('actividadesExtra' => $actividadesExtra));
    }

    /**
     * @Route("/nuevo-actividad-extra", name="nueva_actividad_extra")
     */
    public function nuevoActividadExtraAction(Request $request)
    {
	$actividadExtra = new ActividadExtra();
	$form = $this->createForm(ActividadExtraType::class);
	$form->handleRequest ($request);
	if ($form->isSubmitted() && $form->isValid()){
		$actividadExtra = $form->getData();
		$em = $this->getDoctrine()->getEntityManager();
		$em -> persist ($actividadExtra);
		$em -> flush();
		return $this->redirectToRoute('lista_actividad_extra');
	}
	return $this->render('AppBundle:ActividadExtra:nueva_actividad_extra.html.twig', array ('form' => $form->createView()));
    }

    /**
     * @Route("/editar-actividad-extra/{id}", name="editar_actividad_extra")
     */
    public function editarActividadExtraAction(Request $request, $id)
    {
	$em = $this->getDoctrine()->getEntityManager();
	$actividadExtra = $em->getRepository('AppBundle:ActividadExtra')->find($id);
	$form = $this->createForm(ActividadExtraType::class, $actividadExtra);
	$form -> handleRequest ( $request );
	if ($form->isSubmitted() && $form->isValid()){
		$actividadExtra = $form->getData();
		$em->persist($actividadExtra);
		$em->flush();	
	}
	return $this->render('AppBundle:ActividadExtra:editar_actividad_extra.html.twig', array ('actividadExtra'=>$actividadExtra, 'form' => $form->createView()));
    }

    /**
     * @Route("/eliminar-actividad-extra/{id}", name="eliminar_actividad_extra")
     */
    public function eliminarAlumnoAction(Request $request, $id)
    {
	$em = $this->getDoctrine()->getEntityManager();
	$actividadExtra = $em->getRepository('AppBundle:ActividadExtra')->find($id);
	$em->remove($actividadExtra);
	$em->flush();	       
	return $this->render('AppBundle:ActividadExtra:eliminar_actividad_extra.html.twig', array ('actividadExtra'=>$actividadExtra));
    }


}
