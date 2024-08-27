<?php

/*
 * This file is part of Monsieur Biz's SyliusUiElementsPlugin for Sylius.
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusUiElementsPlugin\Form\Type\UiElement;

use MonsieurBiz\SyliusRichEditorPlugin\Attribute\AsUiElement;
use MonsieurBiz\SyliusRichEditorPlugin\Attribute\TemplatesUiElement;
use MonsieurBiz\SyliusUiElementsPlugin\Form\Type\BadgeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[AsUiElement(
    code: 'monsieurbiz_ui_elements.badges_ui_element',
    icon: 'th',
    title: 'monsieurbiz_ui_elements.ui_element.badges_ui_element.title',
    description: 'monsieurbiz_ui_elements.ui_element.badges_ui_element.description',
    templates: new TemplatesUiElement(
        adminRender: '@MonsieurBizSyliusUiElementsPlugin/Admin/UiElement/badges_ui_element.html.twig',
        frontRender: '@MonsieurBizSyliusUiElementsPlugin/Shop/UiElement/badges_ui_element.html.twig',
    ),
    wireframe: 'badges',
    tags: [],
)]
class BadgesUiElementType extends AbstractType
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('badges', CollectionType::class, [
                'label' => 'monsieurbiz_ui_elements.ui_element.badges_ui_element.fields.badges',
                'entry_type' => BadgeType::class,
                'prototype_name' => '__badge__',
                'allow_add' => true,
                'allow_delete' => true,
                'constraints' => [
                    new Assert\Valid(),
                    new Assert\Count(['min' => 1]),
                ],
                'attr' => [
                    'class' => 'ui segment secondary collection--flex collection--flex-wide',
                ],
            ])
        ;
    }
}