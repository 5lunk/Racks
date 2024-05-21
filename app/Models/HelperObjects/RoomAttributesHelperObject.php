<?php

declare(strict_types=1);

namespace App\Models\HelperObjects;

use App\Domain\Interfaces\RoomInterfaces\RoomEntity;

/**
 * Helper object for room PATCHing
 */
class RoomAttributesHelperObject
{
    /**
     * @var array<mixed>
     */
    private array $attributesForRoom = [];

    /**
     * @var RoomEntity
     */
    private RoomEntity $room;

    /**
     * @param  RoomEntity  $room
     */
    public function __construct(RoomEntity $room)
    {
        $this->room = $room;
        $this->setName();
        $this->setUpdatedBy();
        $this->setBuildingId();
        $this->setDescription();
        $this->setDepartmentId();
        $this->setBuildingFloor();
        $this->setNumberOfRackSpaces();
        $this->setArea();
        $this->setCoolingSystem();
        $this->setFireSuppressionSystem();
        $this->setAccessIsOpen();
        $this->setHasRaisedFloor();
        $this->setResponsible();
    }

    /**
     * @return void
     */
    private function setName(): void
    {
        $name = $this->room->getName();
        if ($name) {
            $this->attributesForRoom += ['name' => $name];
        }
    }

    /**
     * @return void
     */
    private function setBuildingFloor(): void
    {
        $buildingFloor = $this->room->getBuildingFloor();
        if ($buildingFloor) {
            $this->attributesForRoom += ['building_floor' => $buildingFloor];
        }
    }

    /**
     * @return void
     */
    private function setBuildingId(): void
    {
        $buildingId = $this->room->getBuildingId();
        if ($buildingId) {
            $this->attributesForRoom += ['building_id' => $buildingId];
        }
    }

    /**
     * @return void
     */
    private function setNumberOfRackSpaces(): void
    {
        $numberOfRackSpaces = $this->room->getNumberOfRackSpaces();
        if ($numberOfRackSpaces) {
            $this->attributesForRoom += ['number_of_rack_spaces' => $numberOfRackSpaces];
        }
    }

    /**
     * @return void
     */
    private function setArea(): void
    {
        $area = $this->room->getArea();
        if ($area) {
            $this->attributesForRoom += ['area' => $area];
        }
    }

    /**
     * @return void
     */
    private function setCoolingSystem(): void
    {
        $coolingSystem = $this->room->getCoolingSystem();
        if ($coolingSystem) {
            $this->attributesForRoom += ['cooling_system' => $coolingSystem];
        }
    }

    /**
     * @return void
     */
    private function setFireSuppressionSystem(): void
    {
        $fireSuppressionSystem = $this->room->getFireSuppressionSystem();
        if ($fireSuppressionSystem) {
            $this->attributesForRoom += ['fire_suppression_system' => $fireSuppressionSystem];
        }
    }

    /**
     * @return void
     */
    private function setAccessIsOpen(): void
    {
        $accessIsOpen = $this->room->getAccessIsOpen();
        if (! is_null($accessIsOpen)) {
            $this->attributesForRoom += ['access_is_open' => $accessIsOpen];
        }
    }

    /**
     * @return void
     */
    private function setHasRaisedFloor(): void
    {
        $hasRaisedFloor = $this->room->getHasRaisedFloor();
        if (! is_null($hasRaisedFloor)) {
            $this->attributesForRoom += ['has_raised_floor' => $hasRaisedFloor];
        }
    }

    /**
     * @return void
     */
    private function setResponsible(): void
    {
        $responsible = $this->room->getResponsible();
        if ($responsible) {
            $this->attributesForRoom += ['responsible' => $responsible];
        }
    }

    /**
     * @return void
     */
    private function setUpdatedBy(): void
    {
        $updatedBy = $this->room->getUpdatedBy();
        if ($updatedBy) {
            $this->attributesForRoom += ['updated_by' => $updatedBy];
        }
    }

    /**
     * @return void
     */
    private function setDescription(): void
    {
        $description = $this->room->getDescription();
        if ($description) {
            $this->attributesForRoom += ['description' => $description];
        }
    }

    /**
     * @return void
     */
    private function setDepartmentId(): void
    {
        $departmentId = $this->room->getDepartmentId();
        if ($departmentId) {
            $this->attributesForRoom += ['department_id' => $departmentId];
        }
    }

    /**
     * @return array<mixed> Get attributes array
     */
    public function toArray(): array
    {
        return $this->attributesForRoom;
    }
}
