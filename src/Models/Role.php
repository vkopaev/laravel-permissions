<?php
namespace Veneridze\LaravelPermission\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Veneridze\LaravelPermission\Attributes\HasPermission;
use Veneridze\LaravelPermission\Permission;
#[HasPermission]

class Role extends Model
{
    protected $guarded = [];
    static string  $label = 'Роль';
    protected $table = 'roles';
    protected $casts = [
        'perms' => 'array',
        'tabs' => 'array',
    ];

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }

    public function relationModel(): string | null {
        if(!$this->model_name) {
            return null;
        }
        return app(Permission::class)->getClass($this->model_name);
    }
}
