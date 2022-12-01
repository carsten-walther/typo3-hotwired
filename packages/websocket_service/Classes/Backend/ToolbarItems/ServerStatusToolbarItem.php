<?php

namespace Walther\WebsocketService\Backend\ToolbarItems;

use Psr\EventDispatcher\EventDispatcherInterface;
use TYPO3\CMS\Backend\Toolbar\ToolbarItemInterface;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;
use Walther\WebsocketService\Server\Connection\ConnectionComponentRegistry;
use Walther\WebsocketService\Server\Process;

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
        $websocketServers = [];
        $connectionComponents = ConnectionComponentRegistry::getConnectionComponents();
        #$process = GeneralUtility::makeInstance(Process::class);
        foreach ($connectionComponents as $identifier => $connectionComponent) {

            $instance = ConnectionComponentRegistry::getConnectionComponentInstance($identifier);
            \TYPO3\CMS\Core\Utility\DebugUtility::debug($instance);

            $websocketServers[$identifier] = [
                'title' => $connectionComponent['title'],
                'status' => '',
                'value' => ''
            ];
        }

        $view = $this->getFluidTemplateObject('ServerStatusDropDown.html');
        $view->assignMultiple([
            'websocketServers' => $websocketServers
        ]);
        return $view->render();
    }

    public function getAdditionalAttributes(): array
    {
        return [];
    }

    public function getIndex(): int
    {
        return 70;
    }

    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    protected function getFluidTemplateObject(string $filename): StandaloneView
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setLayoutRootPaths(['EXT:websocket_service/Resources/Private/Layouts']);
        $view->setPartialRootPaths(['EXT:websocket_service/Resources/Private/Partials/ToolbarItems']);
        $view->setTemplateRootPaths(['EXT:websocket_service/Resources/Private/Templates/ToolbarItems']);
        $view->setTemplate($filename);
        $view->getRequest()->setControllerExtensionName('Backend');
        return $view;
    }
}