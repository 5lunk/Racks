<?php

declare(strict_types=1);

namespace App\Models;

use App\Domain\Interfaces\DeviceInterfaces\DeviceBusinessRules;
use App\Domain\Interfaces\DeviceInterfaces\DeviceEntity;
use App\Enums\DevicePowerACDCEnum;
use App\Enums\DevicePowerTypeEnum;
use App\Enums\DeviceStatusEnum;
use App\Enums\DeviceTypeEnum;
use App\Models\HelperObjects\DeviceAttributesHelperObject;
use App\Models\ValueObjects\DeviceUnitsValueObject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Device
 *
 * @mixin Eloquent
 *
 * @method static \Illuminate\Database\Query\Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static \App\Models\Device create(array $attributes = [])
 *
 * @property int $id PK
 * @property string|null $vendor Vendor
 * @property string|null $model Model
 * @property string $type Device type {@see DeviceTypeEnum}
 * @property string $status Device status {@see DeviceStatusEnum}
 * @property-read int $has_backside_location Backside location (non-standard)
 * @property mixed $units Units {@see DeviceUnitsValueObject}
 * @property string|null $hostname Hostname (if available)
 * @property string|null $ip IP-address (if available)
 * @property int|null $stack Stack or reserve
 * @property int|null $ports_amount Ports amount (if available)
 * @property string|null $software_version Software version or OS (if available)
 * @property string $power_type Power type {@see DevicePowerTypeEnum}
 * @property int|null $power_w Power W
 * @property int|null $power_v Power V
 * @property string $power_ac_dc AC/DC {@see DevicePowerACDCEnum}
 * @property string|null $serial_number Serial number
 * @property string|null $description Description text
 * @property string|null $project Project identifier
 * @property string $ownership Ownership
 * @property string|null $responsible Responsible person
 * @property string|null $financially_responsible_person Financially responsible person
 * @property string|null $inventory_number Inventory number (usually contains letters)
 * @property string|null $fixed_asset Fixed asset (usually contains letters)
 * @property string|null $link_to_docs Link to documentation
 * @property string $updated_by Updated by user (username)
 * @property int $department_id Department ID {@see AuthServiceProvider}
 * @property \Illuminate\Support\Carbon|null $created_at Created at
 * @property \Illuminate\Support\Carbon|null $updated_at Updated at
 * @property int $rack_id Foreign key
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereFinanciallyResponsiblePerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereFixedAsset($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereHasBacksideLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereHostname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereInventoryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereLinkToDocs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereOwnership($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device wherePortsAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device wherePowerAcDc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device wherePowerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device wherePowerV($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device wherePowerW($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereProject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereRackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereResponsible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereSoftwareVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereStack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereVendor($value)
 *
 * @property-read \App\Models\Department $department
 * @property-read \App\Models\Rack $rack
 */
class Device extends Model implements DeviceBusinessRules, DeviceEntity
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'vendor',
        'model',
        'type',
        'has_backside_location',
        'units',
        'status',
        'hostname',
        'ip',
        'stack',
        'ports_amount',
        'software_version',
        'power_type',
        'power_w',
        'power_v',
        'power_ac_dc',
        'serial_number',
        'description',
        'project',
        'ownership',
        'responsible',
        'financially_responsible_person',
        'inventory_number',
        'fixed_asset',
        'link_to_docs',
        'rack_id',
        'department_id',
        'updated_by',
        'created_at',
        'updated_at',
    ];

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
    public function getType(): ?string
    {
        return $this->attributes['type'];
    }

    /**
     * @param  string|null  $type
     * @return void
     *
     * @throws \DomainException $type is not in DeviceTypeEnum
     */
    public function setType(?string $type): void
    {
        if (! is_null($type)
            && ! in_array($type, array_column(DeviceTypeEnum::cases(), 'value'))) {
            throw new \DomainException('$type is not in DeviceTypeEnum');
        }
        $this->attributes['type'] = $type;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->attributes['status'];
    }

    /**
     * @param  string|null  $status
     * @return void
     *
     * @throws \DomainException $status is not in DeviceStatusEnum
     */
    public function setStatus(?string $status): void
    {
        if (! is_null($status)
            && ! in_array($status, array_column(DeviceStatusEnum::cases(), 'value'))) {
            throw new \DomainException('$status is not in DeviceStatusEnum');
        }
        $this->attributes['status'] = $status;
    }

    /**
     * @return string|null
     */
    public function getHostname(): ?string
    {
        return $this->attributes['hostname'];
    }

    /**
     * @param  string|null  $hostname
     * @return void
     */
    public function setHostname(?string $hostname): void
    {
        $this->attributes['hostname'] = $hostname;
    }

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->attributes['ip'];
    }

    /**
     * IPv4 validation
     *
     * @param  string|null  $ip
     * @return void
     */
    public function setIp(?string $ip): void
    {
        if (! is_null($ip) &&
            ! filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new \DomainException('$ip is not valid');
        }
        $this->attributes['ip'] = $ip;
    }

    /**
     * @return int|null
     */
    public function getStack(): ?int
    {
        return $this->attributes['stack'];
    }

    /**
     * @param  int|null  $stack
     * @return void
     *
     * @throws \DomainException $stack <= 0
     */
    public function setStack(?int $stack): void
    {
        if (! is_null($stack) && $stack <= 0) {
            throw new \DomainException('$stack <= 0');
        }
        $this->attributes['stack'] = $stack;
    }

    /**
     * @return int|null
     */
    public function getPortsAmount(): ?int
    {
        return $this->attributes['ports_amount'];
    }

    /**
     * @param  int|null  $portsAmount
     * @return void
     *
     * @throws \DomainException $portsAmount <= 0
     */
    public function setPortsAmount(?int $portsAmount): void
    {
        if (! is_null($portsAmount) && $portsAmount <= 0) {
            throw new \DomainException('$portsAmount <= 0');
        }
        $this->attributes['ports_amount'] = $portsAmount;
    }

    /**
     * @return string|null
     */
    public function getSoftwareVersion(): ?string
    {
        return $this->attributes['software_version'];
    }

    /**
     * @param  string|null  $softwareVersion
     * @return void
     */
    public function setSoftwareVersion(?string $softwareVersion): void
    {
        $this->attributes['software_version'] = $softwareVersion;
    }

    /**
     * @return string|null
     */
    public function getPowerType(): ?string
    {
        return $this->attributes['power_type'];
    }

    /**
     * @param  string|null  $powerType
     * @return void
     *
     * @throws \DomainException $powerType is not in DevicePowerTypeEnum
     */
    public function setPowerType(?string $powerType): void
    {
        if (! is_null($powerType)
            && ! in_array($powerType, array_column(DevicePowerTypeEnum::cases(), 'value'))) {
            throw new \DomainException('$powerType is not in DevicePowerTypeEnum');
        }
        $this->attributes['power_type'] = $powerType;
    }

    /**
     * @return int|null
     */
    public function getPowerW(): ?int
    {
        return $this->attributes['power_w'];
    }

    /**
     * @param  int|null  $powerW
     * @return void
     *
     * @throws \DomainException $powerW <= 0
     */
    public function setPowerW(?int $powerW): void
    {
        if (! is_null($powerW) && $powerW <= 0) {
            throw new \DomainException('$powerW <= 0');
        }
        $this->attributes['power_w'] = $powerW;
    }

    /**
     * @return int|null
     */
    public function getPowerV(): ?int
    {
        return $this->attributes['power_v'];
    }

    /**
     * @param  int|null  $powerV
     * @return void
     *
     * @throws \DomainException $powerV <= 0
     */
    public function setPowerV(?int $powerV): void
    {
        if (! is_null($powerV) && $powerV <= 0) {
            throw new \DomainException('$powerV <= 0');
        }
        $this->attributes['power_v'] = $powerV;
    }

    /**
     * @return string|null
     */
    public function getPowerACDC(): ?string
    {
        return $this->attributes['power_ac_dc'];
    }

    /**
     * @param  string|null  $powerACDC
     * @return void
     *
     * @throws \DomainException $powerACDC is not in DevicePowerACDCEnum
     */
    public function setPowerACDC(?string $powerACDC): void
    {
        if (! is_null($powerACDC)
            && ! in_array($powerACDC, array_column(DevicePowerACDCEnum::cases(), 'value'))) {
            throw new \DomainException('$powerACDC is not in DevicePowerACDCEnum');
        }
        $this->attributes['power_ac_dc'] = $powerACDC;
    }

    /**
     * @return string|null
     */
    public function getSerialNumber(): ?string
    {
        return $this->attributes['serial_number'];
    }

    /**
     * @param  string|null  $serialNumber
     * @return void
     */
    public function setSerialNumber(?string $serialNumber): void
    {
        $this->attributes['serial_number'] = $serialNumber;
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
     * @return string|null
     */
    public function getProject(): ?string
    {
        return $this->attributes['project'];
    }

    /**
     * @param  string|null  $project
     * @return void
     */
    public function setProject(?string $project): void
    {
        $this->attributes['project'] = $project;
    }

    /**
     * @return string|null
     */
    public function getOwnership(): ?string
    {
        return $this->attributes['ownership'];
    }

    /**
     * @param  string|null  $ownership
     * @return void
     */
    public function setOwnership(?string $ownership): void
    {
        $this->attributes['ownership'] = $ownership;
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
     * @return DeviceUnitsValueObject
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \DomainException $units json decode failed
     * @throws \DomainException $units not match any possible type
     */
    public function getUnits(): DeviceUnitsValueObject
    {
        $units = $this->attributes['units'];
        if (is_string($units)) {
            try {
                $unitsArray = json_decode($units, false, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $e) {
                throw new \DomainException('$units json decode failed');
            }
        } elseif ($units instanceof DeviceUnitsValueObject) {
            $unitsArray = $units->toArray();
        } elseif (is_array($units)) {
            $unitsArray = $units;
        } else {
            throw new \DomainException('$units dont match any allowed type');
        }

        return resolve_proxy(DeviceUnitsValueObject::class, ['units' => $unitsArray]);
    }

    /**
     * @param  DeviceUnitsValueObject  $units
     * @return void
     */
    public function setUnits(DeviceUnitsValueObject $units): void
    {
        $this->attributes['units'] = $units;
    }

    /**
     * @return int|null
     */
    public function getRackId(): ?int
    {
        return $this->attributes['rack_id'];
    }

    /**
     * @param  int|null  $rackId
     * @return void
     *
     * @throws \DomainException $rackId <= 0
     */
    public function setRackId(?int $rackId): void
    {
        if (! is_null($rackId) && $rackId <= 0) {
            throw new \DomainException('$rackId <= 0');
        }
        $this->attributes['rack_id'] = $rackId;
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
     * @return bool|null
     */
    public function getLocation(): ?bool
    {
        if (is_null($this->attributes['has_backside_location'])) {
            return null;
        }

        return (bool) $this->attributes['has_backside_location'];
    }

    /**
     * @param  bool|null  $location
     * @return void
     */
    public function setLocation(?bool $location): void
    {
        $this->attributes['has_backside_location'] = $location;
    }

    /**
     * @return Attribute
     */
    protected function hasBacksideLocation(): Attribute
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
     * @param  array<mixed>|string  $with
     * @return Model|null
     */
    public function fresh($with = []): ?Model
    {
        return parent::fresh($with);
    }

    /**
     * Get attributes for patch method
     *
     * @return DeviceAttributesHelperObject
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getAttributeSet(): DeviceAttributesHelperObject
    {
        return resolve_proxy(DeviceAttributesHelperObject::class, ['device' => $this]);
    }

    /**
     * Belongs to rack
     *
     * @return BelongsTo
     */
    public function rack(): BelongsTo
    {
        return $this->belongsTo(Rack::class, 'rack_id');
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
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return parent::toArray();
    }
}
