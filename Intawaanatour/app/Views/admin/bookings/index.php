<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="page-head">
  <h2>Pemesanan</h2>
</div>

<div class="card">
  <?php if (empty($bookings)): ?>
    <div class="empty">
      <svg class="ic" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="17" rx="2.5"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>
      <div>Belum ada pemesanan masuk.</div>
    </div>
  <?php else: ?>
    <div class="table-wrap"><table>
      <thead>
        <tr><th>Tanggal</th><th>Pemesan</th><th>Trip</th><th>Detail</th><th>Status</th><th>Aksi</th></tr>
      </thead>
      <tbody>
        <?php foreach ($bookings as $b): ?>
          <tr>
            <td><?= esc(date('d M Y', strtotime($b['created_at'] ?? 'now'))) ?></td>
            <td>
              <strong><?= esc($b['name']) ?></strong><br>
              <span class="hint">
                <a href="https://wa.me/<?= esc(preg_replace('/[^0-9]/', '', $b['phone'])) ?>" target="_blank"><?= esc($b['phone']) ?></a>
                <?php if (! empty($b['email'])): ?><br><?= esc($b['email']) ?><?php endif; ?>
              </span>
            </td>
            <td><?= esc($b['trip_title'] ?? '-') ?></td>
            <td>
              <span class="hint">
                Tgl: <?= $b['trip_date'] ? esc(date('d M Y', strtotime($b['trip_date']))) : '-' ?><br>
                Pax: <?= esc($b['pax'] ?? '-') ?>
              </span>
              <?php if (! empty($b['message'])): ?>
                <div style="margin-top:6px;max-width:240px"><?= esc($b['message']) ?></div>
              <?php endif; ?>
            </td>
            <td><span class="badge-st st-<?= esc($b['status']) ?>"><?= esc($b['status']) ?></span></td>
            <td class="actions">
              <?php foreach ($statuses as $s): ?>
                <?php if ($s !== $b['status']): ?>
                  <a class="btn btn-sm" href="<?= site_url('admin/bookings/' . $b['id'] . '/status/' . $s) ?>"
                     title="Tandai sebagai <?= esc($s) ?>"><?= esc(ucfirst($s)) ?></a>
                <?php endif; ?>
              <?php endforeach; ?>
              <a class="btn btn-sm btn-danger" href="<?= site_url('admin/bookings/' . $b['id'] . '/delete') ?>"
                 onclick="return confirm('Hapus pemesanan ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table></div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
