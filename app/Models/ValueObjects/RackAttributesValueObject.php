<?php

declare(strict_types=1);

namespace App\Models\ValueObjects;

use App\Domain\Interfaces\RackInterfaces\RackEntity;

/**
 * Value object for rack PATCHing (reverse DTO)
 */
class RackAttributesValueObject
{
    /**
     * @var array<mixed>
     */
    private array $attributesForRack = [];

    /**
     * @var RackEntity
     */
    private RackEntity $rack;

    /**
     * @param  RackEntity  $rack
     */
    public function __construct(RackEntity $rack)
    {
        $this->rack = $rack;
        $this->setVendor();
        $this->setAmount();
        $this->setName();
        $this->setUpdatedBy();
        $this->setDepth();
        $this->setDescription();
        $this->setFinanciallyResponsiblePerson();
        $this->setFixedAsset();
        $this->setFrame();
        $this->setHasCooler();
        $this->setHeight();
        $this->setHasExternalUps();
        $this->setInventoryNumber();
        $this->setModel();
        $this->setMaxLoad();
        $this->setHasNumberingFromTopToBottom();
        $this->setLinkToDocs();
        $this->setPlace();
        $this->setPlaceType();
        $this->setPowerSockets();
        $this->setPowerSocketsUps();
        $this->setRow();
        $this->setUnitWidth();
        $this->setUnitDepth();
        $this->setWidth();
        $this->setResponsible();
        $this->setDepartmentId();
        $this->setRoomId();
        $this->setType();
    }

    /**
     * @return void
     */
    private function setName(): void
    {
        $name = $this->rack->getName();
        if ($name) {
            $this->attributesForRack += ['name' => $name];
        }
    }

    /**
     * @return void
     */
    private function setAmount(): void
    {
        $amount = $this->rack->getAmount();
        if ($amount) {
            $this->attributesForRack += ['amount' => $amount];
        }
    }

    /**
     * @return void
     */
    private function setVendor(): void
    {
        $vendor = $this->rack->getVendor();
        if ($vendor) {
            $this->attributesForRack += ['vendor' => $vendor];
        }
    }

    /**
     * @return void
     */
    private function setUpdatedBy(): void
    {
        $updatedBy = $this->rack->getUpdatedBy();
        if ($updatedBy) {
            $this->attributesForRack += ['updated_by' => $updatedBy];
        }
    }

    /**
     * @return void
     */
    private function setModel(): void
    {
        $model = $this->rack->getModel();
        if ($model) {
            $this->attributesForRack += ['model' => $model];
        }
    }

    /**
     * @return void
     */
    private function setDescription(): void
    {
        $description = $this->rack->getDescription();
        if ($description) {
            $this->attributesForRack += ['description' => $description];
        }
    }

    /**
     * @return void
     */
    private function setHasNumberingFromTopToBottom(): void
    {
        $hasNumberingFromTopToBottom = $this->rack->getHasNumberingFromTopToBottom();
        if (! is_null($hasNumberingFromTopToBottom)) {
            $this->attributesForRack += ['has_numbering_from_top_to_bottom' => $hasNumberingFromTopToBottom];
        }
    }

    /**
     * @return void
     */
    private function setResponsible(): void
    {
        $responsible = $this->rack->getResponsible();
        if ($responsible) {
            $this->attributesForRack += ['responsible' => $responsible];
        }
    }

    /**
     * @return void
     */
    private function setFinanciallyResponsiblePerson(): void
    {
        $financiallyResponsiblePerson = $this->rack->getFinanciallyResponsiblePerson();
        if ($financiallyResponsiblePerson) {
            $this->attributesForRack += ['financially_responsible_person' => $financiallyResponsiblePerson];
        }
    }

    /**
     * @return void
     */
    private function setInventoryNumber(): void
    {
        $inventoryNumber = $this->rack->getInventoryNumber();
        if ($inventoryNumber) {
            $this->attributesForRack += ['inventory_number' => $inventoryNumber];
        }
    }

    /**
     * @return void
     */
    private function setFixedAsset(): void
    {
        $fixedAsset = $this->rack->getFixedAsset();
        if ($fixedAsset) {
            $this->attributesForRack += ['fixed_asset' => $fixedAsset];
        }
    }

    /**
     * @return void
     */
    private function setLinkToDocs(): void
    {
        $linkToDocs = $this->rack->getLinkToDocs();
        if ($linkToDocs) {
            $this->attributesForRack += ['link_to_docs' => $linkToDocs];
        }
    }

    /**
     * @return void
     */
    private function setRow(): void
    {
        $row = $this->rack->getRow();
        if ($row) {
            $this->attributesForRack += ['row' => $row];
        }
    }

    /**
     * @return void
     */
    private function setPlace(): void
    {
        $place = $this->rack->getPlace();
        if ($place) {
            $this->attributesForRack += ['place' => $place];
        }
    }

    /**
     * @return void
     */
    private function setHeight(): void
    {
        $height = $this->rack->getHeight();
        if ($height) {
            $this->attributesForRack += ['height' => $height];
        }
    }

    /**
     * @return void
     */
    private function setWidth(): void
    {
        $width = $this->rack->getWidth();
        if ($width) {
            $this->attributesForRack += ['width' => $width];
        }
    }

    /**
     * @return void
     */
    private function setDepth(): void
    {
        $depth = $this->rack->getDepth();
        if ($depth) {
            $this->attributesForRack += ['depth' => $depth];
        }
    }

    /**
     * @return void
     */
    private function setUnitWidth(): void
    {
        $unitWidth = $this->rack->getUnitWidth();
        if ($unitWidth) {
            $this->attributesForRack += ['unit_width' => $unitWidth];
        }
    }

    /**
     * @return void
     */
    private function setUnitDepth(): void
    {
        $unitDepth = $this->rack->getUnitDepth();
        if ($unitDepth) {
            $this->attributesForRack += ['unit_depth' => $unitDepth];
        }
    }

    /**
     * @return void
     */
    private function setType(): void
    {
        $type = $this->rack->getType();
        if ($type) {
            $this->attributesForRack += ['type' => $type];
        }
    }

    /**
     * @return void
     */
    private function setFrame(): void
    {
        $frame = $this->rack->getFrame();
        if ($frame) {
            $this->attributesForRack += ['frame' => $frame];
        }
    }

    /**
     * @return void
     */
    private function setPlaceType(): void
    {
        $placeType = $this->rack->getPlaceType();
        if ($placeType) {
            $this->attributesForRack += ['place_type' => $placeType];
        }
    }

    /**
     * @return void
     */
    private function setMaxLoad(): void
    {
        $maxLoad = $this->rack->getMaxLoad();
        if ($maxLoad) {
            $this->attributesForRack += ['max_load' => $maxLoad];
        }
    }

    /**
     * @return void
     */
    private function setPowerSockets(): void
    {
        $powerSockets = $this->rack->getPowerSockets();
        if ($powerSockets) {
            $this->attributesForRack += ['power_sockets' => $powerSockets];
        }
    }

    /**
     * @return void
     */
    private function setPowerSocketsUps(): void
    {
        $powerSocketsUps = $this->rack->getPowerSocketsUps();
        if ($powerSocketsUps) {
            $this->attributesForRack += ['power_sockets_ups' => $powerSocketsUps];
        }
    }

    /**
     * @return void
     */
    private function setHasExternalUps(): void
    {
        $hasExternalUps = $this->rack->getHasExternalUps();
        if (! is_null($hasExternalUps)) {
            $this->attributesForRack += ['has_external_ups' => $hasExternalUps];
        }
    }

    /**
     * @return void
     */
    private function setHasCooler(): void
    {
        $hasCooler = $this->rack->getHasCooler();
        if (! is_null($hasCooler)) {
            $this->attributesForRack += ['has_cooler' => $hasCooler];
        }
    }

    /**
     * @return void
     */
    private function setDepartmentId(): void
    {
        $departmentId = $this->rack->getDepartmentId();
        if ($departmentId) {
            $this->attributesForRack += ['department_id' => $departmentId];
        }
    }

    /**
     * @return void
     */
    private function setRoomId(): void
    {
        $roomId = $this->rack->getRoomId();
        if ($roomId) {
            $this->attributesForRack += ['room_id' => $roomId];
        }
    }

    /**
     * @return array<mixed> Get attributes array
     */
    public function toArray(): array
    {
        return $this->attributesForRack;
    }
}
