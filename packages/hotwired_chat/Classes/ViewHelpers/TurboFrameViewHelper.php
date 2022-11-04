<?php

namespace Walther\Chat\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class TurboFrameViewHelper extends AbstractTagBasedViewHelper
{
    protected $tagName = 'turbo-frame';

    public function initializeArguments(): void
    {
        $this->registerArgument('id', 'string', 'id of the turbo target element', true);
        $this->registerArgument('src', 'string', 'src accepts a URL or path value that controls navigation of the element', false);
        $this->registerArgument('target', 'string', 'target refers to another <turbo-frame> element by ID to be navigated when a descendant <a> is clicked. When target="_top", navigate the window', false);
    }

    public function render(): string
    {
        $this->tag->addAttribute('id', $this->arguments['id']);

        if (isset($this->arguments['src'])) {
            $this->tag->addAttribute('src', $this->arguments['src']);
        }

        if (isset($this->arguments['target'])) {
            $this->tag->addAttribute('target', $this->arguments['target']);
        }

        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);

        return $this->tag->render();
    }
}