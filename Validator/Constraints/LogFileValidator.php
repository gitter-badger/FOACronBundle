<?php

namespace FOA\CronBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @author JM Leroux <jmleroux.pro@gmail.com>
 */
class LogFileValidator extends ConstraintValidator
{
    /** @var string */
    private $appDir;

    /**
     * @param string $appDir
     */
    public function __construct($appDir)
    {
        $this->appDir = $appDir;
    }

    /**
     * @param string $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $allowedPattern = '#(app/logs?)|(^/tmp)#';
        if (!preg_match($allowedPattern, $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }
}
