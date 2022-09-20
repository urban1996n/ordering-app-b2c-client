<?php

namespace App\Form\Type;

use App\Entity\Restaurant;
use App\Form\EventListener\RestaurantFormListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantType extends AbstractType
{
    private RestaurantFormListener $restaurantFormListener;

    /** @required */
    public function setUpListener(RestaurantFormListener $restaurantFormListener): void
    {
        $this->restaurantFormListener = $restaurantFormListener;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('picture', TextType::class)
            ->addEventSubscriber($this->restaurantFormListener);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Restaurant::class);
    }
}
