<?php

declare(strict_types=1);

namespace App\Models;

use App\Domain\Interfaces\DeviceInterfaces\DeviceEntity;
use App\Domain\Interfaces\RackInterfaces\RackBusinessRules;
use App\Domain\Interfaces\RackInterfaces\RackEntity;
use App\Enums\RackFrameEnum;
use App\Enums\RackPlaceTypeEnum;
use App\Enums\RackTypeEnum;
use App\Models\Traits\UniqueNameableTrait;
use App\Models\ValueObjects\RackAttributesValueObject;
use App\Models\ValueObjects\RackBusyUnitsValueObject;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Rack
 *
 * @mixin Eloquent
 *
 * @method static \Illuminate\Database\Query\Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static \App\Models\Rack create(array $attributes = [])
 * @method static \Illuminate\Pagination\LengthAwarePaginator paginate(?int $perPage, array $columns)
 *
 * @property int $id PK
 * @property string $name Name, number or other identifier
 * @property string|null $vendor Vendor
 * @property string|null $model Model
 * @property int $amount Amount of units
 * @property string|null $description Description text
 * @property mixed $busy_units Busy units {@see RackBusyUnitsValueObject}
 * @property-read int $has_numbering_from_top_to_bottom Has numbering from top to bottom (non-standard)
 * @property string|null $responsible Responsible person
 * @property string|null $financially_responsible_person Financially responsible person
 * @property string|null $inventory_number Inventory number (usually contains letters)
 * @property string|null $fixed_asset Fixed asset (usually contains letters)
 * @property string|null $link_to_docs Link to documentation
 * @property string|null $row Row (some time contains letters)
 * @property string|null $place Place (some time contains letters)
 * @property int|null $height Height im mm
 * @property int|null $width Width in mm
 * @property int|null $depth Depth in mm
 * @property int|null $unit_width Unit width in mm
 * @property int|null $unit_depth Unit depth in mm
 * @property string $type Rack type {@see RackTypeEnum}
 * @property string $frame Rack frame type {@see RackFrameEnum}
 * @property string $place_type Rack place type {@see RackPlaceTypeEnum}
 * @property int|null $max_load Max load in kg
 * @property int|null $power_sockets Unused power sockets
 * @property int|null $power_sockets_ups Unused power UPS sockets
 * @property-read int $has_external_ups Has external UPS
 * @property-read int $has_cooler Has cooler
 * @property string $updated_by Updated by user (username)
 * @property int $department_id Department ID {@see AuthServiceProvider}
 * @property \Illuminate\Support\Carbon|null $created_at Created at
 * @property \Illuminate\Support\Carbon|null $updated_at Updated at
 * @property int $room_id Foreign key
 * @property-read \App\Models\Room $room
 * @property-read \App\Models\Department $department
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Device> $devices
 * @property-read int|null $devices_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Rack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rack query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereBusyUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereFinanciallyResponsiblePerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereFixedAsset($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereFrame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereHasCooler($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereHasExternalUps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereHasNumberingFromTopToBottom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereInventoryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereLinkToDocs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereMaxLoad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack wherePlaceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack wherePowerSockets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack wherePowerSocketsUps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereResponsible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereUnitDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereUnitWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereVendor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rack whereWidth($value)
 */
class Rack extends Model implements RackBusinessRules, RackEntity
{
    use UniqueNameableTrait;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'amount',
        'room_id',
        'vendor',
        'model',
        'description',
        'has_numbering_from_top_to_bottom',
        'responsible',
        'financially_responsible_person',
        'inventory_number',
        'fixed_asset',
        'link_to_docs',
        'row',
        'place',
        'height',
        'width',
        'depth',
        'unit_width',
        'unit_depth',
        'type',
        'frame',
        'place_type',
        'max_load',
        'power_sockets',
        'power_sockets_ups',
        'has_external_ups',
        'has_cooler',
        'department_id',
        'updated_by',
        'busy_units',
        'created_at',
        'updated_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Business rules
    |--------------------------------------------------------------------------
    */
    /**
     * @see RackBusinessRules::addNewBusyUnits()
     *
     * @param  DeviceEntity  $device
     * @return RackBusyUnitsValueObject
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \DomainException $units is not valid
     */
    public function addNewBusyUnits(DeviceEntity $device): RackBusyUnitsValueObject
    {
        $updatedBusyUnitsForSide = array_merge(
            $this->getBusyUnits()->getUnitsForSide($device->getLocation()),
            $device->getUnits()->toArray()
        );
        $this->setBusyUnits(
            $this->getBusyUnits()->updateBusyUnits(
                $updatedBusyUnitsForSide,
                $device->getLocation()
            )
        );

        return $this->getBusyUnits();
    }

    /**
     * @see RackBusinessRules::deleteOldBusyUnits()
     *
     * @param  DeviceEntity  $device
     * @return RackBusyUnitsValueObject
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \DomainException $units is not valid
     */
    public function deleteOldBusyUnits(DeviceEntity $device): RackBusyUnitsValueObject
    {
        $updatedBusyUnitsForSide = array_diff(
            $this->getBusyUnits()->getUnitsForSide($device->getLocation()),
            $device->getUnits()->toArray()
        );
        $this->setBusyUnits(
            $this->getBusyUnits()->updateBusyUnits(
                $updatedBusyUnitsForSide,
                $device->getLocation()
            )
        );

        return $this->getBusyUnits();
    }

    /**
     * @see RackBusinessRules::isDeviceAddable()
     *
     * @param  DeviceEntity  $device
     * @return bool
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \DomainException $units is not valid
     */
    public function isDeviceAddable(DeviceEntity $device): bool
    {
        $unitsIntersect = array_intersect(
            $device->getUnits()->toArray(),
            $this->getBusyUnits()->getUnitsForSide(
                $device->getLocation()
            )
        );
        if (count($unitsIntersect) > 0) {
            return false;
        }

        return true;
    }

    /**
     * @see RackBusinessRules::hasDeviceUnits()
     *
     * @param  DeviceEntity  $device
     * @return bool
     *
     * @throws \DomainException $units is not valid
     */
    public function hasDeviceUnits(DeviceEntity $device): bool
    {
        $deviceUnits = $device->getUnits()->toArray();
        if (end($deviceUnits) > $this->getAmount()) {
            return false;
        }

        return true;
    }

    /**
     * @see RackBusinessRules::isDeviceMovingValid()
     *
     * @param  DeviceEntity  $device
     * @param  DeviceEntity  $deviceUpdating
     * @return bool
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \DomainException units is not valid
     */
    public function isDeviceMovingValid(DeviceEntity $device, DeviceEntity $deviceUpdating): bool
    {
        $busyUnitsForMove = array_diff(
            $this->getBusyUnits()->getUnitsForSide($device->getLocation()),
            $device->getUnits()->toArray()
        );
        $unitsIntersect = array_intersect(
            $deviceUpdating->getUnits()->toArray(),
            $busyUnitsForMove
        );
        if (count($unitsIntersect) > 0) {
            return false;
        }

        return true;
    }
    /*
    |--------------------------------------------------------------------------
    */

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->attributes['name'];
    }

    /**
     * @param  string|null  $name
     * @return void
     */
    public function setName(?string $name): void
    {
        $this->attributes['name'] = $name;
    }

    /**
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->attributes['amount'];
    }

    /**
     * @param  int|null  $amount
     * @return void
     *
     * @throws \DomainException $amount <= 0
     */
    public function setAmount(?int $amount): void
    {
        if (! is_null($amount) && $amount <= 0) {
            throw new \DomainException('$amount <= 0');
        }
        $this->attributes['amount'] = $amount;
    }

    /**
     * @return string|null
     */
    public function getVendor(): ?string
    {
        return $this->attributes['vendor'];
    }

    /**
     * @param  string|null  $vendor
     * @return void
     */
    public function setVendor(?string $vendor): void
    {
        $this->attributes['vendor'] = $vendor;
    }

    /**
     * @return string|null
     */
    public function getModel(): ?string
    {
        return $this->attributes['model'];
    }

    /**
     * @param  string|null  $model
     * @return void
     */
    public function setModel(?string $model): void
    {
        $this->attributes['model'] = $model;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->attributes['description'];
    }

    /**
     * @param  string|null  $description
     * @return void
     */
    public function setDescription(?string $description): void
    {
        $this->attributes['description'] = $description;
    }

    /**
     * @return bool|null
     */
    public function getHasNumberingFromTopToBottom(): ?bool
    {
        if (is_null($this->attributes['has_numbering_from_top_to_bottom'])) {
            return null;
        }

        return (bool) $this->attributes['has_numbering_from_top_to_bottom'];
    }

    /**
     * @param  bool|null  $hasNumberingFromTopToBottom
     * @return void
     */
    public function setHasNumberingFromTopToBottom(?bool $hasNumberingFromTopToBottom): void
    {
        $this->attributes['has_numbering_from_top_to_bottom'] = $hasNumberingFromTopToBottom;
    }

    /**
     * @return string|null
     */
    public function getResponsible(): ?string
    {
        return $this->attributes['responsible'];
    }

    /**
     * @param  string|null  $responsible
     * @return void
     */
    public function setResponsible(?string $responsible): void
    {
        $this->attributes['responsible'] = $responsible;
    }

    /**
     * @return string|null
     */
    public function getFinanciallyResponsiblePerson(): ?string
    {
        return $this->attributes['financially_responsible_person'];
    }

    /**
     * @param  string|null  $financiallyResponsiblePerson
     * @return void
     */
    public function setFinanciallyResponsiblePerson(?string $financiallyResponsiblePerson): void
    {
        $this->attributes['financially_responsible_person'] = $financiallyResponsiblePerson;
    }

    /**
     * @return string|null
     */
    public function getInventoryNumber(): ?string
    {
        return $this->attributes['inventory_number'];
    }

    /**
     * @param  string|null  $inventoryNumber
     * @return void
     */
    public function setInventoryNumber(?string $inventoryNumber): void
    {
        $this->attributes['inventory_number'] = $inventoryNumber;
    }

    /**
     * @return string|null
     */
    public function getFixedAsset(): ?string
    {
        return $this->attributes['fixed_asset'];
    }

    /**
     * @param  string|null  $fixedAsset
     * @return void
     */
    public function setFixedAsset(?string $fixedAsset): void
    {
        $this->attributes['fixed_asset'] = $fixedAsset;
    }

    /**
     * @return string|null
     */
    public function getLinkToDocs(): ?string
    {
        return $this->attributes['link_to_docs'];
    }

    /**
     * @param  string|null  $linkToDocs
     * @return void
     */
    public function setLinkToDocs(?string $linkToDocs): void
    {
        $this->attributes['link_to_docs'] = $linkToDocs;
    }

    /**
     * @return string|null
     */
    public function getRow(): ?string
    {
        return $this->attributes['row'];
    }

    /**
     * @param  string|null  $row
     * @return void
     */
    public function setRow(?string $row): void
    {
        $this->attributes['row'] = $row;
    }

    /**
     * @return string|null
     */
    public function getPlace(): ?string
    {
        return $this->attributes['place'];
    }

    /**
     * @param  string|null  $place
     * @return void
     */
    public function setPlace(?string $place): void
    {
        $this->attributes['place'] = $place;
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->attributes['height'];
    }

    /**
     * @param  int|null  $height
     * @return void
     *
     * @throws \DomainException $height <= 0
     */
    public function setHeight(?int $height): void
    {
        if (! is_null($height) && $height <= 0) {
            throw new \DomainException('$height <= 0');
        }
        $this->attributes['height'] = $height;
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->attributes['width'];
    }

    /**
     * @param  int|null  $width
     * @return void
     *
     * @throws \DomainException $width <= 0
     */
    public function setWidth(?int $width): void
    {
        if (! is_null($width) && $width <= 0) {
            throw new \DomainException('$width <= 0');
        }
        $this->attributes['width'] = $width;
    }

    /**
     * @return int|null
     */
    public function getDepth(): ?int
    {
        return $this->attributes['depth'];
    }

    /**
     * @param  int|null  $depth
     * @return void
     *
     * @throws \DomainException $depth <= 0
     */
    public function setDepth(?int $depth): void
    {
        if (! is_null($depth) && $depth <= 0) {
            throw new \DomainException('$depth <= 0');
        }
        $this->attributes['depth'] = $depth;
    }

    /**
     * @return int|null
     */
    public function getUnitWidth(): ?int
    {
        return $this->attributes['unit_width'];
    }

    /**
     * @param  int|null  $unitWidth
     * @return void
     *
     * @throws \DomainException $unitWidth <= 0
     */
    public function setUnitWidth(?int $unitWidth): void
    {
        if (! is_null($unitWidth) && $unitWidth <= 0) {
            throw new \DomainException('$unitWidth <= 0');
        }
        $this->attributes['unit_width'] = $unitWidth;
    }

    /**
     * @return int|null
     */
    public function getUnitDepth(): ?int
    {
        return $this->attributes['unit_depth'];
    }

    /**
     * @param  int|null  $unitDepth
     * @return void
     *
     * @throws \DomainException $unitDepth <= 0
     */
    public function setUnitDepth(?int $unitDepth): void
    {
        if (! is_null($unitDepth) && $unitDepth <= 0) {
            throw new \DomainException('$unitDepth <= 0');
        }
        $this->attributes['unit_depth'] = $unitDepth;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->attributes['type'];
    }

    /**
     * @param  string|null  $type
     * @return void
     *
     * @throws \DomainException $type is not in RackTypeEnum
     */
    public function setType(?string $type): void
    {
        if (! is_null($type)
            && ! in_array($type, array_column(RackTypeEnum::cases(), 'value'))) {
            throw new \DomainException('$type is not in RackTypeEnum');
        }
        $this->attributes['type'] = $type;
    }

    /**
     * @return string|null
     */
    public function getFrame(): ?string
    {
        return $this->attributes['frame'];
    }

    /**
     * @param  string|null  $frame
     * @return void
     *
     * @throws \DomainException $frame is not in RackFrameEnum
     */
    public function setFrame(?string $frame): void
    {
        if (! is_null($frame)
            && ! in_array($frame, array_column(RackFrameEnum::cases(), 'value'))) {
            throw new \DomainException('$frame is not in RackFrameEnum');
        }
        $this->attributes['frame'] = $frame;
    }

    /**
     * @return string|null
     */
    public function getPlaceType(): ?string
    {
        return $this->attributes['place_type'];
    }

    /**
     * @param  string|null  $placeType
     * @return void
     *
     * @throws \DomainException $placeType is not in RackPlaceTypeEnum
     */
    public function setPlaceType(?string $placeType): void
    {
        if (! is_null($placeType)
            && ! in_array($placeType, array_column(RackPlaceTypeEnum::cases(), 'value'))) {
            throw new \DomainException('$placeType is not in RackPlaceTypeEnum');
        }
        $this->attributes['place_type'] = $placeType;
    }

    /**
     * @return int|null
     */
    public function getMaxLoad(): ?int
    {
        return $this->attributes['max_load'];
    }

    /**
     * @param  int|null  $maxLoad
     * @return void
     *
     * @throws \DomainException $maxLoad <= 0
     */
    public function setMaxLoad(?int $maxLoad): void
    {
        if (! is_null($maxLoad) && $maxLoad <= 0) {
            throw new \DomainException('$maxLoad <= 0');
        }
        $this->attributes['max_load'] = $maxLoad;
    }

    /**
     * @return int|null
     */
    public function getPowerSockets(): ?int
    {
        return $this->attributes['power_sockets'];
    }

    /**
     * @param  int|null  $powerSockets
     * @return void
     *
     * @throws \DomainException $powerSockets <= 0
     */
    public function setPowerSockets(?int $powerSockets): void
    {
        if (! is_null($powerSockets) && $powerSockets <= 0) {
            throw new \DomainException('$powerSockets <= 0');
        }
        $this->attributes['power_sockets'] = $powerSockets;
    }

    /**
     * @return int|null
     */
    public function getPowerSocketsUps(): ?int
    {
        return $this->attributes['power_sockets_ups'];
    }

    /**
     * @param  int|null  $powerSocketsUps
     * @return void
     *
     * @throws \DomainException $powerSocketsUps <= 0
     */
    public function setPowerSocketsUps(?int $powerSocketsUps): void
    {
        if (! is_null($powerSocketsUps) && $powerSocketsUps <= 0) {
            throw new \DomainException('$powerSocketsUps <= 0');
        }
        $this->attributes['power_sockets_ups'] = $powerSocketsUps;
    }

    /**
     * @return bool|null
     */
    public function getHasExternalUps(): ?bool
    {
        if (is_null($this->attributes['has_external_ups'])) {
            return null;
        }

        return (bool) $this->attributes['has_external_ups'];
    }

    /**
     * @param  bool|null  $hasExternalUps
     * @return void
     */
    public function setHasExternalUps(?bool $hasExternalUps): void
    {
        $this->attributes['has_external_ups'] = $hasExternalUps;
    }

    /**
     * @return bool|null
     */
    public function getHasCooler(): ?bool
    {
        if (is_null($this->attributes['has_cooler'])) {
            return null;
        }

        return (bool) $this->attributes['has_cooler'];
    }

    /**
     * @param  bool|null  $hasCooler
     * @return void
     */
    public function setHasCooler(?bool $hasCooler): void
    {
        $this->attributes['has_cooler'] = $hasCooler;
    }

    /**
     * @return int|null
     */
    public function getRoomId(): ?int
    {
        return $this->attributes['room_id'];
    }

    /**
     * @param  int|null  $roomId
     * @return void
     *
     * @throws \DomainException $roomId <= 0
     */
    public function setRoomId(?int $roomId): void
    {
        if (! is_null($roomId) && $roomId <= 0) {
            throw new \DomainException('$roomId <= 0');
        }
        $this->attributes['room_id'] = $roomId;
    }

    /**
     * @return int|null
     */
    public function getDepartmentId(): ?int
    {
        return $this->attributes['department_id'];
    }

    /**
     * @param  int|null  $departmentId
     * @return void
     *
     * @throws \DomainException $departmentId <= 0
     */
    public function setDepartmentId(?int $departmentId): void
    {
        if (! is_null($departmentId) && $departmentId <= 0) {
            throw new \DomainException('$departmentId <= 0');
        }
        $this->attributes['department_id'] = $departmentId;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    /**
     * @param  string|null  $oldName
     * @return void
     */
    public function setOldName(?string $oldName): void
    {
        $this->attributes['old_name'] = $oldName;
    }

    /**
     * @return string|null
     */
    public function getOldName(): ?string
    {
        return $this->attributes['old_name'];
    }

    /**
     * @return RackBusyUnitsValueObject
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \DomainException $busyUnits json decode failed
     * @throws \DomainException $busyUnits not match any possible type
     */
    public function getBusyUnits(): RackBusyUnitsValueObject
    {
        $busyUnits = $this->attributes['busy_units'];
        if (is_string($busyUnits)) {
            try {
                $busyUnitsArray = json_decode($busyUnits, true, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $e) {
                throw new \DomainException('$busyUnits json decode failed');
            }
        } elseif ($busyUnits instanceof RackBusyUnitsValueObject) {
            $busyUnitsArray = $busyUnits->toArray();
        } elseif (is_array($busyUnits)) {
            $busyUnitsArray = $busyUnits;
        } else {
            throw new \DomainException('$busyUnits dont match any allowed type');
        }

        return App()->makeWith(RackBusyUnitsValueObject::class, ['busyUnits' => $busyUnitsArray]);
    }

    /**
     * @param  RackBusyUnitsValueObject  $busyUnits
     * @return void
     */
    public function setBusyUnits(RackBusyUnitsValueObject $busyUnits): void
    {
        $this->attributes['busy_units'] = $busyUnits;
    }

    /**
     * @return RackAttributesValueObject
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getAttributeSet(): RackAttributesValueObject
    {
        return App()->makeWith(RackAttributesValueObject::class, ['rack' => $this]);
    }

    /**
     * @return Attribute
     */
    protected function hasNumberingFromTopToBottom(): Attribute
    {
        return Attribute::make(
            get: fn (bool $value) => (bool) $value
        );
    }

    /**
     * @return Attribute
     */
    protected function hasCooler(): Attribute
    {
        return Attribute::make(
            get: fn (bool $value) => (bool) $value
        );
    }

    /**
     * @return Attribute
     */
    protected function hasExternalUps(): Attribute
    {
        return Attribute::make(
            get: fn (bool $value) => (bool) $value
        );
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->attributes['updated_by'];
    }

    /**
     * @param  string|null  $updatedBy
     * @return void
     */
    public function setUpdatedBy(?string $updatedBy): void
    {
        $this->attributes['updated_by'] = $updatedBy;
    }

    /**
     * Belongs to room
     *
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Belongs to department
     *
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * Has many racks
     *
     * @return HasMany
     */
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class, 'rack_id');
    }

    /**
     * @param  array<mixed>|string  $with
     * @return Model|null
     */
    public function fresh($with = []): ?Model
    {
        return parent::fresh($with);
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return parent::toArray();
    }
}
