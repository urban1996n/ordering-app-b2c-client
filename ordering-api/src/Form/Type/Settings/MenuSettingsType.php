<?php

namespace App\Form\Type;

use App\Entity\Settings\MenuSettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('menuCategories', CollectionType::class, [
                'entry_type' => MenuCategoryType::class,
            ])
            ->add('picture', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', MenuSettings::class);
    }
}
