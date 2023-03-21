<?php

declare(strict_types=1);

namespace Field\Entity;

class Date extends Common
{
    protected $format="d.m.Y";

    public function __construct(array $data)
    {
        parent::__construct($data);
        if (isset($data['format'])) {
            $this->format = $data['format'];
        }
    }

    public function __toString(): string
    {
        return $this->value->format($this->format);
    }

    protected function setValue($value):void
    {
        $this->value = \DateTimeImmutable::createFromFormat("d.m.Y", $value);
        //DateTime спокойно принимает даты вроде 45 февраля
        //поэтому дополнительно проверяем что не произошло неявных преобразований
        if (!$this->value || $value!=$this->value->format("d.m.Y")) {
            throw new \InvalidArgumentException('Некорректная дата');
        }
    }

    protected function getDefaultValue()
    {
        return date("d.m.Y");
    }
}
