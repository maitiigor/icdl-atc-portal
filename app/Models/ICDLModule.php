<?php

namespace App\Models;



use Eloquent as Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Customer
 * @package App\Models
 * @version January 15, 2025, 9:41 pm UTC
 *
 * @property string $name
 * @property number $available_cbm
 * @property number $accumulated_cbm
 */
class ICDLModule extends Model
{

    
    use SoftDeletes;

    use HasFactory;

    public $table = 'icdl_modules';
    

    protected $dates = ['deleted_at'];


    /**
     * The attributes that should be fillable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'parent_id', // Ensure this field exists in the database table before uncommenting
        'image',
        'short_description',
        'full_description',
        'amount',
        'is_available'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'short_description' => 'string',
        'full_description' => 'string',
        'image' => 'string',
        'amount' => 'float',
        'is_available' => 'boolean',
    ];


    /**
     * Get the parent that owns the ICDLModule
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subModules(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
   
    /**
     * Get all of the applications for the ICDLModule
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applications(): HasMany
    {
        return $this->hasMany(ICDLApplication::class, 'icdl_module_id', 'id');
    }

    /**
     * Get all of the resources for the ICDLModule
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resources(): HasMany
    {
        return $this->hasMany(ICDLModuleResource::class, 'icdl_module_id', 'id');
    }

    

}
