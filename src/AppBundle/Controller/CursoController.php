<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\CursoType;
use AppBundle\Entity\Curso;

class CursoController extends Controller
{
    /**
     * @Route("/lista-cursos", name="lista_cursos")
     */
    public function listaCursoAction(Request $request)
    {
	$em = $this->getDoctrine()->getEntityManager();
	$cursos = $em -> getRepository('AppBundle:Curso')->findAll();        
	return $this->render('AppBundle:Curso:lista_cursos.html.twig', array ('cursos' => $cursos));
    }

    /**
     * @Route("/nuevo-curso", name="nuevo_curso")
     */
    public function nuevoCursoAction(Request $request)
    {
	$curso = new Curso();
	$form = $this->createForm(CursoType::class);
	$form->handleRequest ($request);
	if ($form->isSubmitted() && $form->isValid()){
		$curso = $form->getData();
		$em = $this->getDoctrine()->getEntityManager();
		$em -> persist ($curso);
		$em -> flush();
		return $this->redirectToRoute('lista_cursos');
	}
	return $this->render('AppBundle:Curso:nuevo_curso.html.twig', array ('form' => $form->createView()));
    }

    /**
     * @Route("/editar-curso/{id}", name="editar_curso")
     */
    public function editarCursoAction(Request $request, $id)
    {
	$em = $this -> getDoctrine()->getEntityManager();
	$curso = $em->getRepository('AppBundle:Curso')->find($id);
	$form = $this->createForm(CursoType::class, $curso);
	$form->handleRequest($request);
	if ($form->isSubmitted() && $form->isValid()) 
	{
		$curso = $form->getData();
		$em->persist($curso);
		$em->flush();
	}
	return $this->render('AppBundle:Curso:editar_curso.html.twig', array ('curso' => $curso, 'form' => $form->createView()));
    }

    /**
     * @Route("/eliminar-curso/{id}", name="eliminar_curso")
     */
    public function eliminarCursoAction(Request $request, $id)
    {
	$em = $this->getDoctrine()->getEntityManager();
	$borrarcurso = $em -> getRepository('AppBundle:Curso')->find($id);
	$em -> remove($borrarcurso);
	$em->flush();

	return $this->render('AppBundle:Curso:eliminar_curso.html.twig', array ('borrarcurso' => $borrarcurso));
    }


}
