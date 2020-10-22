<?php

namespace App\Controller\Traits;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;

/**
 * Common methods for Symfony forms.
 */
trait FormTrait
{
    /**
     * Fill form with http request data.
     *
     * @param Request       $request Http Request.
     * @param FormInterface $form    Symfony form.
     *
     * @return void
     */
    private function processForm(Request $request, FormInterface $form): void
    {
        $data = json_decode($request->getContent(), true);
        $clearMissing = $request->getMethod() != 'PATCH';
        $form->submit($data, $clearMissing);
    }

    /**
     * Create form from given name and fill it with http request data.
     *
     * @param FormInterface $form Symfony form.
     *
     * @return array
     */
    private function getErrors(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrors($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }
}
