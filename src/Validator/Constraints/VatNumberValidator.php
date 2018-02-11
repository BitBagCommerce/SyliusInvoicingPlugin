<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace BitBag\SyliusInvoicingPlugin\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Webmozart\Assert\Assert;

final class VatNumberValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     *
     * @param string $vatNumber
     * @param VatNumber $constraint
     */
    public function validate($vatNumber, Constraint $constraint): void
    {
        Assert::string($vatNumber);

        if (false === $this->isVatNumberValid($vatNumber)) {
            $this->context->buildViolation($constraint->message)->atPath('vatNumber')->addViolation();
        }
    }

    /**
     * @param string|null $vatNumber
     *
     * @return bool
     */
    private function isVatNumberValid(?string $vatNumber): bool
    {
        if (null === $vatNumber) {
            return false;
        }

        $vatNumber = preg_replace('/[^0-9]+/', '', $vatNumber);

        if (strlen($vatNumber) !== 10) {
            return false;
        }

        $arrSteps = [6, 5, 7, 2, 3, 4, 5, 6, 7];
        $intSum = 0;

        for ($i = 0; $i < 9; ++$i) {
            $intSum += $arrSteps[$i] * $vatNumber[$i];
        }

        $int = $intSum % 11;
        $checkSum = $int === 10 ? 0 : $int;

        if ($checkSum == $vatNumber[9]) {
            return true;
        }

        return false;
    }
}
