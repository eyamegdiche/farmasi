<?php

namespace App\Form;

use App\Entity\Medicaments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicamentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pa')
            ->add('pv')
            ->add('qte')
            ->add('classification')
            ->add('Commandes')
            ->add('Fornisseurs')
            ->add('pharmacies')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicaments::class,
        ]);
    }
}
