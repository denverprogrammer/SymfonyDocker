<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Interfaces\ViewStateInterface;
use App\Entity\Constants\Enums\ViewState;

/**
 * Determins how a enity is searched or viewed
 */
trait ViewStateTrait
{
    /**
     * Determins how a enity is searched or viewed
     *
     * @var string
     *
     * @ORM\Column(type="string", length=16, options={"default" : ViewState::ANOMYOUS})
     * @Assert\NotBlank()
     */
    protected $viewState = ViewState::ANOMYOUS;

    /**
     * {inheritdoc}
     */
    public function getViewState(): string
    {
        return $this->viewState;
    }

    /**
     * {inheritdoc}
     */
    public function setViewState(string $viewState): self
    {
        $this->viewState = $viewState;

        return $this;
    }
}
