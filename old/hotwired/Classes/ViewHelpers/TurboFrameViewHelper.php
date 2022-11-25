<?php

namespace Walther\Hotwired\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * A ViewHelper for creating turbo-frame tags.
 *
 * @see: https://turbo.hotwired.dev/reference/frames
 */
final class TurboFrameViewHelper extends AbstractTagBasedViewHelper
{
    protected $tagName = 'turbo-frame';

    public function initializeArguments(): void
    {
        $this->registerArgument('id', 'string', 'Id of the turbo target element.', true);
        $this->registerArgument('src', 'string', 'Src accepts a URL or path value that controls navigation of the element.', false);
        $this->registerArgument('loading', 'string', 'Loading has two valid enumerated values: “eager” and “lazy”. When loading="eager", changes to the src attribute will immediately navigate the element. When loading="lazy", changes to the src attribute will defer navigation until the element is visible in the viewport.', false);
        $this->registerArgument('busy', 'boolean', 'Busy is a boolean attribute toggled to be present when a <turbo-frame>-initiated request starts, and toggled false when the request ends.', false);
        $this->registerArgument('disabled', 'boolean', 'Disabled is a boolean attribute that prevents any navigation when present.', false);
        $this->registerArgument('target', 'string', 'Target refers to another <turbo-frame> element by ID to be navigated when a descendant <a> is clicked. When target="_top", navigate the window.', false);
        $this->registerArgument('complete', 'boolean', 'Complete is a boolean attribute whose presence or absence indicates whether or not the <turbo-frame> element has finished navigating.', false);
        $this->registerArgument('autoscroll', 'boolean', 'Autoscroll is a boolean attribute that controls whether or not to scroll a <turbo-frame> element (and its descendant <turbo-frame> elements) into view when after loading. Control the scroll’s vertical alignment by setting the data-autoscroll-block attribute to a valid Element.scrollIntoView({ block: “…” }) value: one of "end", "start", "center", or "nearest". When data-autoscroll-block is absent, the default value is "end". Control the scroll’s behavior by setting the data-autoscroll-behavior attribute to a valid Element.scrollIntoView({ behavior: “…” }) value: one of "auto", or "smooth". When data-autoscroll-behavior is absent, the default value is "auto".', false);
    }

    public function render(): string
    {
        $this->tag->addAttribute('id', $this->arguments['id']);

        if (isset($this->arguments['src'])) {
            $this->tag->addAttribute('src', $this->arguments['src']);
        }

        if (isset($this->arguments['loading'])) {
            $this->tag->addAttribute('loading', $this->arguments['loading']);
        }

        if (isset($this->arguments['busy'])) {
            $this->tag->addAttribute('busy', $this->arguments['busy']);
        }

        if (isset($this->arguments['disabled'])) {
            $this->tag->addAttribute('disabled', $this->arguments['disabled']);
        }

        if (isset($this->arguments['target'])) {
            $this->tag->addAttribute('target', $this->arguments['target']);
        }

        if (isset($this->arguments['complete'])) {
            $this->tag->addAttribute('complete', $this->arguments['complete']);
        }

        if (isset($this->arguments['autoscroll'])) {
            $this->tag->addAttribute('autoscroll', $this->arguments['autoscroll']);
        }

        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);

        return $this->tag->render();
    }
}