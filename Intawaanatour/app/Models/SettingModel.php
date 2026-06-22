<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table         = 'settings';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['key', 'value', 'updated_at'];
    protected $useTimestamps = false;

    /**
     * Kembalikan seluruh setting sebagai map key => value.
     */
    public function asMap(): array
    {
        $rows = $this->findAll();
        $map  = [];
        foreach ($rows as $r) {
            $map[$r['key']] = $r['value'];
        }

        return $map;
    }

    /**
     * Simpan / perbarui satu key.
     */
    public function put(string $key, ?string $value): void
    {
        $existing = $this->where('key', $key)->first();
        $data     = ['key' => $key, 'value' => $value, 'updated_at' => date('Y-m-d H:i:s')];

        if ($existing) {
            $this->update($existing['id'], $data);
        } else {
            $this->insert($data);
        }
    }
}
