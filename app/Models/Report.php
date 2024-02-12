<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';

    protected $fillable = [
        'Rec_Date',
        'Verify_Date',
        'Customer',
        'Invoice_No',
        'autograph_1',
        'autograph_2',
        'autograph_3',
        'autograph_user_1',
        'autograph_user_2',
        'autograph_user_3',
        'created_by',
        'attachment',
        'is_approve',
        'description',
        'num_of_parts',
        // Add other fields as needed
    ];

    // Define relationships if needed
    public function details()
    {
        return $this->hasMany(Detail::class);
    }

    public function updateAutograph($section, $signaturePath)
    {
        switch ($section) {
            case 1:
                $this->update(['autograph_1' => $signaturePath]);
                break;
            case 2:
                $this->update(['autograph_2' => $signaturePath]);
                break;
            case 3:
                $this->update(['autograph_3' => $signaturePath]);
                break;
            default:
                // Handle other cases if needed
                break;
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Get the current record's position in the table
            $position = static::count() + 1;

            // Calculate the increment number
            $increment = str_pad($position, 4, '0', STR_PAD_LEFT);

            // Get the date portion
            $date = now()->format('ymd'); // Assuming you want the current date

            // Build the custom ID
            $customId = "VQC/{$increment}/{$date}";

            // Assign the custom ID to the model
            $model->doc_num = $customId;
        });
    }
}
