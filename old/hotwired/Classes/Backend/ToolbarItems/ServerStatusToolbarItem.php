<?php

namespace Walther\Hotwired\Backend\ToolbarItems;

use Psr\EventDispatcher\EventDispatcherInterface;
use TYPO3\CMS\Backend\Toolbar\ToolbarItemInterface;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

final class ServerStatusToolbarItem implements ToolbarItemInterface
{
    public function __construct(PageRenderer $pageRenderer, EventDispatcherInterface $eventDispatcher)
    {

    }

    public function checkAccess(): bool
    {
        $backendUser = $this->getBackendUser();
        if ($backendUser->isAdmin()) {
            return true;
        }
        return false;
    }

    public function getItem(): string
    {
        $view = $this->getFluidTemplateObject('ServerStatusToolbarItem.html');
        $view->assignMultiple([

        ]);
        return $view->render();
    }

    public function hasDropDown(): bool
    {
        return true;
    }

    public function getDropDown(): string
    {
        $view = $this->getFluidTemplateObject('ServerStatusToolbarItemDropDown.html');
        $view->assignMultiple([

        ]);
        return $view->render();
    }

    public function getAdditionalAttributes(): array
    {
        return [];
    }

    public function getIndex(): int
    {
        return 25;
    }

    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    protected function getFluidTemplateObject(string $filename): StandaloneView
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setLayoutRootPaths(['EXT:hotwired/Resources/Private/Layouts']);
        $view->setPartialRootPaths(['EXT:hotwired/Resources/Private/Partials/ToolbarItems']);
        $view->setTemplateRootPaths(['EXT:hotwired/Resources/Private/Templates/ToolbarItems']);

        $view->setTemplate($filename);

        $view->getRequest()->setControllerExtensionName('Backend');
        return $view;
    }
}