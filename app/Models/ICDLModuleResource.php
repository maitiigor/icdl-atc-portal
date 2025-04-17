<?php
namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Class Shipment
 * @package App\Models
 * @version January 15, 2025, 9:41 pm UTC
 *
 * @property string $customer_id
 * @property string $shipment_date
 * @property boolean $is_completed
 * @property string $expected_arrival_date
 * @property string $arrival_date
 * @property string $reference_reciept
 * @property number $cbm
 */
class ICDLModuleResource extends Model
{
    use Notifiable;
    use HasFactory;

    public $table = 'icdl_module_resources';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'icdl_module_id',
        'resource_name',
        'file_path',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'resource_name' => 'string',
        'file_path' => 'string',
    ];

   

    /**
     * Get all of the trackings for the Shipment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function icdlModule(): BelongsTo
    {
        return $this->belongsTo(ICDLModule::class, 'icdl_module_id', 'id');
    }

}
