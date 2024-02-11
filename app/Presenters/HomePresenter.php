<?php declare(strict_types=1);

namespace App\Presenters;

use App\Entities\Brand;
use App\Exceptions\BrandNotFoundException;
use App\FormFactories\BrandFormFactory;
use App\Services\BrandService;
use App\Services\TablePaginator\TablePaginatorFactory;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;

final class HomePresenter extends Presenter
{
    /** @var Brand[] $brands */
    private array $brands;

    public function __construct(
        private readonly BrandService          $brandService,
        private readonly TablePaginatorFactory $tablePaginatorFactory,
        private readonly BrandFormFactory      $brandFormFactory,
    )
    {
        parent::__construct();
    }

    public function actionDefault(
        int    $currentPage = 1,
        int    $itemsPerPage = 10,
        string $orderDirection = 'ASC'
    ): void
    {
        $tablePaginator = $this->tablePaginatorFactory->create($currentPage, $itemsPerPage, $orderDirection);
        $tablePaginator->setItemCount($this->brandService->getBrandCount());

        $this->template->tablePaginator = $tablePaginator;
        $this->template->brands = $this->brands = $this->brandService->getBrandsByPaginator($tablePaginator);
    }

    public function actionEdit(int $brandId): void
    {
        try {
            $this->template->brand = $this->brand = $this->brandService->getBrandById($brandId);
        } catch (BrandNotFoundException) {
            $this->flashMessage("Firma s id $brandId neexistuje (což je divné, někdo jí musel smazat pod rukama");
            $this->redirect('default');
        }
    }

    public function actionDelete(int $brandId): void
    {
        try {
            $this->brandService->deleteBrandById($brandId);
            $this->flashMessage("Firma s id $brandId smazána");
        } catch (BrandNotFoundException) {
            $this->flashMessage("Firma s id $brandId neexistuje (což je divné, někdo jí musel smazat pod rukama");
        }

        $this->redirect('default');
    }

    protected function createComponentNewBrandForm(): Form
    {
        $form = $this->brandFormFactory->createNewBrandForm();
        $form->onSuccess[] = function (Form $form): void {

            $brand = $this->brandService->processNewBrandForm($form);

            $this->flashMessage(sprintf('Firma %s vložena', $brand->getName()));
            $this->redirect('default');
        };

        return $form;
    }

    protected function createComponentMassEditBrandForm(): Form
    {
        $form = $this->brandFormFactory->createBrandEditForm($this->brands);
        $form->onSuccess[] = function (Form $form): void {

            $brand = $this->brandService->processMassEditBrandForm($form);

            $this->flashMessage(sprintf('Firma %s aktualizována', $brand->getName()));
            $this->redirect('default');
        };

        $form->onError[] = function (Form $form): void {
            foreach ($form->getErrors() as $error) {
                $this->flashMessage($error, 'error');
            }

            $this->redirect('default');
        };

        return $form;
    }
}
