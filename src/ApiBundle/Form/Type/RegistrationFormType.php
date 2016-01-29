<?php  
namespace ApiBundle\Form\Type;  

use Symfony\Component\Form\AbstractType;  
use Symfony\Component\Form\FormBuilderInterface;  
use Symfony\Component\OptionsResolver\OptionsResolver;  

class RegistrationFormType extends AbstractType  
{      
public function buildForm(FormBuilderInterface $builder, array $options)     {                 
         $builder
             ->add('email', 'email')
             ->add('name')
	     ->add('lastName')
             ->add('phone')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
            'csrf_protection'   => false
        ));
    }


    public function getName()
    {
        return 'api_bundle_user_registration';
    }
}
