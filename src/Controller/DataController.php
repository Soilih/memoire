<?php

namespace App\Controller;

use App\Entity\Data;
use App\Entity\User;
use App\Form\DataType;
use App\Repository\DataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/data")
 */
class DataController extends AbstractController
{
    /**
     * @Route("/", name="app_data_index", methods={"GET"})
     */
    public function index(DataRepository $dataRepository): Response
    {
        return $this->render('data/index.html.twig', [
            'data' => $dataRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_data_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DataRepository $dataRepository): Response
    {
        $data = new Data();
        $data ->setUser($this->getUser());
        $form = $this->createForm(DataType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dataRepository->add($data);
            return $this->redirectToRoute('user_Accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('data/new.html.twig', [
            'data' => $data,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_data_show", methods={"GET"})
     */
    public function show(Data $data): Response
    {
        return $this->render('data/show.html.twig', [
            'data' => $data,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_data_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Data $data, DataRepository $dataRepository): Response
    {
        $form = $this->createForm(DataType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dataRepository->add($data);
            return $this->redirectToRoute('user_Accueil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('data/edit.html.twig', [
            'data' => $data,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_data_delete", methods={"POST"})
     */
    public function delete(Request $request, Data $data, DataRepository $dataRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$data->getId(), $request->request->get('_token'))) {
            $dataRepository->remove($data);
        }

        return $this->redirectToRoute('app_data_index', [], Response::HTTP_SEE_OTHER);
    }
}
