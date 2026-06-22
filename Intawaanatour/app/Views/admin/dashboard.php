<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="grid stats" style="margin-bottom:26px">
  <div class="stat brand">
    <div class="ico"><svg class="ic" viewBox="0 0 24 24"><path d="M22 2 11 13M22 2l-7 20-4-9-9-4z"/></svg></div>
    <div class="num"><?= (int) $newBooking ?></div>
    <div class="lbl">Pemesanan Baru</div>
  </div>
  <div class="stat">
    <div class="ico"><svg class="ic" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="17" rx="2.5"/><path d="M3 9h18M8 2v4M16 2v4"/></svg></div>
    <div class="num"><?= (int) $totalBooking ?></div>
    <div class="lbl">Total Pemesanan</div>
  </div>
  <div class="stat">
    <div class="ico"><svg class="ic" viewBox="0 0 24 24"><path d="M3 18 21 6"/><path d="M3 14h4l2 4"/><path d="M21 6v6"/><circle cx="6" cy="18" r="1.6"/></svg></div>
    <div class="num"><?= (int) $totalTrips ?></div>
    <div class="lbl">Paket Trip</div>
  </div>
  <div class="stat">
    <div class="ico"><svg class="ic" viewBox="0 0 24 24"><path d="M5 3h11l3 3v15H5z"/><path d="M9 8h6M9 12h6M9 16h4"/></svg></div>
    <div class="num"><?= (int) $totalArticle ?></div>
    <div class="lbl">Artikel</div>
  </div>
  <div class="stat">
    <div class="ico"><svg class="ic" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2.5"/><circle cx="9" cy="9" r="2"/><path d="m21 16-5-5L5 21"/></svg></div>
    <div class="num"><?= (int) $totalGallery ?></div>
    <div class="lbl">Foto Galeri</div>
  </div>
</div>

<div class="card">
  <div class="page-head" style="margin-bottom:16px">
    <h2 style="font-size:16px">Pemesanan Terbaru</h2>
    <a class="btn btn-sm" href="<?= site_url('admin/bookings') ?>">Lihat semua</a>
  </div>

  <?php if (empty($recent)): ?>
    <div class="empty">
      <svg class="ic" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="17" rx="2.5"/><path d="M3 9h18M8 2v4M16 2v4"/></svg>
      <div>Belum ada pemesanan masuk.</div>
    </div>
  <?php else: ?>
    <div class="table-wrap"><table>
      <thead>
        <tr><th>Tanggal</th><th>Nama</th><th>Trip</th><th>Tgl Trip</th><th>Pax</th><th>Status</th></tr>
      </thead>
      <tbody>
        <?php foreach (array_slice($recent, 0, 8) as $b): ?>
          <tr>
            <td><?= esc(date('d M Y', strtotime($b['created_at'] ?? 'now'))) ?></td>
            <td><strong><?= esc($b['name']) ?></strong><br><span class="hint"><?= esc($b['phone']) ?></span></td>
            <td><?= esc($b['trip_title'] ?? '-') ?></td>
            <td><?= $b['trip_date'] ? esc(date('d M Y', strtotime($b['trip_date']))) : '-' ?></td>
            <td><?= esc($b['pax'] ?? '-') ?></td>
            <td><span class="badge-st st-<?= esc($b['status']) ?>"><?= esc($b['status']) ?></span></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table></div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
