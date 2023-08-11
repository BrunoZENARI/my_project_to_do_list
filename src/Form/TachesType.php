<?php

namespace App\Form;

use App\Entity\Taches;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


class TachesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre :',
                'attr' => ['class' => 'form-control mb-2', 'required' => 'required']
            ])
            ->add('description', TextType::class, [
                'label' => 'Description :',
                'attr' => ['class' => 'form-control mb-2', 'required' => 'required']
            ])
            ->add('priorite', ChoiceType::class, [
                'label' => 'Priorité',
                'choices' => [
                    'Importante' => '3',
                    'Moyenne' => '2',
                    'Basse' => '1',
                ],
                'choice_attr' => [
                    'Apple' => ['data-color' => 'Red'],
                    'Banana' => ['data-color' => 'Yellow'],
                    'Durian' => ['data-color' => 'Green'],
                ],
                'attr' => ['class' => 'form-control d-flex gap-3 mb-2', 'required' => 'required'],
                'multiple' => true,
                'expanded' => true, // Affiche les options sous forme de boutons radio
            ])
            ->add('statut', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'En attente' => 'en attente',
                    'En cours' => 'en cours',
                    'Termine' => 'termine',
                ],
                'choice_attr' => [
                    'En attente' => ['data-color' => 'Red'],
                    'En cours' => ['data-color' => 'Yellow'],
                    'Termine' => ['data-color' => 'Green'],
                ],
                'attr' => ['class' => 'form-control d-flex gap-3 mb-2', 'required' => 'required'],
                'multiple' => true,
                'expanded' => true, // Affiche les options sous forme de boutons radio
            ])
            ->add('start', DateTimeType::class, [
                'date_widget' => 'single_text',
                'attr' => ['class' => 'form-control d-flex gap-3 align-middle mb-2', 'required' => 'required'],
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => new \DateTime(),
                        'message' => 'La date doit être supérieure ou égale à la date actuelle.',
                    ])],
            ])
            ->add('end', DateTimeType::class, [
                'date_widget' => 'single_text',
                'attr' => ['class' => 'form-control d-flex gap-3 align-middle mb-2', 'required' => 'required'],
                'constraints' => [
                    new Callback([$this, 'validateEndGreaterThanStart']),
                ],
            ])
            ->add('background_color', ColorType::class,[
                'attr' => ['class' => 'form-control mb-2', 'required' => 'required']
            ])
            ->add('border_color', ColorType::class,[
                'attr' => ['class' => 'form-control mb-2', 'required' => 'required']
            ])
            ->add('text_color', ColorType::class,[
                'attr' => ['class' => 'form-control mb-2', 'required' => 'required']
            ])
            ->add('createur',);
    }

    public function validateEndGreaterThanStart($value, ExecutionContextInterface $context): void
    {
        $form = $context->getRoot(); // Récupère le formulaire

        $start = $form['start']->getData(); // Récupère la valeur du champ start
        $end = $value; // Récupère la valeur du champ end

        if ($start >= $end) {
            $context->buildViolation('L\'heure de fin doit être postérieure à l\'heure de début.')
                ->atPath('end')
                ->addViolation();
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Taches::class,
        ]);
    }
}