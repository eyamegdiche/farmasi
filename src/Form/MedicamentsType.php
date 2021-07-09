<?php

namespace App\Form;

use App\Entity\Medicaments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class MedicamentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pa',TextType::class, ['label' => 'Prix Achat : '])
        ->add('pv',TextType::class, ['label' => 'Prix Vente : '])
        ->add('qte',TextType::class,['label' => 'Stock : '])
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
