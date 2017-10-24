<?php

namespace AppBundle\Form\MenuType;

use AppBundle\Entity\Menu\MenuItemModifier;
use AppBundle\Form\MenuItemType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuItemModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices =
        $builder
            ->add('name', TextType::class)
            ->add('price', MoneyType::class)
            ->add('calculusStrategy', ChoiceType::class, [
                'choices' => [
                    'Gratuit' => MenuItemModifier::STRATEGY_FREE,
                    'Supplément' => MenuItemModifier::STRATEGY_ADD_MODIFIER_PRICE,
                    'Prix du produit' => MenuItemModifier::STRATEGY_ADD_MENUITEM_PRICE,
                ]
            ])
            ->add('modifierChoices', CollectionType::class, [
                'entry_type' => ModifierType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MenuItemModifier::class,
        ));
    }
}
