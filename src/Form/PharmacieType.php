<?php

namespace App\Form;

use App\Entity\Pharmacie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PharmacieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('login')
            ->add('mdp')
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
