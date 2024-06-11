<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Portaria extends Model
{
    use HasFactory;

    protected $table = 'portarias';
    protected $fillable = [
        'ano',
        'data',
        'processo',
        'usuario_id',
        'setor_id',
        'assunto_id',
        'data_inicio',
        'data_final',
        'observacoes',
        'destino',
        'numero',
        'deleted_at',
        'deleted_by',
        'updated_by',
    ];

    /**
     * Get the Setor that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function setor(): BelongsTo
    {
        return $this->belongsTo(Setor::class, 'setor_id');
    }

    /**
     * Get the Assunto that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assunto(): BelongsTo
    {
        return $this->belongsTo(Assunto::class, 'assunto_id');
    }

    /**
     * Get the Usuario that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Get the Usuario that deletes the Portaria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deleted_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    /**
     * Get the Usuario that updates the Portaria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updated_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
