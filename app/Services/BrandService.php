<?php declare(strict_types=1);

namespace App\Services;

use App\Entities\Brand;
use App\Exceptions\BrandNotFoundException;
use App\FormFactories\BrandFormFactory;
use App\Repositories\BrandRepository;
use App\Services\TablePaginator\TablePaginator;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\TextInput;
use Nettrine\ORM\EntityManagerDecorator;

final class BrandService
{
    public function __construct(
        private readonly EntityManagerDecorator $entityManager
    )
    {
    }

    /**
     * @return Brand[]
     */
    public function getAllBrands(): array
    {
        return $this->getBrandRepository()->findAll();
    }

    /**
     * @return Brand[]
     */
    public function getBrandsByPaginator(TablePaginator $tablePaginator): array
    {

        return $this->getBrandRepository()->findBy(
            [],
            [$tablePaginator->getOrderBy() => $tablePaginator->getOrderDirection()],
            $tablePaginator->getItemsPerPage(),
            $tablePaginator->getOffset(),
        );
    }

    /**
     * @throws BrandNotFoundException
     */
    public function deleteBrandById(int $brandId): void
    {
        $brand = $this->getBrandById($brandId);

        $this->entityManager->remove($brand);
        $this->entityManager->flush();
    }

    /**
     * @throws BrandNotFoundException
     */
    public function getBrandById(int $brandId): Brand
    {
        $brand = $this->getBrandRepository()->find($brandId);

        if (!$brand instanceof Brand) {
            throw new BrandNotFoundException($brandId);
        }

        return $brand;
    }

    public function getBrandCount(): int
    {
        return $this->getBrandRepository()->count([]);
    }

    public function processNewBrandForm(Form $form): Brand
    {
        $formValues = $form->getValues('array');
        $brand = new Brand($formValues[BrandFormFactory::BRAND_NAME]);

        $this->entityManager->persist($brand);
        $this->entityManager->flush();

        return $brand;
    }

    /**
     * @throws BrandNotFoundException
     */
    public function processMassEditBrandForm(Form $form): Brand
    {
        $formValues = $form->getValues('array');
        $submitButtonName = $form->isSubmitted()->name;
        $submitButtonPrefix = BrandFormFactory::BRAND_SUBMIT_BUTTON . '_';
        $brandId = substr($submitButtonName, strlen($submitButtonPrefix));

        $brand = $this->getBrandById(intval($brandId));
        $brand->setName($formValues[BrandFormFactory::BRAND_NAME . '_' . $brandId]);

        $this->entityManager->persist($brand);
        $this->entityManager->flush();

        return $brand;
    }

    private function getBrandRepository(): BrandRepository
    {
        $entityRepository = $this->entityManager->getRepository(Brand::class);
        assert($entityRepository instanceof BrandRepository);

        return $entityRepository;
    }
}