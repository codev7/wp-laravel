<?php 

namespace CMV;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Project extends Model {

	use SoftDeletes;
    
    protected $columns = [
        'id',
        'files',
        'project_type_id',
        'html_developer_id',
        'javascript_developer_id',
        'qa_engineer_id',
        'wordpress_developer_id',
        'git_url',
        'lead_id',
        'customer_id',
        'title',
        'deadline',
        'status',
        'subdomain',
        'contractor_payout',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'files' => 'array',
        'contractor_payout' => 'array'
    ];

    protected $fillable = [
        'project_type_id',
        'html_developer_id',
        'javascript_developer_id',
        'qa_engineer_id',
        'wordpress_developer_id',
        'git_url',
        'lead_id',
        'title',
        'deadline',
        'status',
        'subdomain'
    ];

    protected $dates = [
        'deadline',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function customer()
    {

        return $this->belongsTo( 'CMV\User', 'customer_id' );

    }

    public function htmlDeveloper()
    {

        return $this->belongsTo( 'CMV\User', 'html_developer_id' );

    }

    public function javascriptDeveloper()
    {

        return $this->belongsTo( 'CMV\User', 'javascript_developer_id' );

    }

    public function qaEngineer()
    {

        return $this->belongsTo( 'CMV\User', 'qa_engineer_id' );

    }

    public function wordpressDeveloper()
    {

        return $this->belongsTo( 'CMV\User', 'wordpress_developer_id' );

    }

    public function lead()
    {

        return $this->belongsTo( 'CMV\Lead' );

    }

    public function type()
    {

        return $this->belongsTo( 'CMV\ProjectType' );

    }


    public function invoices()
    {

        return $this->hasMany( 'CMV\Invoice' );

    }

}
