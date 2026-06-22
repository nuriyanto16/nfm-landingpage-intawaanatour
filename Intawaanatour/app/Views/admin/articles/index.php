<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="page-head">
  <h2>Artikel</h2>
  <a class="btn btn-primary" href="<?= site_url('admin/articles/new') ?>">+ Tulis Artikel</a>
</div>

<div class="card">
  <?php if (empty($articles)): ?>
    <div class="empty">
      <svg class="ic" viewBox="0 0 24 24"><path d="M5 3h11l3 3v15H5z"/><path d="M9 8h6M9 12h6M9 16h4"/></svg>
      <div>Belum ada artikel. <a href="<?= site_url('admin/articles/new') ?>">Tulis sekarang</a>.</div>
    </div>
  <?php else: ?>
    <div class="table-wrap"><table>
      <thead>
        <tr><th>Cover</th><th>Judul</th><th>Penulis</th><th>Status</th><th>Tanggal</th><th></th></tr>
      </thead>
      <tbody>
        <?php foreach ($articles as $a): ?>
          <tr>
            <td><img class="thumb" src="<?= img_url($a['cover_image']) ?>" alt=""></td>
            <td>
              <strong><?= esc($a['title_id']) ?></strong><br>
              <span class="hint"><?= esc($a['slug']) ?></span>
            </td>
            <td><?= esc($a['author'] ?: '-') ?></td>
            <td>
              <?php if ($a['is_published']): ?>
                <span class="badge-st st-confirmed">Terbit</span>
              <?php else: ?>
                <span class="badge-st st-done">Draft</span>
              <?php endif; ?>
            </td>
            <td><?= $a['published_at'] ? esc(date('d M Y', strtotime($a['published_at']))) : '-' ?></td>
            <td class="actions">
              <a class="btn btn-sm" href="<?= site_url('admin/articles/' . $a['id'] . '/edit') ?>">Edit</a>
              <a class="btn btn-sm btn-danger" href="<?= site_url('admin/articles/' . $a['id'] . '/delete') ?>"
                 onclick="return confirm('Hapus artikel ini?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table></div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
