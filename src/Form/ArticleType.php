<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de l\'article',
                'attr' => ['placeholder' => 'Saisissez le titre...', 'class' => 'form-control'],
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Contenu',
                'attr' => ['rows' => 8, 'class' => 'form-control'],
            ])
            ->add('auteur', TextType::class, [
                'label' => 'Auteur',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dateCreation', DateTimeType::class, [
                'label' => 'Date de création',
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'attr' => ['class' => 'form-control'],
            ])
            ->add('publie', CheckboxType::class, [
                'label' => 'Publier immédiatement ?',
                'required' => false,
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',   // ← c'est ici le changement clé de la section 3.6
                'label' => 'Catégorie',
                'placeholder' => '-- Choisir une catégorie --',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('enregistrer', SubmitType::class, [
                'label' => '💾 Enregistrer',
                'attr' => ['class' => 'btn btn-primary w-100'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}