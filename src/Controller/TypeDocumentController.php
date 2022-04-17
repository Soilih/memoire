<?php

namespace App\Controller;

use App\Entity\TypeDocument;
use App\Form\TypeDocumentType;
use App\Repository\TypeDocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/document")
 */
class TypeDocumentController extends AbstractController
{
    /**
     * @Route("/", name="app_type_document_index", methods={"GET"})
     */
    public function index(TypeDocumentRepository $typeDocumentRepository): Response
    {
        return $this->render('type_document/index.html.twig', [
            'type_documents' => $typeDocumentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_type_document_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TypeDocumentRepository $typeDocumentRepository): Response
    {
        $typeDocument = new TypeDocument();
        $form = $this->createForm(TypeDocumentType::class, $typeDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeDocumentRepository->add($typeDocument);
            return $this->redirectToRoute('app_type_document_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_document/index.html.twig', [
            'type_document' => $typeDocument,
            'type_documents' => $typeDocumentRepository->findAll(),
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_type_document_show", methods={"GET"})
     */
    public function show(TypeDocument $typeDocument): Response
    {
        return $this->render('type_document/show.html.twig', [
            'type_document' => $typeDocument,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_type_document_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypeDocument $typeDocument, TypeDocumentRepository $typeDocumentRepository): Response
    {
        $form = $this->createForm(TypeDocumentType::class, $typeDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeDocumentRepository->add($typeDocument);
            return $this->redirectToRoute('app_type_document_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_document/edit.html.twig', [
            'type_document' => $typeDocument,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_type_document_delete", methods={"POST"})
     */
    public function delete(Request $request, TypeDocument $typeDocument, TypeDocumentRepository $typeDocumentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeDocument->getId(), $request->request->get('_token'))) {
            $typeDocumentRepository->remove($typeDocument);
        }

        return $this->redirectToRoute('app_type_document_new', [], Response::HTTP_SEE_OTHER);
    }
}
