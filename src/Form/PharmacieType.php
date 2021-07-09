<?php

namespace App\Form;

use App\Entity\Pharmacie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class PharmacieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class, ['label' => 'Adresse : '])
            ->add('login',TextType::class, ['label' => 'Nom : '])
            ->add('mdp',TextType::class, ['label' => 'Matricule : '])
            ->add('Clients')
            ->add('Medicaments')
            ->add('Fornisseur')
            ->add('Commandes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pharmacie::class,
        ]);
    }
}
