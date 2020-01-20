<?php


namespace validator\validatorInterface;

// Under construction
interface MainInterface
{
    public function validate(array $data, array $validatorRules);
    public function parseRules(array $validatorRules);



}