<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="page-head">
  <h2>Paket Trip</h2>
  <a class="btn btn-primary" href="<?= site_url('admin/trips/new') ?>">+ Tambah Trip</a>
</div>

<div class="card">
  <?php if (empty($trips)): ?>
    <div class="empty">
      <svg class="ic" viewBox="0 0 24 24"><path d="M3 18 21 6"/><path d="M3 14h4l2 4"/><path d="M21 6v6"/><circle cx="6" cy="18" r="1.6"/></svg>
      <div>Belum ada paket trip. <a href="<?= site_url('admin/trips/new') ?>">Tambah sekarang</a>.</div>
    </div>
  <?php else: ?>
    <div class="table-wrap"><table>
      <thead>
        <tr><th>Cover</th><th>Judul</th><th>Tipe</th><th>Harga</th><th>Status</th><th>Urut</th><th></th></tr>
      </thead>
      <tbody>
        <?php foreach ($trips as $t): ?>
          <tr>
            <td><img class="thumb" src="<?= img_url($t['cover_image']) ?>" alt=""></td>
            <td>
              <strong><?= esc($t['title_id']) ?></strong><br>
              <span class="hint"><?= esc($t['slug']) ?></span>
            </td>
            <td><?= esc(ucfirst($t['type'])) ?></td>
            <td><?= esc(rupiah($t['price'])) ?></td>
            <td>
              <?php if ($t['is_active']): ?>
                <span class="badge-st st-confirmed">Aktif</span>
              <?php else: ?>
                <span class="badge-st st-cancelled">Nonaktif</span>
              <?php endif; ?>
              <?php if ($t['is_featured']): ?><span class="badge-st st-new">Unggulan</span><?php endif; ?>
            </td>
            <td><?= (int) $t['sort_order'] ?></td>
            <td class="actions">
              <a class="btn btn-sm" href="<?= site_url('admin/trips/' . $t['id'] . '/edit') ?>">Edit</a>
              <a class="btn btn-sm btn-danger" href="<?= site_url('admin/trips/' . $t['id'] . '/delete') ?>"
                 onclick="return confirm('Hapus trip ini beserta galerinya?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table></div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
