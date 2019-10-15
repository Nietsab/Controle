<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ArticleType extends AbstractType
{

    /***
     * Configuration d'un champ
     * 
     * @param string $label 
     * @param string $placeholder
     * @param array options
     * @return array
     */
    private function getConfiguration($label, $placeholder, $options = [])
    {
        return array_merge( [
            'label' => $label, 
            'attr' => [
                'palceholder' => $placeholder
            ]
            ], $options);
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class, $this->getConfiguration("Libelle","Veuillez entre un libelle sur votre article"))
            ->add('prix', MoneyType::class, $this->getConfiguration("Prix de l'article", "Veuillez entre un prix pour votre article"))
            ->add('description', TextareaType::class, $this->getConfiguration("Description de l'article", "Veuillez entre une description de votre article"))
            ->add('image')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
