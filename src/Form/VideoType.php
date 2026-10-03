<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class VideoType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de la vidéo',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le titre est obligatoire.'
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Ex: Se présenter en français'
                ]
            ])

            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => [
                    'rows' => 5,
                    'placeholder' => 'Description de la formation...'
                ]
            ])

            ->add('videoFile', FileType::class, [
                'label' => 'Vidéo de formation',
                'mapped' => false,
                'required' => true,

                'constraints' => [
                    new File([
                        'maxSize' => '2G',
                        'mimeTypes' => [
                            'video/mp4',
                            'video/webm',
                            'video/quicktime',
                            'video/x-msvideo',
                            'video/x-matroska',
                        ],
                        'mimeTypesMessage' =>
                            'Veuillez sélectionner une vidéo valide.'
                    ])
                ],

                'attr' => [
                    'accept' => 'video/mp4,video/webm,video/quicktime,video/x-msvideo,video/x-matroska'
                ]
            ]);
    }

    public function configureOptions(
        OptionsResolver $resolver
    ): void {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}