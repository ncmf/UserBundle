<?php


namespace NCMF\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints;

class RegistrationFormType extends AbstractType
{

    private $entityManager;
    private $secret;

    public function __construct(EntityManagerInterface $entityManager, $secret)
    {
        $this->entityManager = $entityManager;
        $this->secret = $secret;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $userCount = $this->entityManager
            ->createQuery('SELECT COUNT(n.id) FROM NCMFUserBundle:User n')
            ->getSingleScalarResult();
        if ($userCount === 0) {
            $builder->add('check', PasswordType::class, array(
                'label' => 'Секретный ключ',
                'attr' => array(
                    'class' => 'form-control'
                ),
                'mapped' => false,
                'constraints' => new Constraints\EqualTo(array(
                    'value' => $this->secret,
                    'message' => 'Секретный ключ указан неверно'
                ))
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ncmf_user_registration';
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
}