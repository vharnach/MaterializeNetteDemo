<?php

namespace App\FormFactories;

use App\Entities\Brand;
use Nette\Application\UI\Form;

class BrandFormFactory
{
    public const BRAND_NAME = 'name';
    public const BRAND_SUBMIT_BUTTON = 'send';

    public function createNewBrandForm(): Form
    {
        $form = new Form;
        $form->addText(self::BRAND_NAME, 'Jméno:')
            ->setRequired()
            ->setMaxLength(250);

        $form->addSubmit(self::BRAND_SUBMIT_BUTTON, 'Uložit');

        return $form;
    }

    /**
     * @param Brand[] $brands
     */
    public function createBrandEditForm(array $brands): Form
    {
        $form = new Form;
        foreach ($brands as $brand) {
            $brandId = $brand->getId();
            $form->addText(self::BRAND_NAME . '_' . $brandId, 'Jméno:')
                ->setRequired()
                ->setMaxLength(250)
                ->setDefaultValue($brand->getName());

            $form->addSubmit(self::BRAND_SUBMIT_BUTTON . '_' . $brandId, 'Uložit');
        }

        return $form;
    }
}
