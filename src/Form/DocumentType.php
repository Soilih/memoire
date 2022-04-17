<?php

namespace App\Form;

use App\Entity\Document;
use App\Entity\Domaine;
use App\Entity\Niveau;
use App\Entity\TypeDocument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichImageType;
class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre' , TextType::class , [
                "label" => "Titre document "
            ])
            ->add('annePublication' , DateType::class , 
            ["label"=>"Anneé de publication" ])
            ->add('dateSoutenance' , DateType::class)

            ->add('nombreJury' , NumberType::class)
            ->add('universite' , TextType::class , [
                "label"=>"Université inscrite"
            ])
            ->add('organisme'  , TextType::class , [
                "label"=>"Organisme d'accueil "
            ])
            ->add('imageFile' , VichImageType::class , [
                'label'=>"Televerser votre document" ,
                'mapped' =>  true , 
                'required' => false,
                'allow_delete' => false,
            ])
            ->add('periode' , TextType::class , [
                "label"=>"Periode de recherche"
            ])
            ->add('nombrepage' , NumberType::class , [
                "label"=>"Nombre de page *"
            ])
            ->add('apreciation' , TextType::class , [
                "label"=>"Apreciation du jury"
            ])
            ->add('typedocument' , EntityType::class , [
                'label'=>'Type de document',
                'class' =>TypeDocument::class , 
                'choice_label'=>'libelle'
            ])
            ->add('domaine' , EntityType::class,[
                "label"=>"Domaine de competence",
                'class' =>Domaine::class ,
                'choice_label'=>'libelle'
            ])
            ->add('niveau' , EntityType::class , [
                "label"=>"Niveau d'etude",
                'class' =>Niveau::class ,
                'choice_label'=>'libelle'
            ])
            ->add('resume' ,  TextareaType::class )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
