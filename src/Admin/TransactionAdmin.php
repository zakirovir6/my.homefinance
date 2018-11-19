<?php

namespace App\Admin;

use App\Dictionary\DirectionDictionary;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Translation\TranslatorInterface;

final class TransactionAdmin extends AbstractAdmin
{

    /** @var TranslatorInterface */
    private $adminTranslator;

    /**
     * @required
     * @param TranslatorInterface $translator
     */
    public function setAdminTranslator(TranslatorInterface $translator): void
    {
        $this->adminTranslator = $translator;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('amount')
            ->add('direction')
            ->add('comment')
            ->add('createdAt')
            ->add('updatedAt');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('amount')
            ->add('direction')
            ->add('comment')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $directions = [];
        foreach (array_flip(DirectionDictionary::DIRECTIONS) as $directionValue => $directionLabel) {
            $key = $this->adminTranslator->trans($directionValue, [], $this->getTranslationDomain());
            $directions[$key] = $directionLabel;
        }


        $directions = array_flip(DirectionDictionary::DIRECTIONS);

        $formMapper
            ->add('amount')
            ->add('direction', ChoiceType::class, [
                'choices' => $directions,
                'translation_domain' => 'admin'
            ])
            ->add('comment');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('amount')
            ->add('direction')
            ->add('comment')
            ->add('createdAt')
            ->add('updatedAt');
    }
}
