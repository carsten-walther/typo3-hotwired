<?php

namespace Walther\Chat\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

class TurboStreamViewHelper extends AbstractTagBasedViewHelper
{
    protected $tagName = 'turbo-stream';

    public function initializeArguments(): void
    {
        $this->registerArgument('action', 'string', 'A Turbo Streams message is a fragment of HTML consisting of <turbo-stream> elements. The stream message below demonstrates the seven possible stream actions: (append|prepend|replace|update|remove|before|after)', true);
        $this->registerArgument('target', 'string', 'target refers to another <turbo-frame> element by ID to be navigated when a descendant <a> is clicked. When target="_top", navigate the window', true);
    }

    public function render(): string
    {
        $this->tag->addAttribute('action', $this->arguments['action']);
        $this->tag->addAttribute('target', $this->arguments['target']);

        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);

        return $this->tag->render();
    }
}