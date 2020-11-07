<?php

//car.php

require_once 'Vehicle.php';
require_once 'NoMoreEnergyException.php';
require_once 'LightTableInterface.php';

class Car extends Vehicle implements LightTableInterface
{
    const ALLOWED_ENERGIES = [
        'fuel',
        'electric',
    ];

    /**
     * @var string
     */
    private $energy;

    /**
     * @var integer
     */
    private $energyLevel;

    /**
     * @var bool
     */
    private $hasParkBrake;

    public function __construct(string $color, int $nbSeats, string $energy)
    {
        parent::__construct($color, $nbSeats);
        $this->setEnergy($energy);
    }

    /**
     * @return bool
     */
    public function switchOn(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function switchOff(): bool
    {
        return false;
    }


    public function start(): string
    {
        if ($this->energyLevel < 0 || $this->energyLevel === null) {
            throw new NoMoreEnergyException("no more energy !");
        }
        if ($this->hasParkBrake) {
            throw new Exception(" your park brake is on");
        }
        $sentence = "";
        $this->energyLevel--;
        $sentence = "Ma voiture roule comme un donut";
        return $sentence;
    }

    public function forward(): string
    {
        $sentence = "";
        if ($this->energyLevel > 0 && $this->engineIsOn === true) {
            $this->energyLevel--;
            $this->currentSpeed = 50;
            $sentence .= "Go!";
        } else {
            $sentence .= "stop !";
            $this->currentSpeed = 0;
        }
        return $sentence;
    }

    public function brake(): string
    {
        $sentence = "";
        while ($this->currentSpeed > 0) {
            $this->currentSpeed -= 10;
            $sentence .= "Brake !!!";
        }
        $sentence .= "I'm stopped !";
        return $sentence;
    }

    /**
     * @return string
     */
    public function getEnergy(): string
    {
        return $this->energy;
    }

    public function setEnergy(string $energy): Car
    {
        if (in_array($energy, self::ALLOWED_ENERGIES)) {
            $this->energy = $energy;
        }
        return $this;
    }

    public function setEnergyLevel(int $energyLevel): void
    {
        $this->energyLevel = $energyLevel;
    }

    /**
     * @return integer
     */
    public function getEnergyLevel(): int
    {
        return $this->energyLevel;
    }


    public function setParkBrake($hasParkBrake): Car
    {
        $this->hasParkBrake = $hasParkBrake;
        return $this;
    }
}
