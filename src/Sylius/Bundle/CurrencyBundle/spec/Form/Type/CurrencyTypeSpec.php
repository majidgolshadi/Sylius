<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\CurrencyBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class CurrencyTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Currency', array('sylius'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\CurrencyBundle\Form\Type\CurrencyType');
    }

    function it_is_a_form_type()
    {
        $this->shouldImplement('Symfony\Component\Form\FormTypeInterface');
    }

    function it_should_build_form_with_proper_fields(FormBuilder $builder)
    {
        $builder
            ->add('exchangeRate', 'number', Argument::any())
            ->willReturn($builder)
        ;

        $builder
            ->addEventSubscriber(Argument::type(AddCodeFormSubscriber::class))
            ->willReturn($builder)
        ;

        $this->buildForm($builder, array());
    }

    function it_should_define_assigned_data_class_and_validation_groups(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'Currency',
                'validation_groups' => array('sylius'),
            ))
            ->shouldBeCalled();

        $this->configureOptions($resolver);
    }

    function it_has_valid_name()
    {
        $this->getName()->shouldReturn('sylius_currency');
    }
}
