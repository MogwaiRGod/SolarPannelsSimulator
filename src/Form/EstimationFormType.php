<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Consumption;

class EstimationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $form =  $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('bill', NumberType::class, [
                'label' => 'Facture énergétique annuelle',
                'attr' => array(
                    'placeholder' => '€'
                )
            ])
            ->add('length', NumberType::class, [
                'label' => 'Longueur du toit',
                'attr' => array(
                    'placeholder' => 'm'
                )
            ])
            ->add('width', NumberType::class, [
                'label' => 'Largeur du toit',
                'attr' => array(
                    'placeholder' => 'm'
                )
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Calculer',
            ])
            ->getForm();

        return $form;
    }
}
