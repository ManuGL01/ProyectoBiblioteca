<?php

namespace App\Form;

use App\Entity\Libro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\All;

class LibroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('book', FileType::class, [
            'attr' =>[ 'class' => 'file'],
            'label' => 'Libro electrónico',

            // unmapped means that this field is not associated to any entity property
            'mapped' => false,
            'multiple' => true,
            // make it optional so you don't have to re-upload the PDF file
            // every time you edit the Product details
            'required' => true,

            // unmapped fields can't define their validation using annotations
            // in the associated entity, so you can use the PHP constraint classes
            'constraints' => [
            new All([
            'constraints' => [
                new File([
                    'maxSize' => '10024k',
                    'mimeTypesMessage' => 'Por favor, sube un archivo epub o libro electrónico',
                    'mimeTypes' => [
                        'application/epub+zip',
                    ],  
                ]),
            ],        
        ]),
    ]
])
    ;
        
        
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Libro::class,
            'allow_extra_fields' => true,   
        ]);
    }
}
