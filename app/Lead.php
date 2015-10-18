<?php 

namespace CMV;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CMV\Models\PM\ProjectType;
class Lead extends Model {

    use SoftDeletes;
    
    protected $columns = [
        'id',
        'project_brief',
        'user_id',
        'project_type_id',
        'lead_deadline',
        'files',
        'created_at',
        'deleted_at'
    ];

    protected $casts = [
        'files' => 'array',
    ];

    protected $fillable = [
        'project_brief',
        'lead_deadline'
    ];

    protected $dates = [
        'created_at',
        'deleted_at'
    ];  


    public function user()
    {

        return $this->belongsTo( 'CMV\User' );

    }

    public function type()
    {

        return $this->belongsTo( 'CMV\Models\PM\ProjectType', 'project_type_id' );

    }


    public function createOrFindProjectTypeId($projectTypeName)
    {

        $projectType = ProjectType::firstOrCreate(['name' => $projectTypeName]);

        $this->project_type_id = $projectType->id;
        $this->save();
        
    }

}
